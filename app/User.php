<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * get the connections created by this user
     */
    public function connections()
    {
        return $this->hasMany('App\Connection');
    }

    /**
     * get the dashboards created by this user
     */
    public function dashboards()
    {
        return $this->hasMany('App\Dashboard');
    }

    /**
     * get the datasources created by this user
     */
    public function datasources()
    {
        return $this->hasMany('App\Datasource');
    }

    /**
     * get the directors created by this user
     */
    public function directors()
    {
        return $this->hasMany('App\Director');
    }

    /**
     * get the rules created by this user
     */
    public function rules()
    {
        return $this->hasMany('App\Rule');
    }

    /**
     * get the teams created by this user
     */
    public function teams()
    {
        return $this->hasMany('App\Team');
    }

    /**
     * get the urls created by this user
     */
    public function urls()
    {
        return $this->hasMany('App\Url');
    }

    /**
    * get the widgets for this user
    */
    public function widgets()
    {
        return $this->hasMany('App\Widget');
    }


}
