<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Team;
use Illuminate\Http\Request;
use Session;
use App\Director;
use Auth;
use App\User;

class TeamController extends Controller
{
    
   /**
     * Authenticate before using controller
     */

    public function __construct()
    {
        $this->middleware('auth', ['except'=>"index"]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $team = Team::paginate(25);

        return view('team.index', compact('team'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $directors = Director::pluck('name','id')->toArray();
        $directorList=['Select director']+$directors;


        return view('team.create', compact('directorList'));
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
            'name' => 'required',
            'director_id' => 'exists:directors,id',
        ]);

        $req = $request->all();
        $team=new Team($req);
        Auth::user()->teams()->save($team);        
        
        Session::flash('flash_message', 'Team added!');

        return redirect('team');
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
        $team = Team::findOrFail($id);

        return view('team.show', compact('team'));
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
        $team = Team::findOrFail($id);

        $directors = Director::pluck('name','id')->toArray();
        $directorList=$directors;
        
        if (Auth::user()->id!=$team->user_id) { 
            Session::flash('flash_message', 'Only creator ('. User::find($team->user_id)->name.') can modify this item');
            Session::flash('alert-type', 'error');
            return redirect('team');            
        } 

        return view('team.edit', compact('team', 'directorList'));
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
        
        $team = Team::findOrFail($id);
        $team->update($requestData);

        Session::flash('flash_message', 'Team updated!');

        return redirect('team');
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


        $team = Team::findOrFail($id);
        if (Auth::user()->id!=$team->user_id) { 
            Session::flash('flash_message', 'Only the owner ('. User::find($team->user_id)->name.') of this item can delete it.');
            Session::flash('alert-type', 'error');
            return redirect('team');            
        } 


        Team::destroy($id);

        Session::flash('flash_message', 'Team deleted!');

        return redirect('team');
    }
}
