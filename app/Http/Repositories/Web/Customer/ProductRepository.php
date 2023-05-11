<?php

namespace App\Http\Repositories\Web\Customer;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Http\Interfaces\Web\Customer\ProductInterface;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class ProductRepository implements ProductInterface
{
    public function __construct(
        protected CategoryInterface $categoryRepository
    ){}

    public static function GetProductByIdRules()
    {
        return[
            'id'=>'exists:products,id'
        ];
    }
    public static function GetProductBySlugRules()
    {
       return[
            'slug'=>'exists:products,slug'
        ];
    }

    public function getProductById($request, $id){
        $product = Product::with([
            Product::IMAGES => function($query) {$query->select('product_id', 'url');},
            Product::CATEGORY => function($query) {$query->select('categories.id', 'name_en');},
            Product::REVIEWS,
            Product::INFO
        ])->select('id', 'name_en','name_ar', 'price',
            'stock', 'description', 'brand', 'status',
            'category_id','stock','slug','long_description','average_rating'
        )->where('products.id', $id)->first();

        // Group the reviews by rating
        $grouped = $product->reviews->groupBy('rating');
        // Calculate the percentage for each rating
        $product->reviews->percentages = $grouped->map(function ($group) use ($product) {
            return $product->reviews->count()==0? 0 : number_format(($group->count() / $product->reviews->count() * 100), 2);
        })->toArray();
        return $product;

    }

    public function getProductBySlug($request, $slug)
    {
        return $this->getProductById($request,Product::where('slug',$slug)->first()->id);
    }

    public function getProductsByCategoryID(int $category_id)
    {
        $leafCategories_ids=[];
        $this->categoryRepository->getLeafCategoriesByID(
            $category_id,$leafCategories_ids
        );

        return Product::with(Product::POSTER, Product::CATEGORY, Product::REVIEWS)
            ->whereIn('category_id', $leafCategories_ids)->Paginate()->withQueryString();

    }
    public function getProductsByCategorySlug(string $category_slug)
    {
        return $this->getProductsByCategoryID(Category::whereSlug($category_slug)->get()->first()->id);
    }

    public function allProducts(){

//        dd(Product::with(Product::POSTER, Product::CATEGORY,Product::REVIEWS)->Paginate()
//            ->links());

        return Product::with(Product::POSTER, Product::CATEGORY,Product::REVIEWS)
            ->Paginate()->withQueryString();
    }





}
