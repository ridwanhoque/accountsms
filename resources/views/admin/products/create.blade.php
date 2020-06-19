@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('products.store') }}"> 
  @csrf

  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Finish Product Information</h1>
      <p>Create Finish Product Form</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Finish Products</li>
      <li class="breadcrumb-item"><a href="#">Add Finish Product</a></li>
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

        <a href="{{route('products.index')}}" class="btn btn-primary pull-right" style="float: right;"><i
            class="fa fa-eye"></i>View Finish Product</a>
        <h3 class="tile-title">Add New Finish Product</h3>

        <div class="tile-body">



          <div class="form-group row add_asterisk">
            <label class="control-label col-md-3">Raw Material Name</label>
            <div class="col-md-8">
              <select  name="raw_material_id" class="form-control">
                @foreach($raw_materials as $raw_material)
                  {{-- @foreach ($raw_material->sub_raw_materials as $sub_raw_material) --}}
                    <option value="{{ $raw_material->id }}">{{ $raw_material->name }}</option>
                  {{-- @endforeach --}}
                @endforeach
              </select>
              <div class="text-danger">{{ $errors->has('raw_material_id') ? $errors->first('raw_material_id'):'' }}</div>
            </div>
            </div>
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Color</label>
              <div class="col-md-8">
                <select  name="color_id" class="form-control">
                  @foreach($colors as $color)
                      <option value="{{ $color->id }}">{{ $color->name }}</option>
                  @endforeach
                </select>
                <div class="text-danger">{{ $errors->has('color_id') ? $errors->first('color_id'):'' }}</div>
              </div>
            </div>
            <input type="hidden" name="machine_id" value="1">
          <div class="form-group row">
            <label class="control-label col-md-3">Expected Quantity</label>
            <div class="col-md-8">
              <input type="number" class="form-control" name="expected_quantity" placeholder="expected quantity">
              <div class="text-danger">{{ $errors->has('expected_quantity') ? $errors->first('expected_quantity'):'' }}</div>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3">Standard Weight</label>
            <div class="col-md-8">
              <input type="number" class="form-control" name="standard_weight" placeholder="standard weight">
              <div class="text-danger">{{ $errors->has('standard_weight') ? $errors->first('standard_weight'):'' }}</div>
            </div>
          </div>
          <div class="form-group row add_asterisk">
            <label class="control-label col-md-3">Finish Product Name</label>
            <div class="col-md-8">
              <input name="name" value="{{ old('name') }}" class="form-control" type="text" placeholder="Finish Product Name">
              <div class="text-danger">{{ $errors->has('name') ? $errors->first('name'):'' }}</div>
            </div>
          </div>

          <div class="form-group row">
            <label class="control-label col-md-3">Description</label>
            <div class="col-md-8">
              <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Finish Product Description">{{ old('description') }}</textarea>
              <div class="text-danger">{{ $errors->has('description') ? $errors->first('description'):'' }}</div>
            </div>
          </div>

        </div>



        <div class="tile-footer">
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                  class="fa fa-fw fa-lg fa-check-circle"></i>Add Finish Product</button>
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


@endsection