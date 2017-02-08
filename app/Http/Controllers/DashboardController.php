<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Dashboard;
use Illuminate\Http\Request;
use Session;
use App\Team;
use App\Datasource;

use Auth;
use App\User;

class DashboardController extends Controller
{


    /**
     * Authenticate before using controller
     */

    public function __construct()
    {
        $this->middleware('auth', ['except'=>["index", "show"]]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dashboard = Dashboard::paginate(25);

        return view('dashboard.index', compact('dashboard'));
    
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

       $teams = Team::pluck('name','id')->toArray();
       $teamList=['Select team']+$teams;


        return view('dashboard.create', compact('teamList') );
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
            'title' => 'required|min:3',
            'team_id' => 'exists:teams,id'
        ]);
        
        $req = $request->all();
        $dashboard=new Dashboard($req);
        Auth::user()->dashboards()->save($dashboard);

        Session::flash('flash_message', 'Dashboard '. $req['title'] . ' added!');

        return redirect('dashboard');
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
        $dashboard = Dashboard::findOrFail($id);


        foreach ($dashboard->widgets as $widget) {

            // Get the datasource lastCollect
            $dslast=Datasource::find($widget->datasource_id)->CacheDatasourceStats->last();
                 
            $widget['detail_value']= $dslast->getDotValue($widget->detail);
            $widget['additional_detail_value']= $dslast->getDotValue($widget->additional_detail);
        }

        return view('dashboard.show', compact('dashboard'));
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
       $dashboard = Dashboard::findOrFail($id);
       $teams = Team::pluck('name','id')->toArray();
       $teamList=['Select team']+$teams;

        if (Auth::user()->id!=$dashboard->user_id) { 
            Session::flash('flash_message', 'Only creator ('. User::find($dashboard->user_id)->name.') can modify this item');
            Session::flash('alert-type', 'error');
            return redirect('dashboard');            
        } 



        return view('dashboard.edit', compact('dashboard', 'teamList'));
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
        
        $requestData = $request->all();
        
        $dashboard = Dashboard::findOrFail($id);
        $dashboard->update($requestData);

        Session::flash('flash_message', 'Dashboard '. $dashboard->title . ' updated!');
        

        return redirect('dashboard');
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
        
        $dashboard = dashboard::findOrFail($id);
        if (Auth::user()->id!=$dashboard->user_id) { 
            Session::flash('flash_message', 'Only the owner ('. User::find($dashboard->user_id)->name.') of this item can modify it.');
            Session::flash('alert-type', 'error');
            return redirect('dashboard');            
        } 

        Dashboard::destroy($id);

        Session::flash('flash_message', 'Dashboard deleted!');

        return redirect('dashboard');
    }
}
