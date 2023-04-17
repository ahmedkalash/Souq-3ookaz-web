<?php

namespace App\Models\Traits;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;

trait CategoryRelationshipsTrait
{
    public function poster(){
        return $this->belongsTo(Image::class, 'poster_id');
    }
    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id');
    }

    public function child(){
        return $this->hasMany(Category::class,'parent_id','id');
    }




}
