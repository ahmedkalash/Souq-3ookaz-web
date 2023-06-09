<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use App\Http\Repositories\Web\Customer\CategoryRepository;
use App\Http\Requests\test;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    public function index(Request $request, $eee,)
    {
        dump($request);
        dd($eee);


//
//        $query= Category::select()->where('parent_id','=',null)
//            ->unionAll(
//                Category::select('categories.*')
//                    ->join('tree','categories.parent_id','=','tree.id')
//            );
//
//        $tree = DB::table('tree')
//            ->withRecursiveExpression('tree', $query);
//
//        //dump($tree->toSql());
//
//        //dump($tree->get());
//
//        //dump($groupedCategories);
//
//        $this->buildTree();
//
//         $categories = Category::tree()->get()->toTree();
//         dump($categories);
//
//        $constraint = function ($query) {
//            $query->where('id', 4);
//        };
//
//
//         dump(Category::tree()->breadthFirst()->get()->toTree());


    }


    public function buildTree(){
        $categories = Category::all();
        $groupedCategories = $categories->groupBy('parent_id');
        //$categories = new \Illuminate\Database\Eloquent\Collection ;


        $nestCategories = function (&$category)use (&$nestCategories,$groupedCategories){
            $category->children = $groupedCategories->get($category->id, new Collection);
            foreach ($category->children as &$category){
                $nestCategories($category);
            }
        };

        $buildTree = function () use ($nestCategories, $groupedCategories){
            $rootCategories = $groupedCategories->get(null);
            foreach ($rootCategories as $rootCategory){
                $nestCategories($rootCategory);
            }
            return $rootCategories;
        };

        dump($buildTree());


    }


}
