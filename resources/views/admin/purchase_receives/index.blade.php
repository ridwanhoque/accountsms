@extends('admin.master')
@section('content')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Chalan Receive Information</h1>
          <p>Chalan Receive information </p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Chalan Receive Information</li>
          <li class="breadcrumb-item active"><a href="#">Chalan Receive Information Table</a></li>
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
            <a href="{{route('purchase_receives.create')}}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Add Chalan Receives</a>
            <h3 class="tile-title">Chalan Receive List </h3>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="">
                <thead>
                  <tr>
                    <th>Chalan Receive Date</th>
                    <th>Batch</th>
                    <th>Order ID</th>
                    <th>Chalan Number</th>
                    <th>Supplier</th>
                    <th>Total (kg)</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($purchase_receives as $purchase_receive)
                  <tr>
                      <td>{{ $purchase_receive->purchase_receive_date }}</td>
                      <td>{{ $purchase_receive->purchase->batch->name ?? '-' }}</td>
                      <td>{{ $purchase_receive->purchase->id }}</td>
                      <td>{{ $purchase_receive->chalan_number }}</td>
                      <td>{{ $purchase_receive->purchase->party->name }}</td>
                      <td>{{ $purchase_receive->chalan_receive_quantity ? $purchase_receive->chalan_receive_quantity['sum_quantity'].' '.config('app.kg'):'0.00' }}</td>
                      <td>                          
                        <a class="btn btn-primary btn-sm" title="View" href="{{ route('purchase_receives.show',$purchase_receive->id) }}"> <i class="fa fa-eye"></i> </a> 
                          @if($purchase_receive->status_id !=1 )
                            <a class="btn btn-danger btn-sm" title="Delete" onclick="formSubmit('{{$purchase_receive->id}}')" href="#"> <i class="fa fa-trash"></i> </a>
                                                                           
                            <form action="{{route('purchase_receives.destroy', $purchase_receive->id)}}" id="deleteForm_{{$purchase_receive->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                            </form>
                          @endif
                      </td>
                    </tr>                        
                  @endforeach
                  
                </tbody>
              </table>
              {{ $purchase_receives->links() }}
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