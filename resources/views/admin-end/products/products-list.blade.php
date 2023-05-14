@extends('admin-end.layouts.master')
@section('head')
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product</title>

    <!-- Google font-->
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/font-awesome.css">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="{{asset("")}}admin/assets/css/linearicon.css">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/themify.css">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/feather-icon.css">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/remixicon.css">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/datatables.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/animate.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/style.css">
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title d-sm-flex d-block">
                            <h5>Products List</h5>
                            <div class="right-options">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)">import</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Export</a>
                                    </li>
                                    <li>
                                        <a class="btn btn-solid" href="{{route('admin.product.add.show')}}">Add Product</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package theme-table table-product" id="table_id">
                                    <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Name Eng</th>
                                        <th>Name Ar</th>
                                        <th>Category Eng</th>
                                        <th>Category Ar</th>
                                        <th>Current Qty</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <div class="table-image">
                                                    <img src="{{asset($product->poster->url??null)}}" class="img-fluid"
                                                         alt="">
                                                </div>
                                            </td>

                                            <td>{{$product->name_en}}</td>
                                            <td>{{$product->name_ar}}</td>

                                            <td>{{$product->category->name_en}}</td>
                                            <td>{{$product->category->name_ar}}</td>

                                            <td>{{$product->stock}}</td>

                                            <td class="td-price">${{$product->price}}</td>

                                            @if($product->status == 'available')
                                                <td class="status-close">
                                                    <span>{{$product->status}}</span>
                                                </td>
                                            @else
                                                <td class="status-danger">
                                                    <span>{{$product->status}}</span>
                                                </td>
                                            @endif

                                            <td>
                                                <ul>
{{--                                                    <li>--}}
{{--                                                        <a href="order-detail.html">--}}
{{--                                                            <i class="ri-eye-line"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </li>--}}

                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <form id = 'delete-item-form' action="{{route('admin.product.delete', $product->id)}}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="align-items-center btn btn-theme d-flex" type="submit" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModalToggle">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="custome-pagination">
                                {!! $products->links('vendor.pagination.bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<!-- latest js -->
<script src="{{asset("")}}admin/assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap js -->
<script src="{{asset("")}}admin/assets/js/bootstrap/bootstrap.bundle.min.js"></script>

<!-- feather icon js -->
<script src="{{asset("")}}admin/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="{{asset("")}}admin/assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- scrollbar simplebar js -->
<script src="{{asset("")}}admin/assets/js/scrollbar/simplebar.js"></script>
<script src="{{asset("")}}admin/assets/js/scrollbar/custom.js"></script>

<!-- Sidebar js -->
<script src="{{asset("")}}admin/assets/js/config.js"></script>

<!-- customizer js -->
<script src="{{asset("")}}admin/assets/js/customizer.js"></script>

<!-- Plugins js -->
<script src="{{asset("")}}admin/assets/js/sidebar-menu.js"></script>
<script src="{{asset("")}}admin/assets/js/notify/bootstrap-notify.min.js"></script>
<script src="{{asset("")}}admin/assets/js/notify/index.js"></script>

<!-- Data table js -->
<script src="{{asset("")}}admin/assets/js/jquery.dataTables.js"></script>
<script src="{{asset("")}}admin/assets/js/custom-data-table.js"></script>

<!-- sidebar effect -->
<script src="{{asset("")}}admin/assets/js/sidebareffect.js"></script>

<!-- Theme js -->
<script src="{{asset("")}}admin/assets/js/script.js"></script>

@endsection
