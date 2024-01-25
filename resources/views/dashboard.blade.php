@extends('app')

@section('title','Dashboard')

@push('css')

@endpush

@section('content')
<br><br>
<h3 style="border-bottom: 3px solid #999" class="text-center card-common">Admin Dashboard</h3>
<!--cards-->
     <div class="container-fluid" style="padding-top: 0; margin-top: -60px;">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-3 col-sm-6 p-2">
                        <div class="card card-common">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-shopping-cart fa-3x text-warning"></i>
                                    <div class="text-right text-secondary">
                                        <h5>Sales</h5>
                                        <h3>$135,000</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-secondary">
                                <i class="fas fa-sync mr-3"></i>
                                <span>Updated Now</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 p-2">
                        <div class="card card-common">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-users fa-3x text-info"></i>
                                    <div class="text-right text-secondary">
                                        <h5>Users</h5>
                                        <h3>135,00</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-secondary">
                                <i class="fas fa-sync mr-3"></i>
                                <span>Updated Now</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 p-2">
                        <div class="card card-common">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-money-bill-alt fa-3x text-success"></i>
                                    <div class="text-right text-secondary">
                                        <h5>Expenses</h5>
                                        <h3>$135,000</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-secondary">
                                <i class="fas fa-sync mr-3"></i>
                                <span>Updated Now</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 p-2">
                        <div class="card card-common">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <i class="fas fa-chart-line fa-3x text-danger"></i>
                                    <div class="text-right text-secondary">
                                        <h5>Visitors</h5>
                                        <h3>135,000</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-secondary">
                                <i class="fas fa-sync mr-3"></i>
                                <span>Updated Now</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--end cards-->
@endsection

@push('js')

@endpush
