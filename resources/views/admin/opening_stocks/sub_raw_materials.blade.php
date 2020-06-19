@extends('admin.master')
@section('content')
@section('title', 'Raw Material Opening')
<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ url('production_settings/opening_sub_raw_material_store') }}">
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
                $raw_material_stock = $sub_raw_material->raw_material_stocks->first();
                if($key%3 == 0) { echo '<div class="clearfix"></div>'; }
                @endphp
                <div class="form-group float-left">
                  <label class="control-label"><strong>{{ $sub_raw_material->raw_material->name.' - '.$sub_raw_material->name }}</strong></label>
                  <div style="padding-right: 20px;">
                    <input type="hidden" name="sub_raw_material_ids[]" value="{{ $sub_raw_material->id }}">
                    Qty (kg)
                    <input name="qty_kgs[]" onkeyup="show_total(this)" value="{{ $raw_material_stock ? $raw_material_stock->opening_quantity:'0.00' }}" class="form-control small_input_box qty" type="number" placeholder="Qty (kg)" step="0.01">
                    <div class="text-danger">
                      {{ $errors->has('qty_kgs.*') ? $errors->first('qty_kgs.*'):'' }}</div>
                    Unit Price (per kg)
                    @php
                    $opening_price_total = $raw_material_stock->opening_price_total ?? 0;
                    $opening_quantity_db = $raw_material_stock->opening_quantity ?? 0;
                    @endphp
                    <input name="price[]" onkeyup="show_total(this)" value="{{ $raw_material_stock ? $raw_material_stock->opening_price:'0.00' }}" class="form-control small_input_box price" type="number" placeholder="Unit Price" step="0.01">
                    <div class="text-danger">
                      {{ $errors->has('qty_kgs.*') ? $errors->first('qty_kgs.*'):'' }}</div>

                    Total Price
                    <input name="opening_price_total[]" type="number" value="{{ $opening_price_total }}" class="form-control small_input_box total" placeholder="Total Price" readonly="readonly">
                    <div class="text-danger">
                      {{ $errors->has('opening_price_total.*') ? $errors->first('opening_price_total.*'):'' }}</div>

                    Qty (bags)
                    <input name="bags[]" value="{{ $raw_material_stock ? $raw_material_stock->opening_bags:'0.00' }}" class="form-control small_input_box" type="text" placeholder="Qty (bags)" step="0.01">
                    <div class="text-danger">
                      {{ $errors->has('bags.*') ? $errors->first('bags.*'):'' }}</div>

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

<script>
  
    function show_total(element) {
      var qty = $(element).parent().find('.qty').val();
      qty = qty > 0 ? qty : 0;
      var price = $(element).parent().find('.price').val();
      price = price > 0 ? price : 0;
      var total = parseFloat(qty) * parseFloat(price);
      $(element).parent().find('.total').val(total.toFixed(2));
    }


</script>

@endsection