@extends('app')

@section('title','Product')

@push('css')
<style>
body{
    overflow-x: hidden;
}
</style>
{{-- <link href="{{ asset('assets/css/select2.min.css') }}"> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<br><br>
{{-- <h3 style="border-bottom: 3px solid #999" class="text-center card-common">products</h3> --}}
    <div class="container-fluid" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-md-9 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">product List</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table style="font-size: 14px;" id="myTable" class="table table-sm table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                            <th class="text-center" scope="col">#</th>
                                            <th class="text-center" scope="col">Product Name</th>
                                            <th class="text-center" scope="col">Product code</th>
                                            <th class="text-center" scope="col">Supplier Name</th>
                                            <th class="text-center" scope="col">Category</th>
                                            <th class="text-center" scope="col">Quantity</th>
                                            <th class="text-center" scope="col">Alert Quantity</th>
                                            <th class="text-center" scope="col">Selling Price</th>
                                            <th class="text-center" scope="col">Image</th>
                                            <th class="text-center" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            <th class="text-center" scope="col">#</th>
                                            <th class="text-center" scope="col">Product Name</th>
                                            <th class="text-center" scope="col">Product code</th>
                                            <th class="text-center" scope="col">Supplier Name</th>
                                            <th class="text-center" scope="col">Category</th>
                                            <th class="text-center" scope="col">Quantity</th>
                                            <th class="text-center" scope="col">Alert Quantity</th>
                                            <th class="text-center" scope="col">Selling Price</th>
                                            <th class="text-center" scope="col">Image</th>
                                            <th class="text-center" scope="col">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($products as $key=>$product)
                                            <tr>
                                                <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                                <td class="text-center">{{ $product->name }}</td>
                                                <td class="text-center">{{ $product->code }}</td>
                                                <td class="text-center">{{ $product->suplier->name }}</td>
                                                <td class="text-center">{{ $product->category->name }}</td>
                                                <td class="text-center">{{ $product->inventory->quantity }}</td>
                                                <td class="text-center">{{ $product->inventory->alert_quantity }}</td>
                                                <td class="text-center">{{ price_format($product->inventory->unit_price) }}</td>
                                                <td class="text-center"><img class="img-fluid" src="{{ asset('images/product/'.$product->image) }}" width="32" height="32"></td>
                                                <td class="text-center btn-group" role="group">
                                                    {{-- <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-file-alt"></i></a> --}}
                                                    <a data-toggle="modal" data-target="#product-edit" href="{{ route('product.edit', $product->id) }}" id="{{$product->id}}" data-unit_price="{{$product->inventory->unit_price}}" data-alert_quantity="{{ $product->inventory->alert_quantity }}" class="btn btn-warning btn-sm editModal"><i class="fas fa-edit"></i></a>
                                                    <button type="button" onclick="deleteproduct({{ $product->id }})" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                    <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy',$product->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            <!--start modal-->
                                            <div class="modal fade" id="product-edit">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Are you sure?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group md-form">
                                                                    <label for="exampleInputEmail1">Selling Price</label>
                                                                    {{-- <input type="text" name="id" value="" id="editThisID" class="form-control" readonly=""> --}}
                                                                    <input type="text" name="unit_price" id="unit_price" class="form-control"  placeholder="Enter product Name">
                                                                </div>
                                                                <div class="form-group md-form">
                                                                    <label for="exampleInputEmail1">Alert Quantity</label>
                                                                    <input type="text" name="alert_quantity" id="alert_quantity" class="form-control"  placeholder="Enter product Name">
                                                                </div>
                                                                <div class="form-group md-form">
                                                                    <label for="exampleInputEmail1">product Image</label>
                                                                    <input type="file" name="image" id="productPhone" class="">
                                                                </div>
                                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
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
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card card-common">
                            <div class="card-header">
                                <h3 class="card-title">Add New product</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Supplier Name</label>
                                        <select name="suplier_id" class="form-control suplier_id">
                                            <option>Select a suplier</option>
                                            @foreach ($suplers as $supler)
                                            <option value="{{ $supler->id }}">{{ $supler->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">product Name</label>
                                        <input type="text" name="name" class="form-control"  placeholder="Enter product Name">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">product Code</label>
                                        <input type="text" name="code" class="form-control"  placeholder="Enter product Name">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Category Name</label>
                                        <select name="category_id" class="form-control category_id">
                                            <option>Select a Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Seling Price</label>
                                        <input type="text" name="unit_price" class="form-control"  placeholder="Enter product Name">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Alert Quantity</label>
                                        <input type="text" name="alert_quantity" class="form-control"  placeholder="Enter product Name">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Discount %</label>
                                        <input type="text" name="discount" class="form-control"  placeholder="Enter product Name">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Product Image</label>
                                        <input type="file" name="image">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
 {{-- <script src="{{ asset('assets/js/select2.min.js') }}"></script> --}}
{{-- <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script> --}}
<script src="{{ asset('assets/js/sweetalert2.all.js') }}"></script>
    <script type="text/javascript">
        function deleteproduct(id) {
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
        $('#myTable').DataTable();
    } );

      $(document).on("click", ".editModal", function () {
      var productId = $(this).attr('id');
      //var id = $(this).data('id');
      var unit_price= $(this).data('unit_price');
      var alert_quantity= $(this).data('alert_quantity');
      //$(".modal-body #id").val(id);
      $(".modal-body #editThisID").val(productId);
      $(".modal-body #unit_price").val(unit_price);
      $(".modal-body #alert_quantity").val(alert_quantity);
    });

    //For select2
    $(document).ready(function() {
        $('.suplier_id').select2();
        $('.category_id').select2();
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
