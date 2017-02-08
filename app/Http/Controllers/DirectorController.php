<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Director;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\User;



class DirectorController extends Controller
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
        $director = Director::paginate(25);

        return view('director.index', compact('director'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('director.create');
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
        
        $req = $request->all();
        $director=new Director($req);
        Auth::user()->directors()->save($director);

        Session::flash('flash_message', 'Director added!');

        return redirect('director');
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
        $director = Director::findOrFail($id);    
        return view('director.show', compact('director'));
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
        $director = Director::findOrFail($id);

        if (Auth::user()->id!=$director->user_id) { 
            Session::flash('flash_message', 'Only creator ('. User::find($director->user_id)->name.') can modify this item');
            Session::flash('alert-type', 'error');
            return redirect('director');            
        } 

        return view('director.edit', compact('director'));
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
        
        $director = Director::findOrFail($id);
        $director->update($requestData);

        Session::flash('flash_message', 'Director updated!');

        return redirect('director');
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

        $director = Director::findOrFail($id);
        if (Auth::user()->id!=$director->user_id) { 
            Session::flash('flash_message', 'Only the owner ('. User::find($director->user_id)->name.') of this item can delete it.');
            Session::flash('alert-type', 'error');
            return redirect('director');            
        } 

        Director::destroy($id);

        Session::flash('flash_message', 'Director deleted!');

        return redirect('director');
    }
}
