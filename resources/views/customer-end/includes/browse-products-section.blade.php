@foreach($products as $product)
    <div>
        <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="0.05s">
            <div class="product-header">
                <div class="product-image">
                    <a href="{{route('product.showByID', $product->id)}}">
                        <img src="{{$product->poster->url ?? null }}"
                             class="img-fluid blur-up lazyload" alt="">
                    </a>

                    <ul class="product-option">
                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                            <a href="javascript:void(0)" data-bs-toggle="modal"
                               data-bs-target="#view">
                                <i data-feather="eye"></i>
                            </a>
                        </li>

                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                            <a href="compare.html">
                                <i data-feather="refresh-cw"></i>
                            </a>
                        </li>

                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                            <a href="wishlist.html" class="notifi-wishlist">
                                <i data-feather="heart"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="product-footer">
                <div class="product-detail">
                    <span class="span-name">{{$product->category->name_en ?? null}}</span>
                    <a href={{route('product.showByID', $product->id)}}>
                        <h5 class="name">{{$product->name_en ?? null}}</h5>
                    </a>
                    <p class="text-content mt-1 mb-2 product-content">{{$product->description ?? null}}</p>
                    <div class="product-rating mt-2">
                        <ul class="rating">
                            @include(\App\View\ViewPath::PRODUCT_AVERAGE_RATING)
                        </ul>
                        <span>({{ $product->average_rating }})</span>
                    </div>

                    <h5 class="price"><span class="theme-color">${{$product->price}}</span> {{--<del>$15.15</del>--}}
                    </h5>
                    <div class="add-to-cart-box bg-white">
                        <button class="btn btn-add-cart addcart-button">Add
                            <span class="add-icon bg-light-gray">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                        </button>
                        <div class="cart_qty qty-box">
                            <div class="input-group bg-white">
                                <button type="button" class="qty-left-minus bg-gray"
                                        data-type="minus" data-field="">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>
                                <input class="form-control input-number qty-input" type="text"
                                       name="quantity" value="0">
                                <button type="button" class="qty-right-plus bg-gray"
                                        data-type="plus" data-field="">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
