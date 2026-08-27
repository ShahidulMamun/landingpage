<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUSES = ['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'];
    const PAYMENT_STATUSES = ['unpaid', 'paid', 'refunded'];
    
    protected $fillable = [
        'order_group_id',
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
    
    public function groupSiblings()
    {
        if (!$this->order_group_id) {
            return static::query()->whereRaw('1 = 0');
        }
 
        return static::where('order_group_id', $this->order_group_id)
            ->where('id', '!=', $this->id);
    }
 
    public function isGrouped(): bool
    {
        return !is_null($this->order_group_id);
    }

}
