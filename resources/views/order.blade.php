@extends('app')

@section('title','Category')

@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
.g-invoice-customer{
    width: 300px;
    position: absolute;
    display: block;
    padding-left: 8px;
    padding-right: 20px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    left: 40%;
    top: 80px;
}
.aaa{
    padding: 0 20px;
}
.ccc{
    width: 400px;
    height: 100px;
    margin: 0;
}
.pointer{
    cursor: pointer;
}

</style>

<style media="screen">
    .customerName,.customerAddress,.invoiceNo,.invoiceDate
    {
        background: transparent;
        border: none;
        border-bottom: 1px dashed #83A4C5;
        width: 30%;
        outline: none;
        padding: 0px 0px 0px 0px;
        margin:10px;
        font-style: italic;
    }
    .table-input {
        border:0px;
    }
    .invoiceFooter{
        display: none;
    }

    .logo {
        display:inline-block;
        vertical-align:top;
        margin-top:6px;
    }
</style>
@endpush

@section('content')
<br><br><br><br><br>
{{-- <h3 style="border-bottom: 3px solid #999" class="text-center card-common">Invoice</h3> --}}
    <div class="container-fluid" style="margin-top: -65px;">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12" style="margin-bottom: 30px;">
                <div class="card g-invoice-card">
                    <div class="card-header">
                        <h3 class="card-title">Create Order</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <span class="aaa font-weight-bold">Select a Customer</span>
                                <span>
                                    <select class="ccc customer_id" name="customer_id">
                                        <option value="0">-Walk in customer-</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->id }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            <span data-toggle="modal" data-target="#add-customer" class="aaa pointer"><i class="fas fa-user-plus"></i></span>
                        </div><br>
                        <form class="form-horizontal" role="form" method="POST">
                            @csrf
                            <table class="table table-striped invoice_table">
                                <thead>
                                    <tr>
                                        <th style="width:40%">Product Name</th>
                                        <th>Available</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                        <th>Product Discount</th>
                                        <th>Net Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select id="product_id" type="text" name="product_id[]" class="form-control product_id" required autofocus>
                                                <option value="">-Select a Product-</option>
                                                @foreach($products as $product)
                                                <option value="{{$product->product_id}}">{{$product->product->name}}-{{$product->product->code}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><span class="quantity"></span></td>
                                        <td><input id="quantity" type="number" name="quantity[]" value="" class="form-control" required autofocus></td>
                                        <td><input id="unit_price" type="number" name="unit_price[]" class="form-control" readonly required autofocus></td>
                                        <td><span class="total_price"></span></td>
                                        <td><input id="product_discount" type="number" name="product_discount[]" class="form-control" value="" required autofocus></td>
                                        <td><span class="net_price"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button title="Please select a product" type="button" class="btn btn-primary addButton" disabled="">
                                        <span class="fa fa-plus-square fa-lg"></span>  Add Product
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="card g-invoice-card">
                    <div class="card-header">
                        <h3 class="card-title d-inline-block">Order Details</h3>
                        {{-- <h3 style="position: absolute; right: 20px;" class="card-title d-inline-block"><a href="#" class="text-light text-decoration-none"><i class="fas fa-money-bill fa-lg"></i> Create Invoice</a></h3> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="invoiceTable">
                                <tbody>
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Product Name</th>
                                        <th>Price(unit)</th>
                                        <th>Total Price</th>
                                        <th>Discount</th>
                                        <th>Net Price</th>
                                    </tr>
                                    <tfoot>
                                    {{-- <tr>
                                        <td colspan="5" style="text-align:right;"><h5>Delivery Charge:</h5></td>
                                        <td><input type="text" class="form-control delivery" name="delivery" class="delivery" value="00.00">
                                        <span class="deliveryCharge" id="deliveryCharge"></span></td>
                                    </tr> --}}

                                        <tr>
                                        <td colspan="5" style="text-align:right;"><h5>Discount On Total Amount:</h5></td>
                                        <td><input type="text" class="form-control discount" name="discount" class="reduced" value="0">
                                            <span class="discount_amount"></span>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td colspan="5" style="text-align:right;"><h5>Tax:</h5></td>
                                        <td><div class="input-group">
                                            <input type="text" class="form-control tax" name="tax" class="tax" value="10" readonly/>
                                            <span class="input-group-addon">
                                            <i class="fa fa-percent"></i>
                                            </span>
                                            <span class="taxAmount"></span>
                                        </div>

                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td colspan="5" style="text-align:right;"><h5>Net Amount:</h5></td>
                                        <td><span class="netAmount" id="netAmount"></span></td>
                                    </tr> --}}
                                    <tr>
                                        <td colspan="5" style="text-align:right;"><h5>Total amount</h5></td>
                                        <td><span class="total_Amount"></span></td>
                                    </tr>

                                    <tr>
                                        <td style="text-align:right;"><h5>Payment method</h5></td>
                                        <td><select class="form-control payment_method" name="payment_method" >
                                        <option value="">-Select-</option>
                                        <option value="1">Cash</option>
                                        <option value="2">Card</option>
                                        </select> <span class="payment_methodText"></span></td>

                                        <td style="text-align:right;"><h5>Payment Status</h5></td>
                                        <td><select class="form-control payment_method" name="payment_method" >
                                        <option value="">-Select-</option>
                                        <option value="1">PAID</option>
                                        <option value="2">PARTIAL</option>
                                        <option value="3">UNPAID</option>
                                        </select> <span class="payment_methodText"></span></td>
                                        <td><h5>Paid amount</h5></td>
                                        <td><input class="form-control paid_amount" type="number" name="paid_amount" min="0"/>
                                        <span class="paid_amountText"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align:right;"><h5>Amount Due:</h5></td>
                                        <td><span class="due"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="text-align:right;">
                                            <a href="#" class="btn btn-danger">Order Cancle</a>
                                            <a href="#" class="btn btn-success">Order Confirm</a>
                                        </td>
                                    </tr>
                                    </tfoot>

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--modal-->
    <div class="modal fade" id="add-customer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Customer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('order.customer') }}">
                        @csrf
                        <div class="form-group md-form">
                            <label for="exampleInputEmail1">Customer Name</label>
                            <input type="text" name="name" class="form-control"  placeholder="">
                        </div>
                        <div class="form-group md-form">
                            <label for="exampleInputEmail1">Customer Email</label>
                            <input type="text" name="email" class="form-control"  placeholder="">
                        </div>
                        <div class="form-group md-form">
                            <label for="exampleInputEmail1">Customer Phone</label>
                            <input type="text" name="phone" class="form-control"  placeholder="">
                        </div>
                        <div class="form-group md-form">
                            <label for="exampleInputEmail1">Customer Address</label>
                            <input type="text" name="address" class="form-control"  placeholder="">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end modal-->

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('assets/js/sweetalert2.all.js') }}"></script>
{{-- <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script> --}}
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
    $(document).ready(function(){
    $(window).resize(function() {
      var mobileWidth =  (window.innerWidth > 0) ?
      window.innerWidth :
      screen.width;
      var viewport = (mobileWidth > 480) ?
      'width=device-width, initial-scale=1.0' :
      'width=1200';
      $("meta[name=viewport]").attr('content', viewport);
    }).resize();

    $('.customer_id').select2();
    $('.product_id').select2();
    $('#quantity').on('keydown', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
    $('#unit_price').on('keydown', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
    $('#product_discount').on('keydown', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});


    // var sum = 5;
    // var taxAmount;
    // var taxWow;

    // var aaa = $(".total_Amount").html(sum);
    // alert(aaa);
    // taxWow = $(".tax").val();
    // taxWow = parseInt((taxWow*sum)/100);
    // sum += parseFloat(taxWow);

    // $(".netAmount").html(sum);
    // $(".due").html(sum);

    $('#product_id').on("change",function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var product_id = $(this).val();
        //alert(product_id);

        $.ajax({
          url: "{{ route('order.productInfo') }}",
          type:'POST',
          data:{product_id: product_id},

          success: function (data) {
            //alert(data);
            response=JSON.parse(data);
            $.each(response, function(index, element) {
              $(".quantity").html(element.quantity);
              $("#unit_price").val(element.unit_price);
              $("#product_discount").val(element.discount);
            });
            $(".total_price").html("");
            $(".net_price").html("");
            $('#quantity').val("");
          }
        });
    });


    $('#quantity').on('blur',function(){
        var quantity = parseInt($(".quantity").html());
        var givenQuantity = parseInt($('#quantity').val());
        var unit_price = parseInt($("#unit_price").val());
        var product_discount = parseInt($("#product_discount").val());

        if(quantity < givenQuantity )
        {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Exceed Quantity !!'
            })
          $('#quantity').val("");
        }
        else {
          var total_price = (givenQuantity*unit_price);
          var net_price = ((total_price/100)*product_discount);
          var final_price = Math.round((total_price - net_price));

          $(".total_price").html(total_price);
          $(".net_price").html(final_price);

          $('.addButton').removeAttr('disabled');
        }
      });

      $("#product_discount").on('focus',function(){
        $('.addButton').attr('disabled','true');
      });

      $("#quantity").on('focus',function(){
        $('.addButton').attr('disabled','true');
      });

      $("#product_discount").on('blur',function(){
        var quantity = parseInt($(".quantity").html());
        var givenQuantity = parseInt($('#quantity').val());
        var unit_price = parseInt($("#unit_price").val());
        var product_discount =parseInt($(this).val());
        if(quantity < givenQuantity )
        {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Exceed Quantity !!'
            })
          $('#quantity').val("");
        }
        else {
          var total_price = (givenQuantity*unit_price);
          var net_price = ((total_price/100)*product_discount);
          var final_price = Math.round((total_price - net_price));

          $(".total_price").html(total_price);
          $(".net_price").html(final_price);

          $('.addButton').removeAttr('disabled');
        }
      });

        $('.addButton').click(function(){
            //alert('clicked');
            //var customerCheck = $('.customer_id').val();
            var productCheck = $('.product_id').val();
            var quantityCheck = $('#quantity').val();
            //alert(customerCheck);
            if(productCheck == ""){
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please select a product !!'
                });
            }else if(quantityCheck == ""){
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please give product quantity !!'
                });
            }else {
                var customer_id = $('.customer_id').val();
                var product_id = $('#product_id').val();
                var product_name = $("#product_id option:selected").text().split("-").pop();
                var quantity = $('#quantity').val();
                var unit_price = $('#unit_price').val();
                var total_price = $('.total_price').html();
                var product_discount = $('#product_discount').val();
                var net_price = parseInt($('.net_price').html());

                var totalAmount = parseInt($(".total_Amount").html());
                totalAmount = parseInt(totalAmount+net_price);
                $(".total_Amount").html(totalAmount);
                alert(totalAmount);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                url:"{{ route('tempOrder') }}",
                type:'POST',
                data:{product_id: product_id, product_name: product_name, quantity: quantity, unit_price: unit_price, total_price: total_price, product_discount: product_discount, net_price: net_price, customer_id: customer_id},

                success: function (data) {
                alert(data);
                var temporary = data;

                $("#invoiceTable tbody tr:last").after("<tr><td><input class='table-input quantity' type='text' name='quantity[]' value='"+quantity+"'readonly></td><td><input type='hidden' class='product_id' name='product_id[]' value='"+product_id+"' class='product_id' /><input class='table-input product_name' type='text' name='product_name[]' value='"+product_name+"'readonly></td><td><input class='table-input unit_price' type='text' name='unit_price[]' value='"+unit_price+"'readonly></td><td><input class='table-input total_price' type='text' name='total_price[]' value='"+total_price+"'readonly></td><td><input class='table-input product_discount' type='text' name='product_discount[]'value='"+product_discount+"'readonly></td><td><input class='table-input net_price' type='text' name='net_price[]' value='"+net_price+"'readonly></td><td class='hidden-val'><button type='button' class='btn btn-danger deleteRow' style='cursor:pointer;' value='"+temporary+"'><i class='fas fa-trash-o'></i></td></tr>");
                $('#product_id').select2('val', 'All');
                $('#quantity').val("");
                $('#unit_price').val("");
                $('.total_price').html("");
                $('#product_discount').val("");
                $('.net_price').html("");
                $(".quantity").html("");
                $('.addButton').attr('disabled','true');
                }
                });
            }
        });

        $("#invoiceTable").on("click",".deleteRow",function(){
        var temp = $(this).val();
        //alert(temp);
        var net_price = $(this).closest("td").prev().find("input[type='text']").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
            url:"{{ route('deleteTempOrder') }}",
            type:'POST',
            data:{temp: temp},
            success: function (data) {
                var total = parseInt($(".total_Amount").html());
                var net = parseInt($(".netAmount").html());

                $(".total_Amount").html(total-net_price);
                $(".netAmount").html(net-net_price);
                $(".due").html(net-net_price);
                $(".deleteRow").filter(function(){return this.value==temp}).parents('tr').first().remove();
            }
            });
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
