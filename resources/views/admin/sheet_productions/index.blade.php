@extends('admin.master')
@section('content')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Sheet Production Information</h1>
          <p>Sheet Production information </p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Sheet Production Information</li>
          <li class="breadcrumb-item active"><a href="#">Sheet Production Information Table</a></li>
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
            <a href="{{route('temporary_sheet_productions.create')}}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Add Sheet Productions</a>
            <h3 class="tile-title">Sheet Production List </h3>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Production ID</th>
                    <th>Raw Material</th>
					          <th>Color</th>
                    <th>RM (kg)</th>
                    <th>Sheet (kg)</th>
                    <th>Kutcha (kg)</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sheet_productions as $sheet_production)
                  <tr>
                      <td>{{ $sheet_production->sheet_production_date }}</td>
                      <td>{{ $sheet_production->id }}</td>
                      <td>{{ $sheet_production->sheets->first() ? $sheet_production->sheets->first()->sub_raw_material->raw_material->name:'' }}</td>
                      <td>{{ $sheet_production->sheet_production_details->first() ? $sheet_production->sheet_production_details->first()->color->name:'' }}</td>
					            <td>{{ $sheet_production->sum_material ? $sheet_production->sum_material->total_kg_material.' '.config('app.kg'):'0' }}</td>
                      <td>{{ $sheet_production->sum_sheet ? $sheet_production->sum_sheet->total_kg_sheet.' '.config('app.kg'):'0.00' }}</td>
                      <td>{{ $sheet_production->sum_kutcha ? $sheet_production->sum_kutcha->total_kg_kutcha.' '.config('app.kg'):'0.00' }}</td>
                      <td>
                        <a class="btn btn-primary btn-sm" title="View" href="{{ route('sheet_productions.show',$sheet_production->id) }}"> <i class="fa fa-eye"></i> </a> 
  
                        <a class="btn btn-danger btn-sm" title="Delete" onclick="formSubmit('{{$sheet_production->id}}')" href="#"> <i class="fa fa-trash"></i> </a>
                        
                            <form action="{{route('sheet_productions.destroy', $sheet_production->id)}}" id="deleteForm_{{$sheet_production->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                            </form>  
                      </td>
                    </tr>                        
                  @endforeach
                  
                </tbody>
              </table>
              {{ $sheet_productions->links() }}
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