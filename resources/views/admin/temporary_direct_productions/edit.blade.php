@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('direct_productions.store') }}" id="direct_production_form">
    @csrf
    <input type="hidden" name="temporary_direct_production_id" value="{{ $temporary_direct_production->id }}">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Direct Production</h1>
        <p>Create Direct Production Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Direct Productions</li>
        <li class="breadcrumb-item"><a href="#">Add Direct Production</a></li>
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

          <a href="{{ route('direct_productions.index') }}" class="btn btn-primary pull-right" style="float: right;"><i class="fa fa-eye"></i>View Direct Production</a>
          <h3 class="tile-title">Add New Direct Production</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="direct_production_date" value="{{ old('direct_production_date') ?: $temporary_direct_production->direct_production_date }}" class="form-control dateField" type="text" placeholder="Date">
              </div>
            </div>

            <div class="mt-2"></div>
            <input type="hidden" name="status_id" value="1">


            <div class="container">

              @if(!$assign_materials->isEmpty())
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing outer-repeater" id="raw_material_table">
                    <thead>
                      <tr style="background-color: #099688; color:#fff;">
                        <th width="60%" class="text-center" colspan="2">Assign Raw Material</th>
                        <th width="19%" class="text-center">Qty (kg)</th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody data-repeater-list="outer-group" class="outer">
                      @foreach ($assign_materials as $assign_material)
                      <tr data-repeater-item class="outer" valign="top" id="addr_raw_material_table0">
                        <td width="25%">
                          <input type="hidden" name="outer-text-input">
                          <select name="sub_raw_material_ids[]" class="form-control col-xs outer materials small_input_box" onchange="material_current_stock(this)">
                            <option value="0">select</option>
                            @isset($sub_raw_materials)
                            @foreach ($sub_raw_materials as $sub_raw_material)
                            <option value="{{ $sub_raw_material->id }}" {{ $sub_raw_material->id == $assign_material->sub_raw_material_id ? 'selected':'' }}>
                              {{ $sub_raw_material->raw_material->name.' - '.$sub_raw_material->name }}</option>
                            @endforeach
                            @endisset
                          </select>
                        </td>
                        <td>
                          <select name="batch_id[]" onchange="material_current_stock(this)" class="form-control small_input_box batches">
                            <option value="0">select</option>
                            <option value="" {{ $assign_material->batch_id == NULL ? 'selected':'' }}>-- opening --</option>
                            @foreach($batches as $id => $name)
                            <option value="{{ $id }}" {{ $id == $assign_material->batch_id ? 'selected':'' }}>{{ $name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box rm_stock" placeholder="raw material stock" name="raw_material_stock[]" readonly="readonly">
                        </td>
                        <td>
                          <input type="number" name="qty_kgs[]" placeholder="Qty (kg)" class="form-control col-xs outer qty_kgs small_input_box" step="0.01" value="{{ $assign_material->qty_kgs }}">
                        </td>
                        <td>

                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <input type="hidden" class="form-control small_input_box" name="total_kg" value="0" id="total_kg" readonly="readonly">
                   
              @endif

              <div class="mt-2"></div>
              @if(!$assign_kutchas->isEmpty())
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing outer-repeater" id="fm_kutcha_in_table">
                    <thead>
                      <tr>
                        <th width="60%" colspan="2" class="text-center"></th>
                        <th width="19%" class="text-center"></th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody data-repeater-list="outer-group" class="outer">
                      @foreach ($assign_kutchas as $assign_kutcha)
                      <tr data-repeater-item class="outer" valign="top" id="addr_fm_kutcha_in_table0">
                       <td width="25%">
                          <input type="hidden" name="outer-text-input">
                          <select name="fm_kutcha_in_ids[]" class="form-control col-xs outer small_input_box fm_kutcha_in_ids" onchange="fm_kutcha_current_stock(this)">
                            <option value="0">select</option>
                            @foreach ($fm_kutchas as $fm_kutcha)
                            <option value="{{ $fm_kutcha->id }}" {{ $fm_kutcha->id == $assign_kutcha->fm_kutcha_id ? 'selected':'' }}>{{ $fm_kutcha->raw_material->name.' - '.$fm_kutcha->name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box fm_kutcha_in_stock" placeholder="fm kutcha stock" name="fm_kutcha_stock[]" readonly="readonly">
                        </td>
                        <td>
                          <input type="number" name="fm_kutcha_in_kgs[]" placeholder="Qty (kg)" class="form-control col-xs outer fm_kutcha_in_kgs small_input_box" onkeyup="" step="0.01" value="{{ $assign_kutcha->qty_kgs }}">
                        </td>
                        <td>

                        </td>
                      </tr>
                      @endforeach
                      <tr id="addr_fm_kutcha_in_table1"></tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <input type="hidden" class="form-control small_input_box" name="fm_kutcha_in_total" value="" id="fm_kutcha_in_total" readonly="readonly">
                    
              @endif

            
              <hr>
              <div class="pull-right">
                <table class="no-spacing">
                  <tr>
                    <th style="padding-right: 20px;">
                      Total Raw
                    </th>
                    <td>
                      <input type="number" class="form-control small_input_box" name="total_input" id="total_input" readonly="readonly" value="{{ $temporary_direct_production->total_input }}">
                    </td>
                  </tr>
                </table>
              </div>
              <br>
              <div class="mt-4"></div>


              @if(!$productions->isEmpty())
            
              <div class="row clearfix">
                <div class="col-md-12">
                  <table class="no-spacing text-center" id="direct_production_table">
                    <thead>
                      <tr style="background-color: #099688; color:#fff;">
                        <th width="20%">Product Name</th>
                        <th width="20%">Machine</th>
                        <th>Production Wt</th>
                        <th>Finish Qty</th>
                        <th>Pack</th>
                        <th>Net Wt.</th>
                        <th width="20%">Wastage</th>
                        <th>W. Qty (kg)</th>
                      </tr>
                    </thead>
                    <tbody data-repeater-list="outer-group" class="outer">
                      @foreach ($productions as $production)
                      <tr data-repeater-item class="outer" valign="top" id="addr_direct_production_table0">
                        <td>
                          <select name="product_ids[]" class="form-control product_ids small_input_box">
                            <option value="0">select</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $product->id == $production->product_id ? 'selected':'' }}>{{ $product->raw_material->name.' - '.$product->name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <select name="machine_id[]" class="form-control small_input_box">
                            @foreach($machines as $id => $name)
                            <option value="{{ $id }}" {{ $id == $production->machine_id ? 'selected':'' }}>{{ $name }}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <input type="number" class="form-control small_input_box todays_weight" name="todays_weight[]" placeholder="Production Wt" step="0.01" value="{{ $production->todays_weight }}">
                        </td>

                        <td><input type="number" class="form-control small_input_box" name="finish_quantity[]" placeholder="fin qty" min="0" value="{{ $production->finish_quantity }}">
                        </td>

                        <td><input type="number" class="form-control small_input_box" name="pack[]" placeholder="pack" min="0" value="{{ $production->pack }}">
                        </td>

                        <td>
                          <input type="number" class="form-control small_input_box" name="net_weight[]" placeholder="net wt" min="0" value="{{ $production->net_weight }}" step="0.01">
                        </td>

                        <td>
                          <select name="fm_kutcha_ids[]" class="form-control outer small_input_box fm_kutcha_ids">
                            <option value="0">select</option>
                            @foreach ($fm_kutchas as $fm_kutcha)
                            <option value="{{ $fm_kutcha->id }}" {{ $fm_kutcha->id == $production->fm_kutcha_id ? 'selected':'' }}>{{ $fm_kutcha->raw_material->name.' - '.$fm_kutcha->name }}</option>
                            @endforeach
                          </select>
                        </td>

                        <td>
                          <input type="number" name="kutcha_qty[]" class="form-control small_input_box kutcha_qty" placeholder="qty(kg)" value="{{ $production->qty_kgs }}" step="0.01">
                        </td>


                      </tr>
                      @endforeach
                      <tr id="addr_direct_production_table1"></tr>
                    </tbody>
                  </table>
                </div>
              </div>
              @endif
              <div class="mt-2"></div>

            
              <div class="mt-2"></div>
              <hr>
              <div class="pull-right">
                <table class="no-spacing">
                  <tr>
                    <th style="padding-right: 20px;">
                      Total Production
                    </th>
                    <td>
                      <input type="number" class="form-control small_input_box" id="total_todays_weight" name="total_todays_weight" readonly="readonly" value="{{ $temporary_direct_production->total_todays_weight }}">
                    </td>
                  </tr>
                </table>
              </div>
              <br>

              <div class="mt-2"></div>



              <div class="tile-footer">
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary pull-right" type="submit" type="submit" id="submitBtn"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add Direct Production</button>
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
  function show_product_data(element) {
    var id = element.value;
    var rowIndex = $(element).closest('tr').index();

    $.ajax({
      url: '{{ url("daily_productions/get_product_data") }}',
      type: 'GET',
      data: 'id=' + id,
      success: function(res) {
        // alert(res);
        $('#direct_production_table').find('.machine_details').val(res['machine_name'] + '-' + res['standard_weight'] + '-' + res['expected_quantity']);
      }
    });


    // $.ajax({
    //     url: '{{ url("sheet_productions/kutcha_by_product") }}',
    //     type: 'GET',
    //     data: 'id='+id,
    //     success:function(res){
    //       if(rowIndex == 0){
    //           $('.fm_kutcha_ids').html(res['fm_kutchas']);
    //       }
    //     }
    //   });


  }

  $('#direct_production_form').on('keyup', function() {
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


$(document).ready(function(){
    $('.materials').each(function(){
      var row = $(this).closest('tr');
      var id = row.find('.materials').val();
      var batch_id = row.find('.batches').val();
      
      $.ajax({
        url: '{{ url("sheet_productions/material_check") }}',
        type: 'GET',
        data: 'id=' + id + '&batch_id=' + batch_id,
        success: function(res) {
          row.find('.rm_stock').val(res);
        }
      });


    });



    $('.fm_kutcha_in_ids').each(function(){
      var row = $(this).closest('tr');
      var fm_kutcha_in_id = row.find('.fm_kutcha_in_ids').val();


      $.ajax({
            url: '{{ url("sheet_productions/fm_kutcha_check") }}',
            type: 'GET',
            data: 'id=' + fm_kutcha_in_id,
            success: function(resp) {
              console.log(resp);
              row.find('.fm_kutcha_in_stock').val(resp);
            }
          });

    });
});



  function material_current_stock(element) {
   


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


    // $.ajax({
    //   url: '{{ url("sheet_productions/load_kutchas") }}',
    //   type: 'GET',
    //   data: 'fm_kutcha_id='+id,
    //   success:function(res){
    //     if(rowIndex == 0){
    //         $('.product_ids').html(res['product_dropdown']);
    //         $('.fm_kutcha_ids').html(res['fm_kutcha_dropdown']);
    //     }
    //   }
    // });

  }



  $(document).ready(function() {
    //raw material total quantity
    total_kgs();
    $('#raw_material_table').on('keyup', function() {
      total_kgs();
    });

    function total_kgs() {
      var total_kgs = 0;

      $('.qty_kgs').each(function() {
        var qty_kg = $(this).val() > 0 ? $(this).val() : 0;
        total_kgs += parseFloat(qty_kg);
      });

      $('#total_kg').val(total_kgs);
    }


    //direct total quantity
    todays_weight_out();
    $('#direct_production_table').on('keyup change', function() {
      todays_weight_out();
    });


    function todays_weight_out() {
      var total_todays_weight = 0;
      $('.todays_weight').each(function() {
        var todays_wt = $(this).val() > 0 ? $(this).val() : 0;
        total_todays_weight += parseFloat(todays_wt);
      });

      $('#total_todays_weight').val(total_todays_weight);
    }


    //fm kutcha in total quantity
    fm_kutcha_in_total();
    $('#fm_kutcha_in_table').on('keyup', function() {
      fm_kutcha_in_total();
    });

    function fm_kutcha_in_total() {
      var fm_kutcha_in_total = 0;

      $('.fm_kutcha_in_kgs').each(function() {
        var kutcha_in_kg = $(this).val() > 0 ? $(this).val() : 0;
        fm_kutcha_in_total += parseFloat(kutcha_in_kg);
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
    table_repeater('kutcha_table');
    table_repeater('direct_production_table');

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
        // total_kgs_details();
        fm_kutcha_in_total();
        kutcha_out_total();
        show_total_input();
        show_total_output();
        todays_weight_out();
      });

    }


  });
</script>

@include('admin.includes.date_field')
@endsection


@endsection