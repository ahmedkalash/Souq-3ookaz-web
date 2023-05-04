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
        $product = Product::with([
            Product::IMAGES => function($query) {$query->select('product_id', 'url');},
            Product::CATEGORY => function($query) {$query->select('categories.id', 'name_en');},
            Product::REVIEWS,
            Product::INFO
        ])->select('id', 'name_en','name_ar', 'price',
            'stock', 'description', 'brand', 'status',
            'category_id','stock','slug','long_description'
        )->where('products.id', $id)->first();

        $product->reviews->average_rating =number_format( $product->reviews->average('rating')??0, 2);
        // Group the reviews by rating
        $grouped = $product->reviews->groupBy('rating');
        // Calculate the percentage for each rating
        $product->reviews->percentages = $grouped->map(function ($group) use ($product) {
            return $product->reviews->count()==0? 0 : number_format(($group->count() / $product->reviews->count() * 100), 2);
        })->toArray();
        $product->reviews->groupBy('user_id');

        return $product;

    }

    public function getProductBySlug($request, $slug)
    {
        return $this->getProductById($request,Product::where('slug',$slug)->first()->id);
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

        $products= Product::with(Product::POSTER, Product::CATEGORY,Product::REVIEWS)
            ->whereIn('category_id', $leafCategories_ids)->get();
         foreach ($products as $product){
            $product->reviews->average_rating =number_format( $product->reviews->average('rating'), 2);
        }
         return $products;
    }
    public function allProducts(){
        $products=Product::with(Product::POSTER, Product::CATEGORY,Product::REVIEWS)->get();
        foreach ($products as $product){
            $product->reviews->average_rating =number_format( $product->reviews->average('rating'), 2);
        }
        return $products;
    }





}
