@extends('customer-end.layouts.master')

@section('custom-head')
    <link rel="icon" href="../assets/images/favicon/1.png" type="image/x-icon">
    <title>Cart</title>
@endsection


@section('content')

    <!-- Breadcrumb Section Start -->
    @include('customer-end.includes.breadcrumb-section')
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody>
                                @foreach($cartItems as $cartItem)
                                    <tr class="product-box-contain">

                                        <td class="product-detail">
                                            <div class="product border-0">
                                                <a href="{{route('product.showByID',$cartItem->product_id)}}" class="product-image">
                                                    <img src="{{$cartItem->poster}}"
                                                         class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <div class="product-detail">
                                                    <ul>
                                                        <li class="name">
                                                            <a href="{{route('product.showByID',$cartItem->product_id)}}">{{$cartItem->name_en}}</a>
                                                        </li>

                                                        {{--<li class="text-content"><span class="text-title">SoldBy:</span> Fresho--}}

                                                        </li>

                                                        <li class="text-content"><span
                                                                class="text-title">Quantity</span> {{$cartItem->amount}}
                                                        </li>

                                                        <li>
                                                            <h5 class="text-content d-inline-block">Price :</h5>
                                                            <span>{{$cartItem->unit_price}}</span>

                                                        </li>

                                                        <li>
                                                            <h5 class="saving theme-color">Saving : $20.68</h5>
                                                        </li>

                                                        <li class="quantity-price-box">
                                                            <div class="cart_qty">
                                                                <div class="input-group">
                                                                    <button type="button" class="btn qty-left-minus"
                                                                            data-type="minus" data-field="">
                                                                        <i class="fa fa-minus ms-0"
                                                                           aria-hidden="true"></i>
                                                                    </button>
                                                                    <input class="form-control input-number qty-input"
                                                                           type="text" name="quantity" value="0">
                                                                    <button type="button" class="btn qty-right-plus"
                                                                            data-type="plus" data-field="">
                                                                        <i class="fa fa-plus ms-0"
                                                                           aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <h5>Total: ${{$cartItem->sub_total}}</h5>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="price">
                                            <h4 class="table-title text-content">Price</h4>
                                            <h5>${{$cartItem->unit_price}}
                                                {{--<del class="text-content">$45.68</del>--}}
                                            </h5>
                                           {{-- <h6 class="theme-color">You Save : $20.68</h6>--}}
                                        </td>

                                        <td class="quantity">
                                            <h4 class="table-title text-content">quantity</h4>
                                            <div class="quantity-price">
                                                <div class="cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field="">
                                                            <i class="fa fa-minus ms-0" aria-hidden="true"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                               name="quantity" value="{{$cartItem->amount}}">
                                                        <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field="">
                                                            <i class="fa fa-plus ms-0" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="subtotal">
                                            <h4 class="table-title text-content">Total</h4>
                                            <h5>${{$cartItem->sub_total}}</h5>
                                        </td>

                                        <td class="save-remove">
                                            <h4 class="table-title text-content">Action</h4>
                                            <a class="save notifi-wishlist" href="javascript:void(0)">Save for later</a>
                                           <form action="{{route('cart.deleteItem', $cartItem->product_id)}}" method="post" id="delete-cart-item">
                                               @method('delete')
                                               @csrf
                                               <a class="remove close_button" href="javascript:deleteItem()"  >Remove</a>
                                               <script>
                                                   function deleteItem() {
                                                       document.getElementById("delete-cart-item").submit();
                                                   }
                                               </script>
                                           </form>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <li>

                        <form action="{{route('cart.empty')}}" method="post"  >
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-animation proceed-btn fw-bold">
                                Clear The Cart
                            </button>
                        </form>


                    </li>
                </div>




                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        <div class="summery-header">
                            <h3>Cart Total</h3>
                        </div>

                       {{--
                        <div class="summery-contain">
                            <div class="coupon-cart">
                                <h6 class="text-content mb-2">Coupon Apply</h6>
                                <div class="mb-3 coupon-box input-group">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                           placeholder="Enter Coupon Code Here...">
                                    <button class="btn-apply">Apply</button>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price">$125.65</h4>
                                </li>

                                <li>
                                    <h4>Coupon Discount</h4>
                                    <h4 class="price">(-) 0.00</h4>
                                </li>

                                <li class="align-items-start">
                                    <h4>Shipping</h4>
                                    <h4 class="price text-end">$6.90</h4>
                                </li>
                            </ul>
                        </div>
                                    --}}

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>Total (USD)</h4>
                                <h4 class="price theme-color">${{$total_price}}</h4>
                            </li>
                        </ul>

                        <div class="button-group cart-button">
                            <ul>
                                <li>
                                    <button onclick="location.href = '{{route('checkout.show')}}';"
                                            class="btn btn-animation proceed-btn fw-bold">Process To Checkout
                                    </button>
                                </li>

                                <li>
                                    <button onclick="location.href = '{{route('home.show')}}';"
                                            class="btn btn-light shopping-button text-dark">
                                        <i class="fa-solid fa-arrow-left-long"></i>Return To Shopping
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->

@endsection
@section('script')

@endsection
