<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Widget;
use App\Datasource;
use App\Dashboard;
use App\Rule;
use App\User;
use Illuminate\Http\Request;

use Session;
use DB;
use Auth;
use Charts;


class WidgetsController extends Controller
{

    /**
     * Authenticate before using controller
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>["index", "show", "showtable", "url", "preview", "previewfull"] ]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        $widgets = Widget::paginate(150);

        return view('widgets.index', compact('widgets'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function preview()
    {
        $widgets = Widget::paginate(150);

        return view('widgets.index2', compact('widgets'));
    }


    /**
     * Gets the chart options based on the filters
     * @param  Request $request 
     * @return array
     */
    public function getChartOptions(Request $request) 
    {
        $req=$request->all();

        return array_to_options( Chartoptions($req) );
    }


    public function chartPreview(Request $request) 
    {
        $req=$request->all();
        return ChartGenerate($req);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function showtable($id)
    {
        $widget = Widget::findOrFail($id);
        $widget->infobox_type='tablewidget';
        return view('widgets.preview', compact('widget'));
    }


    /**
     * Display a full preview of the listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function previewfull($id)
    {
        $widget = Widget::findOrFail($id);
        return view('widgets.preview', compact('widget'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        $datasource = Datasource::pluck('name','id')->toArray(); 
        $datasourceList=$datasource;

        $dashboards = Dashboard::pluck('title','id')->toArray(); 
        $datasourcedotList=[''];
        $groupbyfieldList=[''];
        $groupbysumfieldList=[''];
        $categoryL='';
        $charttypeList=$chartlibraryList=$fieldnameList=$fieldnamenumericList=[''];
        $widgetIcon='glyphicon-info-sign';
        $id='0';
        

        return view('widgets.create', compact('datasourceList', 'dashboards', 'datasourcedotList', 'widgetIcon', 
                                        'id', 'groupbyfieldList', 'groupbysumfieldList','categoryL','chartlibraryList', 
                                        'charttypeList','fieldnameList','fieldnamenumericList'));
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
			'datasource_id' => 'exists:datasources,id',
            'infobox_type' => 'required',
			'infobox_level' => 'required',
            'moreinfo_url' => 'url'
		]);

        $req = $request->all();


        //Store labels and values for multicolumn chart type        
        if ($req['chart_category']=='multicolumn') { 
            $req['chart_values']=json_encode(array("labels"=>$req['multiseriesName'],"values"=>$req['multiseriesField']));
        }
             
        $widget=new Widget($req);
        Auth::user()->widgets()->save($widget);

        $this->syncRules($widget->id, $req);

        if (!isset($req['dashboard_list'] )) $req['dashboard_list']=array();
        $widget->dashboards()->sync($req['dashboard_list']);
        

        Session::flash('flash_message', 'Widget added!');
        Session::flash('alert-type', 'success');

        return redirect('widgets');
    }



    /**
     * Sync the rules for the specified widget
     */
    public function syncRules($id, $req) 
    { 

        //Remove all existing rules (on updates)
        DB::table('rules')->where('widget_id', '=', $id)->delete();

        $i=0;
        $rules='';

        //Add all the rules if any.
        foreach ($req['rule_keyvalue'] as $rule) 
        {
            $keyvalue=$req['rule_keyvalue'][$i];
            $operator=$req['rule_operator'][$i];
            $threshold=$req['rule_threshold'][$i];
            $warnlevel=$req['rule_warnlevel'][$i];
            $newRule=array( "widget_id"=>$id, "keyvalue"=>$keyvalue, "operator"=>$operator,  "threshold"=>$threshold, "warnlevel"=>$warnlevel );

            if ( ($keyvalue!='') && ($operator!='') && ($threshold!='') && ($warnlevel!='') ) { 
                $rule=Rule::create($newRule);
                $rules.=$rule->id . ",";
            }

            $i++;
        }

        $rules=rtrim($rules,",");

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
        $widget = Widget::findOrFail($id);

        return view('widgets.show', compact('widget'));
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
        $datasourceList = Datasource::pluck('name','id');

        $dashboards = Dashboard::pluck('title','id')->toArray(); 

        $widget = Widget::findOrFail($id);

        if (Auth::user()->id!=$widget->user_id) { 
            Session::flash('flash_message', 'Only creator ('. User::find($widget->user_id)->name.') can modify this item');
            Session::flash('alert-type', 'error');
            return redirect('widgets');            
        } 

        $datasourcedotList=$widget->datasource->cachedatasourcestats->last()->datasource_dot;

        $groupbyfieldList=[''];
        $groupbysumfieldList=[''];
        $charttypeList=[];
        $chartlibraryList=[];
        $fieldnameList=[];
        $fieldnamenumericList=[];
        $categoryL='none';
        $widgetIcon=$widget->icon;
        $id=$widget->id;
       
        if ($widget->infobox_type=='infoboxcounter') { 
            $groupbyfield_lst=$widget->json_array['headers'];
            $groupbyfieldList=array(''=>'(none)', 'all'=>'(*)')+array_assoc($groupbyfield_lst);

            $groupbysumfieldList=array_assoc(DatasourceNumericFieldnames($widget->datasource_id));
        } elseif ($widget->infobox_type=='chart') {
            $charttypeList=array_assoc(Chartoptions(["category"=>$widget->chart_category]));
            $chartlibraryList=array_assoc(Chartoptions(["category"=>$widget->chart_category, "type"=>$widget->chart_type]));
            $fieldnameList=array_assoc(DatasourceFieldnames($widget->datasource_id));
            $fieldnamenumericList=array_assoc(DatasourceNumericFieldnames($widget->datasource_id));
            $categoryL=$widget->chart_category;
        }


        return view('widgets.edit', 
                compact('widget', 'datasourceList', 'dashboards', 'datasourcedotList', 
                        'widgetIcon','id', 'groupbyfieldList','groupbysumfieldList', 
                        'charttypeList', 'chartlibraryList', 'fieldnameList', 'fieldnamenumericList','categoryL') 
                    );
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
			'title' => 'required|min:3',
			'datasource_id' => 'required|integer',
			'infobox_type' => 'required'
		]);
        $req = $request->all();
        
        $widget = Widget::findOrFail($id);

        $widget->update($req);

        $this->syncRules($id, $req);

     
        if (!isset($req['dashboard_list'] )) $req['dashboard_list']=array();

        $widget->dashboards()->sync($req['dashboard_list']);

        Session::flash('flash_message', 'Widget updated!');
        Session::flash('alert-type', 'success');
        
        return redirect('widgets');
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

        $widget = Widget::findOrFail($id);
        if (Auth::user()->id!=$widget->user_id) { 
            Session::flash('flash_message', 'Only the owner ('. User::find($widget->user_id)->name.') of this item can modify it.');
            Session::flash('alert-type', 'error');
            return redirect('widgets');            
        } 

        Widget::destroy($id);

        Session::flash('flash_message', 'Widget ' . 'deleted!');
        Session::flash('alert-type', 'success');
        

        return redirect('widgets');
    }


    public function url($id) { 
        $widget = Widget::findOrFail($id);
        return view('widgets.framewidget', $widget);
    }
}
