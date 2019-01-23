<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Founder extends Model implements AuthenticatableContract, AuthorizableContract
{
	use Authenticatable, Authorizable;
//	use SoftDeletes;

    protected $table = 'founder';
    //protected $dates = ['deleted_at'];
    protected $fillable = [
        'description', 'file'
    ];

    public $timestamps = false;
}