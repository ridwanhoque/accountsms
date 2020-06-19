@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('machines.update', $machine->id) }}"> 
  @csrf
  @method('PUT')
  <input type="hidden" name="id" value="{{ $machine->id }}">

  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Machine Information</h1>
      <p>Update Machine Form</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Machines</li>
      <li class="breadcrumb-item"><a href="#">Edit Machine</a></li>
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

        <a href="{{route('machines.index')}}" class="btn btn-primary pull-right" style="float: right;"><i
            class="fa fa-eye"></i>View Machine</a>
        <h3 class="tile-title">Edit New Machine</h3>

        <div class="tile-body">

          <div class="form-group row add_asterisk">
            <label class="control-label col-md-3">Machine Name</label>
            <div class="col-md-8">
              <input name="name" value="{{ old('name') ?: $machine->name }}" class="form-control" type="text" placeholder="Machine Name">
              <div class="text-danger">{{ $errors->has('name') ? $errors->first('name'):'' }}</div>
            </div>
          </div>
          
          <div class="form-group row add_asterisk">
            <label class="control-label col-md-3">Machine Model</label>
            <div class="col-md-8">
              <input name="model" value="{{ old('model') ?: $machine->model }}" class="form-control" type="text" placeholder="Machine Model">
              <div class="text-danger">{{ $errors->has('model') ? $errors->first('model'):'' }}</div>
            </div>
          </div>

          <div class="form-group row">
            <label class="control-label col-md-3">Push Per Minute</label>
            <div class="col-md-8">
              <input name="push_per_minute" value="{{ old('push_per_minute') ?: $machine->push_per_minute }}" class="form-control" type="text" placeholder="Push Per Minute">
              <div class="text-danger">{{ $errors->has('push_per_minute') ? $errors->first('push_per_minute'):'' }}</div>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="control-label col-md-3">Purchase Date</label>
            <div class="col-md-8">
              <input name="purchase_date" value="{{ old('purchase_date') ?: $machine->purchase_date }}" class="form-control dateField" type="text" placeholder="Purchase Date" value="{{ old('purchase_date') ?: date("Y-m-d") }}">
              <div class="text-danger">{{ $errors->has('purchase_date') ? $errors->first('purchase_date'):'' }}</div>

            </div>
          </div>
          
          <div class="form-group row">
            <label class="control-label col-md-3">Description</label>
            <div class="col-md-8">
              <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Description">{{ old('description') ?: $machine->description }}</textarea>
              <div class="text-danger">{{ $errors->has('description') ? $errors->first('description'):'' }}</div>
            </div>
          </div>



        </div>



        <div class="tile-footer">
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                  class="fa fa-fw fa-lg fa-check-circle"></i>Edit Machine</button>
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

@include('admin.includes.date_field')

@endsection