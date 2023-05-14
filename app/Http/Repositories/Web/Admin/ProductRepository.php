<?php

namespace App\Http\Repositories\Web\Admin;
use App\Http\Interfaces\Web\Admin\ProductInterface;
use App\Http\Traits\ImagesTrait;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductInfo;
use App\Models\ProductReview;

class ProductRepository implements ProductInterface
{
    use ImagesTrait;
    public static function DeleteProductRule()
    {
        return[
            'product_id'=>'required|exists:products,id'
        ];
    }

    public static function AddProductRule()
    {
        return[
            'name_en'=>'required|min:5',
            'name_ar'=>'required|min:5',
            'price'=>'required',
            'stock'=>'required',
            'description'=>'required|min:50',
            'brand'=>'required|min:2',
            'status'=>'required',
            'category'=>'required|exists:categories,name_en',
            'poster'=>'required|image',
            'long_description'=>'required',
            //'images'=>'file'
        ];
    }

    public static function DeleteProductReviewRules()
    {
        return[
            'productReview_id'=>'required|exists:product_reviews,id'
        ];
    }

    public function allProducts()
    {
        return Product::with(Product::POSTER, Product::CATEGORY)->paginate();
    }

    public function deleteProduct($request)
    {
        Product::find($request->product_id)->delete();
    }

    public function addProduct(\App\Http\Requests\Web\Admin\AddProductRequest $request)
    {
        \DB::transaction(function ()use ($request){
            $posterUrl =$this->uploadImage($request->poster,
                now().'_poster.'.$request->poster->extension(),
                'admin/products'
            );
            $category=Category::where('name_en',$request->category)->get()->first();

            $product =Product::create([
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'description'=>$request->description,
            'brand'=>$request->brand,
            'status'=>$request->status,
            'category_id'=>$category->id,
            'long_description'=>$request->long_description,
             ]);

            $poster=Image::create([
                'url'=>asset($posterUrl),
                'product_id'=>$product->id
            ]);
            $product->poster_id=$poster->id;
            $product->save();

            foreach ($request->images as $image){
                $imageUrl =$this->uploadImage($image,
                    now().'_images.'.$image->extension(),
                    'admin/products'
                );
                Image::create([
                    'url'=>asset($imageUrl),
                    'product_id'=>$product->id
                ]);
            }


            for ($i=0;$i<count($request->info_key);$i++){
               ProductInfo::create([
                   'key'=>$request->info_key[$i],
                   'value'=>$request->info_value[$i],
                   'product_id'=>$product->id
               ]);
            }

        });

    }

    public function deleteProductReview($request, $productReview_id)
    {
        ProductReview::where('id',$productReview_id)->delete();
    }
}
