<?php

namespace App\Models;

use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , Trans, SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(category::class)->withDefault();

    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function album()
    {
        return $this->hasMany(Image::class);
    }




    // public function getTransNameAttribute()
    // {

    //     if($this->name)
    //    {
    //     return json_decode($this->name , true)[app()->currentlocale()];
    //    }

    //    return $this->name;
    // }

    // public function getNameEnAttribute()
    // {

    //     if($this->name)
    //    {
    //     return json_decode($this->name , true)['en'];
    //    }

    //    return $this->name;
    // }

    // public function getNameArAttribute()
    // {

    //     if($this->name)
    //    {
    //     return json_decode($this->name , true)['ar'];
    //    }

    //    return $this->name;
    // }


}
