@extends('admin.master')
@section('content')
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Manage Finish Product</h1>
      <p>Manage Finish Product Form</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Finish Products</li>
      <li class="breadcrumb-item"><a href="#">Show Finish Product</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Finish Products</h3>
        <table class="table table-bordered">

          <tbody>
            <tr>
              <th>Raw Material Name</th>
              <td>{{ $product->raw_material->name }}</td>
            </tr>
            <tr>
              <th>Machine Name</th>
              <td>{{ $product->machine->name }}</td>
            </tr>
            <tr>
              <th>Expected Quantity</th>
              <td>{{ $product->expected_quantity }}</td>
            </tr>
            <tr>
              <th>Standard Weight</th>
              <td>{{ $product->standard_weight }}</td>
            </tr>
            <tr>
              <th>Finish Product Name</th>
              <td>{{ $product->name }}</td>
            </tr>
            <tr>
              <th>Finish Product Description</th>
              <td>{{ $product->description }}</td>
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