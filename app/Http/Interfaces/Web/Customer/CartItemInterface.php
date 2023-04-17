<?php

namespace App\Http\Interfaces\Web\Customer;

interface CartItemInterface
{
    public function addProduct($request);
    public function getCart();
    public function emptyCart();
    public function deleteItem($request);

    public function decrementItemCount($request);

}
