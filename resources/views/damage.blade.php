@extends('app')

@section('title','Damage')

@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

@endpush

@section('content')
<br><br>
{{-- <h3 style="border-bottom: 3px solid #999" class="text-center card-common">Damages Products</h3> --}}
    <div class="container-fluid" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Damage Product List</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">damage product</th>
                                        <th class="text-center" scope="col">Quantity</th>
                                        <th class="text-center" scope="col">Reason</th>
                                        <th class="text-center" scope="col">Issued By</th>
                                        <th class="text-center" scope="col">Created At</th>
                                        {{-- <th class="text-center" scope="col">Updated At</th> --}}
                                        {{-- <th class="text-center" scope="col">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">damage product</th>
                                        <th class="text-center" scope="col">Quantity</th>
                                        <th class="text-center" scope="col">damage Reason</th>
                                        <th class="text-center" scope="col">Issued By</th>
                                        <th class="text-center" scope="col">Created At</th>
                                        {{-- <th class="text-center" scope="col">Updated At</th> --}}
                                        {{-- <th class="text-center" scope="col">Action</th> --}}
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($damages as $key=>$damage)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                            {{-- <td class="text-center">{{ App\Product::find($damage->product_id)->name }}</td> --}}
                                            <td class="text-center">{{ $damage->product->name }}</td>
                                            <td class="text-center">{{ $damage->quantity }}</td>
                                            <td class="text-center">{{ $damage->reason }}</td>
                                            {{-- <td class="text-center">{{ $damage->user->name }}</td> --}}
                                            <td class="text-center">{{ App\User::find($damage->issued_by)->name }}</td>
                                            <td class="text-center">{{ $damage->created_at->format('d M Y') }}</td>
                                            {{-- <td class="text-center">{{ $damage->updated_at->format('d M Y') }}</td> --}}
                                            {{-- <td class="text-center btn-group" role="button">
                                               <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-file-alt"></i></a>
                                                <a data-toggle="modal" data-target="#damage-edit" href="{{ route('damage.edit', $damage->id) }}" id="{{$damage->id}}" value="{{$damage->name}}" class="btn btn-warning btn-sm editModal"><i class="fas fa-edit"></i></a>
                                                <button type="button" onclick="deletedamage({{ $damage->id }})" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $damage->id }}" action="{{ route('damage.destroy',$damage->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td> --}}
                                        </tr>
                                        <!--modal-->
                                        <div class="modal fade" id="damage-edit">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Are you sure?</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('damage.update', $damage->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group md-form">
                                                                <label for="exampleInputEmail1">damage damage Name</label>
                                                                <input type="hidden" name="id" value="" id="editThisID" class="form-control" readonly="">
                                                                <input type="text" name="name" value="" id="damageName" class="form-control">
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
                                <h3 class="card-title">Add damage</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('damage.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Damage Product</label>
                                        <select name="product_id" id="product_id" class="form-control product_id" required>
                                            <option value="">--Select a damage product--</option>
                                            @foreach ($products as $product)
                                            <option value="{{ $product->product->id }}">{{ $product->product->name }}-{{ $product->product->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Quantity</label>
                                        <input type="number" id="quantity" name="quantity"  class="form-control"  placeholder="" required onfocus="">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Reason</label>
                                        <input type="text" name="reason" class="form-control"  placeholder="" required onfocus="">
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
<script src="{{ asset('assets/js/sweetalert2.all.js') }}"></script>
{{-- <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script> --}}
    <script type="text/javascript">
        function deletedamage(id) {
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

    $("#product_id").on('change',function(){
    var product_id = $(this).val();
    //alert(product_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //alert(data);
        $.ajax({
          url: "{{ route('quantityCheck') }}",
          //url:'./productlist',
          type:'POST',
          data:{product_id: product_id},
          success: function (data) {
              //alert(data);
            $("#quantity").attr("max",data);
          }
        });
    });

    //For select2
    $(document).ready(function() {
        $('.product_id').select2();
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
