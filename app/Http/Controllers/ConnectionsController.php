<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Connection;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;

class ConnectionsController extends Controller
{

   /**
     * Authenticate before using controller
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>"index"]);
    }

    
    /**
     * Validates the connection to the passed database
     * @return  true or error message
     */
    public function validateConn(Request $request) { 


        $req = $request->all();

         $conn=array(
            'driver'    => $req['dbtype'],
            'host'      => $req['host'],
            'database'  => $req['dbname'],
            'username'  => $req['username'],
            'password'  => $req['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        );           

        if ($req['dbtype']=='oracle') { 
            $conn['database']='';
            $conn['service_name']=$req['dbname'];
        }

        \Config::set('database.connections.'.$req['name'], $conn);

        try 
        {
            $db=\DB::connection($req['name'])->getPdo();
        } catch(\PDOException $e) { 
            return $e->getMessage();
        }     
        
        return 1;

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $connections = Connection::paginate(25);

        return view('connections.index', compact('connections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('connections.create');
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
        
        $res=$this->validateConn($request);    
        if ($res!=1) { 
            return redirect()->back()->withInput()->withErrors(['error' => $res]);
        }

        $req = $request->all();
        $req['password']=encrypt($req['password']);

        $connection=new Connection($req);
        Auth::user()->connections()->save($connection);

        Session::flash('flash_message', 'Connection '. $req['name']. ' added!');


        return redirect('connections');
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
        $connection = Connection::findOrFail($id);

        return view('connections.show', compact('connection'));
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
        $connection = Connection::findOrFail($id);

        if (Auth::user()->id!=$connection->user_id) { 
            Session::flash('flash_message', 'Only creator ('. User::find($connection->user_id)->name.') can modify this item');
            Session::flash('alert-type', 'error');
            return redirect('connections');            
        } 


        return view('connections.edit', compact('connection'));
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
        
        $res=$this->validateConn($request);    
        if ($res!=1) { 
            return redirect()->back()->withInput()->withErrors(['error' => $res]);
        }

        $req = $request->all();
        $req['password']=encrypt($req['password']);

        
        $connection = Connection::findOrFail($id);
        $connection->update($req);

        Session::flash('flash_message', 'Connection ' . $connection->name . ' updated!');


        return redirect('connections');
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

        $connection = Connection::findOrFail($id);
        if (Auth::user()->id!=$connection->user_id) { 
            Session::flash('flash_message', 'Only the owner ('. User::find($connection->user_id)->name.') of this item can modify it.');
            Session::flash('alert-type', 'error');
            return redirect('connections');            
        } 


        Connection::destroy($id);

        Session::flash('flash_message', 'Connection deleted!');
        

        return redirect('connections');
    }
}
