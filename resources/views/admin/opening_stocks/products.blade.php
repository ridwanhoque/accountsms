@extends('admin.master')
@section('content')
@section('title', 'Product Opening')
<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ url('production_settings/opening_product_store') }}">
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
                @foreach ($products as $key => $product)
                @php
                $product_stock = $product->product_stock;
                if($key%3 == 0) { echo '<div class="clearfix"></div>'; }
                @endphp
                <div class="form-group float-left pr-4">
                  <label class="control-label"><strong>{{ $product->raw_material->name.' - '.$product->name }}</strong></label>
                  <div style="padding-right: 150px;">
                    <input type="hidden" name="product_ids[]" value="{{ $product->id }}">

                    Qty (pcs)
                    <input name="quantity[]" onkeyup="show_total(this)" value="{{ $product_stock ? $product_stock->opening_quantity:'0.00' }}" class="form-control small_input_box qty" type="text" placeholder="Qty (piece)">
                    <div class="text-danger">
                      {{ $errors->has('quantity.*') ? $errors->first('quantity.*'):'' }}</div>

                    Price (per piece)
                    <input name="price[]" onkeyup="show_total(this)" value="{{ $product_stock ? $product_stock->opening_price:'0.00' }}" class="form-control small_input_box price" type="text" placeholder="Price (per piece)">
                    <div class="text-danger">
                      {{ $errors->has('price.*') ? $errors->first('price.*'):'' }}</div>

                    Total
                    <input name="opening_price_total[]" value="{{ $product_stock ? $product_stock->opening_price_total:'0.00' }}" class="form-control small_input_box total" type="text" placeholder="Total" readonly="readonly">
                    <div class="text-danger">
                      {{ $errors->has('opening_price_total.*') ? $errors->first('opening_price_total.*'):'' }}</div>

                    Qty (pack)
                    <input type="number" name="pack[]" class="form-control small_input_box" value="{{ $product_stock ? $product_stock->opening_pack:'0.00' }}">
                    <div class="text-danger">
                      {{ $errors->has('pack.*') ? $errors->first('pack.*'):'' }}
                    </div>

                    Qty (weight)
                    <input type="number" step="0.01" name="weight[]" class="form-control small_input_box" value="{{ $product_stock ? $product_stock->opening_weight:'0.00' }}">
                    <div class="text-danger">
                      {{ $errors->has('weight.*') ? $errors->first('weight.*'):'' }}
                    </div>
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