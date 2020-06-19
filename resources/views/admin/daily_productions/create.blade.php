@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('daily_productions.store') }}">
    @csrf
    <input type="hidden" name="is_qpproved" value="0">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Daily Production</h1>
        <p>Create Daily Production Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Daily Productions</li>
        <li class="breadcrumb-item"><a href="#">Add Daily Production</a></li>
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

          <a href="{{ route('daily_productions.index') }}" class="btn btn-primary pull-right" style="float: right;"><i
              class="fa fa-eye"></i>View Daily Production</a>
          <h3 class="tile-title">Add New Daily Production</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="daily_production_date"
                  value="{{ old('daily_production_date') == '' ? date('Y-m-d'):old('daily_production_date') }}"
                  class="form-control dateField" type="text" placeholder="Date">
              </div>
            </div>


            <div class="mt-2"></div>
            <input type="hidden" name="status_id" value="1">
            {{-- <div class="form-group row add_asterisk">
              <label for="" class="control-label col-md-3">Daily Production Status</label>
              <div class="col-md-8">
                <select name="status_id" class="form-control">
                  @foreach ($statuses as $status)
                  <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected':'' }}>
            {{ $status->name }}</option>
            @endforeach
            </select>
          </div>
        </div> --}}

        <table class="table r-container no-spacing" id="daily_production_table">
          <thead>
            <tr style="text-align:center">
              <th width="35%">Sheet N -Color</th>
              <th width="25%">Stock (kg/roll) </th>
              <th width="">Used (kg)</th>
              <th width="">Used (roll)</th>
              <th width="20%">Product N</th>
              <th width="15%">Machine</th>
              <th>Finish Qty</th>
              <th width="">Pack</th>
              <th width="">Net Wt</th>
              <th width="12%">Fm Kutcha</th>
              <th width="">Qty (kg)</th>
              <th>Action</th>
            </tr>

          </thead>
          <tbody>
          
          @if(old() == true)
            @foreach (old('sheet_size_color_ids') as $key => $sheet_size_color_id)
            <tr class=" r-group" style="text-align:center">
            
                <td>
                  <select name="sheet_size_color_ids[]" class="form-control small_input_box" onchnage="show_sheet_kg_roll(this)">
                  <option value="0">select</option>
                    @foreach ($sheet_size_color_materials as $sheet_size_color_material)
                    <option value="{{ $sheet_size_color_material->id }}" {{ old('sheet_size_color_ids')[$key] == $sheet_size_color_material->id ? 'selected':'' }}>
                      {{ $sheet_size_color_material->raw_material->name.' - '.$sheet_size_color_material->sheet_size->name.' - '.$sheet_size_color_material->color->name }}
                    </option>
                    @endforeach
                  </select>
                </td>

                <td><input type="text" class="form-control small_input_box sheet_current_stock" readonly="readonly"></td>
  
                <td>
                  <input name="todays_weight[]" value="{{ old('todays_weight')[$key] }}" class="form-control small_input_box"
                    type="number" placeholder="kg" min="0" onblur="check_sheet_stock_kg(this)" step="0.01">
                  <div class="todays_weight_error"></div>
                </td>
  
                <td>
                  <input name="used_rolls[]" value="{{ old('used_rolls')[$key] }}" class="form-control small_input_box"
                    type="number" placeholder="roll" min="0" onblur="check_sheet_stock_roll(this)" step="0.01">
                    <div class="used_roll_error"></div>
                </td>
                <td>
                  <select name="product_ids[]" class="form-control product_ids small_input_box">
                    <option value="0">Select</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_ids')[$key] == $product->id ? 'selected':'' }}>{{ $product->raw_material->name.' - '.$product->name }}</option>
                    @endforeach
                  </select>
                </td>
                <td>
                  <select name="machine_ids[]" class="form-control small_input_box">
                    @foreach($machines as $id => $name)
                      <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                  </select>
                </td>
  
                <td><input type="number" class="form-control small_input_box" name="finish_quantity[]"
                    placeholder="fin qty" min="0" value="{{ old('finish_quantity')[$key] }}">
                </td>
  
                <td><input type="number" class="form-control small_input_box" name="pack[]" placeholder="pack" min="0"
                    value="{{ old('pack')[$key] }}">
                </td>
  
  
                <td>
                  <input type="number" class="form-control small_input_box" name="net_weight[]" placeholder="net wt"
                    min="0" value="{{ old('net_weight')[$key] }}" step="0.01">
                </td>
  
                <td>
                  <select name="fm_kutcha_ids[]" class="form-control outer small_input_box">
                    @foreach ($fm_kutchas as $fm_kutcha)
                    <option value="{{ $fm_kutcha->id }}" {{ old('fm_kutcha_id')[$key] == $fm_kutcha->id ? 'selected':'' }}>{{ $fm_kutcha->raw_material->name.' - '.$fm_kutcha->name }}
                    </option>
                    @endforeach
                  </select>
                </td>
  
                <td>
                  <input type="number" name="wastage_out[]" class="form-control small_input_box" placeholder="qty(kg)"
                    value="{{ old('wastage_out')[$key] }}" step="0.01">
                </td>
  
  
  
                <td>
                  <span class="fa fa-plus r-btnAdd pointer btn btn-sm btn-success small_input_button"
                    style="float:left"></span>
                  <span class="fa fa-trash r-btnRemove pointer btn btn-sm btn-danger small_input_button"
                    style="float: left"></span>
                </td>
              </tr>
                  
            @endforeach

