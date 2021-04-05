<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food_rate extends Model
{
    protected $fillable=[
    'product_id',
    'user_id',
    'stars',
    'comment',
    ];
}
