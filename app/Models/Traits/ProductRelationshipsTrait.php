<?php

namespace App\Models\Traits;

use App\Models\Category;
use App\Models\Image;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ProductRelationshipsTrait
{
    public function poster(){
        return  $this->belongsTo(Image::class,'poster_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

     public function reviews(){
        return $this->hasMany(ProductReview::class);
    }



}
