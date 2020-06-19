@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('sales.store') }}">
    @csrf

    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Order Receive</h1>
        <p>Create Order Receive Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Order Receives</li>
        <li class="breadcrumb-item"><a href="#">Add Order Receive</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        @if(Session::get('error_message'))
        <div class="alert alert-danger">
          {{ Seession::get('error_message') }}
        </div>
        @endif
        @if($errors->any())
        <div class="alert-danger">
          <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <div class="tile">

          <a href="{{route('sales.index')}}" class="btn btn-primary pull-right" style="float: right;"><i class="fa fa-eye"></i>View Order Receive</a>
          <h3 class="tile-title">Add New Order Receive</h3>

          <div class="tile-body">


          <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="sale_date" value="{{ old('sale_date') == '' ? date('Y-m-d'):old('sale_date') }}" class="form-control dateField" type="text" placeholder="Date">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Delivery Date (expected)</label>
              <div class="col-md-8">
                <input name="sale_delivery_date" value="{{ old('sale_delivery_date') == '' ? date('Y-m-d'):old('sale_delivery_date') }}" class="form-control dateField" type="text" placeholder="Delivery Date">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Customer</label>
              <div class="col-md-8">
                <select name="party_id" class="form-control select2">
                  @foreach ($parties as $party)
                  <option value="{{ $party->id }}">{{ $party->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Party (chart of account)</label>
              <div class="col-md-8">
                <select name="chart_of_account_ids[]" class="form-control select2">
                  @foreach ($chart_parties as $id => $name)
                  <option value="{{ $id }}">{{ $name }}</option>
                  @endforeach
                </select>
                <input type="hidden" name="chart_of_account_ids[]" value="{{ $sale_chart_id }}">
              </div>
            </div>


            <div class="mt-2"></div>

            <input type="hidden" name="status_id" value="1">


            <!-- add product -->

            <div class="container">
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing" id="sale_table">
                    <thead>
                      <tr>
                        <th class="text-center"> # </th>
                        <th width="40%" class="text-center"> Product Name</th>
                        <th class="text-center">Pcs (Main Stock)</th>
                        <th class="text-center">Pcs (Branch)</th>
                        <th class="text-center">Pcs (Total)</th>
                        <!-- <th class="text-center">Invoiced</th> 
                        <th class="text-center">Pack Stock</th>
                        <th class="text-center">Invoiced</th>
                        <th class="text-center">Wt Stock</th>
                        <th class="text-center">Invoiced</th>
                        <th class="text-center"> Rate </th> -->
                        <th class="text-center"> Qty (pcs) </th>
                        <!-- <th class="text-center"> Qty (pack) </th>
                        <th class="text-center"> Weight</th>-->
                        <th class="text-center">Price</th>
                        <th class="text-center" width="10%"> Sub Total </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id='addr0'>
                        <td>1</td>
                        <td>
                          <select name="product_ids[]" id="" class="form-control small_input_box" onchange="show_product_stock(this)">
                            <option value="0">select</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->raw_material->name.' - '.$product->name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                            <input type="number" class="form-control small_input_box product_stock" readonly="readonly">


                          <input type="hidden" class="form-control small_input_box already_invoiced" readonly="readonly" value="0">
                          <input type="hidden" class="form-control small_input_box remaining_qty" name="remaining_qty[]" readonly="readonly">

                          <input type="hidden" class="form-control small_input_box pack_stock" readonly="readonly">
                          <input type="hidden" class="form-control small_input_box already_invoiced_pack" readonly="readonly">
                          <input type="hidden" class="form-control small_input_box remaining_pack" name="remaining_pack[]" readonly="readonly">

                          <input type="hidden" class="form-control small_input_box weight_stock" readonly="readonly">
                          <input type="hidden" class="form-control small_input_box already_invoiced_weight" readonly="readonly">
                          <input type="hidden" class="form-control small_input_box remaining_weight" name="remaining_weight[]" readonly="readonly">

                          
                          <td><input type="number" class="form-control small_input_box product_branch" readonly="readonly"></td>
                          <td><input type="number" class="form-control small_input_box product_total" name="product_total_stock[]" readonly="readonly"></td>
                          
                          <td><input type="number" name='qty[]' placeholder='Qty (pcs)' class="form-control qty small_input_box" min="0" onkeyup="check_product_stock(this)" /></td>
                          <td>
                            <input type="number" name='price[]' placeholder='Rate' class="form-control price small_input_box" min="0" step="0.01" value="0" /></td>
                            <input type="hidden" name='pack[]' placeholder='Qty (pack)' class="form-control qty small_input_box" min="0" value="0" onkeyup="check_pack_stock(this)" />
                          <input type="hidden" name="weight[]" placeholder="Weight" class="form-control small_input_box" value="0" onkeyup="check_weight_stock(this)">
                          <td>
                            <input type="number" name='total[]' placeholder='0.00' class="form-control total small_input_box" readonly /></td>
                          </td>
                          
                      </tr>
                      <tr id='addr1'></tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-md-12">
                  <span class="fa fa-trash btn btn-sm btn-danger pull-right pointer small_input_button" id="delete_row"></span>
                  <span class="fa fa-plus btn btn-sm btn-success pull-right pointer small_input_button" id="add_row"></span>
                </div>
              </div>

             
              <div class="clearfix"></div>
			       <div class="row pull-right clearfix" style="margin-top:20px">
                <div class="col-md-12">
                  <table class="table" id="tab_logic_total">
                    <tbody>
                      <tr>
                        <th class="text-center">Tax Amount</th>
                        <td class="text-center"><input type="number" name='invoice_tax' value="0" id="invoice_tax"
                            placeholder='0.00' class="form-control small_input_box"/></td>
                      </tr>
                      <tr>
                        <th class="text-center">Vat Amount</th>
                        <td class="text-center"><input type="number" name='invoice_vat' value="0" id="invoice_vat"
                            placeholder='0.00' class="form-control small_input_box"/></td>
                      </tr>
                      <tr>
                        <th class="text-center">Total Amount</th>
                        <td class="text-center">
                          <input type="hidden" name="sub_total" placeholder='0.00' class="form-control small_input_box" id="sub_total" value="0" readonly />
                          <input type="number" name="total_payable" id="total_amount" placeholder='0.00' min="0" class="form-control small_input_box" value="0" readonly />            
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="clearfix"></div>
           
            </div>

            <div class="tile-footer">
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary pull-right" type="submit" id="submitBtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add Order Receive</button>
                </div>
              </div>
            </div>




          </div>

        </div>
      </div>
    </div>







  </form>
</main>

<script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/select2.min.js')}}"></script>

<script src="{{ asset('assets/admin/js/style.js') }}"></script>

<script type="text/javascript">
  $('.select2').select2();
</script>


<script>
  function disable_submit_button(from, to) {
    var btn = $('#submitBtn').is(':disabled');
    if (parseFloat(from) > to) {
      $('#submitBtn').attr('disabled', true);
      alert('Product stock exceeds!');
    } else {
      $('#submitBtn').attr('disabled', false);
    }
  }

  function check_product_stock(element) {
    var order_quantity = element.value;
    var rowIndex = $(element).closest('tr').index();
    var product_stock = $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.product_stock').val();
    var this_product_stock = product_stock > 0 ? product_stock : 0;
    var product_branch_stock = $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.product_branch').val();
    var this_product_branch_stock = product_branch_stock > 0 ? product_branch_stock : 0;
    var already_invoiced = $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.already_invoiced').val();
    var this_already_invoiced = already_invoiced > 0 ? already_invoiced : 0;
    var remaining_for_invoice = (parseFloat(product_branch_stock) + parseFloat(this_product_stock)) - parseFloat(this_already_invoiced);

    disable_submit_button(order_quantity, remaining_for_invoice);

  }


  function check_pack_stock(element) {
    var order_quantity = element.value;
    var rowIndex = $(element).closest('tr').index();
    var pack_stock = $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.pack_stock').val();
    var this_pack_stock = pack_stock > 0 ? pack_stock : 0;
    var already_invoiced_pack = $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.already_invoiced_pack').val();
    var this_already_invoiced_pack = already_invoiced_pack > 0 ? already_invoiced_pack : 0;
    var remaining_for_invoice = parseFloat(this_pack_stock) - parseFloat(this_already_invoiced_pack);

    disable_submit_button(order_quantity, remaining_for_invoice);

  }


  function check_weight_stock(element) {
    var order_quantity = element.value;
    var rowIndex = $(element).closest('tr').index();
    var weight_stock = $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.weight_stock').val();
    var this_weight_stock = weight_stock > 0 ? weight_stock : 0;
    var already_invoiced = $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.already_invoiced').val();
    var this_already_invoiced = already_invoiced > 0 ? already_invoiced : 0;
    var remaining_for_invoice = parseFloat(this_weight_stock) - parseFloat(this_already_invoiced);

    disable_submit_button(order_quantity, remaining_for_invoice);

  }


  function show_product_stock(element) {
    var id = element.value;
    var rowIndex = $(element).closest('tr').index();

    $.ajax({
      url: '{{ url("api/product_stocks/get_product_stock") }}',
      type: 'GET',
      data: 'id=' + id,
      success: function(res) {
        var product_stock = res['product_stock'];
        var product_branch = res['product_branch'];
        var total_stock = parseFloat(product_stock) + parseFloat(product_branch);
        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.product_stock').val(product_stock);
        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.product_branch').val(product_branch);
        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.product_total').val(total_stock);


        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.already_invoiced').val(res['sale_invoice_quantity']);
        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.remaining_qty').val(total_stock - res['sale_invoice_quantity']);

        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.pack_stock').val(res['pack_stock']);
        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.already_invoiced_pack').val(res['sale_invoice_pack']);
        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.remaining_pack').val(res['pack_stock'] - res['sale_invoice_pack']);

        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.weight_stock').val(res['weight_stock']);
        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.already_invoiced_weight').val(res['sale_invoice_weight']);
        $('#sale_table tbody tr:eq(' + rowIndex + ')').find('.remaining_weight').val(res['weight_stock'] - res['sale_invoice_weight']);
      }
    });
  }

  $(document).ready(function() {
    var i = 1;
    $("#add_row").click(function() {
      b = i - 1;
      $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
      $('#sale_table').append('<tr id="addr' + (i + 1) + '"></tr>');
      i++;
    });
    $("#delete_row").click(function() {
      if (i > 1) {
        $("#addr" + (i - 1)).html('');
        i--;
      }
      calc();
    });

    $('#sale_table tbody').on('keyup change', function() {
      calc();
    });
    $('#invoice_tax').on('keyup change', function() {
      calc_total();
    });
    $('#invoice_vat').on('keyup change', function() {
      calc_total();
    });


  });

  function calc() {
    $('#sale_table tbody tr').each(function(i, element) {
        console.log($(this));
        var qty = $(this).find('.qty').val() > 0 ? $(this).find('.qty').val():0;
        var price = $(this).find('.price').val() > 0 ? $(this).find('.price').val():0;
        $(this).find('.total').val(qty*price);

        calc_total();
    });
  }

  function calc_total() {
    total = 0;
    $('.total').each(function() {
      total += parseFloat($(this).val());
    });
    $('#sub_total').val(total.toFixed(2));
    var invoice_tax = $('#invoice_tax').val() > 0 ? $('#invoice_tax').val():0;
    var invoice_vat = $('#invoice_vat').val() > 0 ? $('#invoice_vat').val():0;
    var total_amount = parseFloat(total) + parseFloat(invoice_tax) + parseFloat(invoice_vat);
    $('#total_amount').val(total_amount.toFixed(2));
  }


</script>

@include('admin.includes.date_field')
@endsection