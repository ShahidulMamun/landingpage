<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'old_price',
        'image',
        'badge',
        'stock',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function discountPercent(): ?int
    {
        if (!$this->old_price || $this->old_price <= $this->price) {
            return null;
        }
        return (int) round((($this->old_price - $this->price) / $this->old_price) * 100);
    }
}