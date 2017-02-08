<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rules';

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
    protected $fillable = ['widget_id', 'keyvalue', 'operator', 'threshold', 'warnlevel'];

    
    /**
    * get the user who created this Rule
    */
    public function User()
    {
      return $this->belongsTo('App\User');
    }

}
