@extends('admin.master')
@section('content')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Direct Production Information</h1>
          <p>Direct Production information </p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Direct Production Information</li>
          <li class="breadcrumb-item active"><a href="#">Direct Production Information Table</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
            @if(Session::get('message'))
            <div class="alert alert-success">
              {{ Session::get('message') }}
            </div>
            @endif
          @if(Session::get('error_message'))
            <div class="alert alert-danger">
              {{ Session::get('error_message') }}
            </div>
            @endif
          <div class="tile">
            <a href="{{route('temporary_direct_productions.create')}}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Add Direct Productions</a>
            <h3 class="tile-title">Direct Production List </h3>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Raw Material</th>
                    <th>Production ID</th>
                    <th>RM (kg)</th>
                    <th>Product (kg)</th>
                    <th>Kutcha (kg)</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($direct_productions as $direct_production)
                  @php
                  $direct_production_sheetable = $direct_production->direct_production_sheets->first()
                  @endphp
                  <tr>
                      <td>{{ $direct_production->direct_production_date }}</td>
                      <td>{{ $direct_production_sheetable->direct_production_sheetable->raw_material->name ?? '' }}
                      {{ '-' }}  
                      {{ $direct_production_sheetable->direct_production_sheetable->name ?? '' }}
                      </td>
                      <td>{{ $direct_production->id }}</td>
                      <td>{{ $direct_production->total_input ? $direct_production->total_input.' '.config('app.kg'):'0.00' }}</td>
                      <td>{{ $direct_production->total_todays_weight ? $direct_production->total_todays_weight.' '.config('app.kg'):'0.00' }}</td>
                      <td>{{ $direct_production->total_kutchas ? $direct_production->total_kutchas['sum_kutcha'].' '.config('app.kg'):'0.00' }}</td>
                      <td>
                          
                        <a class="btn btn-primary btn-sm" title="View" href="{{ route('direct_productions.show',$direct_production->id) }}"> <i class="fa fa-eye"></i> </a> 
  
                          <a class="btn btn-danger btn-sm" title="Delete" onclick="formSubmit('{{$direct_production->id}}')" href="#"> <i class="fa fa-trash"></i> </a>
                        
                            <form action="{{route('direct_productions.destroy', $direct_production->id)}}" id="deleteForm_{{$direct_production->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                            </form>
                          
                      </td>
                    </tr>                        
                  @endforeach
                  
                </tbody>
              </table>
              {{ $direct_productions->links() }}
            </div>
          </div>
        </div>
      </div>
    </main>


    <script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/dataTables.bootstrap.min.js')}}"></script>
     

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