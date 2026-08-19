<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUSES = ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'];
    const PAYMENT_STATUSES = ['unpaid', 'paid', 'refunded'];
    
    protected $fillable = [
        'product_id',
        'product_name',
        'unit_price',
        'quantity',
        'total_price',
        'customer_name',
        'phone',
        'address',
        'payment_method',
        'payment_status',
        'status',
    ];

}
