<?php

namespace App\Models;

use App\Models\Traits\getTableNameStaticallyTrait;
use App\Models\Traits\ProductRelationshipsTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Product
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name_en
 * @property string $name_ar
 * @property string $price
 * @property int $stock
 * @property string $description
 * @property string $brand
 * @property string $status
 * @property int|null $category_id
 * @property int|null $poster_id
 * @property string $slug
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Image|null $poster
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePosterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use ProductRelationshipsTrait, getTableNameStaticallyTrait;
    use HasFactory;
    use Sluggable;

    protected $with=['poster'];
    protected $fillable = [
        'name_en', 'name_ar', 'price', 'stock', 'description',
        'brand', 'status', 'category_id', 'poster_id','slug',
        'long_description'
    ];
    protected $hidden=[ 'created_at','updated_at','category_id','poster_id'];
    const POSTER = 'poster';
    const CATEGORY = 'category';
    const IMAGES = 'images';
    const REVIEWS = 'reviews';
    const INFO = 'info';
    public static function getAllForShow(): array
    {
        $allProducts = Product::with([static::POSTER])->get([
            'id',
            'name_en',
            'name_ar',
            'price',
            'poster_id'
            ]
        )->toArray();


        foreach ($allProducts as &$product){
            unset($product['poster_id']);

            $product['poster'] =  $product['poster'] ? $product['poster']['url']:null;

        }

        return $allProducts;
    }

    public function sluggable(): array
    {
        return [
             'slug' => [
                'source' => 'name_en'
            ]
        ];
    }





}
