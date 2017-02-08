<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Url extends Model
{

    /**
     * Enable soft delete in the model
     */
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    use Searchable;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'urls';

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
    protected $fillable = ['title', 'url', 'team_id', 'description'];


    /**
    * get the user who created this Url
    */
    public function User()
    {
      return $this->belongsTo('App\User');
    }


    /**
    * get the datasource for this widget
    */
    public function team()
    {
        return $this->belongsTo('App\Team');
    }


    public function folders() 
    {
        return $this->belongsToMany('App\Folder')->withTimestamps();
    }
    
    /**
     * Gets the selected folders ids associated with the url
     */
    public function getFolderListAttribute() 
    { 
        return $this->folders->pluck('id')->toArray();
    }

}


