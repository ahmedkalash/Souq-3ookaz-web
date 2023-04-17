<?php

namespace App\Models;

use App\Models\Traits\CategoryRelationshipsTrait;
use App\Models\Traits\getTableNameStaticallyTrait;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name_en
 * @property int|null $poster_id
 * @property string $name_ar
 * @property string $slug
 * @property-read \App\Models\Image|null $poster
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category wherePosterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{

    use HasFactory;
    use CategoryRelationshipsTrait, getTableNameStaticallyTrait;
    use Sluggable;
    protected $fillable = [
        'name_ar',
        'poster_id',
        'name_en',
        'slug',
        'parent_id'
    ];
    static $POSTER='poster';
    static $PRODUCTS='products';




    public static function getAllProductsForShow($category_id){
        $prod = 'prod';
        $cat = 'cat';
        $poster = 'poster';
        $category_name_ar = 'category_name_ar';

        $allProducts = Category::find($category_id,["name_ar as $category_name_ar"])->toArray();

        $allProducts['products']= DB::query()->select([
            "$prod.name_ar as product_name_ar",
            "$prod.price",
            "$poster.url as $poster"
            ])->from(Category::getTableName(), $cat)
            ->join(Product::getTableName()." as $prod",
                "$prod.category_id",'=',"$cat.id")
            ->join(Image::getTableName()." as $poster",
                     "$poster.id",'=',"$prod.poster_id")
            ->where("$cat.id",'=',$category_id)
            ->get();

            return $allProducts;

    }
    public static function getAllCategoriesForShow(): array
    {
        $allCategories = Category::with(static::$POSTER)->get([
            'id',
            'name_en',
            'name_ar' ,
            'poster_id',
        ])->toArray();


        foreach ($allCategories as &$category){
            $category['poster']= $category['poster'] ? $category['poster']['url']:null;
            unset($category['poster_id']);
        }

        return $allCategories;
    }



    public static function getCategoryRule(){
        return [
            'id'=>'exists:categories,id'
        ];
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

