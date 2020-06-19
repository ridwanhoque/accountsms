@extends('admin.master')
@section('content')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Production Unit Information</h1>
          <p>Production Unit information </p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Production Unit Information</li>
          <li class="breadcrumb-item active"><a href="#">Production Unit Information</a></li>
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
            <a href="{{ route('production_units.create') }}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Add Production Unit</a>
            <h3 class="tile-title">Production Unit List </h3>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="">
                <thead>
                  <tr>
                    <th>Production Unit Code</th>
                    <th>Production Unit Name</th>
                    <th>Production Unit Unit</th>
                    <th>Production Unit Cost</th>
                    <th>Production Unit Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($production_units as $product)
                  <tr>
                      <td>{{ $product->product_code }}</td>
                      <td>{{ $product->product_name }}</td>
                      <td>{{ $product->product_unit->name }}</td>
                      <td>{{ $product->product_cost }}</td>
                      <td>{{ $product->product_price }}</td>
                      <td>
                          <a href="{{ route('production_units.edit', $product->id) }}"><i class="fa fa-edit"></i></a>
                          <a href="{{ route('production_units.show', $product->id) }}"><i class="fa fa-eye"></i></a>
                          <a href="#" data-toggle="modal" onclick="deleteData({{ $product->id }})" 
                            data-target="#DeleteModal"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>                        
                  @endforeach
                  
                </tbody>
              </table>
              {{ $production_units->links() }}
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

    <script type="text/javascript">
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("production_units.destroy", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
         $("#deleteForm").submit();
        }
      </script>

@include('admin.includes.delete_confirm')

    @endsection