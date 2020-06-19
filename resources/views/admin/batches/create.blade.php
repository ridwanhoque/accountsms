@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('batches.store') }}">
    @csrf

    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Batch Information</h1>
        <p>Create Batch Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Batchs</li>
        <li class="breadcrumb-item"><a href="#">Add Batch</a></li>
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

          <a href="{{route('batches.index')}}" class="btn btn-primary pull-right" style="float: right;"><i class="fa fa-eye"></i>View Batch</a>
          <h3 class="tile-title">Add New Batch</h3>

          <div class="tile-body">

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Batch prefix</label>
              <div class="col-md-8">
                <div class="row">
                  <!-- <div class="col-md-12"> -->
                    <div class="col-md-6">
                      <input name="batch_prefix" required="required" value="{{ old('batch_prefix') }}" class="form-control" type="text" placeholder="Batch Prefix">
                    </div>
                    <div class="col-md-6">
                      <input type="number" required="required" name="total_batches" class="form-control" placeholder="Total">
                    </div>
                  <!-- </div> -->
                </div>
                <div class="text-danger">{{ $errors->has('name') ? $errors->first('name'):'' }}</div>
              </div>
            </div>


            <div class="form-group row">
              <label class="control-label col-md-3">Description</label>
              <div class="col-md-8">
                <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Batch Description">{{ old('description') }}</textarea>
                <div class="text-danger">{{ $errors->has('description') ? $errors->first('description'):'' }}</div>
              </div>
            </div>



          </div>



          <div class="tile-footer">
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add Batch</button>
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