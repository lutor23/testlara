<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;


class Team extends Model
{

    /**
     * Enable soft delete in the model
     */
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['dashboards'];

    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teams';

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
    protected $fillable = ['name', 'director_id'];


    function getTagListAttribute () { 
        $teams = Team::pluck('name','id');
    }
   

    /**
    * get the user who created this Team
    */
    public function User()
    {
      return $this->belongsTo('App\User');
    }


    /**
     * Gets the dashboard associated with current team
     */
    public function dashboards() { 
        return $this->hasMany('App\Dashboard');
    }

    public function director() { 
        return $this->belongsTo('App\Director');
    }


    /**
    * Get the count of warning widgets aggregated by team level
    */
    public function getWarningCountAttribute() { 
        $res=array('success'=>0, 'info'=>0, 'warning'=>0, 'critical'=>0);

        foreach ($this->dashboards as $dashboard) { 
            foreach ($dashboard->warning_count as $warn_level=>$warn_level_value) { 
                $res[$warn_level]=$res[$warn_level]+$warn_level_value;
            }
        }
        
        return $res;
    }


}
