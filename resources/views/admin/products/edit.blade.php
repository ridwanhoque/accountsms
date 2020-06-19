@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('products.update', $product->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $product->id }}">

    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Finish Product Information</h1>
        <p>Update Finish Product Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Finish Products</li>
        <li class="breadcrumb-item"><a href="#">Edit Finish Product</a></li>
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
          <h3 class="tile-title">Edit New Finish Product</h3>

          <div class="tile-body">

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Raw Material Name</label>
              <div class="col-md-8">
                <select name="raw_material_id" class="form-control">
                  @foreach($raw_materials as $raw_material)
                    {{-- @foreach ($raw_materials->sub_raw_materials as $sub_raw_material) --}}
                      <option value="{{ $raw_material->id }}"
                          {{ $raw_material->id == $product->raw_material_id ? 'selected':'' }}>{{ $raw_material->name }}
                      </option>                      
                    {{-- @endforeach --}}
                  @endforeach
                </select>
                <div class="text-danger">{{ $errors->has('raw_material_id') ? $errors->first('raw_material_id'):'' }}
                </div>
              </div>
            </div>


          <div class="form-group row add_asterisk">
            <label class="control-label col-md-3">Color</label>
            <div class="col-md-8">
              <select  name="color_id" class="form-control">
                @foreach($colors as $color)
                    @php
                    $this_color_id = old('color_id') ?: $product->color_id;
                    @endphp
                    <option value="{{ $color->id }}" {{ $color->id == $this_color_id ? 'selected':'' }}>{{ $color->name }}</option>
                @endforeach
              </select>
              <div class="text-danger">{{ $errors->has('color_id') ? $errors->first('color_id'):'' }}</div>
            </div>
          </div>

          <input type="hidden" name="machine_id" value="{{ $product->machine_id }}">           
            <div class="form-group row">
              <label class="control-label col-md-3">Expected Quantity</label>
              <div class="col-md-8">
                <input type="number" class="form-control" name="expected_quantity" value="{{ $product->expected_quantity }}">
                <div class="text-danger">
                  {{ $errors->has('expected_quantity') ? $errors->first('expected_quantity'):'' }}</div>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Standard Weight</label>
              <div class="col-md-8">
                <input type="number" class="form-control" name="standard_weight" value="{{ $product->standard_weight }}">
                <div class="text-danger">{{ $errors->has('standard_weight') ? $errors->first('standard_weight'):'' }}
                </div>
              </div>
            </div>
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Finish Product Name</label>
              <div class="col-md-8">
                <input name="name" value="{{ old('name') ?: $product->name }}" class="form-control" type="text"
                  placeholder="Finish Product Name">
                <div class="text-danger">{{ $errors->has('name') ? $errors->first('name'):'' }}</div>
              </div>
            </div>
       

            <div class="form-group row">
              <label class="control-label col-md-3">Description</label>
              <div class="col-md-8">
                <textarea name="description" id="" cols="30" rows="10" class="form-control"
                  placeholder="Finish Product Description">{{ old('description') ?: $product->description }}</textarea>
                <div class="text-danger">{{ $errors->has('description') ? $errors->first('description'):'' }}</div>
              </div>
            </div>



       <h4>Opeing Quantity Add</h4>
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Qty (pcs)</label>
              <div class="col-md-8">
                    <input name="quantity" onkeyup="show_total(this)" value="{{ $product->product_stock ? $product->product_stock->opening_quantity:'0.00' }}" class="form-control small_input_box qty" type="text" placeholder="Qty (piece)">
                    <div class="text-danger">
                      {{ $errors->has('quantity.*') ? $errors->first('quantity.*'):'' }}</div>
              </div>
            </div>
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Price (per piece)</label>
              <div class="col-md-8">
                <input name="price" onkeyup="show_total(this)" value="{{ $product->product_stock ? $product->product_stock->opening_price:'0.00' }}" class="form-control small_input_box price" type="text" placeholder="Price (per piece)">
                    <div class="text-danger">
                      {{ $errors->has('price.*') ? $errors->first('price.*'):'' }}</div>
              </div>
            </div>
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Total</label>
              <div class="col-md-8">
              <input name="opening_price_total" value="{{ $product->product_stock ? $product->product_stock->opening_price_total:'0.00' }}" class="form-control small_input_box total" type="text" placeholder="Total" readonly="readonly">
                    <div class="text-danger">
                      {{ $errors->has('opening_price_total.*') ? $errors->first('opening_price_total.*'):'' }}</div>
              </div>
            </div>
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Qty (pack)</label>
              <div class="col-md-8">
                     <input type="number" name="pack" class="form-control small_input_box" value="{{ $product->product_stock ? $product->product_stock->opening_pack:'0.00' }}">
                    <div class="text-danger">
                      {{ $errors->has('pack.*') ? $errors->first('pack.*'):'' }}
                    </div>
              </div>
            </div>
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Qty (weight)</label>
              <div class="col-md-8">
                     
                   <input type="number" step="0.01" name="weight" class="form-control small_input_box" value="{{ $product->product_stock ? $product->product_stock->opening_weight:'0.00' }}">
                    <div class="text-danger">
                      {{ $errors->has('weight.*') ? $errors->first('weight.*'):'' }}
                    </div>
              </div>
            </div>



          </div>



          <div class="tile-footer">
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                    class="fa fa-fw fa-lg fa-check-circle"></i>Edit Finish Product</button>
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


