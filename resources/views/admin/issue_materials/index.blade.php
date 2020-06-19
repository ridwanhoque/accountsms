@extends('admin.master')
@section('content')

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Issue Material Information</h1>
          <p>Issue Material information </p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Issue Material Information</li>
          <li class="breadcrumb-item active"><a href="#">Issue Material Information</a></li>
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
            <a href="{{route('issue_materials.create')}}" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Add Issue Material</a>
            <h3 class="tile-title">Issue Material List </h3>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="">
                <thead>
                  <tr>
                    <th>Issue Material Code</th>
                    <th>Issue Material Name</th>
                    <th>Issue Material Unit</th>
                    <th>Issue Material Cost</th>
                    <th>Issue Material Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($issue_materials as $product)
                  <tr>
                      <td>{{ $product->product_code }}</td>
                      <td>{{ $product->product_name }}</td>
                      <td>{{ $product->product_unit->name }}</td>
                      <td>{{ $product->product_cost }}</td>
                      <td>{{ $product->product_price }}</td>
                      <td>
                          <a href="{{ route('issue_materials.edit', $product->id) }}"><i class="fa fa-edit"></i></a>
                          <a href="{{ route('issue_materials.show', $product->id) }}"><i class="fa fa-eye"></i></a>
                          <a href="#" data-toggle="modal" onclick="deleteData({{ $product->id }})" 
                            data-target="#DeleteModal"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>                        
                  @endforeach
                  
                </tbody>
              </table>
              {{ $issue_materials->links() }}
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
            var url = '{{ route("issue_materials.destroy", ":id") }}';
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