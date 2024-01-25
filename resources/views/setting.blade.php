@extends('app')

@section('title','Settings')

@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
.label{
    position: absolute;
    right: 20px;
    top: -18px;
}
.f-group{
    padding-right: 150px;
}

.abc{
    position: relative;
}

a.closeEverything {
    position: absolute;
    right: 18px;
    top: 7px;
}
</style>
@endpush

@section('content')
<br><br>
{{-- <h3 style="border-bottom: 3px solid #999" class="text-center card-common">Purchase Product</h3> --}}
     <div class="container-fluid" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 offset-lg-2 offset-md-2">
                <div class="row pt-md-5 mt-md-3 mb-5">
                    <div class="col-xl-12 col-sm-12 p-2">
                        <div class="card card-common" style="border: 1px solid #3097D1;">
                            <div class="card-header">
                                <h3 class="card-title text-center">Settings</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('setting.update', $setting->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row clearfix align-items-center">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5 form-control-label">
                                            <label class="label" for="invoice_id">Company Name</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-7">
                                            <div class="form-group f-group">
                                                <div class="form-line">
                                                    <input type="text" value="{{ $setting->company_name }}" name="company_name" id="invoice_id" class="form-control"  placeholder="" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix align-items-center">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5 form-control-label">
                                            <label class="label" for="invoice_id">Company Logo</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-7">
                                            <div class="form-group f-group">
                                                <div class="form-line">
                                                    <input type="file" name="logo" id="invoice_id" class="" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix align-items-center">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5 form-control-label">
                                            <label class="label" for="invoice_id">Current Logo</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-7">
                                            <div class="form-group f-group">
                                                <div class="form-line">
                                                    <img src="{{ asset('images/'.$setting->logo) }}" width="100" height="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix align-items-center">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5 form-control-label">
                                            <label class="label" for="invoice_id">Phone</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-7">
                                            <div class="form-group f-group">
                                                <div class="form-line">
                                                    <input type="text" value="{{ $setting->phone }}" name="phone" id="invoice_id" class="form-control"  placeholder="" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix align-items-center">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5 form-control-label">
                                            <label class="label" for="invoice_id">Address</label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-7">
                                            <div class="form-group f-group">
                                                <div class="form-line">
                                                    <textarea type="text" name="address" id="invoice_id" class="form-control" required="">{{ $setting->address }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix align-items-center">
                                        <div class="col-lg-6 col-md-6 col-sm-4 col-xs-5 form-control-label">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <div class="row clearfix align-items-center">
                                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                            <button type="submit" class="submit btn btn-primary btn-sm m-t-15 waves-effect">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<script type="text/javascript">

    $('.product_id').select2();
    var response="";
    var option = "";

    function DeleteRow(o) {
    $(o).parents('div[id=xxx]').remove();
    }

    $(".addMore").click(function() {
    $("#invoice_id").attr('readonly', 'true');
    var suplier_id = $("#suplier_id").val();
    $("#suplier_text").val(suplier_id);
    $("#suplier_id").css('display', 'none');
    $("#suplier_text").css('display', 'block');
    $(".product_id").select2("destroy");
    option = $(".products").html();
    $("#id_product_id").removeClass("product_id");
    $(".closeEverything").remove();
    $('.addrow').html(option);
    $('.product_id').select2();
    $('.addMore').css('display', 'none');
    $('.addMore2').css('display', 'block');
    $('.closeEverything').css('display', 'block');
   });

   $('.addMore2').click(function() {
   $(".products").html();

   $('.addrow').append(option);
   $('.product_id').select2();
   $('.closeEverything').css('display', 'block');
   });

   $("#suplier_id").select(function() {
   $("#suplier_text").val(suplier_id);
   });


   $("#suplier_id").on('change',function(){
  var suplier = $(this).val();
  $('.product_id').empty();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //alert(data);
    $.ajax({
      url: "{{ route('productList') }}",
      //url:'./productlist',
      type:'POST',
      data:{suplier: suplier},

      success: function (data) {
        response=JSON.parse(data);

        $.each(response, function(index, element) {

          $('.product_id').append("<option value="+element.id+">"+element.name+"-"+element.code+"</option>");
        });
      }
    });
  });

    // $("#amount_paid").on('click',function(){
    //     var value = $("#total_cost").val();
    //     $(this).attr('max',value);
    //     //alert(value);
    // });


    $('#from_where').on('change',function(){

    var select = $(this).val();
    var cash = parseInt($('.cash').html());

    if(select == 1)
    {
    if($("#amount_paid").val() - cash > 0)
    {
        alert("you don't have enough cash");
        $(".submit").attr('disabled',true);
    }
    else {
        $(".submit").attr('disabled',false);
    }
    }
    else
    {
    $(".submit").attr('disabled',false);
    }

    });

    $('.amount_paidd').on('keyup',function(){
         var cash = parseInt($('.cash').html());
         var value = $("#total_cost").val()
         //alert(cash);
        if($("#from_where").val() == 1){
            if($(this).val() - cash > 0){
                alert("You don't have enough cash");
                $(".submit").attr('disabled',true);
                $(".amount_paidd").attr('title',"value must be less than or equale "+value+".");
                $(".submit").attr('title',"value must be less than or equale "+value+".");
            }else {
                $(".submit").attr('disabled',false);

            }
            //alert("select 1");
        }else{
            $(".submit").attr('disabled',false);
        }
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
