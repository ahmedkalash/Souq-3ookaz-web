<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Http\Interfaces\Web\Customer\HomePageInterface;
use App\Models\Product;
use App\View\ViewPath;
use Illuminate\Http\Request;
use Illuminate\View\View;

use function App\Http\Helper\cartItems;

class HomePageController extends Controller
{

    public function __construct(
        protected HomePageInterface $homePageRepository,
        protected CategoryInterface $categoryRepository

    ){}
    public function showHomePage(Request $request){
        return view(
            ViewPath::HOME_PAGE,
            mergeData: cartItems()
        );
    }
}
