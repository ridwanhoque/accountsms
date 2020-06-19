@extends('admin.master')
@section('content')
<main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-edit"></i> Show Purchase</h1>
            <p>Show Purchase</p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Purchases</li>
            <li class="breadcrumb-item"><a href="#">Show Purchase</a></li>
          </ul>
        </div>
        <div class="row">
        
          <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Purchases</h3>
            <table class="table table-bordered">
              
              <tbody>
                <tr>
                  <th>Purchase Date</th>
                  <td>{{ $purchase->purchase_date }}</td>
                </tr>
                <tr>
                  <th>Order ID</th>
                  <td>{{ $purchase->id }}</td>
                </tr>
                <tr>
                  <th>Purchase Subtotal</th>
                  <td>{{ $purchase->sub_total }}</td>
                </tr>
                <tr>
                  <th>Purchase Discount</th>
                  <td>{{ $purchase->invoice_discount }}</td>
                </tr>
                <tr>
                  <th>Purchase Tax</th>
                  <td>{{ $purchase->invoice_tax }}</td>
                </tr>
                <tr>
                  <th>Purchase Supplier</th>
                  <td>{{ $purchase->party->name }}</td>
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