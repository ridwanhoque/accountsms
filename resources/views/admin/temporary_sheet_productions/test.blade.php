@extends('admin.master')
@section('content')

<main class="app-content">
    <form class="form-horizontal" method="POST" action="{{ route('sheet_productions.store') }}" id="sheet_production_form">

        <div id="app" v-on:keyup="getTotal">
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
                                    <input name="sheet_production_date" value="{{ old('sheet_production_date') == '' ? date('Y-m-d'):old('sheet_production_date') }}" class="form-control" type="text" placeholder="Date" readonly="readonly">
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
                                                {{-- @if(old('sub_raw_material_ids') == true)
                                            @foreach (old('sub_raw_material_ids') as $key => $old_sub_raw_material_id)
                                            <tr data-repeater-item class="outer" valign="top" id="addr_raw_material_table0">
                                                <td>{{ $key+1 }}</td>

                                                <td width="25%">
                                                    <input type="hidden" name="outer-text-input">
                                                    <select name="sub_raw_material_ids[]" class="form-control col-xs outer materials small_input_box" onchange="material_current_stock(this)">
                                                        <option value="0">select</option>
                                                        @isset($sub_raw_materials)
                                                        @foreach ($sub_raw_materials as $sub_raw_material)
                                                        <option value="{{ $sub_raw_material->id }}" {{ $sub_raw_material->id == $old_sub_raw_material_id ? 'selected':'' }}>
                                                            {{ $sub_raw_material->raw_material->name.' - '.$sub_raw_material->name }}</option>
                                                        @endforeach
                                                        @endisset
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control small_input_box" placeholder="raw material stock" readonly="readonly" name="raw_material_stock_qty[]" value="{{ old('raw_material_stock_qty')[$key] }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="qty_kgs[]" placeholder="Qty (kg)" class="form-control col-xs outer qty_kgs small_input_box" step="0.01" value="{{ old('qty_kgs')[$key] }}">
                                                </td>
                                                <td>

                                                </td>
                                                </tr>
                                                @endforeach
                                                @else --}}
                                                <tr data-repeater-item class="outer" valign="top" id="addr_raw_material_table0">
                                                    <td>1</td>

                                                    <td width="25%">
                                                        <input type="hidden" name="outer-text-input">
                                                        <select name="sub_raw_material_ids[]" class="form-control col-xs outer materials small_input_box" onchange="material_current_stock(this)">
                                                            <option value="0">select</option>
                                                            @isset($sub_raw_materials)
                                                            @foreach ($sub_raw_materials as $sub_raw_material)
                                                            <option value="{{ $sub_raw_material->id }}">
                                                                {{ $sub_raw_material->raw_material->name.' - '.$sub_raw_material->name }}</option>
                                                            @endforeach
                                                            @endisset
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control small_input_box" placeholder="raw material stock" readonly="readonly" name="raw_material_stock_qty[]">
                                                    </td>
                                                    <td>
                                                        <input type="number" @keyup="sumRawMaterials()" name="qty_kgs[]" placeholder="Qty (kg)" class="form-control col-xs outer qty_kgs small_input_box" step="0.01">
                                                    </td>
                                                    <td>

                                                    </td>
                                                </tr>
                                                {{-- @endif --}}
                                                <tr id="addr_raw_material_table1"></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">

                                        <div class="pull-right">
                                            <th>
                                                <input type="number" class="form-control small_input_box" name="total_kg" value="0" id="total_kg" readonly="readonly">
                                                <span class="fa fa-plus btn btn-sm btn-success outer small_input_button" data-repeater-create id="add_row_raw_material_table"></span>
                                                <span class="fa fa-trash btn btn-sm btn-danger outer small_input_button btnRemove" id="delete_row_raw_material_table"></span>
                                            </th>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2"></div>

                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <table class="no-spacing outer-repeater" id="fm_kutcha_in_table">
                                            <thead>
                                                <tr>
                                                    <th width="1%"></th>
                                                    <th width="60%" colspan="2" class="text-center"></th>
                                                    <th width="19%" class="text-center"></th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody data-repeater-list="outer-group" class="outer">

                                                <tr data-repeater-item class="outer" valign="top" id="addr_fm_kutcha_in_table0">
                                                    <td>1</td>

                                                    <td width="25%">
                                                        <input type="hidden" name="outer-text-input">
                                                        <select name="fm_kutcha_in_ids[]" class="form-control col-xs outer materials small_input_box fm_kutcha_in_ids" onchange="fm_kutcha_current_stock(this)">
                                                            <option value="0">select</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control small_input_box" placeholder="fm kutcha stock" readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="fm_kutcha_in_kgs[]" placeholder="Qty (kg)" class="form-control col-xs outer fm_kutcha_in_kgs small_input_box" onkeyup="" step="0.01">
                                                    </td>
                                                    <td>

                                                    </td>
                                                </tr>
                                                <tr id="addr_fm_kutcha_in_table1"></tr>
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
                                                    <th width="1%"></th>
                                                    <th class="text-center" style="width: 30%">Sheet Size</th>
                                                    <th class="text-center" style="width: 30%">Color</th>
                                                    <th class="text-center">Roll (qty)</th>
                                                    <th class="text-center">Kg (qty)</th>
                                                    <th>

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody data-repeater-list="outer-group" class="outer">

                                                <tr data-repeater-item class="outer" valign="top" id="addr_sheet_table0">
                                                    <td>1</td>

                                                    <td><input type="hidden" name="text-input">
                                                        <select name="sheet_size_ids[]" class="form-control outer small_input_box sheet_size_id">
                                                        </select>
                                                        {{--
                  <select name="sheet_size_ids[]" class="form-control outer small_input_box">
                    @foreach ($sheet_sizes as $sheet_size)
                    <option value="{{ $sheet_size->id }}">{{ $sheet_size->raw_material->name.' - '.$sheet_size->name }}
                                                        </option>
                                                        @endforeach
                                                        </select> --}}
                                                    </td>
                                                    <td>
                                                        <select name="color_ids[]" class="form-control outer small_input_box">
                                                            @foreach ($colors as $color)
                                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control outer qty_roll small_input_box" name="qty_rolls[]" value="0" step="0.01">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control outer qty_kgs_details small_input_box" name="qty_kgs_details[]" value="0" step="0.01">
                                                    </td>
                                                </tr>
                                                <tr id="addr_sheet_table1"></tr>
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
                                                    <th width="1%"></th>
                                                    <th width="60%" class="text-center">Wastage</th>
                                                    <th width="19%" class="text-center">Qty (kg)</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody data-repeater-list="outer-group" class="outer">

                                                <tr data-repeater-item class="outer" valign="top" id="addr_kutcha_table0">
                                                    <td>1</td>

                                                    <td width="25%">
                                                        <input type="hidden" name="outer-text-input">
                                                        <select name="fm_kutcha_ids[]" class="form-control outer small_input_box fm_kutcha_ids">
                                                            <option value="0">select</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <!-- <input type="number" class="form-control outer kutcha_qty_kgs small_input_box" name="kutcha_qty_kgs[]" value="" step="0.01"> -->
                                                        <input type="number" class="form-control small_input_box" v-model="kutchaQtyKgs">
                                                    </td>
                                                    <td>

                                                    </td>
                                                </tr>
                                                <tr id="addr_kutcha_table1"></tr>
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
                                                    <input type="number" class="form-control small_input_box" name="haddi" value="" step="0.01" id="haddi">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="65%" style="padding-right: 20px;" class="text-right">Powder (kg) </th>
                                                <th width="20%" class="text-center">
                                                    <input type="number" class="form-control small_input_box" name="powder" value="" step="0.01" id="powder">
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
                <input type="number" placeholder="Unit Price" v-model="unitPrice">
                <input type="number" placeholder="Qty" v-model="Qty">
                <input type="number" placeholder="Sub Total" v-model="subTotal">
            </div>
            <!-- ending div tag of div id app -->

    </form>
</main>

@section('js')
<script src="{{ asset('assets/admin/js/plugins/select2.min.js')}}"></script>

<script src="{{ asset('assets/admin/js/style.js') }}"></script>

<script type="text/javascript">
    $('.select2').select2();
</script>

<script src="{{ asset('assets/admin/js/vue.min.js') }}"></script>

<script>
    var vm = new Vue({
        el: '#app',
        data: {
            unitPrice: 0,
            Qty: 0,
            subTotal: 0,
            kutchaQtyKgs: 0
        },
        methods: {
            getTotal: function(event) {
                return this.subTotal = this.unitPrice * this.Qty;
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        table_repeater('raw_material_table');
        table_repeater('fm_kutcha_in_table');
        table_repeater('sheet_table');
        // table_repeater('kutcha_table');

        function table_repeater(tableId) {
            var i = 1;
            $("#add_row_" + tableId).click(function() {
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

            });

        }

    });
</script>
@endsection


@endsection