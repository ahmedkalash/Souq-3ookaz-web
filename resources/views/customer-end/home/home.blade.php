@extends(\App\View\ViewPath::MASTER)

@section('custom-head')
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
                <div class="row row-cols-xxl-5 row-cols-xl-4 row-cols-md-3 row-cols-2 g-sm-4 g-3 no-arrow section-b-space">
                    @include(\App\View\ViewPath::BROWSE_PRODUCTS_SECTION)
                </div>

                <div class="custome-pagination">
                    {!! $products->links('vendor.pagination.bootstrap-5') !!}
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
