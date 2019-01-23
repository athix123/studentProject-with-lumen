<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Major extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
	use SoftDeletes;

    protected $table = 'major';
    protected $dates = ['deleted_at'];

    public function student()
    {
    	return $this->hasMany('App\Student');
    }

    public function skill()
    {
    	return $this->hasMany('App\Skill');
    }

}