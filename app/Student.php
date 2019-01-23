<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    use SoftDeletes;

    protected $table = 'students';
    protected $dates = ['deleted_at'];

    public function skill()
    {
    	return $this->hasMany('App\Skill');
    }

    public function character()
    {
        return $this->hasMany('App\Character');
    }

    public function major()
    {
    	return $this->belongsTo('App\Major');
    }

    public function studentSkill()
    {
    	return $this->hasMany('App\Studentskill');
    }

    public function studentChar()
    {
        return $this->hasMany('App\StudentChar');
    }

}