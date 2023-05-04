<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\Admin\CategoryRepository;
use App\Http\Requests\Web\Admin\AddCategoryRequest;
use App\Http\Requests\Web\Admin\DeleteCategoryRequest;
use App\View\AdminViewPath;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function __construct(
       protected CategoryRepository $categoryRepository
   ){}

    public function  showCategoryList(){
        $categories = $this->categoryRepository->allWithParent();
       return view(
           AdminViewPath::Category_List,
           compact('categories')
       );
    }

    public function  deleteCategory(DeleteCategoryRequest $request){
        $this->categoryRepository->deleteCategory($request);
        \Alert::success('done', 'category was deleted');
        return redirect()->back();
    }

    public function  showAddCategory(){
        $nonLeafCategories = $this->categoryRepository->allNonLeafCategories();
        return view(
            AdminViewPath::ADD_Category,
            compact('nonLeafCategories')
        );
    }
    public function  AddCategory(AddCategoryRequest $request){
         $this->categoryRepository->AddCategory($request);
         \Alert::success('success', 'Category Was Added.');
         return redirect()->back();
    }


}
