@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('product_stock_transfers.store') }}">
    @csrf

    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Product Stock Transfer</h1>
        <p>Create Product Stock Transfer Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Product Stock Transfers</li>
        <li class="breadcrumb-item"><a href="#">Add Product Stock Transfer</a></li>
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

          <a href="{{route('product_stock_transfers.index')}}" class="btn btn-primary pull-right" style="float: right;"><i class="fa fa-eye"></i>View Product Stock Transfer</a>
          <h3 class="tile-title">Add New Product Stock Transfer</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="product_stock_transfer_date" value="{{ old('product_stock_transfer_date') == '' ? date('Y-m-d'):old('product_stock_transfer_date') }}" class="form-control dateField" type="text" placeholder="Date">
              </div>
            </div>
           

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Transfer To</label>
              <div class="col-md-8">
                <select name="to_branch" class="form-control">
                  @foreach($branches as $id => $name)
                  <option value="{{ $id }}" {{ $id == old('to_branch') ? 'selected':'' }}>{{ $name }}</option>
                  @endforeach
                </select>
                <div class="text-danger">{{ $errors->has('to_branch') ? $errors->first('to_branch'):'' }}</div>
              </div>
            </div>


            <div class="mt-2"></div>

            <input type="hidden" name="status_id" value="1">

            <!-- add product -->


            <div class="container">
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="table no-spacing" id="product_stock_transfer_table">
                    <thead>
                      <tr>
                        <th width="25%" class="text-center"> Product</th>
                        <th class="text-center" colspan="2"> Qty </th>
                        <th class="text-center" colspan="2"> Pack</th>
                        <th class="text-center" colspan="2"> Weight </th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(old('product_ids'))
                      @foreach(old('product_ids') as $key => $product_id)
                      <tr id='addr0'>
                        <td>
                          <select name="product_ids[]" class="form-control product small_input_box" onchange="show_product_stock(this)">
                            <option value="0">select</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_ids')[$key] == $product->id ? 'selected':'' }}>
                              {{ $product->raw_material->name }} - {{ $product->name }}
                            </option>
                            @endforeach
                          </select>
                          <div class="text-danger">
                            {{ $errors->has('product_ids.'.$key) ? $errors->first('product_ids.'.$key):'' }}
                          </div>
                        </td>
                        <td>
                          <input type="number" name="available_quantity[]" id="available_quantity" class="form-control small_input_box available_quantity" readonly="readonly" value="{{ old('available_quantity')[$key] }}">
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box quantity" name="quantity[]" value="{{ old('quantity')[$key] }}">
                          <div class="text-danger">{{ $errors->has('quantity.'.$key) ? $errors->first('quantity.'.$key):'' }}</div>
                        </td>
                        <td>
                          <input type="number" name="available_pack[]" id="available_pack" class="form-control small_input_box available_pack" value="{{ old('available_pack')[$key] }}" readonly="readonly">
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box pack" name="pack[]" value="{{ old('pack')[$key] }}">
                          <div class="text-danger">{{ $errors->has('pack.'.$key) ? $errors->first('pack.'.$key):'' }}</div>
                        </td>
                        <td>
                          <input type="number" name="available_weight[]" id="available_weight" class="form-control small_input_box available_weight" readonly="readonly" value="{{ old('available_weight')[$key] }}">
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box weight" name="weight[]" value="{{ old('weight')[$key] }}">
                          <div class="text-danger">{{ $errors->has('weight.'.$key) ? $errors->first('weight.'.$key):'' }}</div>
                        </td>
                      </tr>
                      @endforeach
                      @else

                      <tr id='addr0'>
                        <td>
                          <select name="product_ids[]" class="form-control product small_input_box" onchange="show_product_stock(this)">
                            <option value="0">select</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">
                              {{ $product->raw_material->name }} - {{ $product->name }}
                            </option>
                            @endforeach
                          </select>
                          <div class="text-danger">
                            {{ $errors->has('product_ids.*') ? $errors->first('product_ids.*'):'' }}
                          </div>
                        </td>
                        <td>
                          <input type="number" name="available_quantity[]" id="available_quantity" class="form-control small_input_box available_quantity" readonly="readonly">
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box quantity" name="quantity[]" value="">
                          <div class="text-danger">{{ $errors->has('quantity.*') ? $errors->first('quantity.*'):'' }}</div>
                        </td>
                        <td>
                          <input type="number" name="available_pack[]" id="available_pack" class="form-control small_input_box available_pack" readonly="readonly">
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box pack" name="pack[]" value="">
                          <div class="text-danger">{{ $errors->has('pack.*') ? $errors->first('pack.*'):'' }}</div>
                        </td>
                        <td>
                          <input type="number" name="available_weight[]" id="available_weight" class="form-control small_input_box available_weight" readonly="readonly">
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box weight" name="weight[]" value="" step="0.01">
                          <div class="text-danger">{{ $errors->has('weight.*') ? $errors->first('weight.*'):'' }}</div>
                        </td>
                      </tr>
                      @endif
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
              <div class="row clearfix">
                <div class="col-md-4">
                  <strong>Total Quantity : </strong>
                  <input type="text" class="form-control small_input_box" name="total_quantity" id="total_quantity" readonly="readonly" value="{{ old('total_quantity') ?: 0 }}">
                </div>

                <div class="col-md-4">
                  <strong>Total Pack : </strong>
                  <input type="text" class="form-control small_input_box" name="total_pack" id="total_pack" readonly="readonly" value="{{ old('total_pack') ?: 0 }}">
                </div>

                <div class="col-md-4">
                  <strong>Total Weight : </strong>
                  <input type="text" class="form-control small_input_box" name="total_weight" id="total_weight" readonly="readonly" value="{{ old('total_weight') ?: 0 }}">
                </div>             

              </div>
              <div class="clearfix"></div>
            </div>

            <div class="tile-footer">
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary pull-right" type="submit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add Product Stock Transfer</button>
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

  $('#product_stock_transfer_table').on('keyup', function(){
    show_total_quantity();
    show_total_pack();
    show_total_weight();
  });

  function show_total_quantity(){
    var total_quantity = 0;
    $('.quantity').each(function(){
      var quantity = parseFloat($(this).val()) > 0 ? parseFloat($(this).val()):0;
      total_quantity += quantity;
    });

    $('#total_quantity').val(total_quantity.toFixed(2));
  }

  function show_total_pack(){
    var total_pack = 0;
    $('.pack').each(function(){
      var pack = parseFloat($(this).val()) > 0 ? parseFloat($(this).val()):0;
      total_pack += pack;
    });

    $('#total_pack').val(total_pack.toFixed(2));
  }

  function show_total_weight(){
    var total_weight = 0;
    $('.weight').each(function(){
      var weight = parseFloat($(this).val()) > 0 ? parseFloat($(this).val()):0;
      total_weight += weight;
    });

    $('#total_weight').val(total_weight.toFixed(2));
  }

function show_product_stock(element){
  var row = $(element).closest('tr');
  var product_id = row.find('.product').val();

  $.ajax({
    data: 'id='+product_id,
    url: '{{ url("api/product_stocks/get_product_stock") }}',
    success:function(res){
        row.find('.available_quantity').val(res['product_stock']);
        row.find('.available_pack').val(res['pack_stock']);
        row.find('.available_weight').val(res['weight_stock']);
    }
  });
}

 var i=1;
    $("#add_row").click(function(){
        b=i-1;
      	$('#addr'+i).html($('#addr'+b).html());
      	$('#product_stock_transfer_table').append('<tr id="addr'+(i+1)+'"></tr>');
      	i++; 
  	});
    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
	});
</script>

@include('admin.includes.date_field')
@endsection