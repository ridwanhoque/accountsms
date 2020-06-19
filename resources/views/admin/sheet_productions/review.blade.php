@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('sheet_productions.store') }}" id="sheet_production_form">
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

          <a href="{{route('sheet_productions.index')}}" class="btn btn-primary pull-right" style="float: right;"><i class="fa fa-eye"></i>View Sheet Production</a>
          <h3 class="tile-title">Add New Sheet Production</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="sheet_production_date" value="{{ old('sheet_production_date') ?: $temp_sheet_production->sheet_production_date }}" class="form-control dateField" type="text" placeholder="Date">
              </div>
            </div>


            <div class="mt-2"></div>
            <input type="hidden" name="status_id" value="1">

            <div class="container">

              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing outer-repeater" id="raw_material_table">
                    <thead>
                      <tr style="background-color: #099688; color:#fff;">
                        <th width="1%"></th>
                        <th width="60%" class="text-center" colspan="2">Assign Raw Material</th>
                        <th width="19%" class="text-center">Qty (kg)</th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody data-repeater-list="outer-group" class="outer">
                      @foreach($temp_materials as $key => $temp_material)
                      <tr data-repeater-item class="outer" valign="top" id="addr_raw_material_table0">
                        <td width="25%">
                          <input type="hidden" name="outer-text-input">
                          <select name="sub_raw_material_ids[]" class="form-control col-xs outer materials small_input_box" onchange="material_current_stock(this)">
                            <option value="0">select</option>
                            @isset($sub_raw_materials)
                            @foreach ($sub_raw_materials as $sub_raw_material)
                            <option value="{{ $sub_raw_material->id }}" {{ $sub_raw_material->id == $temp_material->sub_raw_material_id ? 'selected':'' }}>
                              {{ $sub_raw_material->raw_material->name.' - '.$sub_raw_material->name }}</option>
                            @endforeach
                            @endisset
                          </select>
                        </td>
                        <td>
                          <select name="batch_id[]" onchange="material_current_stock(this)" class="form-control small_input_box batches">
                            <option value="0">select</option>
                            @foreach($batches as $id => $name)
                            <option value="{{ $id }}" {{ $id == $temp_material->batch_id ? 'selected':'' }}>{{ $name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box rm_stock" placeholder="raw material stock" readonly="readonly" name="raw_material_stock_qty[]">
                        </td>
                        <td>
                          <input type="number" name="qty_kgs[]" placeholder="Qty (kg)" class="form-control col-xs outer qty_kgs small_input_box" step="0.01" onkeyup="check_rm_stock(this)" value="{{ $temp_material->qty_kgs }}">
                        </td>
                        <td>

                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-md-12">

                  <div class="pull-right">
                    <th>
                      <input type="hidden" class="form-control small_input_box" name="total_kg" value="0" id="total_kg" readonly="readonly">
                    </th>
                  </div>
                </div>
              </div>

              <div class="mt-2"></div>

              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing outer-repeater" id="fm_kutcha_in_table">
                    <thead>
                      <tr style="background-color: #099688; color:#fff;">
                        <th width="1%"></th>
                        <th width="60%" class="text-center" colspan="2">Assign Fm kutcha</th>
                        <th width="19%" class="text-center">Qty (kg)</th>
                        <th> </th>
                      </tr>
                    </thead>

                    <tbody data-repeater-list="outer-group" class="outer">

                      @foreach($temp_assign_kutchas as $key => $temp_assign_kutcha)
                      <tr data-repeater-item class="outer" valign="top" id="addr_fm_kutcha_in_table0">
                        <td width="25%">
                          <input type="hidden" name="outer-text-input">
                          <select name="fm_kutcha_in_ids[]" class="form-control col-xs outer materials small_input_box fm_kutcha_in_ids" onchange="fm_kutcha_current_stock(this)">
                            <option value="0">select</option>
                            @foreach($fm_kutchas as $key => $fm_kutcha)
                            <option value="{{ $fm_kutcha->id }}" {{ $fm_kutcha->id == $temp_assign_kutcha->fm_kutcha_id ? 'selected':'' }}>{{ $fm_kutcha->raw_material->name }} - {{ $fm_kutcha->name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box fm_kutcha_in_stock" name="fm_kutcha_stock[]" placeholder="fm kutcha stock" readonly="readonly">
                        </td>
                        <td>
                          <input type="number" name="fm_kutcha_in_kgs[]" placeholder="Qty (kg)" class="form-control col-xs outer fm_kutcha_in_kgs small_input_box" onkeyup="check_fm_kutcha_in_stock(this)" step="0.01" value="{{ $temp_assign_kutcha->qty_kgs }}">
                        </td>
                        <td>

                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-md-12">
                  <div class="pull-right">
                    <th>
                      <input type="hidden" class="form-control small_input_box" name="fm_kutcha_in_total" value="0" id="fm_kutcha_in_total" readonly="readonly">
                      <span class="fa fa-plus btn btn-sm btn-success outer small_input_button" data-repeater-create id="add_row_fm_kutcha_in_table"></span>
                      <span class="fa fa-trash btn btn-sm btn-danger outer small_input_button btnRemove" id="delete_row_fm_kutcha_in_table"></span>
                    </th>
                  </div>
                </div>
              </div>

              <hr>
              <div class="pull-right">
                <table class="no-spacing">
                  <tr>
                    <th style="padding-right: 20px;">
                      Total
                    </th>
                    <td>
                      <input type="number" class="form-control small_input_box" name="total_input" id="total_input" readonly="readonly" value="">
                    </td>
                  </tr>
                </table>
              </div>
              <br>
              <div class="mt-4"></div>

              <input type="hidden" name="sub_raw_material_id_first" id="sub_raw_material_id_first" value="">
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing outer-repeater" id="sheet_table">
                    <thead>
                      <tr style="background:burlywood;">
                        <th class="text-center" style="width: 30%">Sheet Size</th>
                        <th class="text-center" style="width: 30%">Color</th>
                        <th class="text-center">Roll (qty)</th>
                        <th class="text-center">Kg (qty)</th>
                        <th>
                        </th>
                      </tr>
                    </thead>
                    <tbody data-repeater-list="outer-group" class="outer">
                      @foreach($temp_sheets as $s_key => $temp_sheet)
                      <tr data-repeater-item class="outer" valign="top" id="addr_sheet_table0">

                        <td>
                          <input type="hidden" name="text-input" />
                          <select name="sheet_size_ids[]" class="outer small_input_box form-control">
                            <option value="0">select</option>
                            @foreach ($sheet_sizes as $sheet_size)
                            <option value="{{ $sheet_size->id }}" {{ $sheet_size->id == $temp_sheet->sheet_size_id ? 'selected':'' }}>{{ $sheet_size->raw_material->name.' - '.$sheet_size->name }}
                            </option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <select name="color_ids[]" class="form-control outer small_input_box">
                            @foreach ($colors as $color)
                            <option value="{{ $color->id }}" {{ $color->id == $temp_sheet->color_id ? 'selected':'' }}>{{ $color->name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <input type="number" class="form-control outer qty_roll small_input_box" name="qty_rolls[]" value="{{ $temp_sheet->sheet_rolls ?: 0 }}" step="0.01">
                        </td>
                        <td>
                          <input type="number" class="form-control outer qty_kgs_details small_input_box" name="qty_kgs_details[]" value="{{ $temp_sheet->sheet_kgs ?: 0 }}" step="0.01">
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="mt-2"></div>

              <div class="row clearfix">
                <div class="col-md-12">
                  <div class="pull-right">
                    <th>
                      <span class="fa fa-plus btn btn-sm btn-success outer small_input_button" data-repeater-create id="add_row_sheet_table"></span>
                      <span class="fa fa-trash btn btn-sm btn-danger outer small_input_button btnRemove" id="delete_row_sheet_table"></span>

                    </th>
                  </div>
                </div>
              </div>

              <div class="mt-2"></div>
              <hr>
              <div class="pull-right">
                <table class="no-spacing">
                  <tr>
                    <th style="padding-right: 20px;">
                      Total
                    </th>
                    <td>
                      <input type="number" class="form-control small_input_box" value="" id="total_kg_details" name="total_kg_details" readonly="readonly">
                    </td>
                  </tr>
                </table>
              </div>
              <br>
              <div class="mt-4"></div>
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing outer-repeater" id="kutcha_table">
                    <thead>
                      <tr style="background-color: #099688; color:#fff;">
                        <th width="60%" class="text-center">Wastage</th>
                        <th width="19%" class="text-center">Qty (kg)</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody data-repeater-list="outer-group" class="outer">
                      @foreach($temp_kutcha_wastages as $temp_kutcha_wastage)
                      <tr data-repeater-item class="outer" valign="top" id="addr_kutcha_table0">
                        <td width="25%">
                          <input type="hidden" name="outer-text-input">
                          <select name="fm_kutcha_ids[]" class="form-control outer small_input_box fm_kutcha_ids">
                            <option value="0">select</option>
                            @foreach($fm_kutchas as $fm_kutcha)
                              <option value="{{ $fm_kutcha->id }}" {{ $fm_kutcha->id == $temp_kutcha_wastage->fm_kutcha_id ? 'selected':'' }}>{{ $fm_kutcha->raw_material->name.' - '.$fm_kutcha->name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>

                          <input type="number" class="form-control outer kutcha_qty_kgs small_input_box" name="kutcha_qty_kgs[]" value="{{ $temp_kutcha_wastage->qty_kgs }}" step="0.01">
                        </td>
                        <td>

                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-md-12">
                  <div class="pull-right">
                    <th>
                      <input type="hidden" class="form-control small_input_box" name="kutcha_out_total" id="kutcha_out_total" readonly="readonly" value="0">
                      <span class="fa fa-plus btn btn-sm btn-success outer small_input_button" data-repeater-create id="add_row_kutcha_table"></span>
                      <span class="fa fa-trash btn btn-sm btn-danger outer small_input_button btnRemove" id="delete_row_kutcha_table"></span>
                    </th>
                  </div>
                </div>
              </div>

              <div class="mt-2"></div>


              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing outer-repeater" id="">
                    <tr>
                      <th width="65%" style="padding-right: 20px;" class="text-right">Haddi (kg) </th>
                      <th width="20%" class="text-center">
                        <input type="number" class="form-control small_input_box" name="haddi" value="{{ $temp_sheet_production->haddi }}" step="0.01" id="haddi">
                      </th>
                    </tr>
                    <tr>
                      <th width="65%" style="padding-right: 20px;" class="text-right">Powder (kg) </th>
                      <th width="20%" class="text-center">
                        <input type="number" class="form-control small_input_box" name="powder" value="{{ $temp_sheet_production->powder }}" step="0.01" id="powder">
                      </th>
                    </tr>
                  </table>
                </div>
              </div>

              <hr>

              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing outer-repeater" id="">
                    <tr>
                      <th width="65%" style="padding-right: 20px;" class="text-right">Total</th>
                      <th width="20%" class="text-center">
                        <input type="number" class="form-control small_input_box" name="total_output" id="total_output" value="" readonly="readonly">
                      </th>
                    </tr>
                  </table>
                </div>
              </div>


              <div class="tile-footer">
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary pull-right" type="submit" type="submit" id="submitBtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add Sheet Production</button>
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
  $('#sheet_production_form').on('keyup', function() {
    show_total_input();
    show_total_output();
    check_material_sheet();
  });

  function show_total_input() {
    var total_kg = $('#total_kg').val() > 0 ? $('#total_kg').val() : 0;
    var fm_kutcha_in_total = $('#fm_kutcha_in_total').val() > 0 ? $('#fm_kutcha_in_total').val() : 0;
    var total_input = parseFloat(total_kg) + parseFloat(fm_kutcha_in_total);
    $('#total_input').val(total_input);
  }

  function show_total_output() {
    var total_kg_details = $('#total_kg_details').val() > 0 ? $('#total_kg_details').val() : 0;
    var kutcha_out_total = $('#kutcha_out_total').val() > 0 ? $('#kutcha_out_total').val() : 0;
    var haddi = $('#haddi').val() > 0 ? $('#haddi').val() : 0;
    var powder = $('#powder').val() > 0 ? $('#powder').val() : 0;

    var total_output = parseFloat(kutcha_out_total) + parseFloat(haddi) + parseFloat(powder);
    $('#total_output').val(total_output);
  }


  function check_material_sheet() {
    var sheet_kg = $('#total_kg_details').val() > 0 ? $('#total_kg_details').val() : 0;
    var total_input = $('#total_input').val() > 0 ? $('#total_input').val() : 0;
    var total_output = $('#total_output').val() > 0 ? $('#total_output').val() : 0;

    var total_out = parseFloat(sheet_kg) + parseFloat(total_output);

    var total_in_decimal = parseFloat(total_input).toFixed(2);
    var total_out_decimal = parseFloat(total_out).toFixed(2);

    var diff_out_in = total_out_decimal - total_in_decimal;


    if (diff_out_in > 0) {
      swal({
        title: 'Raw material quantity exceeds!'
      });
      $('#submitBtn').css('visibility', 'hidden');
    } else {
      $('#submitBtn').css('visibility', 'visible');
    }


  }



  function material_current_stock(element) {
    var row = $(element).closest('tr');
    var id = row.find('.materials').val();
    var batch_id = row.find('.batches').val();
    var rowIndex = $(element).closest('tr').index();

    if (rowIndex == 0) {
      $('#sub_raw_material_id_first').val(id);
      $.ajax({
        url: '{{ url("sheet_productions/load_sheet_sizes") }}',
        type: 'GET',
        data: 'id=' + id,
        success: function(res) {
          $('#sheet_table tbody tr:eq(' + rowIndex + ')').find('.sheet_size_id').html(res);
        }
      });


      $.ajax({
        url: '{{ url("sheet_productions/load_kutchas") }}',
        type: 'GET',
        data: 'id=' + id,
        success: function(res) {
          $('.fm_kutcha_in_ids').html(res['fm_kutcha_dropdown']);
          $('.fm_kutcha_ids').html(res['fm_kutcha_dropdown']);
        }
      });

    }

    $.ajax({
      url: '{{ url("sheet_productions/material_check") }}',
      type: 'GET',
      data: 'id=' + id + '&batch_id=' + batch_id,
      success: function(res) {
        row.find('.rm_stock').val(res);
      }
    });

  }


  function fm_kutcha_current_stock(element) {
    var id = element.value;
    var rowIndex = $(element).closest('tr').index();

    $.ajax({
      url: '{{ url("sheet_productions/fm_kutcha_check") }}',
      type: 'GET',
      data: 'id=' + id,
      success: function(res) {
        $('#fm_kutcha_in_table tbody tr:eq(' + rowIndex + ') td:eq(2)').children().val(res);
      }
    });

  }



  $(document).ready(function() {

    //raw material total quantity
    $('#raw_material_table').on('keyup', function() {
      total_kgs();
    });

    function total_kgs() {
      var total_kgs = 0;

      $('.qty_kgs').each(function() {
        total_kgs += parseFloat($(this).val());
      });

      $('#total_kg').val(total_kgs);
    }


    //sheet total quantity
    $('#sheet_table').on('keyup change', function() {
      total_kgs_details();
    });


    function total_kgs_details() {
      var total_kgs_details = 0;
      $('.qty_kgs_details').each(function() {
        total_kgs_details += parseFloat($(this).val());
      });

      $('#total_kg_details').val(total_kgs_details);
    }


    //fm kutcha in total quantity
    $('#fm_kutcha_in_table').on('keyup', function() {
      fm_kutcha_in_total();
    });

    function fm_kutcha_in_total() {
      var fm_kutcha_in_total = 0;

      $('.fm_kutcha_in_kgs').each(function() {
        fm_kutcha_in_total += parseFloat($(this).val());
      });

      $('#fm_kutcha_in_total').val(fm_kutcha_in_total);
    }

    //kutcha out total quantity
    $('#kutcha_table').on('keyup', function() {
      kutcha_out_total();
    });

    function kutcha_out_total() {
      var kutcha_out_total = 0;

      $('.kutcha_qty_kgs').each(function() {
        kutcha_out_total += parseFloat($(this).val());
      });

      $('#kutcha_out_total').val(kutcha_out_total);
    }



    table_repeater('raw_material_table');
    table_repeater('fm_kutcha_in_table');
    table_repeater('sheet_table');
    table_repeater('kutcha_table');

    function table_repeater(tableId) {
      var i = 1;
      $("#add_row_" + tableId).click(function() {

        // total_kgs_details();
        // $('.select2').select2();
        b = i - 1;
        $('#addr_' + tableId + i).html($('#addr_' + tableId + b).html()).find('td:first-child').html(i + 1);
        $('#' + tableId).append('<tr id="addr_' + tableId + (i + 1) + '"></tr>');
        i++;
      });
      $("#delete_row_" + tableId).click(function() {

        if (i > 1) {
          $("#addr_" + tableId + (i - 1)).html('');
          i--;
        }

        total_kgs();
        total_kgs_details();
        fm_kutcha_in_total();
        kutcha_out_total();
        show_total_input();
        show_total_output();

      });

    }


  });


  function check_rm_stock(element) {
    var row = $(element).closest('tr');
    var rm_qty = $(element).val();
    var rm_stock = row.find('.rm_stock').val();

    if (parseFloat(rm_qty) > parseFloat(rm_stock)) {
      alert('Raw materials stock exceeds!');
    }
  }


  function check_fm_kutcha_in_stock(element) {
    var row = $(element).closest('tr');
    var kutcha_qty = $(element).val();
    var kutcha_stock = row.find('.fm_kutcha_in_stock').val();

    if (parseFloat(kutcha_qty) > parseFloat(kutcha_stock)) {
      alert('Assigned kutcha stock exceeds!');
    }
  }
</script>


@include('admin.includes.date_field')

@endsection

@endsection