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
            <div class="alert-success" id="response_message"></div>
            <div class="row">
              <div class="col-md-12">

                <table class="table" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Sheet Size</th>
                      <th>Color</th>
                      <th>Qty (kg)</th>
                      <th>Qty (roll)</th>
                    </tr>
                  </thead>

                  <tbody>


                    @foreach ($sheet_sizes as $key => $sheet_size)

                    @foreach($colors as $c_key => $color)
                    @php
                    $sheet_stock = $sheet_size->sheet_stock;
                    $spdetails_stock = new \App\SheetproductiondetailsStock();
                    @endphp
                    <tr>
                      <input type="hidden" name="color_id[]" value="{{ $c_key }}">
                      <input type="hidden" name="sheet_size_ids[]" value="{{ $sheet_size->id }}">
                      <input type="hidden" name="raw_material_ids[]" value="{{ $sheet_size->raw_material_id }}">
                      <td>{{ $sheet_size->raw_material->name.' - '.$sheet_size->name }}</td>
                      <td>{{ $color }}
                      </td>
                      <td><input name="qty_kgs[]" step="0.01" value="{{ $spdetails_stock->openingSheetQty($sheet_size->id, $c_key)['opening_kg'] }}" class="form-control small_input_box" type="number" placeholder="Qty (kg)" onblur="showQty(this.value, {{ $sheet_size->id }}, {{ $c_key }}, {{ $sheet_size->raw_material_id }})"></td>
                      <td><input name="qty_rolls[]" value="{{ $spdetails_stock->openingSheetQty($sheet_size->id, $c_key)['opening_roll'] }}" class="form-control small_input_box" type="number" placeholder="Qty (roll)" onblur="showRoll(this.value, {{ $sheet_size->id }}, {{ $c_key }}, {{ $sheet_size->raw_material_id }})"></td>
                    </tr>
                    @endforeach

                    @endforeach



                  </tbody>
                </table>
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
    <input type="hidden" id="csrf" value="{{ csrf_token() }}">
    <input type="hidden" id="company_id" value="{{ $company_id }}">
    <input type="hidden" id="created_by" value="{{ $created_by }}">
    <input type="hidden" id="updated_by" value="{{ $updated_by }}">
  </form>
</main>

<script src="{{ asset('assets/admin/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/select2.min.js')}}"></script>

<script>
function showQty(kg, sheet_size_id, color_id, raw_material_id, roll = 0){
  var company_id = $('#company_id').val();
  var created_by = $('#created_by').val();
  var updated_by = $('#updated_by').val();
  var csrf_token = $('#csrf').val();
  var dataString = 'qty_kg='+kg+'&qty_roll='+roll+'&sheet_size_id='+sheet_size_id+'&color_id='
      +color_id+'&raw_material_id='+raw_material_id+'&company_id='+company_id
      +'&created_by='+created_by+'&updated_by='+updated_by+'&_token='+csrf_token;

  $.ajax({
    url: '{{ url("api/opening_sheet_save/qty_kgs") }}',
    data: dataString,
    type: 'POST',
    success: function(res){
      console.log(res);
      // $('#response_message').html('Qty updated');
    },
    error: function(res){
      // $('#response_error').html('');
    }
  });
}

function showRoll(roll, sheet_size_id, color_id, raw_material_id){
  showQty('0', sheet_size_id, color_id, raw_material_id, roll);
}
</script>

@endsection