<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;



class Folder extends Model
{
     /**
     * Enable soft delete in the model
     */
    use SoftDeletes, CascadeSoftDeletes;

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['urls'];

    //

	protected $fillable = ['name'];

    public function urls() 
    {
    	return $this->belongsToMany('App\Url')->withTimestamps();
    }
}
