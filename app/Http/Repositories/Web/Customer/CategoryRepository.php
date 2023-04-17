<?php

namespace App\Http\Repositories\Web\Customer;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryInterface
{
    public static function validateCategoryIdRules()
    {
        return [
            'id'=>'exists:categories,id'
        ];
    }

    public static function validateCategorySlugRules()
    {
        return [
            'slug'=>'exists:categories,slug'
        ];
    }

    public function getAllCategoriesHierarchy(): Collection
    {
        $rootCategories = Category::whereNull('parent_id')->get();
        foreach ($rootCategories as /** @var Category $rootCategory */ &$rootCategory) {
            $rootCategory->children = $this->getCategoryChildren($rootCategory->id);
        }
        return $rootCategories;
    }

    public function getCategoryChildren(int $Category_id):Collection|null
    {
        // TODO Optimize it by writing a sql recursive query

        $children = Category::where('parent_id','=',$Category_id)->get();
        foreach ($children as &$child){
            $child->children = $this->getCategoryChildren($child->id);
        }
        return $children;
    }

    public function getLeafCategoriesByID(int $Category_id, array &$leafCategories_ids):void
    {
        $children = Category::where('parent_id','=',$Category_id)->get();

        if($children->count()==0){
            $leafCategories_ids[]=$Category_id;
        }
        foreach ($children as $child) {
            $this->getLeafCategoriesByID($child->id, $leafCategories_ids);
        }
    }
    public function getLeafCategoriesBySlug(string $Category_Slug, array &$leafCategories_ids):void
    {
        $category_id = Category::where(
            'slug', $Category_Slug)->get()->first()->id;

        $this->getLeafCategoriesByID($category_id, $leafCategories_ids);
    }
    public function getAllCategoryProducts(int $Category_id): Collection
    {
        $leafCategories_id=[];
        $this->getLeafCategoriesByID($Category_id,$leafCategories_id);

        return Product::with(Product::POSTER, Product::CATEGORY)
            ->
        whereIn('category_id', $leafCategories_id)->get();

    }


}
