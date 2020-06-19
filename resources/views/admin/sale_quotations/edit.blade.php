@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('sale_quotations.update', $saleQuotation->id) }}">
    @csrf
    @method('PUT')
    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Sale Quotation</h1>
        <p>Update Sale Quotation Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Sale Quotations</li>
        <li class="breadcrumb-item"><a href="#">Edit Sale Quotation</a></li>
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

          <a href="{{route('sale_quotations.index')}}" class="btn btn-primary pull-right" style="float: right;"><i
              class="fa fa-eye"></i>View Sale Quotation</a>
          <h3 class="tile-title">Edit New Sale Quotation</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="sale_quotation_date"
                  value="{{ $saleQuotation->sale_quotation_date ? $saleQuotation->sale_quotation_date:date('Y-m-d') }}" class="form-control"
                  type="text" placeholder="Date" readonly="readonly">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Customer</label>
              <div class="col-md-8">
                <select name="party_id" class="form-control select2">
                  @foreach ($parties as $party)
                  <option value="{{ $party->id }}" {{ $party->id == $saleQuotation->party_id ? 'selected':'' }}>{{ $party->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>


            <div class="mt-2"></div>


            <!-- add product -->


            <div class="container">
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="table no-spacing" id="tab_logic">
                    <thead>
                      <tr>
                        <th class="text-center"> # </th>
                        <th width="25%" class="text-center"> Product Name</th>
                        <th class="text-center"> Price </th>
                        <th class="text-center"> Qty</th>
                        <th class="text-center"> Sub Total </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($saleQuotation->sale_quotation_details as $details)
                      <input type="hidden" name="sale_quotation_details_ids[]" value="{{ $details->id }}">
                      <tr id='addr0'>
                          <td>1</td>
                          <td>
                            <select name="product_ids[]" class="form-control product small_input_box">
                              <option value="0">select</option>
                                @foreach ($products as $product)
                                  <option value="{{ $product->id }}" {{ $details->product_id == $product->id ? 'selected':'' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">
                              {{ $errors->has('product_ids.*') ? $errors->first('product_ids.*'):'' }}
                            </div>
                          </td>
                          <td><input type="number" name='price[]' placeholder='Enter Unit Price'
                              class="form-control price small_input_box" min="0" step="0.001" value="{{ $details->unit_price }}" />
                            <div class="text-danger">{{ $errors->has('price.*') ? $errors->first('price.*'):'' }}</div>
                          </td>
                          <td><input type="number" name='qty[]' placeholder='Enter Qty'
                              class="form-control qty small_input_box" min="0" step="0.001" value="{{ $details->quantity }}" />
                            <div class="text-danger">{{ $errors->has('qty.*') ? $errors->first('qty.*'):'' }}</div>
                          </td>
                          <td><input type="number" name='total[]' placeholder='0.00'
                              class="form-control total small_input_box" readonly value="{{ $details->product_sub_total }}" /></td>
                        </tr>                            
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row pull-right clearfix" style="margin-top:20px">
                <div class="col-md-12">
                  <table class="table" id="tab_logic_total">
                    <tbody>
                      <tr>
                        <th class="text-center">Sub Total</th>
                        <td class="text-center"><input type="number" name='sub_total' placeholder='0.00'
                            class="form-control" id="sub_total" readonly value="{{ $saleQuotation->sub_total }}" /></td>
                      </tr>
                      <tr>
                        <th class="text-center">Discount Amount</th>
                        <td class="text-center"><input type="number" name='invoice_discount' value="{{ $saleQuotation->invoice_discount }}"
                            id="invoice_discount" placeholder='0.00' class="form-control" /></td>
                      </tr>
                      <tr>
                        <th class="text-center">Vat</th>
                        <td class="text-center"><input type="number" name='invoice_vat' value="{{ $saleQuotation->invoice_vat }}"
                            id="invoice_vat" placeholder='0.00' class="form-control" /></td>
                      </tr>
                      <tr>
                        <th class="text-center">Tax</th>
                        <td class="text-center">
                          <div class="input-group mb-2 mb-sm-0">
                            <input type="number" name="tax_percent" class="form-control" id="tax" placeholder="0"
                              min="0" max="100" value="{{ $saleQuotation->tax_percent }}">
                            <div class="input-group-addon">%</div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center">Tax Amount</th>
                        <td class="text-center"><input type="number" name='invoice_tax' value="{{ $saleQuotation->invoice_tax }}" id="invoice_tax"
                            placeholder='0.00' class="form-control" readonly /></td>
                      </tr>
                      <tr>
                        <th class="text-center">Grand Total</th>
                        <td class="text-center"><input type="number" name='total_payable' id="total_amount"
                            placeholder='0.00' min="0" class="form-control" value="{{ $saleQuotation->total_payable }}" readonly /></td>
                      </tr>
                      @if($account_linked == 1)
                      <tr>
                        <th class="text-center">Paid Amount</th>
                        <td class="text-center">
                          <input type="number" class="form-control" name="total_paid" id="total_paid" placeholder="0.00"
                            min="0" value="{{ $saleQuotation->total_paid }}">
                        </td>
                      </tr>
                      @endif

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>

            <div class="tile-footer">
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                      class="fa fa-fw fa-lg fa-check-circle"></i>Edit Sale Quotation</button>
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
  selected_materials = [];

$('.product').each(function(key, value){
//   if($.inArray(value, selected_materials) == -1){
//     selected_materials.push(value);
//   }
//  alert(parseInt(selected_materials));
});

// console.log(selected_materials);

  $(document).ready(function(){


    // $('.product').change(function(){
    //   alert();
    // });


    var i=1;
    $("#add_row").click(function(){
      
      // $('.select2').select2();
        b=i-1;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      	i++; 
  	});
    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
		calc();
	});
	
	$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});
	$('#tax').on('keyup change',function(){
		calc_total();
	});
	$('#invoice_vat').on('keyup change',function(){
		calc_total();
	});

  $('#invoice_discount').on('keyup change', function(){
    calc_total();
  });
	

});

function calc()
{
	$('#tab_logic tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var qty = $(this).find('.qty').val();
      var price = $(this).find('.price').val();
      
			$(this).find('.total').val(qty*price);
			
			calc_total();
		}
    });
}

function calc_total()
{
	total=0;
	$('.total').each(function() {
        total += parseFloat($(this).val());
    });
	$('#sub_total').val(total.toFixed(3));
	tax_sum=total/100*$('#tax').val();
  $('#invoice_tax').val(tax_sum.toFixed(3));  
  var invoice_vat = parseFloat($('#invoice_vat').val()) > 0 ? parseFloat($('#invoice_vat').val()):0;
  var discount = $('#invoice_discount').val();
	$('#total_amount').val(((tax_sum+invoice_vat+total)-discount).toFixed(3));
  $('#total_paid').val(((tax_sum+invoice_vat+total)-discount).toFixed(3));
}
</script>

@include('admin.includes.date_field')
@endsection