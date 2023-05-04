@extends(\App\View\AdminViewPath::MASTER)
@section('head')
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{asset("admin")}}/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset("admin")}}/assets/images/favicon.png" type="image/x-icon">
    <title>Admin Product Review</title>

    <!-- Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/font-awesome.css">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="{{asset("admin")}}/assets/css/linearicon.css">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/remixicon.css">

    <!-- Data Table css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/datatables.css">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/themify.css">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/feather-icon.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/animate.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{asset("admin")}}/assets/css/style.css">
@endsection

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <!-- Table Start -->
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Product Reviews</h5>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="user-table ticket-table review-table theme-table table"
                                       id="table_id">
                                    <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Option</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productReviews as $productReview)
                                        <tr>
                                            <td>{{$productReview->user->first_name}}</td>
                                            <td>{{$productReview->product->name_en}}</td>
                                            <td>
                                                <ul class="rating">
                                                    @for($i=0;$i<5;$i++)
                                                        @if($i<=$productReview->rating)
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                            </td>
                                            <td>
                                                <textarea class="form-control" id="comment" rows="4" cols="50" readonly>
                                                    {{$productReview->comment}}
                                                </textarea>


                                            </td>
                                            <td >
                                               <ul>
                                                   <li>
                                                       <form id = 'delete-item-form' action="{{route('admin.product.review.delete', $productReview->id)}}" method="post">
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
                        </div>
                    </div>
                    <!-- Table End -->
                </div>
            </div>
        </div>
    </div>
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

    <!-- customizer js -->
    <script src="{{asset("admin")}}/assets/js/customizer.js"></script>

    <!-- Sidebar js -->
    <script src="{{asset("admin")}}/assets/js/config.js"></script>

    <!-- Plugins JS -->
    <script src="{{asset("admin")}}/assets/js/sidebar-menu.js"></script>
    <script src="{{asset("admin")}}/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="{{asset("admin")}}/assets/js/notify/index.js"></script>

    <!-- Data table js -->
    <script src="{{asset("admin")}}/assets/js/jquery.dataTables.js"></script>
    <script src="{{asset("admin")}}/assets/js/custom-data-table.js"></script>

    <!-- sidebar effect -->
    <script src="{{asset("admin")}}/assets/js/sidebareffect.js"></script>

    <!-- Theme js -->
    <script src="{{asset("admin")}}/assets/js/script.js"></script>
@endsection
