<?php

namespace Tests\Feature;

use App\Http\Repositories\Web\Customer\CategoryRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetLeafCategories()
    {
        $categoryRepository = new CategoryRepository();
        $arr=[];
        $categoryRepository->getLeafCategoriesByID(1,$arr);

        var_dump($arr);
    }

}
