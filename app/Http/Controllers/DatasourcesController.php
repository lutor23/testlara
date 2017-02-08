<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Datasource;
use Illuminate\Http\Request;
use Response;

use Session;
use App\CacheDatasourceStats;

use App\Connection;
use Auth;
use App\User;


class DatasourcesController extends Controller
{

    /**
     * Authenticate before using controller
     */

    public function __construct()
    {
        $this->middleware('auth', ['except'=>"index"]);
    }
    

    /**
     * Validates the URL or SQL and  return proper JSON output
     */
    public function validateParam(Request $request) { 
        $req = $request->all();

        if ($req['ds_type']=='json') 
        { 
            // $json = file_get_contents($req['param']);
            // $jsonerror="Error: JSON output is invalid.";

            $ch = curl_init($req['param']);
            curl_setopt($ch, CURLOPT_TIMEOUT,$req['timeout']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            $json = curl_exec($ch);
            $json=str_replace(array("\n","\r","\t","  "), "", $json);
            
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error_msg=curl_error($ch);

            if ($httpcode!=200) { 
                $jsonerror="HTTP_code: $httpcode. Error: $error_msg.";
            }
           
            curl_close($ch); 

        } 
        else if ( $req['ds_type']=='dbconnection' ) 
        { 
        
            $this->validate($request, [
                'connection_id' => 'required|numeric'
            ]);

            $conn = Connection::findOrFail($req['connection_id']);
            $json = $conn->runquery($req['param']);
        }

        //clean up special characters in json
        $json=str_replace(array("\n","\r","\t","  "), "", $json);
        

        if (json_decode($json)) {
            return $json;
        } else {
            http_response_code(500);
            if ($req['ds_type']=='json') { 
                if ($json=='[]') {
                    $jsonerror='Empty dataset []';
                }
                return Response($jsonerror,500);
            } else {
                if ($json=='[]') { 
                    //no records matching but sql is good
                    $results=$results2=$ret=array();
                    preg_match("/select (.*) from (.*)/", str_replace("\n","",strtolower($req['param'])), $results);
                    $results2=explode(",",str_replace(" ","",$results[1]) );

                    foreach($results2 as $res) { 
                        $ret[0][$res]='';
                    }

                    return collect($ret)->toJson();
                } else {
                    return Response($json,500);
                }
            }
        }
    }


    /**
     * Sync up the datasource 
     */
    public function sync($id) { 

        $datasource = Datasource::findOrFail($id);
        $datasource->syncnow();
        
        return $this->index();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $datasources = Datasource::paginate(25);

        return view('datasources.index', compact('datasources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $connectionsList = Connection::pluck('name','id')->toArray(); 
        return view('datasources.create', compact('connectionsList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required|min:3',
			'param' => 'required',
			'refresh' => 'numeric|required'
		]);
        $req = $request->all();

        if (empty($req['connection_id'])) {
            unset($req['connection_id']);    
        }

        if (empty($req['timeout'])) {
            $req['timeout']=60;    
        }

        $datasource=new Datasource($req);
        Auth::user()->datasources()->save($datasource);
  
        // $datasource=Datasource::create($req);

        $cacheds = new CacheDatasourceStats;
        $cacheds->output=str_replace(array("\n","\r","\t","  "), "", $req['jsonoutput']); 
        $cacheds->datasource_id=$datasource['id'];
        $cacheds->save();

        Session::flash('flash_message', 'Datasource added!');
        
        return redirect('datasources');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $datasource = Datasource::findOrFail($id);

        return view('datasources.show', compact('datasource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $datasource = Datasource::findOrFail($id);
        $connectionsList = Connection::pluck('name','id')->toArray(); 
        
        if (Auth::user()->id!=$datasource->user_id) { 
            Session::flash('flash_message', 'Only creator ('. User::find($datasource->user_id)->name.') can modify this item');
            Session::flash('alert-type', 'error');
            return redirect('datasources');            
        } 


        return view('datasources.edit', compact('datasource', 'connectionsList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
			'name' => 'required|min:3',
			'param' => 'required',
			'refresh' => 'numeric|required'
		]);
        $requestData = $request->all();
        
        if (empty($requestData['connection_id'])) {
            unset($requestData['connection_id']);    
        }

        if ($requestData['ds_type']=='dbconnection') {
            $this->validate($request, [
                'connection_id' => 'required|numeric'
            ]);
        }

        
        $datasource = Datasource::findOrFail($id);
        $datasource->update($requestData);

        $cacheds = new CacheDatasourceStats;
        $cacheds->output=str_replace(array("\n","\r","\t","  "), "", $requestData['jsonoutput']); 
        $cacheds->datasource_id=$id;
        $cacheds->save();


        Session::flash('flash_message', 'Datasource updated!');

        return redirect('datasources');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $datasource = Datasource::findOrFail($id);
        if (Auth::user()->id!=$datasource->user_id) { 
            Session::flash('flash_message', 'Only the owner ('. User::find($datasource->user_id)->name.') of this item can delete it.');
            Session::flash('alert-type', 'error');
            return redirect('widgets');            
        } 

        Datasource::destroy($id);

        Session::flash('flash_message', 'Datasource deleted!');

        return redirect('datasources');
    }



}
