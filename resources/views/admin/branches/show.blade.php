@extends('admin.master')
@section('content')
<main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-edit"></i> Manage Branch</h1>
            <p>Manage Branch Form</p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Branchs</li>
            <li class="breadcrumb-item"><a href="#">Show Branch</a></li>
          </ul>
        </div>
        <div class="row">

        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Branchs</h3>
            <table class="table table-bordered">
              
              <tbody>
                <tr>
                  <th>Branch Name</th>
                  <td>{{ $branch->name }}</td>
                </tr>
                <tr>
                  <th>Branch Description</th>
                  <td>{{ $branch->description }}</td>
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