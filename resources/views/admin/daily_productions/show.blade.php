@extends('admin.master')
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Show Daily Production</h1>
      <p>Show Daily Production</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Daily Productions</li>
      <li class="breadcrumb-item"><a href="#">Show Daily Production</a></li>
    </ul>
  </div>
  <div class="row print-area">

    <div class="col-md-12">

      <div class="tile">

        <div class="row">
          <div class="col-12 text-center display_when_print" style="display: none">
            <h4>{{ $dailyProduction->company->name }}</h4>
            <h5>{{ $dailyProduction->company->phone }}</h5>
            <h6>{{ $dailyProduction->company->email }}</h6>
            <h6>{{ $dailyProduction->company->address }}</h6>
          </div>
        </div>

        <div class="mt-4"></div>
        <h3 class="tile-title">Daily Productions</h3>
        <div class="float-left;"> </div>
        <div class="float-left"> <strong class="pr-2"> Date : </strong>{{ $dailyProduction->daily_production_date }}
        </div>

        <div class="table-responsive text-nowrap">

          <table class="table table-bordered no-spacing mt-4">
            <thead>
              <tr>
                <th>Sheet Name</th>
                <th>Color</th>
                <th>Used (kg)</th>
                <th>Used (roll)</th>
                <th>Raw Material</th>
                <th>Product</th>
                <th>Machine</th>
                <th>Finish Qty</th>
                <th>Pack</th>
                <th>Net Weight</th>
                <th>Fm Kutcha</th>
                <th>Qty (kg)</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dailyProduction->daily_production_details as $details)
              <tr>
                <td>
                  {{ $details->sheet_size_color->raw_material->name.' - '.$details->sheet_size_color->sheet_size->name }}
                </td>
                <td>{{ $details->sheet_size_color->color->name }}</td>
                <td>{{ $details->todays_weight.' '.config('app.kg') }}</td>
                <td>{{ $details->used_roll.' '.config('app.kg') }}</td>
                <td>{{ $details->product->raw_material->name }}</td>
                <td>{{ $details->product->name }}</td>
                <td>{{ $details->machine ? $details->machine->name:'-' }}</td>
                <td>{{ $details->finish_quantity }}</td>
                <td>{{ $details->pack }}</td>
                <td>{{ $details->net_weight.' '.config('app.kg') }}</td>
                <td>{{ $details->fm_kutcha->raw_material->name.' - '.$details->fm_kutcha->name }}</td>
                <td>{{ $details->wastage_out.' '.config('app.kg') }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>


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

<script>
  function confirmDelete(){
  var cnf=confirm('Are you sure?');
  if(cnf){
      $('#deleteForm').submit();
      return true;
  }else{
    return false;
  }
}
</script>

<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('assets/admin/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $('#sampleTable').DataTable();
</script>

@endsection