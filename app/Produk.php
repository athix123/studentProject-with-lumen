<?php

namespace App;


use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Produk extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'produk';

    protected $fillable = [
        'judul', 'harga', 'gambar', 'deskripsi'
    ];

    public function kategori() {
        return $this->belongsTo('App\Kategori');
    }

}