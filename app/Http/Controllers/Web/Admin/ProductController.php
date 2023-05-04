<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\Admin\ProductRepository;
use App\Http\Repositories\Web\Customer\CategoryRepository;
use App\Http\Requests\Web\Admin\AddProductRequest;
use App\Http\Requests\Web\Admin\DeleteProductRequest;
use App\Http\Requests\Web\Admin\DeleteProductReviewRequest;
use App\Models\Product;
use App\Models\ProductReview;
use App\View\AdminViewPath;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected CategoryRepository $categoryRepository
    ){}

    public function showProductList(){
        $products = $this->productRepository->allProducts();

        return view(
            AdminViewPath::PRODUCTS_List,
            compact('products')
        );
    }
    public function deleteProduct(DeleteProductRequest $request){
         $this->productRepository->deleteProduct($request);
         \Alert::success('success','product was deleted');
        return redirect()->back();
    }
    public function showAddProduct(){
        $leafCategories = $this->categoryRepository->getAllLeafCategories();
        return view(
            AdminViewPath::ADD_PRODUCT,
            compact('leafCategories')
        );
    }
    public function addProduct(AddProductRequest $request){

         $this->productRepository->addProduct($request);
         \Alert::success('success','product was added');
         return redirect()->back();
    }
    public function showProductReview(){
        $productReviews = ProductReview::with('user','product')->get();
        return view(
            AdminViewPath::PRODUCT_REVIEW,
            compact('productReviews')
        );
    }

    public function deleteProductReview(DeleteProductReviewRequest $request, $productReview_id){
        $this->productRepository->deleteProductReview($request, $productReview_id);
        \Alert::success('Product Review Was Deleted');
        return redirect()->back();
    }


}
