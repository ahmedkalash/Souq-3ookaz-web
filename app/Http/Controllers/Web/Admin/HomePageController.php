<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\Admin\HomePageRepository;
use App\View\AdminViewPath;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct(
        protected HomePageRepository $homePageRepository,
    ){}
    public function showHomePage(Request $request){
        return view(
            AdminViewPath::HOME_PAGE,
        );
    }
}
