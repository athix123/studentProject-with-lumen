<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Tentang extends Model 
{

//	use SoftDeletes;

    protected $table = 'tentang';
    //protected $dates = ['deleted_at'];
    protected $fillable = [
        'deskripsi', 'gambar'
    ];

    public $timestamps = false;


}