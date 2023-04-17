<?php

namespace App\Http\Repositories\Web\Customer;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Http\Interfaces\Web\Customer\ProductInterface;

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
        return Product::with([
            Product::IMAGES => function($query) {$query->select('product_id', 'url');},
            Product::CATEGORY => function($query) {$query->select('categories.id', 'name_en');},
        ])->select('id', 'name_en','name_ar', 'price',
            'stock', 'description', 'brand', 'status',
            'category_id','stock','slug'
        )->where('products.id', $id)->first();
    }

    public function getProductBySlug($request, $slug)
    {
        return Product::with([
            Product::IMAGES => function($query) {$query->select('product_id', 'url');},
            Product::CATEGORY => function($query) {$query->select('id', 'name_en');},
        ])->select('id', 'name_en','name_ar', 'price',
            'stock', 'description', 'brand', 'status',
            'category_id','stock','slug'
        )->where('slug', $slug)->first();
    }

    public function getProductsByCategoryID(int $category_id): Collection
    {
        $leafCategories_ids=[];
        $this->categoryRepository->getLeafCategoriesByID(
            $category_id,$leafCategories_ids
        );

        return Product::with(Product::POSTER, Product::CATEGORY)
            ->whereIn('category_id', $leafCategories_ids)->get();
    }
    public function getProductsByCategorySlug(string $category_slug): Collection
    {
        $leafCategories_ids=[];
        $this->categoryRepository->getLeafCategoriesBySlug(
            $category_slug,$leafCategories_ids
        );

        return Product::with(Product::POSTER, Product::CATEGORY)
            ->whereIn('category_id', $leafCategories_ids)->get();
    }
    public function allProducts(){
        return Product::all();
    }





}
