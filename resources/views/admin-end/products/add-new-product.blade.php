@extends(\App\View\AdminViewPath::MASTER)
@section('head')
    <!-- meta data -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset("")}}admin/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset("")}}admin/assets/images/favicon.png" type="image/x-icon">
    <title>Admin - Add New Product</title>

    <!-- Google font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="{{asset("admin/assets/css/linearicon.css")}}">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin/assets/css/vendors/font-awesome.css")}}">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin/assets/css/vendors/themify.css")}}">

    <!--Dropzon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin/assets/css/vendors/dropzone.css")}}">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset("admin/assets/css/vendors/feather-icon.css")}}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin/assets/css/remixicon.css")}}">

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin/assets/css/select2.min.css")}}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/date-picker.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/bootstrap.css">

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/vendors/bootstrap-tagsinput.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{asset("")}}admin/assets/css/style.css">

@endsection

@section('body')
    <!-- New Product Add Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <form class="theme-form theme-form-2 mega-form" method="post" action="{{route('admin.product.add.store')}}" enctype="multipart/form-data">

                    <div class="col-sm-8 m-auto">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Product Information</h5>
                                </div>
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product English Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Product English Name" name="name_en" required>
                                        </div>
                                        @error('name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Arabic Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Product Arabic Name" name="name_ar" required>
                                        </div>
                                        @error('name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="category" required>
                                                <option disabled>Category Menu</option>
                                                @foreach($leafCategories as $leafCategory)
                                                    <option>{{$leafCategory->name_en}}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Brand</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Brand" name="brand" required>
                                        </div>
                                        @error('brand')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">status</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="status" required>
                                                <option disabled>Category Menu</option>
                                                <option>Available</option>
                                                 <option>Not Available</option>
                                            </select>
                                            @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Description</h5>
                                </div>

                                <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" type="text" placeholder="Product Description" name="description" required></textarea>
                                        </div>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" type="text" placeholder="Product Description" name="long_description" required></textarea>
                                            </div>
                                            @error('long_description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Product Images</h5>
                                </div>


                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 col-form-label form-label-title">Poster</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-choose" type="file" id="formFile"  name="poster" required>
                                    </div>
                                    @error('poster')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row align-items-center">
                                    <label class="col-sm-3 col-form-label form-label-title">Images</label>
                                    <div class="col-sm-9">
                                        <input class="form-control form-choose" type="file" id="formFileMultiple1" multiple name="images[]">
                                        <input class="form-control form-choose" type="file" id="formFileMultiple1" multiple name="images[]">
                                        <input class="form-control form-choose" type="file" id="formFileMultiple1" multiple name="images[]">
                                    </div>

                                    @error('images')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Product info</h5>
                                </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Option Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Info Name" name="info_key[]" >
                                        </div>
                                        @error('info_key')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Option Value</label>
                                        <div class="col-sm-9">
                                            <div class="bs-example">
                                                <input type="text" class="form-control"
                                                       placeholder="Info Value" id="#inputTag"
                                                       data-role="tagsinput" name="info_value[]">
                                            </div>
                                            @error('info_value')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Option Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Info Name" name="info_key[]">
                                        </div>
                                        @error('info_key')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Option Value</label>
                                        <div class="col-sm-9">
                                            <div class="bs-example">
                                                <input type="text" class="form-control"
                                                       placeholder="Info Value" id="#inputTag"
                                                       data-role="tagsinput" name="info_value[]">
                                            </div>
                                            @error('info_value')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                <a href="#"  class="add-option"><i class="ri-add-line me-2"></i> Add Another Option</a>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Product Price</h5>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 form-label-title">price</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" placeholder="0" name="price" required>
                                    </div>
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Product Inventory</h5>
                                </div>
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-3 mb-0">Stock</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="stock" required>
                                    </div>
                                    @error('stock')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-solid">Add Product</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- New Product Add End -->

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

    <!-- bootstrap tag-input js -->
    <script src="{{asset("")}}admin/assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="{{asset("")}}admin/assets/js/sidebar-menu.js"></script>

    <!-- customizer js -->
    <script src="{{asset("")}}admin/assets/js/customizer.js"></script>

    <!--Dropzon js -->
    <script src="{{asset("")}}admin/assets/js/dropzone/dropzone.js"></script>
    <script src="{{asset("")}}admin/assets/js/dropzone/dropzone-script.js"></script>

    <!-- Plugins js -->
    <script src="{{asset("")}}admin/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="{{asset("")}}admin/assets/js/notify/index.js"></script>

    <!-- ck editor js -->
    <script src="{{asset("")}}admin/assets/js/ckeditor.js"></script>
    <script src="{{asset("")}}admin/assets/js/ckeditor-custom.js"></script>

    <!-- select2 js -->
    <script src="{{asset("admin/assets/js/select2.min.js")}}"></script>
    <script src="{{asset("admin/assets/js/select2-custom.js")}}"></script>

    <!-- sidebar effect -->
    <script src="{{asset("admin/assets/js/sidebareffect.js")}}"></script>

    <!-- Theme js -->
    <script src="{{asset("admin/assets/js/script.js")}}"></script>
@endsection
