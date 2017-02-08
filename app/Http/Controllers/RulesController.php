<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Rule;
use Illuminate\Http\Request;
use Session;
use App\Widget;

class RulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $rules = Rule::paginate(25);

        return view('rules.index', compact('rules'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function indexmin($id)
    {

        $widget = Widget::where('id', $id)->get();
        if (count($widget)<1) { 
            return view('rules.indexminerror', compact('rules'));

        } else {
            $rules = Rule::paginate(25);
            return view('rules.indexmin', compact('rules', 'id'));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('rules.create');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function createmin($id)
    {
        
        $widget = Widget::where('id', $id)->get();
        if (count($widget)<1) { 
            return 'Widget Id does not exist';
        } else {
            return view('rules.createmin', compact('id'));
        }

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
        
        $requestData = $request->all();
        
        Rule::create($requestData);

        Session::flash('flash_message', 'Rule added!');

        return redirect('rules');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storemin(Request $request)
    {
        
        $requestData = $request->all();
       
        Rule::create($requestData);

        Session::flash('flash_message', 'Rule added!');

        return redirect('rules/min/'.$requestData['widget_id']);
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
        $rule = Rule::findOrFail($id);

        return view('rules.show', compact('rule'));
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
        $rule = Rule::findOrFail($id);

        return view('rules.edit', compact('rule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function editmin($id)
    {
        $rule = Rule::findOrFail($id);

        return view('rules.editmin', compact('rule'));
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
        
        $rule = Rule::findOrFail($id);
        $rule->update($requestData);

        Session::flash('flash_message', 'Rule updated!');

        return redirect('rules');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatemin($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $rule = Rule::findOrFail($id);
        $rule->update($requestData);

        Session::flash('flash_message', 'Rule updated!');

        return redirect('rules/min');
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
        Rule::destroy($id);

        Session::flash('flash_message', 'Rule deleted!');

        return redirect('rules');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroymin($id)
    {
        Rule::destroy($id);

        Session::flash('flash_message', 'Rule deleted!');

        return redirect("rules/min/$id");
    }



}
