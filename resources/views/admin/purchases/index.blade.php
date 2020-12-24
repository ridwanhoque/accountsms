@extends('admin.master')
@section('content')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Purchase Information</h1>
          <p>Purchase information </p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Purchase Information</li>
          <li class="breadcrumb-item active"><a href="#">Purchase Information Table</a></li>
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
            <a href="{{route('purchases.create')}}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Add Purchases</a>
            <h3 class="tile-title">Purchase List </h3>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Batch</th>
                    <th>Order ID</th>
                    <th>Supplier</th>
                    <th>Total Payable</th>
                    <th>Party (Acc)</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($purchases as $purchase)
                  {{-- @dd(array_column($purchase->purchase_details->toArray(), 'id')) --}}
                  <tr>
                      <td>{{ $purchase->purchase_date }}</td>
                      <td>{{ $purchase->batch->name ?? '-' }}</td>
                      <td>{{ $purchase->id }}</td>
                      <td>{{ $purchase->party->name ?? '-' }}</td>
                      <td>{{ Formatter::addComma($purchase->total_payable) }} {{ config('app.tk') }}</td>
                      <td>{{ $purchase->chart_of_account->head_name }}</td>
                      <td>
                          
                        <a class="btn btn-primary btn-sm" title="View" href="{{ route('purchases.show',$purchase->id) }}"> <i class="fa fa-eye"></i> </a> 
                            <a class="btn btn-danger btn-sm" title="Delete" onclick="formSubmit('{{$purchase->id}}')" href="#"> <i class="fa fa-trash"></i> </a>
                        
                        
                            <form action="{{route('purchases.destroy', $purchase->id)}}" id="deleteForm_{{$purchase->id}}" method="POST">
                                @csrf
                                @method("DELETE")
                            </form>
                      </td>
                    </tr>                        
                  @endforeach
                  
                </tbody>
              </table>
              {{ $purchases->links() }}
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