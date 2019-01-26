<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class OurWork extends Model 
{
	use SoftDeletes;

    protected $table = 'our_works';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'category', 'title', 'url_website', 'file'
    ];

    public $timestamps = false;


}