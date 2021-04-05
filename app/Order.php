<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
    'user_id',
    'invoice_code',
    'address_id',
    'product_id',
    'quantity',
	'status_id',
    'payment_id',

    ];
}
