@extends('admin.master')
@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Order Receive Information</h1>
      <p>Order Receive information </p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Order Receive Information</li>
      <li class="breadcrumb-item active"><a href="#">Order Receive Information Table</a></li>
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
        <a href="{{route('sales.create')}}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Add
          Order Receives</a>
        <h3 class="tile-title">Order Receive List </h3>
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sale_table">
            <thead>
              <tr>
                <th>Order Receive Date</th>
                <th>Delivery Date</th>
                <th>Order Receive Reference</th>
                <th>Order Receive Supplier</th>
                <th>Party</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sales as $sale)
              <tr>
                <td>{{ $sale->sale_date }}</td>
                <td>{{ $sale->sale_delivery_date ?? '-' }}</td>
                <td>{{ $sale->sale_reference }}</td>
                <td>{{ $sale->party->name ?? '' }}</td>
                
                <td>{{ Formatter::addComma($sale->total_payable) ?? '' }}</td>
                <td>
                  <a class="btn btn-info btn-sm" title="Edit" href="{{ route('sales.edit',$sale->id) }}"> <i
                      class="fa fa-edit"></i> </a>
                  <a class="btn btn-primary btn-sm" title="View" href="{{ route('sales.show',$sale->id) }}"> <i
                      class="fa fa-eye"></i> </a>
                  <a class="btn btn-danger btn-sm" title="Delete" onclick="formSubmit('{{$sale->id}}')" href="#"> <i
                      class="fa fa-trash"></i> </a>


                  <form action="{{route('sales.destroy', $sale->id)}}" id="deleteForm_{{$sale->id}}" method="POST">
                    @csrf
                    @method("DELETE")
                  </form>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
         
        </div>
      </div>
    </div>
  </div>
</main>


<script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('assets/admin/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/js/plugins/dataTables.bootstrap.min.js')}}"></script>


<script type="text/javascript">
  $('#sale_table').DataTable();
</script>
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