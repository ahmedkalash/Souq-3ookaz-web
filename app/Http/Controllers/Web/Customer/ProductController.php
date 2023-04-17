<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Http\Interfaces\Web\Customer\ProductInterface;
use App\Http\Requests\Web\Customer\Product\GetProductByIdRequest;
use App\Http\Requests\Web\Customer\Product\GetProductBySlugRequest;
use App\Http\Requests\Web\Customer\Product\GetProductsByCategoryIDRequest;
use App\Http\Requests\Web\Customer\Product\GetProductsByCategorySlugRequest;
use App\View\ViewPath;
use function App\Http\Helper\cartItems;

class ProductController extends Controller
{
    public function __construct(
        protected ProductInterface $productRepository,
        protected CategoryInterface $categoryRepository
    ){}


    public function showProductById(GetProductByIdRequest $request, $id){
        $product = $this->productRepository->getProductById($request, $id);

        return view(
            ViewPath::VIEW_PRODUCT,
            compact('product'),
              cartItems()
        );
    }
    public function showProductBySlug(GetProductBySlugRequest $request, $slug){
       $product = $this->productRepository->getProductBySlug($request, $slug);
       return view(
            ViewPath::VIEW_PRODUCT,
            compact('product'),
            cartItems()
        );
    }
    public function showProductsByCategoryID(GetProductsByCategoryIDRequest $request, $category_id){
        $products = $this->productRepository->getProductsByCategoryID($category_id);
       return view(
            ViewPath::BROWSE_PRODUCTS,
            compact('products'),
            cartItems()
        );
    }
    public function showProductsByCategorySlug(GetProductsByCategorySlugRequest $request, $category_slug){
        $products = $this->productRepository->getProductsByCategorySlug($category_slug);
       return view(
            ViewPath::BROWSE_PRODUCTS,
            compact('products'),
             cartItems()
        );
    }
    public function allProducts(){
        $products = $this->productRepository->allProducts();
       return view(
            ViewPath::BROWSE_PRODUCTS,
            compact('products'),
            cartItems()
        );
    }

}