<script type="text/javascript">
  $('.select2').select2();
</script>

<script>

  function show_total(element) {
    var qty = $('.qty').val();
    qty = qty > 0 ? qty : 0;
    var price = $('.price').val();
    price = price > 0 ? price : 0;
    var total = parseFloat(qty) * parseFloat(price);
    $('.total').val(total.toFixed(2));
  }


  $('.addRow').on('click', function(){
    
    addRow('product_table');

  });

var i = 1;
  function addRow(tableId){
    i++;
    var table = document.getElementById(tableId);
    var tr = '<tr>' +
            '<td><select name=\"product_ids[]\" id=\"product_name_'+i+'\" class=\"dynamic_product form-control select2\" onchange=\"show_product_price(this.value, '+i+')\"><option>select</option></select>' +
            '</td>'+
            '<td><input type=\"number\" min=\"1\" name=\"unit_prices[]\" id=\"product_price_'+i+'\" placeholder=\"\" class=\"dynamic_product_price form-control\"></td>'+
            '<td><input type=\"number\" placeholder=\"Qty\" min=\"1\" name=\"quantities[]\" id=\"quantity_'+i+'\" onkeyup=\"get_sub_total(this.value,'+i+')\" class=\"form-control qty_unit\"></td>'+
            '<td><input type=\"number\" readonly=\"readonly\" placeholder=\"Sub Total\" name=\"product_sub_total[]\" id=\"sub_total_'+i+'\" class=\"form-control\" ></td>'+
            '<td><button class=\"remove btn-danger\"><span class=\"fa fa-trash-o\"></span></button></td>'+
            '</tr>';

            $('#product_table tbody').append(tr);



  $.ajax({
      url: "{{ url('products/get_json_list') }}",
      type: "GET",
      success:function(res){
        if(res){
          $.each(res, function(id, product_name){
            $("#product_name_"+i).append('<option value="'+id+'">'+product_name+'</option>');
          });
        }
      }
    });



  }

  $('tbody').on('click','.remove',function(){
        $(this).parent().parent().remove();
  });



  function show_product_price(product_id, n){
    var product_id = product_id;
    $.ajax({
      url: "{{ url('products/get_product_by_id') }}?id="+product_id,
      type: "GET",
      success:function(res){
        if(res){
          $.each(res, function(key, value){
            $('#product_price_'+n).val(value['product_price']);
              $('#product_unit_'+n).html(value['product_unit']['name']);
          });
        }
      }
    });
  }

  function get_sub_total(qty, n){
    $("#product_price_"+n).prop('readonly', true);
    var qty = parseInt(qty);
    var product_price = parseFloat($('#product_price_'+n).val());
      $("#sub_total_"+n).val(qty*product_price);
      var inv_sub_total = 0;
      for(var i = 1; i<=n; i++){
        inv_sub_total += parseFloat($('#sub_total_'+i).val());
        
      }
      $("#invoice_sub_total").val(inv_sub_total);
      $("#total_payable").val(inv_sub_total);
      $('#total_due').val(inv_sub_total);
  }

  function deduct_discount(discount_amount){
    var tax_amount = $('#invoice_tax').val();
    var discount_amount = discount_amount <= 0 ? 0:parseFloat(discount_amount);
    var invoice_sub_total = $('#invoice_sub_total').val();
    var discount_deducted = (invoice_sub_total-discount_amount)+parseFloat(tax_amount);
    $('#total_payable').val(discount_deducted);
    $('#total_due').val(discount_deducted);
  }

  function add_tax(tax_amount){
    $('#invoice_discount').prop('readonly', true);
    var discount_amount = $('#invoice_discount').val();
    var tax_amount = tax_amount <= 0 ? 0:tax_amount;
    var invoice_sub_total = $('#invoice_sub_total').val();
    var tax_added = (parseFloat(invoice_sub_total)+parseFloat(tax_amount))-parseFloat(discount_amount);
    $('#total_payable').val(tax_added);
    $('#total_due').val(tax_added);
  }

  function get_due_amount(paid_amount){
    $('#invoice_discount').prop('readonly', true);
    $('#invoice_tax').prop('readonly', true);
    var payable_amount = $('#total_payable').val();
    var paid_amount = parseFloat(paid_amount);
    if(parseFloat(payable_amount) > 0 && paid_amount <= payable_amount){
      due_amount = payable_amount-paid_amount;
      $('#total_due').val(due_amount);
    }else{
      $('#total_paid').val(payable_amount);
      $('#total_due').val(0);
      alert('Paid amount must be less or equal to payable amount');
    }
  }


  function totalAmount() {
            var total = 0;
            $('.service-prices').each(function (i, price) {
                var p = $(price).val();
                total += p ? parseFloat(p) : 0;
            });
            var subtotal = $('#subTotal').val(total);
            discountAmount();
        }


$(document).ready(function(){

  
  $('form').on('focus', 'input[type=number]', function(e){
  $(this).on('mousewheel.disableScroll', function(e){
    e.preventDefault()
  })
});
 
    // Restore scroll on number inputs.
    $('form').on('blur', 'input[type=number]', function(e) {
        $(this).off('wheel');
    });
 
    // Disable up and down keys.
    $('form').on('keydown', 'input[type=number]', function(e) {
        if ( e.which == 38 || e.which == 40 )
            e.preventDefault();
    });  

});
    
</script>


@include('admin.includes.date_field')
@endsection