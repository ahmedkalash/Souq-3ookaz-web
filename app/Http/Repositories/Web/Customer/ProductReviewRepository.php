<?php

namespace App\Http\Repositories\Web\Customer;
use App\Http\Interfaces\Web\Customer\ProductReviewInterface;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProductReviewRepository implements ProductReviewInterface
{
    public static function addReviewRules()
    {
        return [
            'product_id'=>['required','exists:products,id'],
            'rating'=>'gte:1|lte:5',
        ];
    }

    public function addReview($request){
        $productReview = ProductReview::where([['product_id','=',$request->product_id],['user_id','=',Auth::id()]])->get()->first();

        Product::whereId($request->product_id)
        ->update([
            'average_rating'=>number_format( ProductReview::average('rating'), 2)
        ]);

        if($productReview){
            $productReview->update([
                'user_id'=>Auth::id(),
                'product_id'=>$request->product_id,
                'rating'=>$request->rating,
                'comment'=>$request->comment,
            ]);
        }else{
            ProductReview::create([
                'user_id'=>Auth::id(),
                'product_id'=>$request->product_id,
                'rating'=>$request->rating,
                'comment'=>$request->comment,
            ]);
        }
    }


    public function productReviews(int $id){

        $reviews=ProductReview::with(['user'=>function($query){
            $query->select(['id','image_url','first_name','last_name']);
        }])
        ->where('product_id',$id)->get();
        $reviews->average_rating =number_format($reviews->average('rating'), 2);
        // Group the reviews by rating
        $grouped = $reviews->groupBy('rating');
        // Calculate the percentage for each rating
        $reviews->percentages = $grouped->map(function ($group) use ($reviews) {
            return number_format(($group->count() / $reviews->count() * 100), 2);
        })->toArray();

        return $reviews;
    }



}
