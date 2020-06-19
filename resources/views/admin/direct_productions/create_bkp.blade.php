@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal outer-repeater" method="POST" action="{{ route('sheet_productions.store') }}">
    @csrf
    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Sheet Production</h1>
        <p>Create Sheet Production Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Sheet Productions</li>
        <li class="breadcrumb-item"><a href="#">Add Sheet Production</a></li>
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
          <h3 class="tile-title">Add New Sheet Production</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="sheet_production_date"
                  value="{{ old('sheet_production_date') == '' ? date('Y-m-d'):old('sheet_production_date') }}"
                  class="form-control" type="text" placeholder="Date" readonly="readonly">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Batch</label>
              <div class="col-md-8">
                <select name="batch_id" class="form-control select2">
                  @foreach ($batches as $batch)
                  <option value="{{ $batch->id }}">{{ $batch->name }}</option>
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
                  <option value="{{ $status->id }}">{{ $status->name }}</option>
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
                        <th width="5%" class="text-center" style="background-color:burlywood">Roll (qty)</th>
                        <th width="5%" class="text-center" style="background-color:burlywood">Kg (qty)</th>
                      </tr>
                    </thead>
                    <tbody data-repeater-list="outer-group" class="outer">

                      {{-- <tr>
                        <td>
                          <span class="fa fa-trash btn btn-sm btn-danger pull-right outer" id="btnRemove"></span>
                          <span class="fa fa-plus pull-right btn btn-sm btn-success outer" data-repeater-create></span>
                        </td>
                      </tr> --}}
                      <tr data-repeater-item class="outer" valign="top" style="border-bottom:cornflowerblue 1px solid;">

                        <td>
                          <table class="inner-repeater" id="sheet_production_table_inner">
                            <tbody class="inner" data-repeater-list="inner-group">
                              <tr class="inner" data-repeater-item style="overflow: scroll">
                                <td width="25%">
                                  <input type="hidden" name="inner-text-input">
                                  <select name="sub_raw_material_ids" class="form-control col-xs inner materials small_input_box"
                                    onchange="material_current_stock(this))">
                                    @isset($sub_raw_materials)
                                      @foreach ($sub_raw_materials as $sub_raw_material)
                                          <option value="{{ $sub_raw_material->id }}">{{ $sub_raw_material->raw_material->name.' - '.$sub_raw_material->name }}</option>                                          
                                      @endforeach
                                    @endisset
                                  </select>
                                </td>
                                <td>
                                  <input type="number" name="qty_kgs" placeholder="Qty (kg)"
                                    class="form-control col-xs inner qty_kgs small_input_box">
                                </td>
                                <td>
                                  <input type="number" class="form-control inner wastage_out small_input_box" name="wastage_out"
                                    value="" placeholder="kutcha out">
                                </td>

                                <td>
                                  <input type="number" class="form-control inner small_input_box" name="sheet_wastage" value=""
                                    placeholder="kutcha in">
                                </td>

                                <td>
                                  <input type="number" class="form-control inner small_input_box" name="forming_wastage" value=""
                                    placeholder="forming wast.">
                                </td>
                                <td>
                                  <span class="fa fa-plus btn btn-success btn-sm inner small_input_button" data-repeater-create></span>
                                </td>
                                <td><span class="fa fa-trash btn btn-danger btn-sm inner small_input_button" data-repeater-delete></span></td>
                              </tr>
                            </tbody>
                          </table>

                          {{-- <div class="inner-repeater">
                                
                              <div class="inner" data-repeater-list="inner-group">
                                <div class="inner" data-repeater-item>
                                    <select name="raw_material_ids" class="form-control inner" style="float:left">
                                        @isset($raw_materials)
                                          @foreach ($raw_materials as $raw_material)
                                            <option value="{{ $raw_material->id }}">{{ $raw_material->name }}</option>
                          @endforeach
                          @endisset
                          </select>

                          <input type="number" class="form-control inner" name="qty_kgs" style="float: left">
                          <span class="fa fa-plus inner" data-repeater-create=""></span>
                </div>

              </div>

            </div> --}}

            </td>

            <td><input type="hidden" name="text-input">

              <select name="sheet_size_ids" class="form-control outer small_input_box">
                @foreach ($sheet_sizes as $sheet_size)
                <option value="{{ $sheet_size->id }}">{{ $sheet_size->name }}</option>
                @endforeach
              </select>
            </td>
            <td>
              <select name="color_ids" class="form-control outer small_input_box">
                @foreach ($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
                @endforeach
              </select>
            </td>
            <td>
              <input type="number" class="form-control outer qty_roll small_input_box" name="qty_rolls" value="0">
            </td>
            <td>
              <input type="number" class="form-control outer qty_kgs_details small_input_box" name="qty_kgs_details" value="0">
            </td>

            </tr>
            </tbody>
            </table>
          </div>
        </div>
        <div class="mt-2"></div>
        <div class="row clearfix">
          <div class="col-md-12">

            <div class="full-right">
              <th>
                <span class="fa fa-trash btn btn-sm btn-danger pull-right outer small_input_button" id="btnRemove"></span>
                <span class="fa fa-plus pull-right btn btn-sm btn-success outer small_input_button" data-repeater-create></span>
              </th>
            </div>
          </div>
        </div>
        <div class="row pull-right clearfix" style="margin-top:20px">
          <div class="col-md-12">
            <table class="table" id="tab_logic_total">
              <tbody>
                <tr>
                  <th class="text-center">Total (roll)
                    {{-- <select id="sheet_size_id">

                    </select> --}}
                  </th>
                  <td class="text-center"><input type="number" name='total_roll' id="total_roll" placeholder='0.00'
                      min="0" class="form-control" readonly value="0" /></td>
                </tr>
                <tr>
                  <th class="text-center">Total (kg)</th>
                  <td class="text-center">
                    <input type="number" name='total_kg' placeholder='0.00' class="form-control" id="total_kg" readonly
                      value="0" min="0" />
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
            <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                class="fa fa-fw fa-lg fa-check-circle"></i>Add Sheet Production</button>
          </div>
        </div>
      </div>




    </div>

    </div>
    </div>
    </div>






    <input type="hidden" id="material_current_stock" value="">
    <input type="hidden" id="material_qty_this" value="">

  </form>
</main>

@section('js')
<script src="{{ asset('assets/admin/js/plugins/select2.min.js')}}"></script>

<script src="{{ asset('assets/admin/js/style.js') }}"></script>

<script type="text/javascript">
  $('.select2').select2();
</script>

<script src="{{ asset('assets/admin/js/jq-repeater/repeater.js') }}"></script>

<script type="text/javascript">
//check material stock available
$('.qty_kgs').on('keyup', function(){

});

$('.materials').on('change', function(){
  material_current_stock($(this).val());
});

function material_current_stock(element){
  
  var id = element.value;
  var rowIndex = $(element).closest('tr').index();

    $.ajax({
      url: '{{ url("sheet_productions/material_check") }}',
      type: 'GET',
      data: 'id='+id,
      success:function(res){
        $('#ra_material_table tr:eq('+rowIndex+') td:eq(1)').children().val(res);
      }
    });

}









  $(document).ready(function(){

    $('#btnRemove').on('click', function(){
      $('#sheet_production_table tr:last-child').not('#sheet_production_table_inner tr').not('#sheet_production_table tr:first-child').remove();
      total_kg();
      total_roll();
    })

window.outerRepeater = $('.outer-repeater').repeater({
  isFirstItemUndeletable: true,
  defaultValues: { 'text-input': 'outer-default' },
  show: function () {

      //check material stock available
      $('.materials').on('change', function(){
        material_current_stock($(this).val())
      });

      console.log('outer show');
      $(this).slideDown();
  },
  hide: function (deleteElement) {
      console.log('outer delete');
      $(this).slideUp(deleteElement);
  },
  repeaters: [{
      isFirstItemUndeletable: true,
      selector: '.inner-repeater',
      defaultValues: { 'inner-text-input': 'inner-default' },
      show: function () {
          console.log('inner show');
          $(this).slideDown();
      },
      hide: function (deleteElement) {
          console.log('inner delete');
          $(this).slideUp(deleteElement);
      }
  }]
});


$('#sheet_production_table tbody').on('keyup change', function(){
    total_roll();
    total_kg();
});

});


function total_roll(){
  var total_roll = 0;
  $('.qty_roll').each(function(){
    total_roll += parseInt($(this).val());
  });

  $('#total_roll').val(total_roll.toFixed(2));
}

function total_kg(){
  var total_kg = 0;
  $('.qty_kgs_details').each(function(){
    total_kg += parseInt($(this).val());
  });

  $('#total_kg').val(total_kg.toFixed(2));
}

// $('.materials').each(function(key, value){
//   $(this).change(function(){
//     alert((key, value));
//   });
// });

function load_sheets(id){
  $.ajax({
    url: '{{ url("sheet_productions/load_sheet_sizes") }}',
    type: 'GET',
    data: 'id='+id,
    success:function(res){
      $('#sheet_size_id').html(res);
    }
  });
}



</script>
@endsection


@endsection