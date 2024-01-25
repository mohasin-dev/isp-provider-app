@extends('app')

@section('title','Package')

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
{{-- <h3 style="border-bottom: 3px solid #999" class="text-center card-common">packages</h3> --}}
    <div class="container-fluid" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-md-9 ml-auto">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Package List</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table style="font-size: 14px;" id="myTable" class="table table-sm table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                            <th class="text-center" scope="col">#</th>
                                            <th class="text-center" scope="col">Name</th>
                                            <th class="text-center" scope="col">Features</th>
                                            <th class="text-center" scope="col">Price</th>
                                            <th class="text-center" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            <th class="text-center" scope="col">#</th>
                                            <th class="text-center" scope="col">Name</th>
                                            <th class="text-center" scope="col">Features</th>
                                            <th class="text-center" scope="col">Price</th>
                                            <th class="text-center" scope="col">Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($packages as $key=>$package)
                                            <tr>
                                                <th class="text-center" scope="row">{{ $key + 1 }}</th>
                                                <td class="text-center">{{ $package->title }}</td>
                                                <td class="text-center">
                                                    @foreach ($package->features as $feature)
                                                        <li>{{ $feature->name }}</li>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">{{ $package->price }}</td>
                                                <td class="text-center btn-group" role="group">
                                                    {{-- <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-file-alt"></i></a> --}}
                                                    <a data-toggle="modal" data-target="#package-edit" href="{{ route('package.edit', $package->id) }}" id="{{$package->id}}" data-title="{{$package->title}}"
                                                        data-features="
                                                        <option>--Select Package Features--</option>
                                                        @foreach ($features as $feature)
                                                            <option
                                                            @foreach($package->features as $packageFeature)
                                                                {{ $packageFeature->id == $feature->id ? 'selected' : '' }}
                                                            @endforeach
                                                            value = {{ $feature->id }}>{{ $feature->name }}</option>
                                                        @endforeach"
                                                    data-price="{{ $package->price }}" class="btn btn-warning btn-sm editModal"><i class="fas fa-edit"></i></a>
                                                    <button type="button" onclick="deletepackage({{ $package->id }})" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                                    <form id="delete-form-{{ $package->id }}" action="{{ route('package.destroy',$package->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            <!--start modal-->
                                            <div class="modal fade" id="package-edit">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Are you sure?</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="{{ route('package.update', $package->id) }}" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group md-form">
                                                                    <label for="exampleInputEmail1">Package Name</label>
                                                                    {{-- <input type="text" name="id" value="" id="editThisID" class="form-control" readonly=""> --}}
                                                                    <input type="text" name="title" id="title" class="form-control">
                                                                </div>
                                                                <div class="form-group md-form">
                                                                    <label for="exampleInputEmail1">Package Feature</label>
                                                                    <select name="feature_id[]" class="form-control feature_id" id="feature_id" multiple onfocus="">

                                                                    </select>
                                                                </div>
                                                                <div class="form-group md-form">
                                                                    <label for="exampleInputEmail1">Package Price</label>
                                                                    <input type="text" name="price" id="price" class="form-control">
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
                                <h3 class="card-title">Add New Package</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('package.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Package Name</label>
                                        <input type="text" name="title" class="form-control"  placeholder="">
                                    </div>

                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Package Feature</label>
                                        <select name="features[]" class="form-control feature_id" multiple>
                                            <option>--Select Package Features--</option>
                                            @foreach ($features as $feature)
                                            <option value="{{ $feature->id }}">{{ $feature->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group md-form">
                                        <label for="exampleInputEmail1">Package Price</label>
                                        <input type="text" name="price" class="form-control"  placeholder="">
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
        function deletepackage(id) {
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
      var packageId = $(this).attr('id');
      //var id = $(this).data('id');
      var title= $(this).data('title');
      var features= $(this).data('features');
      var price= $(this).data('price');
      //$(".modal-body #id").val(id);
      $(".modal-body #editThisID").val(packageId);
      $(".modal-body #title").val(title);
      $(".modal-body #feature_id").html(features);
      $(".modal-body #price").val(price);
    });

    //For select2
    $(document).ready(function() {
        // $('.category_id').select2();
        $(".feature_id").select2({
        theme: "classic"
        });
        $("#feature_id").select2({
        theme: "classic"
        });
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
