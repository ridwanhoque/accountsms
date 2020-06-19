@extends('admin.master')
@section('content')

<main class="app-content">
    {{-- <form class="form-horizontal" method="POST" action="{{ route('issue_materials.store') }}"> --}}
        @csrf
     
        <div class="app-title">
          <div>
            <h1><i class="fa fa-edit"></i> Store</h1>
            <p>Create Issue Material Form</p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Issue Materials</li>
            <li class="breadcrumb-item"><a href="#">Add Issue Material</a></li>
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
                          
                          <a href="{{route('issue_materials.index')}}" class="btn btn-primary pull-right" style="float: right;"><i class="fa fa-eye"></i>View Issue Material</a>
                          <h3 class="tile-title">Add New Issue Material</h3>
                          
                            <div class="tile-body">
                               

                           
                            <div class="form-group row add_asterisk">
                                  <label class="control-label col-md-3">Date</label>
                                  <div class="col-md-8">
                                  <input name="purchase_date" value="{{ old('purchase_date') == '' ? date('Y-m-d'):old('purchase_date') }}" class="form-control" type="text" placeholder="Date" readonly="readonly">
                                  </div>
                            </div>

                            <div class="form-group row">
									<label class="control-label col-md-3">Reference (ID on paper)</label>
									<div class="col-md-8">
										<input type="text" class="form-control" readonly="readonly" value="issue-1">
									</div>                            	
                            </div>

                            <div class="form-group row add_asterisk">
                                  <label class="control-label col-md-3">Store Officer</label>
                                  <div class="col-md-8">
                                  <select name="fk_supplier_id" class="form-control select2" >
                                    	<option value="">Store Officer 1</option>
                                    	<option value="">Store Officer 2</option>
                                    	<option value="">Store Officer 3</option>
                                    	<option value="">Store Officer 4</option>
                                    	<option value="">Store Officer 5</option>
                                  </select>
                                  </div>
                            </div>

                            <div class="form-group row">
                              <label for="" class="control-label col-md-3">Slip No.</label>
                                <div class="col-md-8">
                                	<input type="text" class="form-control" value="">
                                </div>
                            </div> 


                    <!-- add product -->

                    <div class="row">
                          <div class="col-md-12">

                            <table class="table table-bordered table-hover" id="product_table">
                              <thead>
                              <tr>
                                  <th width="28%">Product Name</th>
                                  <th>Purpose</th>
                                  <th colspan="2">Issue Quantity</th>
                                  <th>Stock</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td>
                                    <select name="product_ids[]" id="product_name_1" class="dynamic_product form-control select2" onchange="show_product_price(this.value, 1)">
                                      <option value="0">select</option>
                                      
                                    </select>
                                  </td>
                                  <td><input type="text" name="unit_prices[]" min="1" value="" id="product_price_1" class="dynamic_product_price form-control" onblur=""></td>
                                  <td><input type="number" min="1" step="1" id="quantity_1" name="quantities[]" id="quantities" class="form-control changesNo  qty_unit" autocomplete="off" placeholder="Qty" onkeyup="get_sub_total(this.value, 1)"></td>
                                  <td>
                                      <div id="product_unit_1"></div>
                                  </td>
                                  <td><input type="number" name="product_sub_total[]" id="sub_total_1" readonly="readonly" min="0" id="txtResult"  class="form-control totalLinePrice" autocomplete="off" placeholder="Stock">
                                  </td>
                                  <td></td>
                              </tr>
                              </tbody>
                            </table>
                            <div class="full-right">
                              <th> <button class="btn btn-success addRow pull-right" type="button">+</button></th>
                            </div>
                            

                          </div>
                    </div>

                    <div class="mt-4"></div>

                            <!-- add product -->

                        
   

                            <div class="tile-footer">
                              <div class="row">
                                <div class="col-md-12">
                                  <button class="btn btn-primary pull-right" type="submit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add Issue Material</button>
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
    <script  src="{{ asset('assets/admin/js/plugins/select2.min.js')}}"></script>

    
    <script type="text/javascript">
      $('.select2').select2();
    </script>
    
<script>


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
            '<td><div id=\"product_unit_'+i+'\"></div></td>'+
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