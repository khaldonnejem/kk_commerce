<?php

namespace App\Models;


use App\Traits\Trans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;



class category extends Model
{
    use HasFactory , Trans;

    // protected $guarded = [];
    protected $fillable = ['name', 'image', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(category::class,'parent_id')->withDefault();
    }

    public function children()
    {
        return $this->hasMany(category::class,'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
