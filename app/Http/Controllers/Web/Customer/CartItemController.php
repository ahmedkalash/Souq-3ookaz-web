<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Customer\CartItemInterface;
use App\Http\Repositories\Web\Customer\CartItemRepository;
use App\Http\Repositories\Web\Customer\CategoryRepository;
use App\Http\Requests\addCartItemRequest;
use App\Http\Requests\decrementCartItemCountRequest;
use App\Http\Requests\deleteCartItemRequest;
use App\View\ViewPath;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartItemController extends Controller
{
    public function __construct(
        protected CartItemInterface $cartItemRepository,
    ){}
    public function addProduct(addCartItemRequest $request){
         $this->cartItemRepository->addProduct($request);
         Alert::success('success','ضيفتهالك علي الله تشتري بقي');
         return redirect()->back();
    }

    public function getCart(){
         $useCart= $this->cartItemRepository->getCart();
        return view(
            ViewPath::CART,
            mergeData: $useCart
        );
    }

    public function deleteItem(deleteCartItemRequest $request){
        $this->cartItemRepository->deleteItem($request);
        Alert::success('success','تمام مسحتهولك');
        return redirect()->back();
    }

    public function emptyCart(Request $request){
        $this->cartItemRepository->emptyCart();
        Alert::success('تمام','مسحتهالك ليه بس كدا الخساره دي');
        return redirect()->back();
    }

   /**
    * decrement the amount of an item  or delete the item if its amount is one
    * */
    public function decrementItemCount(decrementCartItemCountRequest $request){
        // need ajax
        $this->cartItemRepository->decrementItemCount($request);
        return ;

    }


}
