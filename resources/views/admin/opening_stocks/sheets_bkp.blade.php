@extends('admin.master')
@section('content')
@section('title', 'Sheet Opening')
<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ url('production_settings/opening_sheet_store') }}">
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
                @foreach ($sheet_sizes as $key => $sheet_size)

                @foreach($colors as $c_key => $color)
                    @php
                    $sheet_stock = $sheet_size->sheet_stock;
                    if($c_key%4 == 0) { echo '<div class="clearfix"></div>'; }
                    @endphp

                    <div class="form-group float-left">
                      <label class="control-label">{{ $sheet_size->raw_material->name.' - '.$sheet_size->name }}</label>
                      <div style="padding-right: 50px;">
                        
                      <input type="hidden" name="color_id[]" value="{{ $c_key }}">
                      <select disabled="disabled" class="form-control small_input_box">
                        <option>{{ $color }}</option>
                      </select>
                        <input type="hidden" name="sheet_size_ids[]" value="{{ $sheet_size->id }}">
                        <input name="qty_kgs[]" value="{{ $sheet_stock ? $sheet_stock->opening_kg:'0.00' }}" class="form-control small_input_box" type="text" placeholder="Qty (kg)">
                        <div class="text-danger">
                          {{ $errors->has('qty_kgs.*') ? $errors->first('qty_kgs.*'):'' }}
                        </div>
                        <input name="qty_rolls[]" value="{{ $sheet_stock ? $sheet_stock->opening_roll:'0.00' }}" class="form-control small_input_box" type="text" placeholder="Qty (kg)">
                        <div class="text-danger">
                          {{ $errors->has('qty_rolls.*') ? $errors->first('qty_rolls.*'):'' }}
                        </div>
                      </div>
                      <br>
                    </div>

                  </div>

              @endforeach

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
