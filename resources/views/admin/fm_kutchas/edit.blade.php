@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('fm_kutchas.update', $FmKutcha->id) }}"> 
  @csrf
  @method('PUT')
  <input type="hidden" name="id" value="{{ $FmKutcha->id }}">

  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Fm Kutcha Information</h1>
      <p>Update Fm Kutcha Form</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Fm Kutchas</li>
      <li class="breadcrumb-item"><a href="#">Edit Fm Kutcha</a></li>
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

        <a href="{{route('fm_kutchas.index')}}" class="btn btn-primary pull-right" style="float: right;"><i
            class="fa fa-eye"></i>View Fm Kutcha</a>
        <h3 class="tile-title">Edit New Fm Kutcha</h3>

        <div class="tile-body">


            <div class="form-group row add_asterisk">
                <label class="control-label col-md-3">Raw Material</label>
                <div class="col-md-8">
                  <select name="raw_material_id" class="form-control">
                      @foreach ($raw_materials as $raw_material)
                        <option value="{{ $raw_material->id }}" {{ $FmKutcha->raw_material_id == $raw_material->id ? 'selected':'' }}>{{ $raw_material->name }}</option>                      
                      @endforeach
                  </select>
                  <div class="text-danger">{{ $errors->has('raw_material_id') ? $errors->first('raw_material_id'):'' }}</div>
                </div>
              </div>
    

          <div class="form-group row add_asterisk">
            <label class="control-label col-md-3">Fm Kutcha Name</label>
            <div class="col-md-8">
              <input name="name" value="{{ old('name') ?: $FmKutcha->name }}" class="form-control" type="text" placeholder="Fm Kutcha Name">
              <div class="text-danger">{{ $errors->has('name') ? $errors->first('name'):'' }}</div>
            </div>
          </div>

          <div class="form-group row">
            <label class="control-label col-md-3">Description</label>
            <div class="col-md-8">
              <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Fm Kutcha Description">{{ old('description') ?: $FmKutcha->description }}</textarea>
              <div class="text-danger">{{ $errors->has('description') ? $errors->first('description'):'' }}</div>
            </div>
          </div>



        </div>



        <div class="tile-footer">
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                  class="fa fa-fw fa-lg fa-check-circle"></i>Edit Fm Kutcha</button>
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
@include('admin.includes.date_field')
@endsection