<?php
namespace App\Http\Helper;

use App\Http\Interfaces\Web\Customer\CartItemInterface;

function cartItems(){
    $cartItemRepository =app(CartItemInterface::class);
    return $cartItemRepository->getCart();
}
