<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;




class Director extends Model
{
    /**
     * Enable soft delete in the model
     */
    use SoftDeletes, CascadeSoftDeletes;

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['teams'];


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'directors';

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
    protected $fillable = ['name'];


    /**
    * get the user who created this Director
    */
    public function User()
    {
      return $this->belongsTo('App\User');
    }



    /**
     * Get the team associated with current director
     */
    public function teams() { 
        return $this->hasMany('App\Team');
    }
    

    /**
     * Get the count of warning widgets aggregated by director level
     */
    public function getWarningCountAttribute() { 
        $res=array('success'=>0, 'info'=>0, 'warning'=>0, 'critical'=>0);

        foreach ($this->teams as $team) { 
            foreach ($team->warning_count as $warn_level=>$warn_level_value) { 
                $res[$warn_level]=$res[$warn_level]+$warn_level_value;
            }
        }
        
        return $res;
    }


   /**
     * returns an ordered list of widgets
     */
    public function getArrangedWidgetsAttribute() { 
        
        $arrange=$ret=$res=array();

        foreach ($this->teams as $team) 
        { 
            foreach($team->dashboards as $dashboard) 
            {
                foreach ($dashboard->widgets as $widget) 
                { 

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

                } //foreach widget
            } //foreach dashboard
        } //foreach team

        
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
