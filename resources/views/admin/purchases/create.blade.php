@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('purchases.store') }}">
    @csrf

    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Purchase</h1>
        <p>Create Purchase Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Purchases</li>
        <li class="breadcrumb-item"><a href="#">Add Purchase</a></li>
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

          <a href="{{route('purchases.index')}}" class="btn btn-primary pull-right" style="float: right;"><i
              class="fa fa-eye"></i>View Purchase</a>
          <h3 class="tile-title">Add New Purchase</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="purchase_date"
                  value="{{ old('purchase_date') == '' ? date('Y-m-d'):old('purchase_date') }}" class="form-control dateField"
                  type="text" placeholder="Date">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Batch</label>
              <div class="col-md-8">
                <select name="batch_id" class="form-control select2">
                  @foreach ($batches as $id => $name)
                  <option value="{{ $id }}">{{ $name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Supplier</label>
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
                <input type="hidden" name="chart_of_account_ids[]" value="{{ $purchase_chart_id }}">
              </div>
            </div>


            <div class="mt-2"></div>

            <input type="hidden" name="status_id" value="1">

            <!-- add product -->


            <div class="container">
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="table no-spacing" id="tab_logic">
                    <thead>
                      <tr>
                        <th width="25%" class="text-center"> Raw Material Name</th>
                        <th class="text-center"> Price </th>
                        <th class="text-center"> Qty ({{ config('app.kg') }})</th>
                        <th class="text-center"> Sub Total </th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(old('sub_raw_material_ids') == true)
                      @foreach (old('sub_raw_material_ids') as $old_key => $old_sub_raw_material_id)
                      <tr id='addr0'>
                          <td>
                            <select name="sub_raw_material_ids[]" class="form-control raw_material small_input_box">
                              <option value="0">select</option>
                              @foreach ($raw_materials as $raw_material)
                              @foreach ($raw_material->sub_raw_materials as $sub_raw_material)
                              <option value="{{ $sub_raw_material->id }}" {{ $sub_raw_material->id == old('sub_raw_material_ids')[$old_key] ? 'selected':'' }}>{{ $raw_material->name }} -
                                {{ $sub_raw_material->name }}</option>
                              @endforeach
                              @endforeach
                            </select>
                            <div class="text-danger">
                              {{ $errors->has('sub_raw_material_ids')[$old_key] ? $errors->first('sub_raw_material_ids')[$old_key]:'' }}
                            </div>
                          </td>
                          <td><input type="number" name='price[]' placeholder='Enter Unit Price'
                              class="form-control price small_input_box" min="0" step="0.001" value="{{ old('price')[$old_key] }}" />
                            <div class="text-danger">{{ $errors->has('price')[$old_key] ? $errors->first('price')[$old_key]:'' }}</div>
                          </td>
                          <td><input type="number" name='qty[]' placeholder='Enter Qty'
                              class="form-control qty small_input_box" min="0" value="{{ old('qty')[$old_key] }}" step="0.001" />
                            <div class="text-danger">{{ $errors->has('qty')[$old_key] ? $errors->first('qty')[$old_key]:'' }}</div>
                          </td>
                          <td><input type="number" name='total[]' placeholder='0.00'
                              class="form-control total small_input_box" readonly value="{{ old('total')[$old_key] }}" /></td>
                        </tr>                            
                      @endforeach
                      <tr id='addr1'></tr>
                      @else
                      <tr id='addr0'>
                        <td>
                          <select name="sub_raw_material_ids[]" class="form-control raw_material small_input_box">
                            <option value="0">select</option>
                            @foreach ($raw_materials as $raw_material)
                            @foreach ($raw_material->sub_raw_materials as $sub_raw_material)
                            <option value="{{ $sub_raw_material->id }}">{{ $raw_material->name }} -
                              {{ $sub_raw_material->name }}</option>
                            @endforeach
                            @endforeach
                          </select>
                          <div class="text-danger">
                            {{ $errors->has('sub_raw_material_ids.*') ? $errors->first('sub_raw_material_ids.*'):'' }}
                          </div>
                        </td>
                        <td><input type="number" name='price[]' placeholder='Enter Unit Price'
                            class="form-control price small_input_box" min="0" step="0.001" />
                          <div class="text-danger">{{ $errors->has('price.*') ? $errors->first('price.*'):'' }}</div>
                        </td>
                        <td><input type="number" name='qty[]' placeholder='Enter Qty'
                            class="form-control qty small_input_box" min="0" step="0.001" />
                          <div class="text-danger">{{ $errors->has('qty.*') ? $errors->first('qty.*'):'' }}</div>
                        </td>
                        <td><input type="number" name='total[]' placeholder='0.00'
                            class="form-control total small_input_box" readonly /></td>
                      </tr>
                      <tr id='addr1'></tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-md-12">
                  <span class="fa fa-trash btn btn-sm btn-danger pull-right pointer small_input_button"
                    id="delete_row"></span>
                  <span class="fa fa-plus btn btn-sm btn-success pull-right pointer small_input_button"
                    id="add_row"></span>
                </div>
              </div>
              <div class="row pull-right clearfix" style="margin-top:20px">
                <div class="col-md-12">
                  <table class="table" id="tab_logic_total">
                    <tbody>
                      <tr>
                        <th class="text-center">Sub Total</th>
                        <td class="text-center"><input type="number" name='sub_total' placeholder='0.00'
                            class="form-control" id="sub_total" readonly /></td>
                      </tr>
                      <tr>
                        <th class="text-center">Tax</th>
                        <td class="text-center">
                          <div class="input-group mb-2 mb-sm-0">
                            <input type="number" name="tax_percent" class="form-control" id="tax" placeholder="0"
                              min="0" max="100" value="0">
                            <div class="input-group-addon">%</div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center">Discount Amount</th>
                        <td class="text-center"><input type="number" name='invoice_discount' value="0"
                            id="invoice_discount" placeholder='0.00' class="form-control" /></td>
                      </tr>
                      <tr>
                        <th class="text-center">Tax Amount</th>
                        <td class="text-center"><input type="number" name='invoice_tax' value="0" id="invoice_tax"
                            placeholder='0.00' class="form-control" readonly /></td>
                      </tr>
                      <tr>
                        <th class="text-center">Grand Total</th>
                        <td class="text-center"><input type="number" name='total_payable' id="total_amount"
                            placeholder='0.00' min="0" class="form-control" readonly /></td>
                      </tr>
                      @if($account_linked == 1)
                      <tr>
                        <th class="text-center">Paid Amount</th>
                        <td class="text-center">
                          <input type="number" class="form-control" name="total_paid" id="total_paid" placeholder="0.00"
                            min="0">
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
                      class="fa fa-fw fa-lg fa-check-circle"></i>Add Purchase</button>
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

$('.raw_material').each(function(key, value){
//   if($.inArray(value, selected_materials) == -1){
//     selected_materials.push(value);
//   }
//  alert(parseInt(selected_materials));
});

// console.log(selected_materials);

  $(document).ready(function(){


    // $('.raw_material').change(function(){
    //   alert();
    // });


    var i=1;
    $("#add_row").click(function(){
      
      // $('.select2').select2();
        b=i-1;
      	$('#addr'+i).html($('#addr'+b).html());
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
  var discount = $('#invoice_discount').val();
	$('#total_amount').val(((tax_sum+total)-discount).toFixed(3));
  $('#total_paid').val(((tax_sum+total)-discount).toFixed(3));
}
</script>

@include('admin.includes.date_field')
@endsection