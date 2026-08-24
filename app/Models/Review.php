<?php

namespace App\Models;
use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
     protected $fillable = [
        'product_id',
        'customer_name',
        'city',
        'rating',
        'comment',
        'status',
    ];
 
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
 
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
