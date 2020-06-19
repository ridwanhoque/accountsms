@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('temporary_daily_productions.update', $dailyProduction->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $dailyProduction->id }}">
    <input type="hidden" name="status_id" value="1">
    <input type="hidden" name="is_approved" value="1">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Daily Production</h1>
        <p>Update Daily Production Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Daily Productions</li>
        <li class="breadcrumb-item"><a href="#">Edit Daily Production</a></li>
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

          <a href="{{route('temporary_daily_productions.index')}}" class="btn btn-primary pull-right" style="float: right;"><i class="fa fa-eye"></i>View Daily Production</a>
          <h3 class="tile-title">Edit New Daily Production</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="daily_production_date" value="{{ $dailyProduction->daily_production_date != '' ? $dailyProduction->daily_production_date:old('daily_production_date') }}" class="form-control" type="text" placeholder="Date" readonly="readonly">
              </div>
            </div>


            <div class="mt-2"></div>


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
                </tr>

              </thead>
              <tbody>
                @foreach ($dailyProduction->daily_production_details as $details)
                <input type="hidden" name="daily_production_details_ids[]" value="{{ $details->id }}">
                <tr class=" r-group" style="text-align:center">
                  <td>
                    <input type="hidden" name="sheet_size_color_ids[]" class="sheet_size_color_ids" value="{{ $details->sheet_size_color_id }}">
                    <select name="" class="form-control small_input_box" disabled>
                      @foreach ($sheet_size_color_materials as $key => $spdetails_color)
                      <option value="{{ $spdetails_color->id }}" {{ $spdetails_color->id == $details->sheetproductiondetails_color_id ? 'selected':'' }}>
                        {{ $spdetails_color->sheet_size->name }}-{{ $spdetails_color->color->name }}
                      </option>
                      @endforeach
                    </select>

                  </td>
                  <td>
                    <input type="text" class="form-control small_input_box sheet_current_stock" readonly="readonly">
                    <input type="hidden" name="sheet_stock_roll[]" class="sheet_stock_roll" value="{{ old('sheet_stock_roll')[$key] }}">
                    <input type="hidden" name="sheet_stock_kg[]" class="sheet_stock_kg" value="{{ old('sheet_stock_kg')[$key] }}">  
                  </td>

                  <td>
                    <input name="todays_weight[]" value="{{ $details->todays_weight }}" class="form-control small_input_box" type="number" placeholder="kg" min="0" onblur="check_sheet_stock_kg(this)" step="0.01">
                    <div class="todays_weight_error"></div>
                  </td>

                  <td>
                    <input name="used_rolls[]" value="{{ $details->used_roll }}" class="form-control small_input_box" type="number" placeholder="roll" min="0" onblur="check_sheet_stock_roll(this)" step="0.01">
                    <div class="used_roll_error"></div>
                  </td>

                  <td>
                    <input type="hidden" name="product_ids[]" value="{{ $details->product_id }}">
                    <select name="product_ids[]" class="form-control product_ids small_input_box" onchange="show_product_data(this)" disabled>
                      @foreach ($products as $product)
                      <option value="{{ $product->id }}" {{ $product->id == $details->product_id ? 'selected':'' }}>{{ $product->name }}</option>
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <input type="hidden" name="machine_ids[]" value="{{ $details->machine_id }}">
                    <input type="text" value="{{ $details->machine->name }}" readonly="readonly" class="form-control small_input_box" placeholder="machine name">
                  </td>


                  <td><input type="number" class="form-control small_input_box" name="finish_quantity[]" placeholder="finish qty" min="0" value="{{ $details->finish_quantity }}">
                  </td>
                  <td><input type="number" class="form-control small_input_box" name="pack[]" placeholder="pack" min="0" value="{{ $details->pack }}"></td>


                  <td>
                    <input type="number" class="form-control small_input_box" name="net_weight[]" placeholder="net weight" min="0" value="{{ $details->net_weight }}" step="0.01">
                  </td>

                  <td>
                  <select name="fm_kutcha_ids[]" class="form-control outer small_input_box">
                    @foreach ($fm_kutchas as $fm_kutcha)
                    <option value="{{ $fm_kutcha->id }}" {{ $details->fm_kutcha_id == $fm_kutcha->id ? 'selected':'' }}>{{ $fm_kutcha->raw_material->name.' - '.$fm_kutcha->name }}
                    </option>
                    @endforeach
                  </select>
                </td>

                  <td>
                    <input type="number" name="wastage_out[]" class="form-control small_input_box" placeholder="wastage qty" value="{{ $details->wastage_out }}" step="0.01">
                  </td>



                </tr>
                @endforeach
              </tbody>
            </table>




            <div class="tile-footer">
              <div class="row">
                <div class="col-md-12">
                  <button class="btn btn-primary pull-right" type="submit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Edit Daily Production</button>
                </div>
              </div>
            </div>




          </div>

        </div>
      </div>
    </div>







  </form>
</main>

@endsection

@section('js')
<script>
$(document).ready(function(){

  $('.sheet_size_color_ids').each(function(){
    // console.log($(this).val());
    show_sheet_kg_roll(this);
  });


function show_sheet_kg_roll(element){
      var id = element.value;
      var rowIndex = $(element).closest('tr').index()-1;
      var row = $(element).closest('tr');

      $.ajax({
        url: '{{ url("api/sheetproductiondetailsstock/sheet_kg_roll") }}',
        type: 'GET',
        data: 'id='+id,
        success:function(res){
          $('#daily_production_table tbody tr:eq('+rowIndex+')').find('.sheet_current_stock').val(res['qty_kg']+' / '+res['qty_roll']);
          row.find('.sheet_stock_roll').val(res['qty_roll']);
          row.find('.sheet_stock_kg').val(res['qty_kg']);
        }
      });
}



});
</script>
@endsection
