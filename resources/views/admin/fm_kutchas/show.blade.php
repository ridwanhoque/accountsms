@extends('admin.master')
@section('content')
<main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-edit"></i> Manage Fm Kutcha</h1>
            <p>Manage Fm Kutcha Form</p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Fm Kutchas</li>
            <li class="breadcrumb-item"><a href="#">Show Fm Kutcha</a></li>
          </ul>
        </div>
        <div class="row">
<div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Fm Kutchas</h3>
            <table class="table table-bordered">
              
              <tbody>
                <tr>
                  <th>Raw Material</th>
                  <td>{{ $FmKutcha->raw_material ? $FmKutcha->raw_material->name : '-' }}</td>
                </tr>
                <tr>
                  <th>Fm Kutcha Name</th>
                  <td>{{ $FmKutcha->name }}</td>
                </tr>
                <tr>
                  <th>Fm Kutcha Description</th>
                  <td>{{ $FmKutcha->description }}</td>
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