@extends('admin.master')
@section('content')
<main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-edit"></i> Manage Sheet Size</h1>
            <p>Manage Sheet Size Form</p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Sheet Sizes</li>
            <li class="breadcrumb-item"><a href="#">Show Sheet Size</a></li>
          </ul>
        </div>
        <div class="row">
<div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Sheet Sizes Table</h3>
            <table class="table table-bordered">
              
              <tbody>
                <tr>
                  <th>Raw Material</th>
                  <td>{{ $sheetSize->raw_material ? $sheetSize->raw_material->name : '-' }}</td>
                </tr>
                <tr>
                  <th>Sheet Size Name</th>
                  <td>{{ $sheetSize->name }}</td>
                </tr>
                <tr>
                  <th>Sheet Size Description</th>
                  <td>{{ $sheetSize->description }}</td>
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