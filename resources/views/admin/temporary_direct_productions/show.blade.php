@extends('admin.master')
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Show Direct Production</h1>
      <p>Show Direct Production</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Direct Productions</li>
      <li class="breadcrumb-item"><a href="#">Show Direct Production</a></li>
    </ul>
  </div>
  <div class="row">

    <div class="col-md-12 print-area">
      <div class="tile">
        <div class="row display_when_print" style="display: none;">
          <div class="col-md-12 text-center">
            <h4>{{ $temp_direct_production->company->name }}</h4>
            <h5>{{ $temp_direct_production->company->address }}</h5>
            <h6>{{ $temp_direct_production->company->phone }}</h6>
            <h6>{{ $temp_direct_production->company->email }}</h6>
            <br>
          </div>
        </div>
    <br>
        <h4 class="text-center">Direct Productions</h4>
        <div class="row">
          <div class="col-md-12">
            <table class="table no-spacing">
              <tbody>
                <tr>
                  <td>Production ID : {{ $temp_direct_production->id }}</td>
                  <td>Date : {{ $temp_direct_production->direct_production_date }}</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>



        <h5 class="">Raw Materials</h5>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="padding-top:5px; padding-bottom:5px;">Material / Kutcha Name</th>
              <th style="padding-top:5px; padding-bottom:5px;">Batch</th>
              <th style="padding-top:5px; padding-bottom:5px;">Quantity (kg)</th>
            </tr>
          </thead>

          <tbody>
          @php
                $qty_total_kg = 0;
            @endphp
            @foreach ($temp_materials as $sheet)
            @php
                $qty_kg = $sheet->qty_kgs;
                $qty_total_kg += $qty_kg;
            @endphp
            <tr>
              <td style="padding-top:2px; padding-bottom:2px">{{ $sheet->sub_raw_material->raw_material->name ?? ' - '}}
              {{ $sheet->sub_raw_material->name ?? '' }}</td>
              <td style="">{{ $sheet->batch->name ?? '-' }}</td>
              {{-- <td style="padding-top:2px; padding-bottom:2px">{{ $sheet->sub_raw_material ? $sheet->sub_raw_material->raw_material->name.' - '.$sheet->sub_raw_material->name
                    :$sheet->fm_kutcha->raw_material->name.' - '.$sheet->fm_kutcha->name }}</td> --}}
              <td style="padding-top:2px; padding-bottom:2px">{{ $qty_kg.' '.config('app.kg') }}</td>
            </tr>
            @endforeach


            @foreach ($temp_assign_kutchas ?? [] as $sheet)
            @php
                $qty_kg = $sheet->qty_kgs;
                $qty_total_kg += $qty_kg;
            @endphp
            <tr>
              <td style="padding-top:2px; padding-bottom:2px">{{ $sheet->fm_kutcha->raw_material->name ?? ' - '}}
              {{ $sheet->fm_kutcha->name ?? '' }}</td>
              <td style="">{{ $sheet->batch->name ?? '-' }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $qty_kg.' '.config('app.kg') }}</td>
            </tr>
            @endforeach
            <tr>
              <th class="text-right" colspan="2">Total</th>
              <td>{{ number_format($qty_total_kg, 2).' '.config('app.kg') }}</td>
            </tr>

          </tbody>

        </table>
        <br>

        <h5 class="">Production Details</h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              <!-- <th style="padding-top:5px; padding-bottom:5px">Raw Material</th> -->
              <th style="padding-top:5px; padding-bottom:5px">Product</th>
              <th style="padding-top:5px; padding-bottom:5px">Machine</th>
              <th style="padding-top:5px; padding-bottom:5px">Todays Weight</th>
              <th style="padding-top:5px; padding-bottom:5px">Finish Quantity</th>
              <th style="padding-top:5px; padding-bottom:5px">Pack</th>
              <th style="padding-top:5px; padding-bottom:5px">Net Weight</th>
              <th style="padding-top:5px; padding-bottom:5px">Fm Kutcha</th>
              <th style="padding-top:5px; padding-bottom:5px">Kutcha Qty</th>
            </tr>
          </thead>
          <tbody>
            @php
                $total_todays_weight = 0;
                $total_finish_quantity = 0;
                $total_pack = 0;
                $total_net_weight = 0;
                $total_kutcha_qty = 0;
            @endphp
            @foreach ($temp_productions as $details)
            @php
                $todays_weight = $details->todays_weight;
                $finish_quantity = $details->finish_quantity;
                $pack = $details->pack;
                $net_weight = $details->net_weight;
                $kutcha_qty = $details->qty_kgs;

                $total_todays_weight += $todays_weight;
                $total_finish_quantity += $finish_quantity;
                $total_pack += $pack;
                $total_net_weight += $net_weight;
                $total_kutcha_qty += $kutcha_qty;
            @endphp
            <tr>
              <!-- <td style="padding-top:2px; padding-bottom:2px">{{ $details->sub_raw_material->raw_material->name ?? '' }}
                                                        -    {{ $details->sub_raw_material->name ?? '' }}
              </td> -->
              <td style="padding-top:2px; padding-bottom:2px">{{ $details->product->raw_material->name ?? '' }}
                                                          -  {{ $details->product->name ?? '' }}
              </td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $details->machine ? $details->machine->name:'-' }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $todays_weight.' '.config('app.kg') }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $finish_quantity.' '.config('app.pcs') }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $pack.' '.config('app.pcs') }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $net_weight.' '.config('app.kg') }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $details->fm_kutcha->raw_material->name ?? '' }}
                -  {{ $details->fm_kutcha->name ?? '' }}</td>
              <td style="padding-top:2px; padding-bottom:2px">{{ $kutcha_qty.' '.config('app.kg') }}</td>
            </tr>
            @endforeach
            <tr>
              <th class="text-right" colspan="2">
                Total
              </th>
              <th>
                {{ number_format($total_todays_weight, 2).' '.config('app.kg') }}
              </th>
              <th>
                {{ number_format($total_finish_quantity, 2).' '.config('app.pcs') }}
              </th>
              <th>
                {{ number_format($total_pack, 2).' '.config('app.pcs') }}
              </th>
              <th>
                {{ number_format($total_net_weight, 2).' '.config('app.kg') }}
              </th>
              <th></th>
              <th>
                {{ number_format($total_kutcha_qty, 2).' '.config('app.kg') }}
              </th>
            </tr>
          </tbody>

        </table>


        
        
        <div class="row d-print-none mt-2">
          <div class="col-12 text-right">
            <a href="javascript:window.print()"  class="btn btn-primary"> <i class="fa fa-print"></i>Print</a>
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