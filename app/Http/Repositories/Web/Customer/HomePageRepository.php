<?php

namespace App\Http\Repositories\Web\Customer;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Http\Interfaces\Web\Customer\HomePageInterface;

class HomePageRepository implements HomePageInterface
{
    public function __construct(
        protected CategoryInterface $categoryRepository
    ){}


}
