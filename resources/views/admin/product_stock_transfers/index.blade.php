@extends('admin.master')
@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Product Stock Transfer Information</h1>
      <p>Product Stock Transfer information </p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Product Stock Transfer Information</li>
      <li class="breadcrumb-item active"><a href="#">Product Stock Transfer Information Table</a></li>
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
        <a href="{{ route('product_stock_transfers.create') }}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Add Product Stock Transfer</a>
        <h3 class="tile-title">Product Stock Transfer List </h3>
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="">
            <thead>
              <tr>
                <th>Date</th>
                <th>Transfer To</th>
                <!-- <th>Quantity</th>
                <th>Pack</th>
                <th>Weight</th> -->
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($product_stock_transfers as $product_stock_transfer)
              <tr>
                <td>{{ $product_stock_transfer->product_stock_transfer_date ?? '' }}</td>
                <td>{{ $product_stock_transfer->transfer_to_branch->name ?? '-' }}</td>
                <!-- <td>{{ $product_stock_transfer->total_quantity }}</td>
                <td>{{ $product_stock_transfer->total_pack }}</td>
                <td>{{ $product_stock_transfer->total_weight }}</td> -->
                <td>
                  <a title="view" href="{{ route('product_stock_transfers.show', $product_stock_transfer->id) }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-eye"></i>
                  </a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
          {{ $product_stock_transfers->links() }}
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


<script type="text/javascript">
  $('#sampleTable').DataTable();
</script>

<script>
  function formSubmit(id) {
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
        $('#deleteForm_' + id).submit();
        swal("Deleted!", "Your data has been deleted.", "success");
      } else {
        swal("Cancelled", "Your data is safe :)", "error");
      }
    });
  }
</script>


@include('admin.includes.delete_confirm')

@endsection