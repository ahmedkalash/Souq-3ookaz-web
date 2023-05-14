@extends(\App\View\AdminViewPath::MASTER)

@section('head')
    <!-- meta data -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Admin - Add New Product</title>

    <!-- Google font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="{{asset("admin")}}/assets/css/linearicon.css">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/font-awesome.css">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/themify.css">

    <!--Dropzon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/dropzone.css">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/feather-icon.css">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/remixicon.css">

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/select2.min.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/date-picker.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/bootstrap.css">

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/bootstrap-tagsinput.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/style.css">
@endsection


@section('body')

    <!-- New Product Add Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Category Information</h5>
                                </div>
                                @if($errors->any())
                                    @dump($errors)
                                @endif
                                <form class="theme-form theme-form-2 mega-form" action="{{route("admin.category.add.store")}}" method="post">
                                    @csrf
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Category Arabic Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text"
                                                   placeholder="Category Arabic Name" name="name_ar" required>
                                        </div>
                                        @error('name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                     <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Category English Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text"
                                                   placeholder="Category English Name" name="name_en" required>
                                        </div>
                                         @error('name_en')
                                         <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Parent Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="parent" required>
                                                <option disabled>Category Menu</option>
                                                 <option>{{null}}</option>
                                                @foreach($nonLeafCategories as $nonLeafCategory)
                                                    <option>{{$nonLeafCategory->name_en}}</option>
                                                @endforeach
                                            </select>
                                            @error('parent')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Category Icon </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="url"
                                                   placeholder="Icon URL" name="icon_url" required>
                                        </div>
                                        @error('icon_url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-solid">Add Category</button>

                                  {{--  <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Category
                                            Image</label>
                                        <div class="form-group col-sm-9">
                                            <div class="dropzone-wrapper">
                                                <div class="dropzone-desc">
                                                    <i class="ri-upload-2-line"></i>
                                                    <p>Choose an image file or drag it here.</p>
                                                </div>
                                                <input type="file" class="dropzone">
                                            </div>
                                        </div>
                                    </div>--}}
                                  {{--<div class="mb-4 row align-items-center">
                                        <div class="col-sm-3 form-label-title">Select Category Icon</div>
                                        <div class="col-sm-9">
                                            <div class="dropdown icon-dropdown">
                                                <button class="btn dropdown-toggle" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                                    Select Icon
                                                </button>
                                                <ul class="dropdown-menu"
                                                    aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{asset("admin")}}/../assets/svg/1/vegetable.svg"
                                                                 class="img-fluid" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{asset("admin")}}/../assets/svg/1/cup.svg"
                                                                 class="blur-up lazyload" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{asset("admin")}}/../assets/svg/1/meats.svg"
                                                                 class="img-fluid" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{asset("admin")}}/../assets/svg/1/breakfast.svg"
                                                                 class="img-fluid" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{asset("admin")}}/../assets/svg/1/frozen.svg"
                                                                 class="img-fluid" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{asset("admin")}}/../assets/svg/1/biscuit.svg"
                                                                 class="img-fluid" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{asset("admin")}}/../assets/svg/1/grocery.svg"
                                                                 class="img-fluid" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{asset("admin")}}/../assets/svg/1/drink.svg"
                                                                 class="img-fluid" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{asset("admin")}}/../assets/svg/1/milk.svg"
                                                                 class="img-fluid" alt="">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <img src="{{asset("admin")}}/../assets/svg/1/pet.svg"
                                                                 class="img-fluid" alt="">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>--}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Product Add End -->

@endsection


@section('scripts')
    <!-- latest js -->
    <script src="{{asset("admin")}}/assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap js -->
    <script src="{{asset("admin")}}/assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- feather icon js -->
    <script src="{{asset("admin")}}/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{asset("admin")}}/assets/js/icons/feather-icon/feather-icon.js"></script>

    <!-- scrollbar simplebar js -->
    <script src="{{asset("admin")}}/assets/js/scrollbar/simplebar.js"></script>
    <script src="{{asset("admin")}}/assets/js/scrollbar/custom.js"></script>

    <!-- Sidebar js -->
    <script src="{{asset("admin")}}/assets/js/config.js"></script>

    <!-- bootstrap tag-input js -->
    <script src="{{asset("admin")}}/assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="{{asset("admin")}}/assets/js/sidebar-menu.js"></script>

    <!-- customizer js -->
    <script src="{{asset("admin")}}/assets/js/customizer.js"></script>

    <!--Dropzon js -->
    <script src="{{asset("admin")}}/assets/js/dropzone/dropzone.js"></script>
    <script src="{{asset("admin")}}/assets/js/dropzone/dropzone-script.js"></script>

    <!-- Plugins js -->
    <script src="{{asset("admin")}}/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="{{asset("admin")}}/assets/js/notify/index.js"></script>

    <!-- select2 js -->
    <script src="{{asset("admin")}}/assets/js/select2.min.js"></script>
    <script src="{{asset("admin")}}/assets/js/select2-custom.js"></script>

    <!-- sidebar effect -->
    <script src="{{asset("admin")}}/assets/js/sidebareffect.js"></script>

    <!-- Theme js -->
    <script src="{{asset("admin")}}/assets/js/script.js"></script>
@endsection
