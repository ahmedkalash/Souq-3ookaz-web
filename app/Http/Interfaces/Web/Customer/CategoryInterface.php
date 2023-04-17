<?php

namespace App\Http\Interfaces\Web\Customer;

use Illuminate\Support\Collection;

interface CategoryInterface
{
    public function getAllCategoriesHierarchy(): Collection|null;
}
