<?php

namespace App\Http\Repositories\Web\Admin;
use App\Http\Interfaces\Web\Admin\CategoryInterface;
use App\Http\Traits\ImagesTrait;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryInterface
{
    use ImagesTrait;
    public static function deleteCategoryRules()
    {
        return[
            'category_id'=>'required|exists:categories,id'
        ];
    }

    public static function addCategoryRules()
    {
        return[
            'name_ar' =>'required|min:3',
            'name_en' =>'required|min:3',
            'parent'  =>'nullable|sometimes|exists:categories,name_en',
            'icon_url'=>'required|url',
            'poster'  =>'required',
        ];
    }

    function allWithParent()
    {
        return Category::with('parent')->get();
    }

    public function deleteCategory(\App\Http\Requests\Web\Admin\DeleteCategoryRequest $request)
    {
        Category::where('id',$request->category_id)->delete();
    }

    public function allNonLeafCategories()
    {
        return DB::query()->selectRaw(
            'c.* FROM categories c WHERE EXISTS (SELECT 1 FROM categories WHERE parent_id = c.id)'
        )->get();

    }

    public function AddCategory($request)
    {
        $parent_id = $request->parent? Category::where('name_en',$request->parent):null;
        Category::create([
            'name_ar' => $request->name_ar,
            'name_en' =>$request->name_en,
            'parent_id'  =>$parent_id,
            'icon_url'=>$request->icon_url
        ]);

    }

}
