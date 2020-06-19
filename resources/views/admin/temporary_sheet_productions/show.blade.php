@extends('admin.master')
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Show Sheet Production</h1>
      <p>Show Sheet Production</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Sheet Productions</li>
      <li class="breadcrumb-item"><a href="#">Show Sheet Production</a></li>
    </ul>
  </div>
  <div class="row">

    <div class="col-md-12 print-area">
      <div class="tile">
        <div class="row display_when_print" style="display: none;">
          <div class="col-md-12 text-center">
            <h4>{{ $temp_sheet_production->company->name }}</h4>
            <h5>{{ $temp_sheet_production->company->address }}</h5>
            <h6>{{ $temp_sheet_production->company->phone }}</h6>
            <h6>{{ $temp_sheet_production->company->email }}</h6>
            <br>
          </div>
        </div>
        <br>
        <h4 class="text-center">Sheet Productions</h4>
        <div class="row">
          <div class="col-md-12">
            <table class="table no-spacing">
              <tbody>
                <tr>
                  <td>Production ID : {{ $temp_sheet_production->id }}</td>
                  <td>Date : {{ $temp_sheet_production->sheet_production_date }}</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>



        <h5 class="">Raw Materials</h5>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="padding-top:5px; padding-bottom:5px; width: 30%">Material Name</th>
              <th style="padding-top:5px; padding-bottom:5px; width: 30%">Batch</th>
              <th style="padding-top:5px; padding-bottom:5px;">Quantity (kg)</th>
            </tr>
          </thead>

          <tbody>
            @php
            $qty_total_kg = 0;
            @endphp
            @foreach ($temp_materials as $sheet)
            @php
            $qty_kgs = $sheet->qty_kgs;
            $qty_total_kg += $qty_kgs;
            @endphp
            <tr>
              <td style="padding-top:2px; padding-bottom:2px">{{ $sheet->sub_raw_material ? $sheet->sub_raw_material->raw_material->name.' - '.$sheet->sub_raw_material->name
                    :$sheet->fm_kutcha->raw_material->name.' - '.$sheet->fm_kutcha->name }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $sheet->batch->name ?? '-' }}</td>
                    <td style="padding-top:2px; padding-bottom:2px">{{ $qty_kgs.' '.config('app.kg') }}</td>
            </tr>
            @endforeach
            <tr>
              <th class="text-right" colspan="2">Total</th>
              <td>{{ number_format($qty_total_kg, 2).' '.config('app.kg') }}</td>
            </tr>
          </tbody>

        </table>
        <br>

        <h5 class="">Sheets</h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="padding-top:5px; padding-bottom:5px; width:25%">Sheet Name</th>
              <th style="padding-top:5px; padding-bottom:5px; width:25%">Color</th>
              <th style="padding-top:5px; padding-bottom:5px; width:25%">Qty (roll)</th>
              <th style="padding-top:5px; padding-bottom:5px; width:25%">Qty (kg)</th>
            </tr>
          </thead>
          <tbody>
            @php
            $total_qty_roll = 0;
            $total_qty_kg = 0;
            @endphp
            @foreach ($temp_sheets as $details)
            @php
            $qty_roll = $details->sheet_rolls;
            $qty_kgs = $details->sheet_kgs;
            $total_qty_roll += $qty_roll;
            $total_qty_kg += $qty_kgs;
            @endphp
            <tr>
              <td style="padding-top:2px; padding-bottom:2px">
                {{ $details->sheet_size->raw_material->name.' - '.$details->sheet_size->name }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $details->color->name }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $qty_roll.' '.config('app.roll') }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $qty_kgs.' '.config('app.kg') }}</td>
            </tr>
            @endforeach
            <tr>
              <th class="text-right" colspan="2">
                Total
              </th>
              <th>
                {{ number_format($total_qty_roll, 2).' '.config('app.roll') }}
              </th>
              <th>
                {{ number_format($total_qty_kg, 2).' '.config('app.kg') }}
              </th>
            </tr>
          </tbody>

        </table>


        <br>
        <h5 class="">Wastage</h5>
        <table class="table table-bordered">

            @php
            $total_kutcha_wastage_qty = 0;
            @endphp
          @foreach ($temp_kutcha_wastages as $kutcha_wastage)
          @php
          $kutcha_qty_kg = $kutcha_wastage->qty_kgs;
          $total_kutcha_wastage_qty += $kutcha_qty_kg;
          @endphp
          <tr>
            <td>{{ $kutcha_wastage->fm_kutcha->raw_material->name.' '.$kutcha_wastage->fm_kutcha->name }}</td>
            <td>{{ $kutcha_wastage->qty_kgs.' '.config('app.kg') }}</td>
          </tr>
          @endforeach
          <tr class="">
            <th style="">Haddi</th>
            <td>{{ $temp_sheet_production->haddi.' '.config('app.kg') }}</td>
          </tr>
          <tr class="">
            <th style="">Powder</th>
            <td>{{ $temp_sheet_production->powder.' '.config('app.kg') }}</td>
          </tr>
          <tr>
            <th style="">Grand Total</th>
            <td>
              <strong>{{ number_format($total_kutcha_wastage_qty+$temp_sheet_production->haddi+$temp_sheet_production->powder, 2).' '.config('app.kg') }}</strong>
            </td>
          </tr>
        </table>

        <div class="row d-print-none mt-2">
          <div class="col-12 text-right">
            <a href="javascript:window.print()"  class="btn btn-primary"> <i
                class="fa fa-print"></i>Print</a>
          </div>
        </div>

      </div>
    </div>

  </div>
</main>

<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('assets/admin/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $('#sampleTable').DataTable();
</script>

@endsection