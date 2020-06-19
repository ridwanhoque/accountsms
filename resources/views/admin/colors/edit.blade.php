@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('colors.update', $color->id) }}"> 
  @csrf
  @method('PUT')
  <input type="hidden" name="id" value="{{ $color->id }}">

  <div class="app-title">
    <div>
      <h1><i class="fa fa-edit"></i> Color Information</h1>
      <p>Update Color Form</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Colors</li>
      <li class="breadcrumb-item"><a href="#">Edit Color</a></li>
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

        <a href="{{route('colors.index')}}" class="btn btn-primary pull-right" style="float: right;"><i
            class="fa fa-eye"></i>View Color</a>
        <h3 class="tile-title">Edit New Color</h3>

        <div class="tile-body">



          <div class="form-group row add_asterisk">
            <label class="control-label col-md-3">Color Name</label>
            <div class="col-md-8">
              <input name="name" value="{{ old('name') ?: $color->name }}" class="form-control" type="text" placeholder="Color Name">
              <div class="text-danger">{{ $errors->has('name') ? $errors->first('name'):'' }}</div>
            </div>
          </div>

          <div class="form-group row">
            <label class="control-label col-md-3">Description</label>
            <div class="col-md-8">
              <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Color Description">{{ old('description') ?: $color->description }}</textarea>
              <div class="text-danger">{{ $errors->has('description') ? $errors->first('description'):'' }}</div>
            </div>
          </div>



        </div>



        <div class="tile-footer">
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary pull-right" type="submit" type="submit"><i
                  class="fa fa-fw fa-lg fa-check-circle"></i>Edit Color</button>
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
  $('.addRow').on('click', function(){
    
    addRow('color_table');

  });

var i = 1;
  function addRow(tableId){
    i++;
    var table = document.getElementById(tableId);
    var tr = '<tr>' +
            '<td><select name=\"color_ids[]\" id=\"color_name_'+i+'\" class=\"dynamic_color form-control select2\" onchange=\"show_color_price(this.value, '+i+')\"><option>select</option></select>' +
            '</td>'+
            '<td><input type=\"number\" min=\"1\" name=\"unit_prices[]\" id=\"color_price_'+i+'\" placeholder=\"\" class=\"dynamic_color_price form-control\"></td>'+
            '<td><input type=\"number\" placeholder=\"Qty\" min=\"1\" name=\"quantities[]\" id=\"quantity_'+i+'\" onkeyup=\"get_sub_total(this.value,'+i+')\" class=\"form-control qty_unit\"></td>'+
            '<td><input type=\"number\" readonly=\"readonly\" placeholder=\"Sub Total\" name=\"color_sub_total[]\" id=\"sub_total_'+i+'\" class=\"form-control\" ></td>'+
            '<td><button class=\"remove btn-danger\"><span class=\"fa fa-trash-o\"></span></button></td>'+
            '</tr>';

            $('#color_table tbody').append(tr);



  $.ajax({
      url: "{{ url('colors/get_json_list') }}",
      type: "GET",
      success:function(res){
        if(res){
          $.each(res, function(id, color_name){
            $("#color_name_"+i).append('<option value="'+id+'">'+color_name+'</option>');
          });
        }
      }
    });



  }

  $('tbody').on('click','.remove',function(){
        $(this).parent().parent().remove();
  });



  function show_color_price(color_id, n){
    var color_id = color_id;
    $.ajax({
      url: "{{ url('colors/get_color_by_id') }}?id="+color_id,
      type: "GET",
      success:function(res){
        if(res){
          $.each(res, function(key, value){
            $('#color_price_'+n).val(value['color_price']);
              $('#color_unit_'+n).html(value['color_unit']['name']);
          });
        }
      }
    });
  }

  function get_sub_total(qty, n){
    $("#color_price_"+n).prop('readonly', true);
    var qty = parseInt(qty);
    var color_price = parseFloat($('#color_price_'+n).val());
      $("#sub_total_"+n).val(qty*color_price);
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