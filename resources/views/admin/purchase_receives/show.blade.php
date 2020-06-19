@extends('admin.master')
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Show Purchase Receive</h1>
      <p>Show Purchase Receive</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Purchase Receives</li>
      <li class="breadcrumb-item"><a href="#">Show Purchase Receive</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Purchase Receives</h3>
        <table class="table no-spacing">
          <tbody>
            <tr>
              <th>Purchase Receive Date</th>
              <td>{{ $purchase_receive->purchase_receive_date }}</td>
            </tr>
            <tr>
              <th>Purchase Receive Reference</th>
              <td>{{ $purchase_receive->chalan_number }}</td>
            </tr>
            <tr>
              <th>Purchase Order Reference</th>
              <td>{{ $purchase_receive->purchase->purchase_reference }}</td>
            </tr>
            <tr>
              <th colspan="2">Purchase Receive Details</th>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table no-spacing">
                      <tr>
                        <th>Raw Material</th>
                        <th>Quantity</th>
                        <th>Bag</th>
                      </tr>
                      @foreach ($purchase_receive->purchase_receive_details as $details)
                      <tr>
                        <td>{{ $details->sub_raw_material->raw_material->name.' - '.$details->sub_raw_material->name }}</td>
                        <td>{{ $details->quantity }} {{ config('app.kg') }}</td>
                        <td>{{ $details->quantity_bag }} </td>
                      </tr>
                      @endforeach
                    </table>
    
                  </td>
            </tr>

          </tbody>
        </table>
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