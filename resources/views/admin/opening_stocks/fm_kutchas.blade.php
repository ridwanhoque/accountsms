@extends('admin.master')
@section('content')
@section('title', 'Fm Kutcha Opening')
<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ url('production_settings/opening_fm_kutcha_store') }}">
    @csrf

    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> @yield('title') Information</h1>
        <p>Create @yield('title') Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">@yield('title')s</li>
        <li class="breadcrumb-item"><a href="#">Add @yield('title')</a></li>
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

          <h3 class="tile-title">@yield('title') Stock</h3>

          <div class="tile-body">

            @if(Session::get('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
            @endif

            <div class="row">
              <div class="col-md-12">
                  @foreach ($fm_kutchas as $key => $fm_kutcha)
                  @php
                      $kutcha_wastage_stock = $fm_kutcha->kutcha_wastage_stock;
                      if($key%4 == 0) { echo '<div class="clearfix"></div>'; }
                  @endphp
                  
                  <div class="form-group float-left">
                    <label class="control-label">{{ $fm_kutcha->raw_material->name.' - '.$fm_kutcha->name }}</label>
                    <div style="padding-right: 50px;">
                      <input type="hidden" name="fm_kutcha_ids[]" value="{{ $fm_kutcha->id }}">
                      <input name="qty_kgs[]" value="{{ $kutcha_wastage_stock ? $kutcha_wastage_stock->opening_kg:'0.00' }}" class="form-control small_input_box" type="text"
                        placeholder="Qty (kg)">
                      <div class="text-danger">
                        {{ $errors->has('qty_kgs.*') ? $errors->first('qty_kgs.*'):'' }}</div>
                    </div>
                  </div>
                  @endforeach      
              </div>
            </div>
 
          </div>



          <div class="tile-footer">
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                    class="fa fa-fw fa-lg fa-check-circle"></i>Add @yield('title')</button>
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