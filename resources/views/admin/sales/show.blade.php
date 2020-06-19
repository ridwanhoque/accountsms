@extends('admin.master')
@section('content')
<main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-edit"></i> Show Order Receive</h1>
            <p>Show Order Receive</p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Order Receives</li>
            <li class="breadcrumb-item"><a href="#">Show Order Receive</a></li>
          </ul>
        </div>
        <div class="row">
        
          <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Order Receives Table</h3>
            <table class="table table-bordered">
              
              <tbody>
                <tr>
                  <th>Order Receive Date</th>
                  <td>{{ $sale->sale_date }}</td>
                </tr>
                <tr>
                  <th>Order Receive Reference</th>
                  <td>{{ $sale->sale_reference }}</td>
                </tr>
                <tr>
                  <th>Order Receive Subtotal</th>
                  <td>{{ $sale->sub_total }}</td>
                </tr>
                <tr>
                  <th>Order Receive Tax</th>
                  <td>{{ $sale->invoice_tax }}</td>
                </tr>
                <tr>
                  <th>Order Receive Customer</th>
                  <td>{{ $sale->party->name }}</td>
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