<?php

namespace Tests\Http\Repositories\Web\Customer;

use App\Http\Repositories\Web\Customer\CategoryRepository;
//use App\Models\Category;
//use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;

class CategoryRepositoryTest extends TestCase
{


    public function  test_get_categories_children()
    {
        // Create parent category
        $parentCategory = Category::create([
            'name_en' => 'Parent Category',
            'name_ar' => 'القسم الأب',
            'slug' => 'parent-category',
            'parent_id' => null
        ]);

        // Create child category
        $childCategory = Category::create([
            'name_en' => 'Child Category',
            'name_ar' => 'القسم الفرعي',
            'slug' => 'child-category',
            'parent_id' => $parentCategory->id
        ]);

        // Call the function to get children of the parent category
        $children = (new CategoryRepository())->getCategoryChildren($parentCategory->id);

        // Assert that the returned data is not empty
        $this->assertNotEmpty($children);

        // Assert that the returned data is a collection
        $this->assertInstanceOf(Collection::class, $children);

        // Assert that the first item in the collection is the child category
        $this->assertEquals($childCategory->id, $children->first()->id);
    }
    public function GetCategoriesChildren()
    {
        // Create a category hierarchy
        $root = Category::create(['name_en' => 'Root', 'name_ar' => 'الجذر', 'slug' => 'root']);
        $child1 = Category::create(['name_en' => 'Child 1', 'name_ar' => 'الطفل 1', 'slug' => 'child-1', 'parent_id' => $root->id]);
        $grandchild1 = Category::create(['name_en' => 'Grandchild 1', 'name_ar' => 'حفيد 1', 'slug' => 'grandchild-1', 'parent_id' => $child1->id]);
        $grandchild2 = Category::create(['name_en' => 'Grandchild 2', 'name_ar' => 'حفيد 2', 'slug' => 'grandchild-2', 'parent_id' => $child1->id]);
        $child2 = Category::create(['name_en' => 'Child 2', 'name_ar' => 'الطفل 2', 'slug' => 'child-2', 'parent_id' => $root->id]);

        // Test root category without children
        $result = app(CategoryRepository::class)->getCategoryChildren($root->id);
        $this->assertCount(2, $result);
        $this->assertEquals('Child 1', $result[0]->name_en);
        $this->assertNull($result[0]->children);
        $this->assertEquals('Child 2', $result[1]->name_en);
        $this->assertNull($result[1]->children);

        // Test category with children
        $result = app(CategoryRepository::class)->getCategoryChildren($child1->id);
        $this->assertCount(2, $result);
        $this->assertEquals('Grandchild 1', $result[0]->name_en);
        //$this->assertNull($result[0]->children);
        $this->assertEquals('Grandchild 2', $result[1]->name_en);
        $this->assertNull($result[1]->children);

        // Test category without children
        $result = app(CategoryRepository::class)->getCategoryChildren($grandchild1->id);
        $this->assertCount(0, $result);
    }

    public function testGetLeafCategories()
    {
        $categoryRepository = new CategoryRepository();

        $categoryRepository->getLeafCategoriesByID(2);
        $res= $categoryRepository->leafCategories_id;
        //dd($res);
    }
}
