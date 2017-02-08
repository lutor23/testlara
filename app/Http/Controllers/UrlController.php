<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Url;
use Illuminate\Http\Request;
use Session;
use App\Folder;
use Auth;
use App\User;

class UrlController extends Controller
{
   /**
     * Authenticate before using controller
     */

    public function __construct()
    {
        $this->middleware('auth', ['except'=>["index", "showframe"]]);
    }


   /**
     * Display the specified resource, and render the url in an <object> tag
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function showframe($id)
    {
        $url = Url::findOrFail($id);

        return view('url.frame', compact('url'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $url = Url::paginate(25);

        return view('url.index', compact('url'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

       $folders = Folder::pluck('name','id')->toArray();
       $folder_list=array();
       
       return view('url.create', compact('folders', 'folder_list'));
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
            'url' => 'required|min:3',
            'team_id' => 'exists:teams,id',
            'description' => 'required|min:3',
            'folders' => 'required'
        ]);
        
        $req = $request->all();
        $url=new Url($req);
        Auth::user()->urls()->save($url);

        $folders=$request->input('folders');
        foreach ($folders as $folder) { 
            if (is_numeric($folder)) {
                $folderArr[]=$folder;
            }
            else {
                $newFolder=Folder::create(['name'=>$folder]);
                $folderArr[]=$newFolder->id;
            }
        }

        if (count($folderArr)>0) { 
            $url->folders()->sync($folderArr);
        }


        Session::flash('flash_message', 'Url added!');

        return redirect('url');
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
        $url = Url::findOrFail($id);

        return view('url.show', compact('url'));
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

        $url = Url::findOrFail($id);
        if (Auth::user()->id!=$url->user_id) { 
            Session::flash('flash_message', 'Only creator ('. User::find($url->user_id)->name.') can modify this item');
            Session::flash('alert-type', 'error');
            return redirect('urls');            
        }         
        $folders = Folder::pluck('name','id')->toArray();        
        $folder_list=$url->folder_list;

        return view('url.edit', compact('url', 'folders', 'folder_list'));
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
        
        $url = Url::findOrFail($id);
        $url->update($requestData);

        $folders=$request->input('folders');
        foreach ($folders as $folder) { 
            if (is_numeric($folder)) {
                $folderArr[]=$folder;
            }
            else {
                $newFolder=Folder::create(['name'=>$folder]);
                $folderArr[]=$newFolder->id;
            }
        }

        if (count($folderArr)>0) { 
            $url->folders()->sync($folderArr);
        }


        Session::flash('flash_message', 'Url updated!');

        return redirect('url');
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
        $url = Url::findOrFail($id);
        if (Auth::user()->id!=$url->user_id) { 
            Session::flash('flash_message', 'Only the owner ('. User::find($url->user_id)->name.') of this item can delete it.');
            Session::flash('alert-type', 'error');
            return redirect('urls');            
        } 

        Url::destroy($id);

        Session::flash('flash_message', 'Url deleted!');

        return redirect('url');
    }
}
