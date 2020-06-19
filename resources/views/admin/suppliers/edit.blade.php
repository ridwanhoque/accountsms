@extends('admin.master')
@section('content')

<main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-edit"></i> People</h1>
            <p>Update Supplier Form</p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Suppliers</li>
            <li class="breadcrumb-item"><a href="#">Edit Supplier</a></li>
          </ul>
        </div>
        <div class="row">
                <div class="col-md-12">
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
                          <a href="{{route('suppliers.index')}}" class="btn btn-primary pull-right" style="float: right;"><i class="fa fa-eye"></i>View Supplier</a>
                          <h3 class="tile-title">Edit New Supplier</h3>
                          <div class="tile-body">
                            <form class="form-horizontal" method="POST" action="{{ route('suppliers.update', $supplier->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $supplier->id }}">
                                
                              <div class="form-group row add_asterisk">
                                    <label class="control-label col-md-3">Name</label>
                                    <div class="col-md-8">
                                    <input name="name" value="{{ old('name') ?: $supplier->name }}" class="form-control" type="text" placeholder="Name">
                                    <div class="text-danger">
                                        {{ $errors->has('name') ? $errors->first('name'):'' }}
                                    </div>
                                    </div>
                              </div>


                              <div class="form-group row add_asterisk">
                                    <label class="control-label col-md-3">Email</label>
                                    <div class="col-md-8">
                                    <input name="email" value="{{ old('email') ?: $supplier->email }}" class="form-control" type="email" placeholder="Email">
                                    <div class="text-danger">
                                        {{ $errors->has('email') ? $errors->first('email'):'' }}
                                    </div>
                                    </div>
                              </div>

                              <div class="form-group row add_asterisk">
                                    <label class="control-label col-md-3">Phone</label>
                                    <div class="col-md-8">
                                    <input name="phone" value="{{ old('phone') ?: $supplier->phone }}" class="form-control" type="number" placeholder="Phone">
                                    <div class="text-danger">
                                        {{ $errors->has('phone') ? $errors->first('phone'):'' }}
                                    </div>
                                    </div>
                              </div>

                              <div class="form-group row">
                                    <label class="control-label col-md-3">Address</label>
                                    <div class="col-md-8">
                                    <textarea name="address" class="form-control" rows="5" type="text" placeholder="Editress">{{ old('address') ?: $supplier->address }}</textarea>
                                    <div class="text-danger">
                                        {{ $errors->has('address') ? $errors->first('address'):'' }}
                                    </div>
                                    </div>
                              </div>

                              <div class="tile-footer">
                                <div class="row">
                                  <div class="col-md-12">
                                    <button class="btn btn-primary pull-right" type="submit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Edit Supplier</button>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
        </div>
</main>

  <script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
    <script  src="{{ asset('assets/admin/js/plugins/select2.min.js')}}"></script>


<script type="text/javascript">
  $('.select2').select2();
</script>
        @endsection