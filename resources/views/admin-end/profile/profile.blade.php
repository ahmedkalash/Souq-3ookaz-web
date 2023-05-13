@extends('admin-end.layouts.master')

@section('head')
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Profile Setting</title>

    <!-- Google font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="assets/css/linearicon.css">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/remixicon.css">

    <!-- fontawesome css  -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/font-awesome.css">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">

    <!--Drop zon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/dropzone.css">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/date-picker.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap-tagsinput.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
@endsection
@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Details Start -->
                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>Profile Setting</h5>
                                </div>
                                <form class="theme-form theme-form-2 mega-form" action="{{route('admin.profile.update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">First Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Enter Your First Name"
                                                       name="first_name" value="{{$user->first_name??null}}" required>
                                            </div>
                                            @error('first_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Last Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Enter Your Last Name"
                                                       name="last_name" value="{{$user->last_name??null}}" required>
                                            </div>
                                             @error('last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Your Phone
                                                Number</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="tel" placeholder="Enter Your Number"
                                                        name="phone" value="{{$user->phone??null}}" required>
                                            </div>
                                            @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Enter Email
                                                Address</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="email" placeholder="Enter Your Email Address"
                                                    name="email" value="{{$user->email??null}}" required>
                                            </div>
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-2 col-form-label form-label-title">Photo</label>
                                            <div class="col-sm-10">
                                                <input class="form-control form-choose" type="file" id="formFileMultiple" multiple
                                                    name="image">
                                            </div>
                                            @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="password" placeholder="Enter Your Password"
                                                    name="password" required>
                                            </div>
                                            @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

{{--                                        <div class="mb-4 row align-items-center" >--}}
{{--                                            <label class="form-label-title col-sm-2 mb-0">Confirm Password</label>--}}
{{--                                            <div class="col-sm-10">--}}
{{--                                                <input class="form-control" type="password" placeholder="Confirm Password"--}}
{{--                                                     name="password_confirmation" required>--}}
{{--                                            </div>--}}
{{--                                            @error('password_confirmation')--}}
{{--                                            <div class="alert alert-danger" >{{ $message }} </div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-animation w-100" type="submit" name="register">Update date</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Details End -->

                        <!-- Address Start -->
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="card-header-2 mb-3">--}}
{{--                                    <h5>Address</h5>--}}
{{--                                </div>--}}

{{--                                <div class="save-details-box">--}}
{{--                                    <div class="row g-4">--}}
{{--                                        <div class="col-xl-4 col-md-6">--}}
{{--                                            <div class="save-details">--}}
{{--                                                <div class="save-name">--}}
{{--                                                    <h5>Mark Jugal</h5>--}}
{{--                                                </div>--}}

{{--                                                <div class="save-position">--}}
{{--                                                    <h6>Home</h6>--}}
{{--                                                </div>--}}

{{--                                                <div class="save-address">--}}
{{--                                                    <p>549 Sulphur Springs Road</p>--}}
{{--                                                    <p>Downers Grove, IL</p>--}}
{{--                                                    <p>60515</p>--}}
{{--                                                </div>--}}

{{--                                                <div class="mobile">--}}
{{--                                                    <p class="mobile">Mobile No. +1-123-456-7890</p>--}}
{{--                                                </div>--}}

{{--                                                <div class="button">--}}
{{--                                                    <a href="javascript:void(0)" class="btn btn-sm">Edit</a>--}}
{{--                                                    <a href="javascript:void(0)"--}}
{{--                                                       class="btn btn-sm">Remove</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-xl-4 col-md-6">--}}
{{--                                            <div class="save-details">--}}
{{--                                                <div class="save-name">--}}
{{--                                                    <h5>Method Zaki</h5>--}}
{{--                                                </div>--}}

{{--                                                <div class="save-position">--}}
{{--                                                    <h6>Office</h6>--}}
{{--                                                </div>--}}

{{--                                                <div class="save-address">--}}
{{--                                                    <p>549 Sulphur Springs Road</p>--}}
{{--                                                    <p>Downers Grove, IL</p>--}}
{{--                                                    <p>60515</p>--}}
{{--                                                </div>--}}

{{--                                                <div class="mobile">--}}
{{--                                                    <p class="mobile">Mobile No. +1-123-456-7890</p>--}}
{{--                                                </div>--}}

{{--                                                <div class="button">--}}
{{--                                                    <a href="javascript:void(0)" class="btn btn-sm">Edit</a>--}}
{{--                                                    <a href="javascript:void(0)" class="btn btn-sm">--}}
{{--                                                        Remove</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-xl-4 col-md-6">--}}
{{--                                            <div class="save-details">--}}
{{--                                                <div class="save-name">--}}
{{--                                                    <h5>Mark Jugal</h5>--}}
{{--                                                </div>--}}

{{--                                                <div class="save-position">--}}
{{--                                                    <h6>Home</h6>--}}
{{--                                                </div>--}}

{{--                                                <div class="save-address">--}}
{{--                                                    <p>549 Sulphur Springs Road</p>--}}
{{--                                                    <p>Downers Grove, IL</p>--}}
{{--                                                    <p>60515</p>--}}
{{--                                                </div>--}}

{{--                                                <div class="mobile">--}}
{{--                                                    <p class="mobile">Mobile No. +1-123-456-7890</p>--}}
{{--                                                </div>--}}

{{--                                                <div class="button">--}}
{{--                                                    <a href="javascript:void(0)" class="btn btn-sm">Edit</a>--}}
{{--                                                    <a href="javascript:void(0)"--}}
{{--                                                       class="btn btn-sm">Remove</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- Address End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- latest jquery-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>

    <!-- scrollbar simplebar js-->
    <script src="assets/js/scrollbar/simplebar.js"></script>
    <script src="assets/js/scrollbar/custom.js"></script>

    <!-- Sidebar jquery-->
    <script src="assets/js/config.js"></script>
    <!-- Plugins JS start-->

    <!-- bootstrap tag-input JS start-->
    <script src="assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="assets/js/sidebar-menu.js"></script>

    <!-- customizer js start  -->
    <script src="assets/js/customizer.js"></script>
    <!-- customizer js end -->

    <!--Dropzon start-->
    <script src="assets/js/dropzone/dropzone.js"></script>
    <script src="assets/js/dropzone/dropzone-script.js"></script>

    <!--Dropzon start-->
    <script src="assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/notify/index.js"></script>
    <!-- Plugins JS Ends-->

    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
@endsection


