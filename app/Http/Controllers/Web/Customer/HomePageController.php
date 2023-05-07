<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Http\Interfaces\Web\Customer\HomePageInterface;
use App\Http\Interfaces\Web\Customer\ProductInterface;
use App\Models\Product;
use App\View\ViewPath;
use Illuminate\Http\Request;
use Illuminate\View\View;


class HomePageController extends Controller
{

    public function __construct(
        protected HomePageInterface $homePageRepository,
        protected CategoryInterface $categoryRepository,
        protected ProductInterface $productRepository

    ){}
    public function showHomePage(Request $request){
        $products = $this->productRepository->allProducts();
        return view(
            ViewPath::HOME_PAGE,
            compact('products')
        );
    }
}
