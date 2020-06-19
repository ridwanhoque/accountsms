@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('sub_raw_materials.store') }}">
    @csrf

    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Sub Raw Material Information</h1>
        <p>Create Sub Raw Material Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Sub Raw Materials</li>
        <li class="breadcrumb-item"><a href="#">Add Sub Raw Material</a></li>
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

          <a href="{{ route('sub_raw_materials.index') }}" class="btn btn-primary pull-right" style="float: right;"><i
              class="fa fa-eye"></i>View Sub Raw Material</a>
          <h3 class="tile-title">Add New Sub Raw Material</h3>

          <div class="tile-body">


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Main Material Name</label>
              <div class="col-md-8">
                <select name="raw_material_id" class="form-control">
                  @foreach ($raw_materials as $raw_material)
                  <option value="{{ $raw_material->id }}" {{ old('raw_material_id') == $raw_material->id ? 'selected':'' }}>{{ $raw_material->name }}</option>
                  @endforeach
                </select>
                <div class="text-danger">{{ $errors->has('raw_material_id') ? $errors->first('raw_material_id'):'' }}</div>
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Sub Raw Material Name</label>
              <div class="col-md-8">
                <input name="name" value="{{ old('name') }}" class="form-control" type="text"
                  placeholder="Sub Raw Material Name">
                <div class="text-danger">{{ $errors->has('name') ? $errors->first('name'):'' }}</div>
              </div>
            </div>

            <div class="form-group row">
              <label class="control-label col-md-3">Description</label>
              <div class="col-md-8">
                <textarea name="description" id="" cols="30" rows="10" class="form-control"
                  placeholder="Sub Raw Material Description">{{ old('description') }}</textarea>
                <div class="text-danger">{{ $errors->has('description') ? $errors->first('description'):'' }}</div>
              </div>
            </div>



          </div>



          <div class="tile-footer">
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                    class="fa fa-fw fa-lg fa-check-circle"></i>Add Sub Raw Material</button>
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