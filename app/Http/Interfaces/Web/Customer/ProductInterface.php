<?php

namespace App\Http\Interfaces\Web\Customer;

interface ProductInterface
{
    public function getProductsByCategoryID(int $category_id) ;
     public function getProductsByCategorySlug(string $category_slug) ;
    public function getProductById($request, $id);
    public function getProductBySlug($request, $slug);
    public function allProducts();

}
