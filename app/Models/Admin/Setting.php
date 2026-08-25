<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'tagline',
        'logo',
        'favicon',
        'address',
        'phone',
        'whatsapp',
        'email',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'tiktok_url',
        'footer_about',
        'meta_description',
    ];
 
    // সবসময় একটাই রো (id = 1) — না থাকলে ডিফল্ট ভ্যালু দিয়ে বানিয়ে ফেলে
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'site_name' => 'ShopKori',
        ]);
    }
}