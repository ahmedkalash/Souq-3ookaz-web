<?php

namespace App\Http\Interfaces\Web\Customer;



use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface
{
    public function getAllCategoriesHierarchy(): Collection|null;
    public function nestCategoryChildren(Category &$category): void;
    public function getLeafCategoriesByID(int $Category_id, array &$leafCategories_ids):void;
    public function getLeafCategoriesBySlug(string $Category_Slug, array &$leafCategories_ids):void;
}
