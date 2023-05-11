<?php

namespace App\Http\Middleware;

use App\Http\Repositories\Web\Customer\CartItemRepository;
use Closure;
use Illuminate\Http\Request;

class LoadCartItemsToAllViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         $cartItems = app(CartItemRepository::class)->getCart();
         \View::share('cartItems' , $cartItems['cartItems']);
         \View::share('total_price' , $cartItems['total_price']);
        return $next($request);
    }
}
