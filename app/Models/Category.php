<?php

namespace App\Models;

use App\Models\Traits\CategoryRelationshipsTrait;
use App\Models\Traits\getTableNameStaticallyTrait;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Staudenmeir\LaravelCte\Eloquent\QueriesExpressions;


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
 * @property int|null $parent_id
 * @property string|null $icon_url
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, Category> $child
 * @property-read int|null $child_count
 * @property \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, Category> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Image|null $poster
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category breadthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category depthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category getExpressionGrammar()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category hasChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category hasParent()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category isLeaf()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category isRoot()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category newModelQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category newQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category query()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category tree($maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category treeOf(callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category whereDepth($operator, $value = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category whereIconUrl($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category whereId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category whereNameAr($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category whereNameEn($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category whereParentId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category wherePosterId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category whereSlug($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Category withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $ancestors The model's recursive parents.
 * @property-read int|null $ancestors_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $ancestorsAndSelf The model's recursive parents and itself.
 * @property-read int|null $ancestors_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $bloodline The model's ancestors, descendants and itself.
 * @property-read int|null $bloodline_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $childrenAndSelf The model's direct children and itself.
 * @property-read int|null $children_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $descendants The model's recursive children.
 * @property-read int|null $descendants_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $descendantsAndSelf The model's recursive children and itself.
 * @property-read int|null $descendants_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $parentAndSelf The model's direct parent and itself.
 * @property-read int|null $parent_and_self_count
 * @property-read Category|null $rootAncestor The model's topmost parent.
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $siblings The parent's other children.
 * @property-read int|null $siblings_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection|Category[] $siblingsAndSelf All the parent's children.
 * @property-read int|null $siblings_and_self_count
 * @mixin \Eloquent
 */
class Category extends Model
{

    use HasFactory;
    use CategoryRelationshipsTrait, getTableNameStaticallyTrait;
    use Sluggable;
    use QueriesExpressions;
    use HasRecursiveRelationships;

    protected $fillable = [
        'name_ar',
        'poster_id',
        'name_en',
        'slug',
        'parent_id',
        'icon_url'
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

