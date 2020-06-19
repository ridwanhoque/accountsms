@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('purchase_receives.update', $purchase_receive->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="id" value="{{ $purchase_receive->id }}">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Purchase Receive</h1>
        <p>Update Purchase Receive Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Purchase Receives</li>
        <li class="breadcrumb-item"><a href="#">Edit Purchase Receive</a></li>
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
              class="fa fa-eye"></i>View Purchase Receive</a>
          <h3 class="tile-title">Edit New Purchase Receive</h3>

          <div class="tile-body">


            <div class="form-group row">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-8">
                <input name="purchase_receive_date"
                  value="{{ old('purchase_receive_date') == '' ? date('Y-m-d'):old('purchase_receive_date') }}"
                  class="form-control" type="text" placeholder="Date" readonly="readonly">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Purchase Order</label>
              <div class="col-md-8">
                <input type="text" class="form-control" readonly="readonly" name="purchase_id" value="{{ $purchase_receive->purchase_id }}">
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Supplier</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="party"
                  value="{{ $purchase_receive->purchase->party->name }}" id="party_id" readonly="readonly">
              </div>
            </div>
            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Chalan Number</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="chalan_number"
                  value="{{ $purchase_receive->chalan_number }}">
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
                        <th width="50%" class="text-center"> Raw Material</th>
                        <th width="25%" class="text-center"> Received Qty </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($purchase_receive->purchase_receive_details as $details)
                      <input type="hidden" name="purchase_receive_details_id[]" value="{{ $details->id }}">
                      <input type="hidden" name="raw_material_id[]" value="{{ $details->raw_material_id }}">
                      <tr>
                        <td>{{ $details->raw_material->name }}</td>
                        <td><input type="number" class="form-control" name="quantity[]"
                            value="{{ $details->quantity }}"></td>
                      </tr>
                      @endforeach
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
                      class="fa fa-fw fa-lg fa-check-circle"></i>Edit Purchase Receive</button>
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