@extends('admin.master')
@section('content')
<main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-edit"></i> Manage Product Stock Transfer</h1>
            <p>Manage Product Stock Transfer Form</p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Product Stock Transfers</li>
            <li class="breadcrumb-item"><a href="#">Show Product Stock Transfer</a></li>
          </ul>
        </div>
        <div class="row">

        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Product Stock Transfers</h3>
            <table class="table table-bordered">
              
              <tbody>
                <tr>
                  <td> <strong>Product Stock Transfer Date </strong> : 
                    {{ $product_stock_transfer->product_stock_transfer_date ?? '-' }}</td>
                </tr>
                  <tr>
                  <td> <strong>Product Stock Transfer To </strong> : 
                    {{ $product_stock_transfer->transfer_to_branch->name ?? '-' }}</td>
                </tr>
                <tr>
                  <td colspan="2">
                        <table>
                          <tr>
                            <thead>
                              <th>Product</th>
                              <th>Quantity</th>
                              <th>Pack</th>
                              <th>Weight</th>
                            </thead>
                          </tr>
                          @foreach($product_stock_transfer->product_stock_transfer_details as $details)
                          <tr>
                            <td>{{ $details->product->name }}</td>
                            <td>{{ $details->quantity }}</td>
                            <td>{{ $details->pack }}</td>
                            <td>{{ $details->weight }}</td>
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
<script type="text/javascript">$('#sampleTable').DataTable();</script>

        @endsection