@else
            <tr class=" r-group" style="text-align:center">
            
              <td>
                <select name="sheet_size_color_ids[]" class="form-control small_input_box" onchange="show_sheet_kg_roll(this)">
                <option value="0">select</option>
                  @foreach ($sheet_size_color_materials as $sheet_size_color_material)
                  <option value="{{ $sheet_size_color_material->id }}">
                    {{ $sheet_size_color_material->raw_material->name.' - '.$sheet_size_color_material->sheet_size->name.' - '.$sheet_size_color_material->color->name }}
                  </option>
                  @endforeach
                </select>
            
              </td>
              
              <td><input type="text" class="form-control small_input_box sheet_current_stock" readonly="readonly"></td>

              <td>
                <input name="todays_weight[]" value="{{ old('todays_weight[]') }}" class="form-control small_input_box"
                  type="number" placeholder="kg" min="0" onblur="check_sheet_stock_kg(this)" step="0.01">
                <div class="todays_weight_error"></div>
              </td>

              <td>
                <input name="used_rolls[]" value="{{ old('used_rolls[]') }}" class="form-control small_input_box"
                  type="number" placeholder="roll" min="0" onblur="check_sheet_stock_roll(this)" step="0.01">
                  <div class="used_roll_error"></div>
              </td>
              <td>
                <select name="product_ids[]" class="form-control product_ids small_input_box">
                  <option value="0">Select</option>
                  @foreach ($products as $product)
                  <option value="{{ $product->id }}">{{ $product->raw_material->name.' - '.$product->name }}</option>
                  @endforeach
                </select>
              </td>
              <td>
                  <select name="machine_ids[]" class="form-control small_input_box">
                    @foreach($machines as $id => $name)
                      <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                  </select>
              </td>

              <td><input type="number" class="form-control small_input_box" name="finish_quantity[]"
                  placeholder="fin qty" min="0" value="{{ old('finish_quantity[]') }}">
              </td>

              <td><input type="number" class="form-control small_input_box" name="pack[]" placeholder="pack" min="0"
                  value="{{ old('pack[]') }}">
              </td>


              <td>
                <input type="number" class="form-control small_input_box" name="net_weight[]" placeholder="net wt"
                  min="0" value="{{ old('net_weight[]') }}" step="0.01">
              </td>

              <td>
                <select name="fm_kutcha_ids[]" class="form-control outer small_input_box">
                  @foreach ($fm_kutchas as $fm_kutcha)
                  <option value="{{ $fm_kutcha->id }}">{{ $fm_kutcha->raw_material->name.' - '.$fm_kutcha->name }}
                  </option>
                  @endforeach
                </select>
              </td>

              <td>
                <input type="number" name="wastage_out[]" class="form-control small_input_box" placeholder="qty(kg)"
                  value="" step="0.01">
              </td>



              <td>
                <span class="fa fa-plus r-btnAdd pointer btn btn-sm btn-success small_input_button"
                  style="float:left"></span>
                <span class="fa fa-trash r-btnRemove pointer btn btn-sm btn-danger small_input_button"
                  style="float: left"></span>
              </td>
            </tr>
            @endif
          </tbody>
        </table>

        <div class="tile-footer">
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary pull-right" id="submitBtn" type="submit" type="submit"><i
                  class="fa fa-fw fa-lg fa-check-circle"></i>Add Daily Production</button>
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




