<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    @yield('head')
</head>

<body>
<!-- tap on top start -->
<div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
</div>
<!-- tap on tap end -->

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    @include('admin-end.includes.header')
    <!-- Page Header Ends-->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('admin-end.includes.sidebar')
        <!-- Page Sidebar Ends-->

        <!-- index body start -->
        <div class="page-body">
            <!-- Container-fluid Start-->
            @yield('body')
            <!-- Container-fluid Ends-->

            <!-- footer start-->
            @include('admin-end.includes.footer')
            <!-- footer End-->
        </div>
        <!-- index body end -->

    </div>
    <!-- Page Body End -->
</div>
<!-- page-wrapper End-->

<!-- Modal Start -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                <p>Are you sure you want to log out?</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="button-box">
                    <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                    <form action="{{route('admin.logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn  btn--yes btn-primary">Yes</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->
@yield('scripts')
@include('sweetalert::alert')
</body>

</html>
