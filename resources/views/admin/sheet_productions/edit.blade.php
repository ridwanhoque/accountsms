@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal outer-repeater" method="POST"
    action="{{ route('sheet_productions.update', $sheetProduction->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $sheetProduction->id }}">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Sheet Production</h1>
        <p>Update Sheet Production Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Sheet Productions</li>
        <li class="breadcrumb-item"><a href="#">Edit Sheet Production</a></li>
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

          <a href="{{route('sheet_productions.index')}}" class="btn btn-primary pull-right" style="float: right;"><i
              class="fa fa-eye"></i>View Sheet Production</a>
          <h3 class="tile-title">Edit New Sheet Production</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="sheet_production_date"
                  value="{{ old('sheet_production_date') == '' ? $sheetProduction->sheet_production_date:old('sheet_production_date') }}"
                  class="form-control" type="text" placeholder="Date" readonly="readonly">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Batch</label>
              <div class="col-md-8">
                <select name="batch_id" class="form-control select2">
                  @foreach ($batches as $batch)
                  <option value="{{ $batch->id }}" {{ $batch->id == $sheetProduction->batch_id ? 'selected':'' }}>
                    {{ $batch->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>


            <div class="mt-2"></div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Sheet Production Status</label>
              <div class="col-md-8">
                <select name="status_id" class="form-control">
                  @foreach ($statuses as $status)
                  <option value="{{ $status->id }}" {{ $status->id == $sheetProduction->status_id ? 'selected':'' }}>
                    {{ $status->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>


            <div class="container">
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing" id="sheet_production_table">
                    <thead>
                      <tr>
                        <th width="50%" class="text-center" style="background-color:bisque">Raw Material Name, Quantity
                          with Wastage</th>
                        <th width="10%" class="text-center" style="background-color:burlywood">Sheet Size</th>
                        <th width="10%" class="text-center" style="background-color:burlywood">Color</th>
                        <th class="text-center" style="background-color:burlywood">Qty (roll)</th>
                        <th class="text-center" style="background-color:burlywood">Qty (kg)</th>
                      </tr>
                    </thead>
                    <tbody data-repeater-list="outer-group" class="outer">
                      @foreach ($sheetProduction->sheet_production_details as $details)
                      <tr data-repeater-item class="outer">
                        <input type="hidden" name="sheet_production_details_ids[]" value="{{ $details->id }}">
                        <td>

                            <table class="inner-repeater">
                              <tbody class="inner" data-repeater-list="inner-group">
                                @foreach ($details->sheets as $sheet)
                                <tr class="inner" data-repeater-item>
  
  
                                  <td width="25%">
                                    <input type="hidden" name="sheet_ids[]" value="{{ $sheet->id }}" class="inner">
                                    <select name="raw_material_ids[]" class="form-control col-xs inner">
                                      @isset($raw_materials)
                                      @foreach ($raw_materials as $raw_material)
                                      <option value="{{ $raw_material->id }}"
                                        {{ $raw_material->id == $sheet->raw_material_id ? 'selected':'' }}>
                                        {{ $raw_material->name }}</option>
                                      @endforeach
                                      @endisset
                                    </select>
                                  </td>
                                  <td>
                                    <input type="text" name="qty_kgs[]" placeholder="Qty (kg)"
                                      class="form-control col-xs inner" value="{{ $sheet->qty_kg }}">
                                  </td>

                                  <td>
                                      <input type="number" class="form-control outer wastage_out" name="wastage_out[]"
                                        value="{{ $sheet->wastage_out }}">
                                    </td>
                                    <td>
                                      <input type="number" class="form-control outer" name="sheet_wastage[]"
                                        value="{{ $sheet->sheet_wastage }}">
                                    </td>
            
                                    <td>
                                      <input type="number" class="form-control outer" name="forming_wastage[]"
                                        value="{{ $sheet->forming_wastage }}">
                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
  
                          </td>
                          
                          <td>
                          <select name="sheet_size_ids[]" class="form-control outer">
                            @foreach ($sheet_sizes as $sheet_size)
                            <option value="{{ $sheet_size->id }}"
                              {{ $sheet_size->id == $details->sheet_size_id ? 'selected':'' }}>{{ $sheet_size->name }}
                            </option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <select name="color_ids[]" class="form-control outer">
                            @foreach ($colors as $color)
                            <option value="{{ $color->id }}" {{ $color->id == $details->color_id ? 'selected':'' }}>
                              {{ $color->name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <input type="number" class="form-control outer qty_roll" name="qty_rolls[]"
                            value="{{ $details->qty_roll }}">
                        </td>

                        <td>
                          <input type="number" class="form-control outer qty_kgs_details" name="qty_kgs_details[]"
                            value="{{ $details->qty_kg }}">
                        </td>
                        


                        
                      </tr>


                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row pull-right clearfix" style="margin-top:20px">
                <div class="col-md-12">
                  <table class="" id="tab_logic_total">
                    <tbody>
                      <tr>
                        <th>Total (kg)</th>
                        <td>
                          <input type="number" name='total_kg' placeholder='0.00' class="form-control" id="total_kg"
                            readonly="readonly" value="{{ $sheetProduction->total_kg }}" />
                        </td>
                      </tr>

                      <tr>
                        <th class="text-center">Total (roll)</th>
                        <td class="text-center"><input type="number" name='total_roll' id="total_roll"
                            placeholder='0.00' min="0" class="form-control" readonly="readonly"
                            value="{{ $sheetProduction->total_roll }}" /></td>
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
                  <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                      class="fa fa-fw fa-lg fa-check-circle"></i>Edit Sheet Production</button>
                </div>
              </div>
            </div>




          </div>

        </div>
      </div>
    </div>







  </form>
</main>

@section('js')
<script src="{{ asset('assets/admin/js/plugins/select2.min.js')}}"></script>

<script src="{{ asset('assets/admin/js/style.js') }}"></script>

<script type="text/javascript">
  $('.select2').select2();
</script>

<script>
  $(document).ready(function(){

$('#sheet_production_table').on('keyup change', function(){
    total_roll()
});


});

function total_roll(){
  var total_roll = 0;
  $('.qty_roll').each(function(){
    total_roll += parseInt($(this).val());
  });

  $('#total_roll').val(total_roll.toFixed(2));
}


</script>
@endsection

@include('admin.includes.date_field')
@endsection