function show_sheet_kg_roll(element){
  var id = element.value;
  var rowIndex = $(element).closest('tr').index();


  $.ajax({
    url: '{{ url("api/sheetproductiondetailsstock/sheet_kg_roll") }}',
    type: 'GET',
    data: 'id='+id,
    success:function(res){
      $('#daily_production_table tbody tr:eq('+rowIndex+')').find('.sheet_current_stock').val(res['qty_kg']+' / '+res['qty_roll']);
    }
  });
}


  function show_product_data(element){
  var id = element.value;
  var rowIndex = $(element).closest('tr').index();

  $.ajax({
    url: '{{ url("daily_productions/get_product_data") }}',
    type: 'GET',
    data: 'id='+id,
    success:function(res){
      $('#daily_production_table tbody tr:eq('+rowIndex+')').find('.machine_info').val(res['machine_name']+'-'+res['standard_weight']+'-'+res['expected_quantity']);
    }
  });
} 
</script>

<script src="{{ asset('assets/admin/js/field-repeater/repeater.js') }}"></script>

<script type="text/javascript">
  function check_sheet_stock_kg(element){

var todays_weight = element.value;
var rowIndex = $(element).closest('tr').index();
var sheet_size_color_id = $('#daily_production_table tbody tr:eq('+rowIndex+') td:eq(0)').children().val();

$.ajax({
  url: '{{ url("daily_productions/get_sheet_stock_data") }}',
  type: 'GET',
  data: 'todays_weight='+todays_weight+'&sheet_size_color_id='+sheet_size_color_id,
  success:function(res){
    if(res['sheet_stock_kg'] < 0){
      var used_kg_field = $('#daily_production_table tbody tr:eq('+rowIndex+') td:eq(1)').children();
      $('#daily_production_table tbody tr:eq('+rowIndex+') td:eq(1)').children(1).html('')
      $('#submitBtn').attr('disabled', true);
      used_kg_field.append('<div id="used_kg_error" class="alert-danger">qty (kg) stock out!</div>');
    }else{
      if(todays_weight > 0){
        $('#daily_production_table tbody tr:eq('+rowIndex+') td:eq(1)').children(1).html('');
        $('#submitBtn').attr('disabled', false);
      }
    }

  }
});
}


function check_sheet_stock_roll(element){

var used_roll = element.value;
var rowIndex = $(element).closest('tr').index();
var sheet_size_color_id = $('#daily_production_table tbody tr:eq('+rowIndex+') td:eq(0)').children().val();

$.ajax({
  url: '{{ url("daily_productions/get_sheet_stock_data") }}',
  type: 'GET',
  data: 'used_roll='+used_roll+'&sheet_size_color_id='+sheet_size_color_id,
  success:function(res){
    if(res['sheet_stock_roll'] < 0){
      var used_roll_field = $('#daily_production_table tbody tr:eq('+rowIndex+') td:eq(2)').children();
      $('#daily_production_table tbody tr:eq('+rowIndex+') td:eq(2)').children(1).html('')
      $('#submitBtn').attr('disabled', true);
      used_roll_field.append('<div id="used_roll_error" class="alert-danger">qty (roll) stock out!</div>');
    }else{
      if(used_roll > 0){
        $('#daily_production_table tbody tr:eq('+rowIndex+') td:eq(2)').children(1).html('');
        $('#submitBtn').attr('disabled', false);
      }
    }

  }
});
}



  $('.r-container').repeater({
   btnAddClass: 'r-btnAdd',
   btnRemoveClass: 'r-btnRemove',
   groupClass: 'r-group',
   minItems: 1,
   maxItems: 0,
   startingIndex: 0,
   reindexOnDelete: true,
   repeatMode: 'append',
   animation: null,
   animationSpeed: 400,
   animationEasing: 'swing',
   clearValues: true
 });
</script>

@include('admin.includes.date_field')
@endsection