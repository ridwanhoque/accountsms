@extends('admin.master')
@section('content')
@section('title', 'Haddi Powder Opening')
<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ url('production_settings/opening_haddi_powder_store') }}">
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
                @foreach ($sub_raw_materials as $key => $sub_raw_material)
                @php
                $haddi_powder_stock = $sub_raw_material->haddi_powder_stocks->first();
                if($key%3 == 0) { echo '<div class="clearfix"></div>'; }
                @endphp
                <div class="form-group float-left pr-4">
                  <label class="control-label"> <strong>{{ $sub_raw_material->raw_material->name.' - '.$sub_raw_material->name }}</strong></label>
                  <div style="padding-right: 150px;">
                    <input type="hidden" name="sub_raw_material_ids[]" value="{{ $sub_raw_material->id }}">
                    Haddi
                    <input name="opening_haddi[]" value="{{ $haddi_powder_stock ? $haddi_powder_stock->opening_haddi:'0.00' }}" class="form-control small_input_box" type="text" placeholder="Qty (kg)">
                    <div class="text-danger">
                      {{ $errors->has('opening_haddi.*') ? $errors->first('opening_haddi.*'):'' }}</div>

                    Powder
                    <input name="opening_powder[]" value="{{ $haddi_powder_stock ? $haddi_powder_stock->opening_powder:'0.00' }}" class="form-control small_input_box" type="text" placeholder="Qty (kg)">
                    <div class="text-danger">
                      {{ $errors->has('opening_powder.*') ? $errors->first('opening_powder.*'):'' }}</div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>


          <div class="tile-footer">
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add @yield('title')</button>
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