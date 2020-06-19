@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('product_deliveries.store') }}">
    @csrf
    <input type="hidden" name="status_id" value="1">

    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Delivery Chalan</h1>
        <p>Create Delivery Chalan Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Delivery Chalans</li>
        <li class="breadcrumb-item"><a href="#">Add Delivery Chalan</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        @if(Session::get('error_message'))
        <div class="alert alert-danger">
          {{ Session::get('error_message') }}
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

          <a href="{{ route('product_deliveries.index') }}" class="btn btn-primary pull-right" style="float: right;"><i class="fa fa-eye"></i>View Delivery Chalan</a>
          <h3 class="tile-title">Add New Delivery Chalan</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="product_delivery_date" value="{{ old('product_delivery_date') == '' ? date('Y-m-d'):old('product_delivery_date') }}" class="form-control dateField" type="text" placeholder="Date">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Delivery Chalan Number</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="product_delivery_chalan" placeholder="Delivery Chalan Number" value="{{ old('product_delivery_chalan') }}">
                <div class="text-danger">
                  {{ $errors->has('product_delivery_chalan') ? $errors->first('product_delivery_chalan'):'' }}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Driver Name</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="driver_name" placeholder="Driver Name" value="{{ old('driver_name') }}">
                <div class="text-danger">{{ $errors->has('driver_name') ? $errors->first('driver_name'):'' }}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Driver Phone</label>
              <div class="col-md-8">
                <input type="number" class="form-control" name="driver_phone" placeholder="Driver Phone" value="{{ old('driver_phone') }}">
                <div class="text-danger">{{ $errors->has('driver_phone') ? $errors->first('driver_phone'):'' }}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Reference Name</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="reference_name" placeholder="Reference Name" value="{{ old('reference_name') }}">
                <div class="text-danger">{{ $errors->has('reference_name') ? $errors->first('reference_name'):'' }}</div>
              </div>
            </div>




            <div class="mt-2"></div>


            <!-- add product -->




            <div class="container">
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="table no-spacing text-center" id="product_deliveries_table">
                    <thead>
                      <tr>
                        <th width="30%" class="text-center"> Product Name</th>
                        {{-- <th width="30%"> Lot </th> --}}
                        <th width="12%">Sales Invoice</th>
                        <th>Invoiced (pcs)</th>
                        <th>Delivered (pcs)</th>
                        <!-- <th class="text-center">Invoiced Pack</th>
                        <th class="text-center">Delivered Pack</th>
                        <th class="text-center">Invoiced Weight</th>
                        <th class="text-center">Delivered Weight</th> -->
                        <th class="text-center">Branch</th>
                        <th class="text-center">Qty (stock)</th>
                        <th class="text-center">Pack (stock)</th>
                        <th class="text-center">Weight (stock)</th>
                        <th class="text-center">Qty (pieces) </th>
                        <th>Qty (packs)</th>
                        <th>Weight</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id='addr0'>
                        <td>
                          <select name="product_ids[]" class="form-control small_input_box product_ids" onchange="loadInvoices(this)">
                            <option value="0">select</option>
                            @foreach ($products as $product)
                              <option value="{{ $product->id }}">{{ $product->raw_material->name.'-'.$product->name }}</option>
                            @endforeach
                          </select>
                          <div class="text-danger">
                            {{ $errors->has('product_ids.*') ? $errors->first('product_ids.*'):'' }}</div>
                        </td>
                        {{-- <td>
                          <select name="daily_production_details_ids[]" class="form-control small_input_box">
                            @foreach ($daily_production_details as $details)
                              <option value="{{ $details->id }}">{{ $details->daily_production_details_code }}</option>
                        @endforeach
                        </select>
                        <div class="text-danger">
                          {{ $errors->has('daily_production_details_ids.*') ? $errors->first('daily_production_details_ids.*'):'' }}
                        </div>
                        </td> --}}
                        <td>
                          <select name="sale_ids[]" class="form-control small_input_box sale_ids" onchange="load_sale_invoice_stock(this)">
                          </select>
                          </div>
                        </td>
                        <td><input type="number" class="form-control small_input_box sale_invoice_qty" readonly="readonly" placeholder="invoice quantity" name="sale_invoice_qty[]"></td>
                        <td><input type="number" class="form-control small_input_box already_delivered" placeholder="already delivered" readonly="readonly">
                          <input type="hidden" class="form-control small_input_box remaining_qty" name="remaining_qty[]">
                          
                          <input type="hidden" class="form-control small_input_box product_stock_pack" name="product_stock_pack[]" readonly="readonly" placeholder="pack stock" value="0">
                          <input type="hidden" class="form-control small_input_box delivered_pack" placeholder="delivered pack" readonly="readonly" value="0">
                          <input type="hidden" class="form-control small_input_box remaining_pack" name="remaining_pack[]" readonly="readonly" value="0">
                          
                          <input type="hidden" class="form-control small_input_box product_stock_weight" name="product_stock_weight[]" readonly="readonly" placeholder="wt stock" value="0">
                          <input type="hidden" class="form-control small_input_box delivered_weight" placeholder="delivered weight" readonly="readonly" value="0">
                          <input type="hidden" class="form-control small_input_box remaining_weight" name="remaining_weight[]" readonly="readonly" value="0"></td>
                        
                        
                          <td>
                            <select name="branch_ids[]" class="form-control small_input_box branch" onchange="loadProductByBranch(this)">
                              <option value="0">select</option>
                              <option>Main</option>
                              @foreach($branches as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                              @endforeach
                            </select>
                          </td>
                          <td><input type="text" class="form-control small_input_box available_quantity" readonly="readonly" name="available_quantity[]"></td>
                          <td><input type="text" class="form-control small_input_box available_pack" readonly="readonly" name="available_pack[]"></td>
                          <td><input type="text" class="form-control small_input_box available_weight" readonly="readonly" name="available_weight[]"></td>
                          <td><input type="number" name='quantity[]' placeholder='Enter Qty' class="form-control qty small_input_box" min="0" onkeyup="check_invoice_quantity(this)"/></td>
                        <td><input type="number" name="pack[]" class="form-control small_input_box" placeholder="Enter Pack" onkeyup="check_invoice_pack(this)"></td>
                        <td><input type="number" name="weight[]" class="form-control small_input_box input_weight" step="0.01" placeholder="Enter Weight" onkeyup="check_invoice_weight(this)" value="0" readonly=""></td>
                      </tr>
                      <tr id='addr1'></tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-md-12">
                  <span class="fa fa-trash fa-xs pull-right pointer btn btn-sm btn-danger small_input_button" id="delete_row"></span>
                  <span class="fa fa-plus fa-xs pull-right pointer btn btn-sm btn-success small_input_button" id="add_row"></span>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>

            <div class="tile-footer">
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary pull-right" type="submit" id="submitBtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add Delivery Chalan</button>
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
<script src="{{ asset('assets/admin/js/vue.min.js') }}"></script>

<script>

  var vm = new Vue({
    el: '#app_test',
    data: {
      product: 'product-name'
    }
  })
</script>

<script>

function loadProductByBranch(element){
    var row = $(element).closest('tr');
    var branch_id = element.value;
    var product_id = row.find('.product_ids').val();

    $.ajax({
      url: '{{ url("api/product_stocks/get_product_branch_stock") }}',
      type: 'GET',
      data: 'product_id=' + product_id + '&branch_id=' + branch_id,
      success:function(res){
        row.find('.available_quantity').val(res['product_quantity']);
        row.find('.available_pack').val(res['product_pack']);
        row.find('.available_weight').val(res['product_weight']);

        row.find('.product_stock_pack').val(res['product_pack']);
        var delivered_pack = row.find('.delivered_pack').val();
        row.find('.remaining_pack').val(parseFloat(res['product_pack']-delivered_pack));

        row.find('.product_stock_weight').val(res['product_weight']);
        var delivered_weight = row.find('.delivered_weight').val();
        row.find('.remaining_weight').val(parseFloat(res['product_weight']-delivered_weight));

        row.find('.product_stock_pack').val(res['product_pack']);
        var delivered_pack = row.find('.delivered_pack').val();
        row.find('.remaining_pack').val(parseFloat(res['product_pack']-delivered_pack));
      }
    });
}


  function loadInvoices(element) {

    var id = element.value;
    var rowIndex = $(element).closest('tr').index();
    $.ajax({
      url: '{{ url("product_deliveries/invoice_by_product") }}',
      type: 'GET',
      data: 'id=' + id,
      success: function(data) {
        $('#product_deliveries_table tbody tr:eq(' + rowIndex + ')').find('.sale_ids').html(data);
      }
    });

    // var rowIndex = $(element).closest('tr').index();

    // var arr = $('select.product_ids').map(function(){
    //           return this.value
    //       }).get();
    // if (rowIndex > 0) {
    //   var seleted_products = $('select.product_ids').map(function() {
    //     return this.value;
    //   }).get();

    //   var tr = $('#product_deliveries_table tbody tr:eq(' + rowIndex + ')');
    //   alert($.inArray(tr.find('.product_ids').val(), seleted_products));
    //   alert($.inArray(2, [1,2,3]));

    //   tr.$.inArray(tr.find('.product_ids').val(), seleted_products).attr('disabled', true);

    //   alert(tr.find('.product_ids').val());
    //   alert(seleted_products);


    //   tr.find('.product_ids option').filter(function() {
    //     var current_option = tr.find('.product_ids').val();
    //     return $.inArray(current_option, seleted_products) > -1; //if value is in the array of selected values

    //   }).attr("disabled", true);


    // }




  }

  function load_sale_invoice_stock(element) {
    var id = element.value;
    var row = $(element).closest('tr');
    var product_id = row.find('.product_ids').val();
    $.ajax({
      url: '{{ url("product_deliveries/sale_invoice_qty") }}',
      type: 'GET',
      data: 'id=' + id + '&product_id=' + product_id,
      success: function(res) {
        row.find('.sale_invoice_qty').val(res['sale_invoice_qty']);
        row.find('.already_delivered').val(res['already_delivered']);
        row.find('.remaining_qty').val(res['sale_invoice_qty']-res['already_delivered']);

        row.find('.product_stock_pack').val(res['product_stock_pack']);
        row.find('.delivered_pack').val(res['delivered_pack']);
        row.find('.remaining_pack').val(res['product_stock_pack']);
        // row.find('.remaining_pack').val(res['product_stock_pack']-res['delivered_pack']);
        
        row.find('.product_stock_weight').val(res['product_stock_weight']);
        row.find('.delivered_weight').val(res['delivered_weight']);
        row.find('.remaining_weight').val(res['product_stock_weight']);
        // row.find('.remaining_weight').val(res['product_stock_weight']-res['delivered_weight']);
      }
    });

  }



  function disable_submit_button(from, to) {
    var btn = $('#submitBtn').is(':disabled');
      if (parseFloat(from) > to) {
        $('#submitBtn').attr('disabled', true);
        alert('Product stock exceeds!');
      } else {
          $('#submitBtn').attr('disabled', false);
      }
  }


  function setAutoWeight(row, quantity){
    var available_quantity = row.find('.available_quantity').val();
    var stock_quantity = available_quantity > 0 ? parseFloat(available_quantity):0;

    var available_weight = row.find('.available_weight').val();
    var stock_weight = available_weight > 0 ? parseFloat(available_weight):0;

    var current_weight = ((stock_weight/stock_quantity)*quantity).toFixed(2);
    row.find('.input_weight').val(current_weight);

  }

  function check_invoice_quantity(element) {
    var delivery_quantity = parseFloat(element.value);
    var row = $(element).closest('tr');
    var remaining_qty = row.find('.remaining_qty').val() > 0 ? row.find('.remaining_qty').val():0;

    setAutoWeight(row, delivery_quantity);

    disable_submit_button(delivery_quantity, remaining_qty);

  }

  function check_invoice_pack(element){
    var delivery_pack = parseFloat(element.value);
    var row = $(element).closest('tr');

    var product_stock_pack = row.find('.product_stock_pack').val() > 0 ? row.find('.product_stock_pack').val():0;
    
    disable_submit_button(delivery_pack, product_stock_pack);

  }

  function check_invoice_weight(element){
    var delivery_weight = parseFloat(element.value);
    var row = $(element).closest('tr');
    var product_stock_weight = row.find('.product_stock_weight').val() > 0 ? row.find('.product_stock_weight').val():0;

    disable_submit_button(delivery_weight, product_stock_weight);

  }

</script>


<script>
  $(document).ready(function() {
    var i = 1;
    $("#add_row").click(function() {
      b = i - 1;
      $('#addr' + i).html($('#addr' + b).html());
      $('#product_deliveries_table').append('<tr id="addr' + (i + 1) + '"></tr>');
      i++;
    });
    $("#delete_row").click(function() {
      if (i > 1) {
        $("#addr" + (i - 1)).html('');
        i--;
      }
    });


  });
</script>

@include('admin.includes.date_field')
@endsection