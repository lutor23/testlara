<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use DB;
use App\chartoptions;

class Widget extends Model
{

    use Searchable;


    /**
     * Enable soft delete in the model
     */
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'widgets';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'datasource_id', 'detail', 'additional_detail', 'infobox_level', 'infobox_type', 
    'icon', 'size', 'threshold_operator', 'threshold_value', 'moreinfo_url', 'groupby_field', 
    'groupby_operator', 'groupby_opfield', 'units', 'chart_category', 'chart_type', 'chart_library', 'chart_labels', 'chart_values',
    'chart_dataset', 'chart_dimensionx', 'chart_dimensiony', 'chart_responsive'];


    /**
    * get user for this widget
    */
    public function User()
    {
      return $this->belongsTo('App\User');
    }


   /**
    * get the datasource for this widget
    */
   public function datasource()
    {
    return $this->belongsTo('App\Datasource');

    }

    /**
     * get the dashboard associated with this widget
     */
    public function dashboards() 
    {
        return $this->belongsToMany('App\Dashboard');
    }


    /**
     * get the rules associated with this widget
     */
    public function rules() 
    {
        return $this->hasMany('App\Rule');
    }


    /**
     * runs the specified groupby query in widget and returns aggregated array of results
     */
    public function getGroupbyArrayAttribute() { 

        if ($this->infobox_type!='infoboxcounter') return 0;

        $datasource_id=$this->datasource_id;
        
        $field=$this->groupby_field;
        $operator=$this->groupby_operator;
        $sumfield=$this->groupby_opfield;


        if ($operator=='sum') { 
            $sum_extract_field=",json_extract_path_text(elements, '$sumfield') as sumfield ";
            $count="sum(sumfield::integer)";
            $tag="($sumfield)";          
        } else {
            $sum_extract_field='';
            $count="count(*)";
            $tag='';
            $asCount='as count';
        }

        $query="
        select field, $count as fieldvalue from 
            (   select  json_extract_path_text(elements, '$field') as field  $sum_extract_field
                        from  
                        (   
                            select json_array_elements(output) as elements  from 
                                (   select output from cache_datasource_stats 
                                    where datasource_id = $datasource_id 
                                    order by created_at desc limit 1
                                ) as q0
                        ) as q1
            ) as q2 
        group by field order by $count desc";

        // return $query;

        $ret=(array) DB::select($query);
        $ret[0]['field']=(is_null($ret[0]['field'])?'count':$ret[0]['field']);

        return $ret;

    }


    /**
     * get a list of dashboard_id associated with current widget
     * @return array 
     */
    public function getDashboardListAttribute() 
    {   
       return $this->dashboards->pluck('id')->toArray();
   }


    /**
     * Gets the actual value of the detail field from the last collection
     */
    public function getDetailValueAttribute() 
    {
        return Datasource::find($this->datasource_id)->CacheDatasourceStats->last()->getDotValue($this->detail);
    }

    /**
     * Gets the actual value of the additional_detail field from the last collection
     */
    public function getAdditionaldetailValueAttribute() 
    {
        return Datasource::find($this->datasource_id)->CacheDatasourceStats->last()->getDotValue($this->additional_detail);
    }
    
    /**
     * Returns the warn level of the current widget based from the infotype, operator and last collection
     */
    public function getWarnStatusAttribute() 
    {

        $cache_name='widget_'.$this->id.'_warn_status';
        $minutes=5;

        $value = Cache::remember($cache_name, $minutes, function () {

            $value=Datasource::find($this->datasource_id)->CacheDatasourceStats->last()->getDotValue($this->detail);
            $threshold=$this->threshold_value;
            $operator=$this->threshold_operator;

            if ($this->infobox_level=='info') { 
                return 'info';
            }
            else 
            {

                if ($operator=='=') { 
                    $condition=($value == $threshold)?true:false;
                } else if ($operator=='>') { 
                    $condition=($value > $threshold)?true:false;
                } else if ($operator=='<') { 
                    $condition=($value < $threshold)?true:false;
                } else {
                    $condition=false;
                }

                if ($condition==false) { 
                    return 'success';
                } 
                else 
                {
                    return $this->infobox_level;
                }

            }

        });

        return $value;

        // $value=Datasource::find($this->datasource_id)->CacheDatasourceStats->last()->getDotValue($this->detail);
        // $threshold=$this->threshold_value;
        // $operator=$this->threshold_operator;

        // if ($this->infobox_level=='info') { 
        //     return 'info';
        // }
        // else 
        // {

        //     if ($operator=='=') { 
        //         $condition=($value == $threshold)?true:false;
        //     } else if ($operator=='>') { 
        //         $condition=($value > $threshold)?true:false;
        //     } else if ($operator=='<') { 
        //         $condition=($value < $threshold)?true:false;
        //     } else {
        //         $condition=false;
        //     }

        //     if ($condition==false) { 
        //         return 'success';
        //     } 
        //     else 
        //     {
        //         return $this->infobox_level;
        //     }

        // }
    }

    /**
     * gets the color of the widget based on the warn_status
     */
    public function getColorAttribute() 
    {
        switch($this->warn_status) {
            case 'critical':
            return 'red';
            case 'warning':
            return 'yellow';
            case 'success':
            return 'green';
            case 'info':
            return 'aqua';
        }   
    }


    /**
     * parses the icon attribute and returns full class
     */
    public function getIconClassAttribute() 
    {
        $array=explode('-', $this->icon);

        if ( $array[1]=='' ) {          
            //sets some default icon if nothing is set           
            $status=$this->warn_status;

            if (($status=='critical' or $status=='warning')) {
                return 'glyphicon glyphicon-warning-sign';
            } 
            else if ($status=='success') {
                return 'glyphicon glyphicon-thumbs-up';
            }
            else {
                return 'glyphicon glyphicon-info-sign';
            }
        } else {
            return $array[0]. " " . $this->icon;            
        }
    }


    /**
     * parses the icon attribute and returns full class
     */
    public function getJsonArrayAttribute() 
    {

        $json=Datasource::find($this->datasource_id)->last_collect;
        $array=json_decode($json, true);
        $headers=array_keys($array[0]);
        return array('headers'=>$headers, 'content'=>$array);
    } 


    /**
     * gets the  chart list for the selected category
     */
    public function getCharttypeListAttribute()
    {
        if ($this->chart_type!='') { 
            return DB::table('chartoptions')->select('charttype')
                        ->where($this->chart_category,1)
                        ->distinct()->orderby('charttype')->get()
                        ->pluck('charttype')
                        ->toArray();
        } else {
            return array();
        }
    }


    /**
     * gets the  chart library for the selected chart type
     */
    public function getChartlibraryListAttribute()
    {
        if ($this->chart_type!='') { 
            return DB::table('chartoptions')->select('library')
                        ->where($this->chart_category,1)
                        ->where('charttype', $this->chart_type)
                        ->distinct()->orderby('library')->get()
                        ->pluck('library')
                        ->toArray();
        } else {
            return array();
        }
    }



    public function chartpreview() 
    { 

        $req['title']=$this->title;
        $req['datasource_id']=$this->datasource_id;
        $req['category']=$this->chart_category;
        $req['type']=$this->chart_type;
        $req['library']=$this->chart_library;
        $req['labels']=$this->chart_labels;
        $req['values']=$this->chart_values;
        $req['dataset']=$this->chart_dataset;
        $req['dimensionx']=$this->chart_dimensionx;
        $req['dimensiony']=$this->chart_dimensiony;
        $req['responsive']=$this->chart_responsive;

        return ChartGenerate($req);
    }




}