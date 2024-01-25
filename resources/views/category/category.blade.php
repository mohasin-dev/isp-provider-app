@extends('app')

@section('title','Category')

@push('css')
<style>

</style>
@endpush

@section('content')
<br><br><h3 style="border-bottom: 3px solid #999" class="text-center card-common">Catsegories</h3>
    <div class="container-fluid" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Category List</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Name</th>
                                        <th class="text-center" scope="col">Created At</th>
                                        <th class="text-center" scope="col">Updated At</th>
                                        <th class="text-center" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Name</th>
                                        <th class="text-center" scope="col">Created At</th>
                                        <th class="text-center" scope="col">Updated At</th>
                                        <th class="text-center" scope="col">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($categories as $key=>$category)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                            <td class="text-center">{{ $category->name }}</td>
                                            <td class="text-center">{{ $category->created_at }}</td>
                                            <td class="text-center">{{ $category->updated_at }}</td>
                                            <td class="text-center btn-group" role="button">
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-file-alt"></i></a>
                                                <a data-toggle="modal" data-target="#category-edit" href="{{ route('category.edit', $category->id) }}" value="{{$category->name}}" class="btn btn-warning btn-sm editModal"><i class="fas fa-edit"></i></a>
                                                <button type="button" onclick="deleteCategory({{ $category->id }})" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $category->id }}" action="{{ route('category.destroy',$category->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        <!--modal-->
                                        <div class="modal fade" id="category-edit">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Are you sure?</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('category.update', $category->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group md-form">
                                                                <label for="exampleInputEmail1">Category Name</label>
                                                                <input type="text" name="name" value="" id="thiscategory" class="form-control">
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
                                <h3 class="card-title">Add New Category</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('category.store') }}">
                                    @csrf
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Category Name</label>
                                        <input type="text" name="name" class="form-control"  placeholder="Enter Category Name">
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
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteCategory(id) {
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
        //var categoryId = $(this).attr('id');
        var categoryName = $(this).attr('value');
        $(".modal-body #thiscategory").val(categoryName);
        //$(".modal-body #thisID").val(categoryId);
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
