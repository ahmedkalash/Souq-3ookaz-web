<?php

namespace App\Http\Repositories\Web\Customer;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Models\Category;
use App\Models\Product;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryInterface
{
    protected Collection $categoryAdjacencyList;
    public function __construct()
    {
        $this->categoryAdjacencyList =  Category::all()->groupBy('parent_id');
    }

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

    public function getAllCategoriesHierarchy(): ?Collection
    {
        $rootCategories = $this->categoryAdjacencyList->get(null);
        foreach ($rootCategories as $rootCategory){
            $this->nestCategoryChildren($rootCategory);
        }
        return $rootCategories;
    }

    public function nestCategoryChildren(Category &$category): void
    {
        $category->children = $this->categoryAdjacencyList->get($category->id, new Collection);
            foreach ($category->children as &$category) {
                $this->nestCategoryChildren($category);
            }
    }

    public function getLeafCategoriesByID(int $Category_id, array &$leafCategories_ids):void
    {
        $categoryChildren = $this->categoryAdjacencyList->get($Category_id);
        if($categoryChildren){
            foreach ($categoryChildren as $child){
                $this->getLeafCategoriesByID($child->id,$leafCategories_ids);
            }
        }else {
            $leafCategories_ids[]=$Category_id;
        }

    }
    public function getLeafCategoriesBySlug(string $Category_Slug, array &$leafCategories_ids):void
    {
        $category_id = Category::where('slug', $Category_Slug)->get()->first()->id;

        $this->getLeafCategoriesByID($category_id, $leafCategories_ids);
    }

    public function getAllLeafCategories():Collection
    {
        $allLeafCategories= new Collection();
        foreach ($this->categoryAdjacencyList as $categories){
            foreach ($categories as $category){
                if(!$this->categoryAdjacencyList->offsetExists($category->id)){
                    $allLeafCategories->push($category);
                }
            }
        }
        return $allLeafCategories;
    }



}
