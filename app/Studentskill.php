<?php

namespace App;


use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Studentskill extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'student_skills';

    protected $fillable = [
        'student_id', 'skill_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function student()
    {
    	return $this->belongsToMany('App\Student');
    }
}