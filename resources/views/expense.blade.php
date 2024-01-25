@extends('app')

@section('title','Expense')

@push('css')
<style>

</style>
@endpush

@section('content')
<br><br>
{{-- <h3 style="border-bottom: 3px solid #999" class="text-center card-common">Catsegories</h3> --}}
    <div class="container-fluid" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Expense expense List</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Expense Category</th>
                                        <th class="text-center" scope="col">Expense Amount</th>
                                        <th class="text-center" scope="col">Expense Reason</th>
                                        <th class="text-center" scope="col">Expense Attachment</th>
                                        <th class="text-center" scope="col">Created At</th>
                                        {{-- <th class="text-center" scope="col">Updated At</th> --}}
                                        {{-- <th class="text-center" scope="col">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Expense Category</th>
                                        <th class="text-center" scope="col">Expense Amount</th>
                                        <th class="text-center" scope="col">Expense Reason</th>
                                        <th class="text-center" scope="col">Expense Attachment</th>
                                        <th class="text-center" scope="col">Created At</th>
                                        {{-- <th class="text-center" scope="col">Updated At</th> --}}
                                        {{-- <th class="text-center" scope="col">Action</th> --}}
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($expenses as $key=>$expense)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                            <td class="text-center">{{ $expense->expenseCategory->name }}</td>
                                            <td class="text-center">{{ $expense->amount }}</td>
                                            <td class="text-center">{{ $expense->reason }}</td>
                                            <td class="text-center">
                                                @isset($expense->attach_file)
                                                <a download="" href="{{ asset('storage') }}/{{ $expense->attach_file }}">Download</a>
                                                @else
                                                ---
                                                @endisset
                                            </td>
                                            <td class="text-center">{{ $expense->created_at->format('d M Y') }}</td>
                                            {{-- <td class="text-center">{{ $expense->updated_at->format('d M Y') }}</td> --}}
                                            {{-- <td class="text-center btn-group" role="button">
                                               <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-file-alt"></i></a>
                                                <a data-toggle="modal" data-target="#expense-edit" href="{{ route('expense.edit', $expense->id) }}" id="{{$expense->id}}" value="{{$expense->name}}" class="btn btn-warning btn-sm editModal"><i class="fas fa-edit"></i></a>
                                                <button type="button" onclick="deleteexpense({{ $expense->id }})" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $expense->id }}" action="{{ route('expense.destroy',$expense->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td> --}}
                                        </tr>
                                        <!--modal-->
                                        <div class="modal fade" id="expense-edit">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Are you sure?</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('expense.update', $expense->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group md-form">
                                                                <label for="exampleInputEmail1">Expense expense Name</label>
                                                                <input type="hidden" name="id" value="" id="editThisID" class="form-control" readonly="">
                                                                <input type="text" name="name" value="" id="expenseName" class="form-control">
                                                            </div>
                                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end modal-->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-14 col-lg-4 col-md-4 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card card-common">
                            <div class="card-header">
                                <h3 class="card-title">Add Expense</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('expense.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Expense Category</label>
                                        <select name="expense_category_id" class="form-control suplier_id">
                                            <option>Select a expense expense</option>
                                            @foreach ($expenseCategories as $expense)
                                            <option value="{{ $expense->id }}">{{ $expense->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Expense Amount</label>
                                        <input type="text" name="amount" class="form-control"  placeholder="">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Expense Reason</label>
                                        <input type="text" name="reason" class="form-control"  placeholder="">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Attach File</label>
                                        <input type="file" name="attach_file"  placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="{{ asset('assets/js/sweetalert2.all.js') }}"></script>
{{-- <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script> --}}
    <script type="text/javascript">
        function deleteexpense(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
<script>
        $(document).ready( function () {
            //$('#myTable').DataTable();
            $('#myTable').DataTable({
            "order": [[ 0, "desc" ]],
            "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ]
            });
        });


        $(document).on("click", ".editModal", function () {
        var expenseId = $(this).attr('id');
        var expenseName = $(this).attr('value');
        $(".modal-body #editThisID").val(expenseId);
        $(".modal-body #expenseName").val(expenseName);
        });

        //For select2
        $(document).ready(function() {
            $('.expense_category_id').select2();
        });
</script>

{{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf','print'
        ]
    });
</script> --}}
@endpush
