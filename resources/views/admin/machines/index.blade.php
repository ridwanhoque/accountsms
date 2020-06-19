@extends('admin.master')
@section('content')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Machine Information</h1>
          <p>Machine information </p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Machine Information</li>
          <li class="breadcrumb-item active"><a href="#">Machine Information Table</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
            @if(Session::get('message'))
            <div class="alert alert-success">
              {{ Session::get('message') }}
            </div>
            @endif
          
          <div class="tile">
            <a href="{{ route('machines.create') }}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Add Machine</a>
            <h3 class="tile-title">Machine List </h3>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="">
                <thead>
                  <tr>
                    <th>Machine Name</th>
                    <th>Machine Model</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($machines as $machine)
                  <tr>
                      <td>{{ $machine->name }}</td>
                      <td>{{ $machine->model }}</td>
                      <td>

                          <a class="btn btn-info btn-sm" title="Edit" href="{{ route('machines.edit',$machine->id) }}"> <i class="fa fa-edit"></i> </a> 
                          <a class="btn btn-primary btn-sm" title="View" href="{{ route('machines.show',$machine->id) }}"> <i class="fa fa-eye"></i> </a> 
                            <a class="btn btn-danger btn-sm" title="Delete" onclick="formSubmit('{{$machine->id}}')" href="#"> <i class="fa fa-trash"></i> </a>
                      
                      
                          <form action="{{route('machines.destroy', $machine->id)}}" id="deleteForm_{{$machine->id}}" method="POST">
                              @csrf
                              @method("DELETE")
                          </form>
                          
                      </td>
                    </tr>                        
                  @endforeach
                  
                </tbody>
              </table>
              {{ $machines->links() }}
            </div>
          </div>
        </div>
      </div>
    </main>


    <script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/dataTables.bootstrap.min.js')}}"></script>
     
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/sweetalert.min.js')}}"></script>
    

    <script type="text/javascript">$('#sampleTable').DataTable();</script>

    <script>
        function formSubmit(id)
        {
          swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data !",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plz!",
            closeOnConfirm: false,
            closeOnCancel: false
          }, function(isConfirm) {
            if (isConfirm) {
              $('#deleteForm_'+id).submit();
              swal("Deleted!", "Your data has been deleted.", "success");
            } else {
              swal("Cancelled", "Your data is safe :)", "error");
            }
          });
        }
       </script>
  

@include('admin.includes.delete_confirm')

    @endsection