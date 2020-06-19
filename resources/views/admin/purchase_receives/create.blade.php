@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('purchase_receives.store') }}">
    @csrf

    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Chalan Receive</h1>
        <p>Create Chalan Receive Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Chalan Receives</li>
        <li class="breadcrumb-item"><a href="#">Add Chalan Receive</a></li>
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

          <a href="{{route('purchase_receives.index')}}" class="btn btn-primary pull-right" style="float: right;"><i
              class="fa fa-eye"></i>View Chalan Receive</a>
          <h3 class="tile-title">Add New Chalan Receive</h3>

          <div class="tile-body">


            <div class="form-group row">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="purchase_receive_date"
                  value="{{ old('purchase_receive_date') == '' ? date('Y-m-d'):old('purchase_receive_date') }}" class="form-control dateField"
                  type="text" placeholder="Date">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Chalan Order</label>
              <div class="col-md-8">
                <select name="purchase_id" id="purchase_id" class="form-control select2">
                  <option value="0">Select Chalan Order</option>
                  @foreach ($purchases as $purchase)
                  <option value="{{ $purchase->id }}">{{ $purchase->id }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Batch</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="batch" value="" id="batch_id" readonly="readonly">
              </div>
            </div>
            
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Supplier</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="party" value="" id="party_id" readonly="readonly">
              </div>
            </div>
            
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Chalan Number</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="chalan_number" name="chalan_number" value="">
              </div>
            </div>
            <div class="mt-2"></div>

           

        <!-- add product -->


        <div class="container">
          <div class="row clearfix">
            <div class="col-md-12">
              <table class="table table-bordered table-hover" id="purchase_receive_table">
                <thead>
                  <tr>
                    <th width="40%" class="text-center"> Raw Material</th>
                    <th width="20%" class="text-center"> Order Qty  ({{ config('app.kg') }})</th>
                    <th width="20%" class="text-center"> Received Qty  ({{ config('app.kg') }})</th>
                    <th width="20%">Received Bags</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- {{ Session::get('purchase_details_party') }}
                  {!! Session::get('purchase_details_tr') !!} --}}
                </tbody>
              </table>
            </div>
          </div>
         
          <div class="clearfix"></div>
        </div>

        <div class="tile-footer">
          <div class="row">
            <div class="col-md-12">
              <button class="btn btn-primary pull-right" type="submit"><i
                  class="fa fa-fw fa-lg fa-check-circle"></i>Add Chalan Receive</button>
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

<script src="{{ asset('assets/admin/js/style.js') }}"></script>

<script type="text/javascript">
  $('.select2').select2();
</script>


<script>

$('#chalan_number').on('keyup', function(){
  $(this).removeClass('is-invalid');
});


  
  $('#purchase_id').on('change', function(){
    var id = $('#purchase_id').val();
    $.ajax({
      url: "{{ url('purchasedetails') }}",
      type: "GET",
      data: 'id='+id,
      success:function(data){
        $('#party_id').val(data[0]);
        $('#purchase_receive_table tbody').html(data[1]);
        $('#batch_id').val(data[2]);
      }
    });
  });

</script>

<script>
  $(document).ready(function(){
    var i=1;
    $("#add_row").click(function(){b=i-1;
      	$('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
      	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      	i++; 
  	});
    $("#delete_row").click(function(){
    	if(i>1){
		$("#addr"+(i-1)).html('');
		i--;
		}
		calc();
	});
	
	$('#tab_logic tbody').on('keyup change',function(){
		calc();
	});
	$('#tax').on('keyup change',function(){
		calc_total();
	});

  $('#invoice_discount').on('keyup change', function(){
    calc_total();
  });
	

});

function calc()
{
	$('#tab_logic tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var qty = $(this).find('.qty').val();
			var price = $(this).find('.price').val();
			$(this).find('.total').val(qty*price);
			
			calc_total();
		}
    });
}

function calc_total()
{
	total=0;
	$('.total').each(function() {
        total += parseInt($(this).val());
    });
	$('#sub_total').val(total.toFixed(2));
	tax_sum=total/100*$('#tax').val();
	$('#invoice_tax').val(tax_sum.toFixed(2));
  var discount = $('#invoice_discount').val();
	$('#total_amount').val(((tax_sum+total)-discount).toFixed(2));
}
</script>

@include('admin.includes.date_field')
@endsection