@extends('admin.master')
@section('content')

<main class="app-content">
    <div class="row">
        <div class="col-md-12">
        @extends('admin.master')
@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Raw Material Information</h1>
      <p>Raw Material Information </p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Raw Material Information</li>
      <li class="breadcrumb-item active"><a href="#">Raw Material Information Table</a></li>
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
        <a href="{{ route('raw_materials.create') }}" class="btn btn-primary" style="float: right;"><i
            class="fa fa-plus"></i>Add Raw Material</a>
        <h3 class="tile-title">Raw Material List </h3>
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="">
            <thead>
              <tr>
                <th>Raw Material Name</th>
                <th>Debit</th>
                <th>Credit</th>
                <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
              @foreach ($debit_credit as $raw_material)
              @php
              $amount = $raw_material->amount;
              @endphp
              <tr>
                <td>{{ $raw_material->chart_of_account->head_name }}</td>
                <td>{{ $debit_amount = $amount > 0 ? $amount:0.00  }}</td>
                <td>{{ $credit_amount = $amount < 0 ? $amount:0.00 }}</td>
                <!-- <td>

                  <a class="btn btn-info btn-sm" title="Edit"
                    href="{{ route('raw_materials.edit',$raw_material->id) }}"> <i class="fa fa-edit"></i> </a>
                  <a class="btn btn-primary btn-sm" title="View"
                    href="{{ route('raw_materials.show',$raw_material->id) }}"> <i class="fa fa-eye"></i> </a>
                  <a class="btn btn-danger btn-sm" title="Delete" onclick="formSubmit('{{$raw_material->id}}')"
                    href="#"> <i class="fa fa-trash"></i> </a>


                  <form action="{{route('raw_materials.destroy', $raw_material->id)}}"
                    id="deleteForm_{{$raw_material->id}}" method="POST">
                    @csrf
                    @method("DELETE")
                  </form>

                </td> -->
              </tr>
              @endforeach

            </tbody>
          </table>
          {{ $debit_credit->links() }}
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
        </div>
    </div>
</main>

@section('js')
<script src="{{ asset('assets/admin/js/plugins/select2.min.js')}}"></script>

<script src="{{ asset('assets/admin/js/style.js') }}"></script>

<script type="text/javascript">
    $('.select2').select2();
</script>

<script src="{{ asset('assets/admin/js/vue.min.js') }}"></script>

<script>
var vm = new Vue({
    el: '#app',
    data: {
        unitPrice: 0,
        Qty: 0,
        subTotal: 0,
        kutchaQtyKgs: 0
    },
    methods: {
        getTotal: function(event){
            return this.subTotal = this.unitPrice*this.Qty;
        }
    }
});
</script>

<script>
    $(document).ready(function() {
        table_repeater('raw_material_table');
        table_repeater('fm_kutcha_in_table');
        table_repeater('sheet_table');
        // table_repeater('kutcha_table');

        function table_repeater(tableId) {
            var i = 1;
            $("#add_row_" + tableId).click(function() {
                b = i - 1;
                $('#addr_' + tableId + i).html($('#addr_' + tableId + b).html()).find('td:first-child').html(i + 1);
                $('#' + tableId).append('<tr id="addr_' + tableId + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row_" + tableId).click(function() {

                if (i > 1) {
                    $("#addr_" + tableId + (i - 1)).html('');
                    i--;
                }

            });

        }

    });
</script>
@endsection


@endsection
