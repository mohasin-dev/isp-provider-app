@extends('app')

@section('title','Suplier')

@push('css')
<style>

</style>
@endpush

@section('content')
<br><br><h3 style="border-bottom: 3px solid #999" class="text-center card-common">Supliers</h3>
    <div class="container-fluid" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-md-9 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">suplier List</h3>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Name</th>
                                        <th class="text-center" scope="col">Email</th>
                                        <th class="text-center" scope="col">Phone</th>
                                        <th class="text-center" scope="col">Address</th>
                                        <th class="text-center" scope="col">Note</th>
                                        <th class="text-center" scope="col">Created At</th>
                                        {{-- <th class="text-center" scope="col">Updated At</th> --}}
                                        <th class="text-center" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th class="text-center" scope="col">Name</th>
                                        <th class="text-center" scope="col">Email</th>
                                        <th class="text-center" scope="col">Phone</th>
                                        <th class="text-center" scope="col">Address</th>
                                        <th class="text-center" scope="col">Note</th>
                                        <th class="text-center" scope="col">Created At</th>
                                        {{-- <th class="text-center" scope="col">Updated At</th> --}}
                                        <th class="text-center" scope="col">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($supliers as $key=>$suplier)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                            <td class="text-center">{{ $suplier->name }}</td>
                                            <td class="text-center">{{ $suplier->email }}</td>
                                            <td class="text-center">{{ $suplier->phone }}</td>
                                            <td class="text-center">{{ $suplier->address }}</td>
                                            <td class="text-center">{{ $suplier->note }}</td>
                                            <td class="text-center">{{ $suplier->created_at->format('d M Y') }}</td>
                                            {{-- <td class="text-center">{{ $suplier->updated_at }}</td> --}}
                                            <td class="text-center btn-group" role="group">
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-file-alt"></i></a>
                                                <a data-toggle="modal" data-target="#suplier-edit" href="{{ route('suplier.edit', $suplier->id) }}" data-name="{{$suplier->name}}" data-email="{{$suplier->email}}" data-phone="{{$suplier->phone}}" data-address="{{$suplier->address}}" data-note="{{$suplier->note}}" class="btn btn-warning btn-sm editModal"><i class="fas fa-edit"></i></a>
                                                {{-- <a href="{{ route('suplier.edit', $suplier->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a> --}}
                                                <button type="button" onclick="deletesuplier({{ $suplier->id }})" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $suplier->id }}" action="{{ route('suplier.destroy',$suplier->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        <!--start modal-->
                                        <div class="modal fade" id="suplier-edit">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Are you sure?</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('suplier.update', $suplier->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group md-form">
                                                                <label for="exampleInputEmail1">suplier Name</label>
                                                                <input type="text" name="name" id="suplierName" class="form-control"  placeholder="Enter suplier Name">
                                                            </div>
                                                            <div class="form-group md-form">
                                                                <label for="exampleInputEmail1">suplier Email</label>
                                                                <input type="text" name="email" id="suplierEmail" class="form-control"  placeholder="Enter suplier Name">
                                                            </div>
                                                            <div class="form-group md-form">
                                                                <label for="exampleInputEmail1">suplier Phone</label>
                                                                <input type="text" name="phone" id="suplierPhone" class="form-control"  placeholder="Enter suplier Name">
                                                            </div>
                                                            <div class="form-group md-form">
                                                                <label for="exampleInputEmail1">suplier Address</label>
                                                                <input type="text" name="address" id="suplierAddress" class="form-control"  placeholder="Enter suplier Name">
                                                            </div>
                                                            <div class="form-group md-form">
                                                                <label for="exampleInputEmail1">Short Note(If Required)</label>
                                                                <input type="text" name="note" id="suplierNote" class="form-control"  placeholder="Enter suplier Name">
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
            <div class="col-xl-3 col-lg-3 col-md-3 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card card-common">
                            <div class="card-header">
                                <h3 class="card-title">Add New Suplier</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('suplier.store') }}">
                                    @csrf
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">suplier Name</label>
                                        <input type="text" name="name" class="form-control"  placeholder="Enter suplier Name">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">suplier Email</label>
                                        <input type="text" name="email" class="form-control"  placeholder="Enter suplier Name">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">suplier Phone</label>
                                        <input type="text" name="phone" class="form-control"  placeholder="Enter suplier Name">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">suplier Address</label>
                                        <input type="text" name="address" class="form-control"  placeholder="Enter suplier Name">
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Short Note(If Required)</label>
                                        <input type="text" name="note" class="form-control"  placeholder="Enter suplier Name">
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
        function deletesuplier(id) {
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
      //var suplierName = $(this).attr('id');
      var suplierName= $(this).data('name');
      var suplierEmail= $(this).data('email');
      var suplierPhone= $(this).data('phone');
      var suplierAddress= $(this).data('address');
      var suplierNote= $(this).data('note');
    //   $(".modal-body #id").val(vendorId);
      $(".modal-body #suplierName").val(suplierName);
      $(".modal-body #suplierEmail").val(suplierEmail);
      $(".modal-body #suplierPhone").val(suplierPhone);
      $(".modal-body #suplierAddress").val(suplierAddress);
      $(".modal-body #suplierNote").val(suplierNote);
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
