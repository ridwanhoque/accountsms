@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('raw_materials.store') }}"> 
  @csrf

  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Raw Material Information</h1>
      <p>Create Raw Material Form</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Raw Materials</li>
      <li class="breadcrumb-item"><a href="#">Add Raw Material</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      @if(Session::get('error_message'))
      <div class="alert alert-danger">
        {{ Seession::get('error_message') }}
      </div>
      @endif
      @if($errors->any())
      <div class="alert-danger">
        <ul class="list-unstyled">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <div class="tile">

        <a href="{{route('raw_materials.index')}}" class="btn btn-primary pull-right" style="float: right;"><i
            class="fa fa-eye"></i>View Raw Material</a>
        <h3 class="tile-title">Add New Raw Material</h3>

        <div class="tile-body">



          <div class="form-group row add_asterisk">
            <label class="control-label col-md-3">Raw Material Name</label>
            <div class="col-md-8">
              <input name="name" value="{{ old('name') }}" class="form-control" type="text" placeholder="Raw Material Name">
              <div class="text-danger">{{ $errors->has('name') ? $errors->first('name'):'' }}</div>
            </div>
          </div>

          <div class="form-group row">
            <label class="control-label col-md-3">Description</label>
            <div class="col-md-8">
              <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Raw Material Description">{{ old('description') }}</textarea>
              <div class="text-danger">{{ $errors->has('description') ? $errors->first('description'):'' }}</div>
            </div>
          </div>



        </div>



        <div class="tile-footer">
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                  class="fa fa-fw fa-lg fa-check-circle"></i>Add Raw Material</button>
            </div>
          </div>
        </div>



      </div>


    </div>

  </div>
  </div>
  </div>

  </form>
</main>

<script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/select2.min.js')}}"></script>


<script type="text/javascript">
  $('.select2').select2();
</script>


@endsection