@extends('admin.master')
@section('content')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Finish Production Information</h1>
          <p>Finish Production information </p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Finish Production Information</li>
          <li class="breadcrumb-item active"><a href="#">Finish Production Information Table</a></li>
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
            <a href="{{ route('temporary_daily_productions.create') }}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Add Finish Production</a>
            <h3 class="tile-title">Finish Production List </h3>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Raw Material</th>
                    <th>Production ID</th>
                    <th>Color</th>
                    <th>Sheet (kg)</th>
                    <th>Kutcha (kg)</th>
                    <th>Product (kg)</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($temporary_daily_productions as $daily_production)
                  <tr>
                    <td>{{ $daily_production->daily_production_date }}</td>
                    <td>{{ $daily_production->daily_production_details->first()->product->raw_material->name }}</td>
                    <td>{{ $daily_production->id }}</td>
                    <td>{{ $daily_production->daily_production_details->first()->sheet_size_color->color->name }}</td>
                    <td>{{ $daily_production->total_sheet_kutchas ? $daily_production->total_sheet_kutchas['sum_sheet_kg'].' '.config('app.kg'):'0.00' }}</td>
                    <td>{{ $daily_production->total_sheet_kutchas ? $daily_production->total_sheet_kutchas['sum_kutcha_kg'].' '.config('app.kg'):'0.00' }}</td>
                    <td>{{ $daily_production->total_sheet_kutchas ? $daily_production->total_sheet_kutchas['sum_product_weight'].' '.config('app.kg'):'0.00' }}</td>
                      <td>
                          <a class="btn btn-primary btn-sm" title="View" href="{{ route('daily_productions.show',$daily_production->id) }}"> <i class="fa fa-eye"></i> </a> 
                          @if($daily_production->is_approved !=1 )

                            <a href="{{ route('temporary_daily_productions.edit', $daily_production->id) }}" class="btn btn-success btn-sm" title="edit">
                              <i class="fa fa-edit"></i>
                            </a>

                            <a class="btn btn-danger btn-sm" title="Delete" onclick="formSubmit('{{$daily_production->id}}')" href="#"> <i class="fa fa-trash"></i> </a>
                        
                            <form action="{{route('daily_productions.destroy', $daily_production->id)}}" id="deleteForm_{{$daily_production->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                            </form>
                          @endif
                      </td>
                    </tr>                        
                  @endforeach
                  
                </tbody>
              </table>
              {{ $temporary_daily_productions->links() }}
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