<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
    'image',
    'name',
    'cat',
    'id',
    'price',
    'desc',

    ];
}
