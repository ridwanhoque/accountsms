@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('product_deliveries.update', $productDelivery->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $productDelivery->id }}">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Delivery Chalan</h1>
        <p>Update Delivery Chalan Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Delivery Chalans</li>
        <li class="breadcrumb-item"><a href="#">Edit Delivery Chalan</a></li>
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
          <h3 class="tile-title">Edit Delivery Chalan</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="product_delivery_date" value="{{ $productDelivery->product_delivery_date }}" class="form-control dateField" type="text" placeholder="Date">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Customer</label>
              <div class="col-md-8">
                <select name="party_id" class="form-control select2">
                  @foreach ($parties as $party)
                  <option value="{{ $party->id }}" {{ $party->id == $productDelivery->party_id ? 'selected':'' }}>{{ $party->name }}</option>
                  @endforeach
                </select>
                <div class="text-danger">{{ $errors->has('party_id') ? $errors->first('party_id'):'' }}</div>
              </div>
            </div>
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Delivery Chalan Number</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="product_delivery_chalan" placeholder="Delivery Chalan Number" value="{{ $productDelivery->product_delivery_chalan }}">
                <div class="text-danger">
                  {{ $errors->has('product_delivery_chalan') ? $errors->first('product_delivery_chalan'):'' }}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Pary</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="driver_name" placeholder="Party" value="{{ $productDelivery->driver_name }}">
                <div class="text-danger">{{ $errors->has('driver_name') ? $errors->first('driver_name'):'' }}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Driver Phone</label>
              <div class="col-md-8">
                <input type="number" class="form-control" name="driver_phone" placeholder="Driver Phone" value="{{ $productDelivery->driver_phone }}">
                <div class="text-danger">{{ $errors->has('driver_phone') ? $errors->first('driver_phone'):'' }}</div>
              </div>
            </div>




            <div class="mt-2"></div>

            <input type="hidden" name="status_id" value="1">


            <!-- add product -->


            <div class="container">
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="table" id="tab_logic">
                    <thead>
                      <tr class="text-center">
                        <th width="30%" class="text-center"> Product Name</th>
                        <th width="12%">Sales Invoice</th>
                        <th>Invoiced (pcs)</th>
                        <th>Delivered (pcs)</th>
                        <th class="text-center">Invoiced Pack</th>
                        <th class="text-center">Delivered Pack</th>
                        <th class="text-center">Invoiced Weight</th>
                        <th class="text-center">Delivered Weight</th>
                        <th class="text-center">Qty (pieces) </th>
                        <th>Qty (packs)</th>
                        <th>Weight</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($productDelivery->product_delivery_details as $key => $details)
                      <input type="hidden" name="product_delivery_details_id" value="{{ $details->id }}">
                      <tr>
                        <td>
                          <input type="hidden" name="product_ids[]" value="{{ $details->product_id }}" class="product_ids">
                          <input type="text" class="form-control small_input_box" value="{{ $details->product->name }}" disabled="disabled">
                        </td>
                        <td>
                          <input type="hidden" class="form-control sale_ids" name="sale_ids[]" value="{{ $details->sale_id }}">
                          <select class="form-control small_input_box" disabled="disabled">
                            @foreach ($sales as $sale)
                            <option value="{{ $sale->id }}" {{ $sale->id == $details->sale_id ? 'selected':'' }}>{{ $sale->sale_reference }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td><input type="number" class="form-control sale_invoice_qty small_input_box" readonly="readonly"></td>
                        <td><input type="text" class="form-control small_input_box already_delivered" readonly="readonly">
                            <input type="hidden" class="form-control small_input_box remaining_qty" name="remaining_qty[]">
                        </td>
                        <td><input type="number" class="form-control product_stock_pack small_input_box" readonly="readonly"></td>
                        <td><input type="number" class="form-control delivered_pack small_input_box" readonly="readonly">
                            <input type="hidden" class="form-control small_input_box remaining_pack" name="remaining_pack[]">
                        </td>
                        <td><input type="number" class="form-control product_stock_weight small_input_box" readonly="readonly"></td>
                        <td><input type="number" class="form-control delivered_weight small_input_box" readonly="readonly">
                            <input type="hidden" class="form-control small_input_box remaining_weight" name="remaining_weight[]">
                        </td>
                        <td>
                          <input type="hidden" name="db_quantity[]" class="db_quantity" value="{{ $details->quantity }}">
                          <input type="number" name='quantity[]' placeholder='Enter Qty' class="form-control qty small_input_box" min="0" value="{{ $details->quantity }}" onkeyup="check_invoice_quantity(this)" />
                        </td>
                        <td>
                          <input type="hidden" name="db_pack[]" class="db_pack" value="{{ $details->pack }}">
                          <input type="number" class="form-control small_input_box pack" name="pack[]" value="{{ $details->pack }}">
                        </td>
                        <td>
                          <input type="hidden" name="db_weight[]" class="db_weight" value="{{ $details->weight }}">
                          <input type="number" class="form-control small_input_box weight" step="0.01" name="weight[]" value="{{ $details->weight }}">
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>

            <div class="tile-footer">
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary pull-right" type="submit" id="submitBtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Edit Delivery Chalan</button>
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


 
 function check_invoice_quantity(element) {
    var delivery_quantity = parseFloat(element.value);
    var row = $(element).closest('tr');
    var remaining_qty = row.find('.remaining_qty').val() > 0 ? row.find('.remaining_qty').val():0;

    disable_submit_button(delivery_quantity, remaining_qty);

  }

  function check_invoice_pack(element){
    var delivery_pack = parseFloat(element.value);
    var row = $(element).closest('tr');

    var remaining_pack = row.find('.remaining_pack').val() > 0 ? row.find('.remaining_pack').val():0;
    var db_pack = row.find('.db_pack').val();
    var remaining_pack_with_this = remaining_pack+db_pack;

    disable_submit_button(delivery_pack, remaining_pack_with_this);

  }

  function check_invoice_weight(element){
    var delivery_weight = parseFloat(element.value);
    var row = $(element).closest('tr');
    var remaining_weight = row.find('.remaining_weight').val() > 0 ? row.find('.remaining_weight').val():0;

    disable_submit_button(delivery_weight, remaining_weight);

  }


  $(document).ready(function() {
    var i = 1;
    $("#add_row").click(function() {
      b = i - 1;
      $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
      $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
      i++;
    });
    $("#delete_row").click(function() {
      if (i > 1) {
        $("#addr" + (i - 1)).html('');
        i--;
      }
    });

    $('.product_ids').each(function() {

      var row = $(this).closest('tr');

      var id = row.find('.sale_ids').val();
      var product_id = row.find('.product_ids').val();

      $.ajax({
        url: '{{ url("product_deliveries/sale_invoice_qty") }}',
        type: 'GET',
        data: 'id=' + id + '&product_id=' + product_id,
        success: function(res) {
          var db_qty = row.find('.db_qty').val();
          var db_pack = row.find('.db_pack').val();
          var db_weight = row.find('.db_weight').val();

            row.find('.sale_invoice_qty').val(res['sale_invoice_qty']);
            row.find('.already_delivered').val(res['already_delivered']);
            row.find('.remaining_qty').val((res['sale_invoice_qty']-res['already_delivered'])+(parseFloat(db_qty)*2));

            row.find('.product_stock_pack').val(res['product_stock_pack']);
            row.find('.delivered_pack').val(res['delivered_pack']);
            row.find('.remaining_pack').val((res['product_stock_pack']-res['delivered_pack'])+(parseFloat(db_pack)*2));
            
            row.find('.product_stock_weight').val(res['product_stock_weight']);
            row.find('.delivered_weight').val(res['delivered_weight']);
            row.find('.remaining_weight').val((res['product_stock_weight']-res['delivered_weight'])+(parseFloat(db_weight*2)));
        }
      });


    });



  });
</script>
@include('admin.includes.date_field')
@endsection