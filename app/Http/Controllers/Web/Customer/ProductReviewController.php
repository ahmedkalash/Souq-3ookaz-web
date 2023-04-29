<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\Customer\ProductReviewRepository;
use App\Http\Requests\Web\Customer\AddProductReviewRequest;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function __construct(protected ProductReviewRepository $productReviewRepository )
    {}

    public function addReview(AddProductReviewRequest $request){
        $this->productReviewRepository->addReview($request);
        \Alert::success('success','Product Review Was Added.');
        return redirect()->back();
    }

}
