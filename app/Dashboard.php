<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Dashboard extends Model
{
    use Searchable;

    /**
     * Enable soft delete in the model
     */
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['widgets'];


    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dashboards';

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
    protected $fillable = ['title', 'team_id'];


    /**
    * get user for this dashboard
    */
    public function User()
    {
      return $this->belongsTo('App\User');
    }


    /**
    * get the datasource for this widget
    */
    public function widgets()
    {
        return $this->belongsToMany('App\Widget');
    }


    /**
     * Get the team associated with the dashboard
     */
    public function team() { 
        return $this->belongsTo('App\Team');
    }

    /**
     * returns counter of warn level 
     */
    public function getWarningCountAttribute() { 
        $res=array('success'=>0, 'info'=>0, 'warning'=>0, 'critical'=>0);

        foreach ($this->widgets as $widget) { 
            $res[$widget->warn_status]++;   
        }
        
        return $res;
    }


    /**
     * returns an ordered list of widgets
     */
    public function getArrangedWidgetsAttribute() { 
        
        $arrange=$ret=$res=array();
        foreach ($this->widgets as $widget) { 

            if ($widget->warn_status=='critical')
            {
               $arrange['critical'][]=$widget;
            }
            else if ($widget->warn_status=='warning')
            {
                $arrange['warning'][]=$widget;
            }
            else if ($widget->warn_status=='success')
            {
                $arrange['success'][]=$widget;
            }
            else 
            {
                $arrange['info'][]=$widget;
            }
        }

        
        $orderby = array('critical', 'warning', 'success', 'info');

        $OrderedArray = array_merge(array_flip($orderby), $arrange);
        foreach ($OrderedArray as $order=>$val) { 
            if (!is_integer($val)) {
                $ret[]=$val;
            }
        }

        if (count($ret)>0) { 
            $res=call_user_func_array('array_merge', $ret);
        }
        return $res;

    }



}
