@extends('app')

@section('title','Expense Report')

@push('css')
<style>

</style>
@endpush

@section('content')
<br><br>
    <div class="container-fluid" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 offset-md-2">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-center">Expense Report</h3>
                            </div>
                            <div class="card-body">
                                @if ((!empty($expenseReports)))
                                <form class="form-horizontal" method="POST" action="{{ route('expense.report.result') }}">
                                    @csrf
                                    <div>
                                        <div class="row abc clearfix align-items-center">
                                            <div style="text-align: right" class="col-lg-2 col-md-3 col-sm-3 col-xs-5 form-control-label">
                                                <label class="label" for="id_product_id">From Date</label>
                                            </div>
                                            <div class="col-lg-4 col-md-3 col-sm-4 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="date" value="{{ $from }}" name="from_date" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="text-align: right" class="col-lg-2 col-md-3 col-sm-3 col-xs-5 form-control-label">
                                                <label class="label" for="id_product_id">To Date</label>
                                            </div>
                                            <div class="col-lg-4 col-md-3 col-sm-4 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="date" value="{{ $to }}" name="to_date" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row clearfix align-items-center">
                                        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-5 form-control-label">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <div class="row clearfix align-items-center">
                                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                            <button type="submit" class="submit btn btn-primary btn-sm m-t-15 waves-effect">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <form class="form-horizontal" method="POST" action="{{ route('expense.report.result') }}">
                                        @csrf
                                        <div>
                                            <div class="row abc clearfix align-items-center">
                                                <div style="text-align: right" class="col-lg-2 col-md-3 col-sm-3 col-xs-5 form-control-label">
                                                    <label class="label" for="id_product_id">From Date</label>
                                                </div>
                                                <div class="col-lg-4 col-md-3 col-sm-4 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="date" name="from_date" id="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="text-align: right" class="col-lg-2 col-md-3 col-sm-3 col-xs-5 form-control-label">
                                                    <label class="label" for="id_product_id">To Date</label>
                                                </div>
                                                <div class="col-lg-4 col-md-3 col-sm-4 col-xs-7">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="date" name="to_date" id="" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row clearfix align-items-center">
                                            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-5 form-control-label">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <div class="row clearfix align-items-center">
                                                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                                <button type="submit" class="submit btn btn-primary btn-sm m-t-15 waves-effect">Search</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 offset-md-2">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h3 class="card-title">Expense Report</h3>
                            </div> --}}
                            <div class="card-body">
                                @if ((!empty($expenseReports)))
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        <th class="text-center" scope="col">SL</th>
                                        <th class="text-center" scope="col">Expense Category</th>
                                        <th class="text-center" scope="col">Amount</th>
                                        <th class="text-center" scope="col">Reason</th>
                                        </tr>
                                    </thead>
                                    {{-- <tfoot>
                                        <tr>
                                        <th class="text-center" scope="col">SL</th>
                                        <th class="text-center" scope="col">Expense Category</th>
                                        <th class="text-center" scope="col">Amount</th>
                                        <th class="text-center" scope="col">Reason</th>
                                        </tr>
                                    </tfoot> --}}
                                    <tbody>
                                        @foreach ($expenseReports as $key=>$expenseReport)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                            <td class="text-center">{{ $expenseReport->expenseCategory->name }}</td>
                                            <td class="text-center">{{ $expenseReport->amount }}</td>
                                            <td class="text-center">{{ $expenseReport->reason }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-center">Total Expense From {{ $from }} To {{ $to }} : {{ $sum }} taka</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                @else
                                <table id="myTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                            <th class="text-center" scope="col">SL</th>
                                            <th class="text-center" scope="col">Expense Category</th>
                                            <th class="text-center" scope="col">Amount</th>
                                            <th class="text-center" scope="col">Reason</th>
                                            </tr>
                                        </thead>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
<script>
    $(document).ready( function () {
        //$('#myTable').DataTable();
        $('#myTable').DataTable({
        "order": [[ 0, "asc" ]],
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
        });
    });
</script>
@endpush
