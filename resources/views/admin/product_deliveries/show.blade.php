@extends('admin.master')
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Show Product Delivery</h1>
      <p>Show Product Delivery</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Product Deliverys</li>
      <li class="breadcrumb-item"><a href="#">Show Product Delivery</a></li>
    </ul>
  </div>
  <div class="row">

    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Product Deliverys</h3>
        <table class="table table-bordered">

          <tbody>
            <tr>
              <th>Product Delivery Date</th>
              <td>{{ $productDelivery->product_delivery_date }}</td>
            </tr>
            <tr>
              <th>Product Delivery Chalan</th>
              <td>{{ $productDelivery->product_delivery_chalan }}</td>
            </tr>
            <tr>
              <th>Driver Name</th>
              <td>{{ $productDelivery->driver_name }}</td>
            </tr>
            <tr>
              <th>Driver Phone</th>
              <td>{{ $productDelivery->driver_phone }}</td>
            </tr>
            <tr>
              <th>Status</th>
              <td><span
                  class="badge badge-{{ $productDelivery->status_id == 1 ? 'success':'danger' }}">{{ $productDelivery->status->name }}</span>
              </td>
            </tr>
            <tr>
              <th colspan="2">Details</th>
            </tr>
            <tr>
              <td colspan="2">
                <table>
                  <tr>
                    <th>Delivery ID</th>
                    <th>Sale ID</th>
                    <th>Party</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Pack</th>
                    <th>Weight</th>
                  </tr>
                  @foreach ($productDelivery->product_delivery_details as $details)
                  <tr>
                    <td>#{{ $productDelivery->id }}</td>
                    <td>#{{ $details->sale->id ?? '' }}</td>
                    <td>{{ $details->sale->party->name ?? '' }}</td>
                    <td>{{ $details->product->name }}</td>
                    <td>{{ $details->quantity }} {{ config('app.pcs') }}</td>
                    <td>{{ $details->pack }}</td>
                    <td>{{ $details->weight }} {{ config('app.kg') }}</td>
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