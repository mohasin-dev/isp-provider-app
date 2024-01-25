<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!--font awesome-->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <!-- datatables Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.min.css') }}">
    <!-- Custom Css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- toastr css -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet">
    @stack('css')
    <style>
    .dropdown:hover>.dropdown-menu {
        display: block;
    }
    .dropdown-item:hover{
        background-color: #ccc;
    }
    </style>
</head>
<body>

        <!--navbar-->
        <nav class="navbar navbar-expand-md navbar-light">
            <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#myNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="myNavbar">
                <div class="container-fluid">
                    <div class="row">
                        <!--top nav-->
                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 top-navbar ml-auto bg-dark fixed-top py-2">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <a href="{{ route('dashboard') }}" class=" text-uppercase mb-0 font-weight-bold" style="color: #f44336; letter-spacing: .1em; text-decoration: none;">ISP Software</a>
                                </div>
                                <div class="col-md-8">
                                    <!-- <form>
                                        <div class="input-group">
                                            <input type="text" class="form-control search-input" placeholder="Sarch...">
                                            <button type="button" class="btn btn-white search-button"><i class="fas fa-search text-danger"></i></button>
                                        </div>
                                    </form> -->
                                    <ul class="navbar-nav main-nav">
                                        {{-- <li class="nav-item ml-2"><a href="#" class="nav-link"><i class="fas fa-bullseye text-danger"></i> POS</a> --}}
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-users text-danger"></i> People<i class="pl-1 fas fa-sort-down fa-lg text-danger"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('customer.index') }}"><i class="fas fa-users text-danger"></i> Customer</a>
                                                <a class="dropdown-item" href="{{ route('suplier.index') }}"><i class="fas fa-user-friends text-danger"></i> Supplier</a>
                                                <a class="dropdown-item" href="#"><i class="fas fa-user text-danger"></i> User</a>
                                            </div>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownp" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cubes text-danger"></i> Packages<i class="pl-1 fas fa-sort-down fa-lg text-danger"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownp">
                                                    <a class="dropdown-item" href="{{ route('feature.index') }}"><i class="fas fa-feather-alt text-danger"></i> Package Feature</a>
                                                    <a class="dropdown-item" href="{{ route('package.index') }}"><i class="fas fa-cubes text-danger"></i> Packages</a>
                                            </div>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-archive text-danger"></i> Product<i class="pl-1 fas fa-sort-down fa-lg text-danger"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                                <a class="dropdown-item" href="{{ route('unit.index') }}"><i class="fas fa-bookmark text-danger"></i> Product Units</a>
                                                <a class="dropdown-item" href="{{ route('category.index') }}"><i class="fas fa-bookmark text-danger"></i> Product Categories</a>
                                                <a class="dropdown-item" href="{{ route('expense-category.index') }}"><i class="fas fa-bookmark text-danger"></i> Expense Categories</a>
                                                <a class="dropdown-item" href="{{ route('product.index') }}"><i class="fas fa-book text-danger"></i> Product</a>
                                                <a class="dropdown-item" href="{{ route('product.index') }}"><i class="fas fa-money-bill text-danger"></i> Expense</a>
                                                <a class="dropdown-item" href="{{ route('damage.index') }}"><i class="fas fa-trash-alt text-danger"></i> Damage Product</a>
                                            </div>
                                        </li>
                                        <li class="nav-item ml-2"><a href="{{ route('inventory.index') }}" class="nav-link"><i class="fas fa-shopping-basket text-danger"></i> Purchase</a></li>
                                        <li class="nav-item ml-2"><a href="#" class="nav-link"><i class="fas fa-money-bill-alt text-danger"></i> Bill</a></li>
                                        <li class="nav-item ml-2"><a href="{{ route('setting.index') }}" class="nav-link"><i class="fas fa-cogs text-danger"></i> Settings</a></li>
                                        {{-- <li class="nav-item ml-2"><a href="#" class="nav-link"><i class="fas fa-chart-line text-danger"></i> Report</a></li> --}}
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownr" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-chart-line text-danger"></i> Report<i class="pl-1 fas fa-sort-down fa-lg text-danger"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdownr">
                                                    <a class="dropdown-item" href="{{ route('expense.report') }}"><i class="far fa-chart-bar text-danger"></i> Expense Report</a>
                                                    <a class="dropdown-item" href="#"><i class="fas fa-chart-pie text-danger"></i> Expense Report</a>
                                                    <a class="dropdown-item" href="#"><i class="fas fa-chart-area text-danger"></i> Expense Report</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-2">
                                    <ul class="navbar-nav" style="margin-left: -20px;">
                                        <li class="nav-item icon-parent text-light"><img class="mt-1 rounded-circle img-fluid" src="{{ asset('assets/img/admin.JPG') }}" width="30px;" height="30px;"> Mohasin Hossain</li>
                                        <li class="nav-item ml-md-auto"><a href="#" class="nav-link" data-toggle="modal" data-target="#sign-out"><i class="fas fa-sign-out-alt text-danger"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end tor nav-->
                    </div>
                </div>
            </div>
        </nav>
    <!--end navbar-->
    <!--modal-->
    <div class="modal fade" id="sign-out">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Want to leave?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Press logout to leave
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Stay Here</button>

                            <a data-dismiss="modal" class="btn btn-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>

                </div>
            </div>
        </div>
    </div>
    <!--end modal-->
    @yield('content')

    <!--footer-->
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 ml-auto footer-bottom">
                    <div class="row border-top pt-2">
                        <div class="col-lg-12 text-center">
                            <p>&copy; 2019 Copyright. Made with <i class="fas fa-heart text-danger"></i> by <a href="#" class="text-success">Intezie Limited</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--end footer-->

<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- Custom Js -->
<script src="{{ asset('assets/js/all.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/js/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
{!! Toastr::message() !!}
<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
              toastr.error('{{ $error }}',{
                  closeButton:false,
                  progressBar:true,
               });
        @endforeach
    @endif
</script>
@stack('js')
</body>
</html>
