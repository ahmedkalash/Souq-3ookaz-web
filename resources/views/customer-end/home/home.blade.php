@extends(\App\View\ViewPath::MASTER)

@section('custom-head')
    <link rel="icon" href="../assets/images/favicon/1.png" type="image/x-icon">
    <title>سوق عكاظ</title>
@endsection

@section('content')

<!-- Home Section Start -->
<section class="home-search-full pt-0 overflow-hidden">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="slider-animate">
                    <div>
                        <div class="home-contain rounded-0 p-0">
                            <img src="https://themes.pixelstrap.com/fastkart/assets/images/vegetable/bg-img.jpg"
                                 class="img-fluid bg-img blur-up lazyload bg-top" alt="">
                            <div class="home-detail p-center text-center home-overlay position-relative">
                                <div>
                                    <div class="content">
                                        <h1>Get your grocery in 25 minutes</h1>
                                        <h3>Better ingredients, better food, and beverages, at low prices</h3>
                                        <div class="search-box">
                                            <input type="search" class="form-control"
                                                   placeholder="I'm searching for..."
                                                   aria-label="Recipient's username">
                                            <i data-feather="search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Home Section End -->

<!-- product section start -->
<section class="section-b-space">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-xxl-3 col-lg-4 d-none d-lg-block">
                <div class="category-menu menu-xl">

                    <ul>
                        @foreach($categories as $category)
                        <li>
                            <div class="category-list">
                                <img src="{{$category->icon_url??null}}" class="blur-up lazyload" alt="">
                                <h5>
                                    <a href="{{route('product.showByCategorySlug',$category->slug)}}">{{$category->name_en??null}}</a>
                                </h5>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>

            <div class="col-xxl-9 col-lg-8">
                <div class="title d-block">
                    <h2 class="text-theme font-sm">Hot Products</h2>
                    <p>A virtual assistant collects the Hot products for you</p>
                </div>
                <div class="row row-cols-xxl-5 row-cols-xl-4 row-cols-md-3 row-cols-2 g-sm-4 g-3 no-arrow
                        section-b-space">
                    @foreach($products as $product)
                    <div>
                        <div class="product-box product-white-bg wow fadeIn">
                            <div class="product-image">
                                <a href="{{route('product.showBySlug',$product->slug)}}">
                                    <img src="{{$product->poster->url??null}}"
                                         class="img-fluid blur-up lazyload" alt="">
                                </a>
                                <ul class="product-option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
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
                            <div class="product-detail position-relative">
                                <a href="{{route('product.showBySlug',$product->slug)}}">
                                    <h6 class="name">
                                        {{$product->name_en??null}}
                                    </h6>
                                </a>

                                <h6 class="sold weight text-content fw-normal">1 KG</h6>

                                <h6 class="price theme-color">$ {{$product->price??null}}</h6>

                                <div class="add-to-cart-btn-2 addtocart_btn">
                                    <button class="btn addcart-button btn buy-button"><i
                                            class="fa-solid fa-plus"></i></button>
                                    <div class="cart_qty qty-box-2">
                                        <div class="input-group">
                                            <button type="button" class="qty-left-minus" data-type="minus"
                                                    data-field="">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                            <input class="form-control input-number qty-input" type="text"
                                                   name="quantity" value="1">
                                            <button type="button" class="qty-right-plus" data-type="plus"
                                                    data-field="">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>


            </div>

        </div>
    </div>
</section>
<!-- product section end -->

<!-- Quick View Modal Box Start -->
@include('customer-end.includes.quick-view-modal-box')
<!-- Quick View Modal Box End -->

@endsection

@section('script')

@endsection