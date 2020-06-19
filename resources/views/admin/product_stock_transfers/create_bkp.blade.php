@extends('admin.master')
@section('content')

<main class="app-content">
  <form class="form-horizontal" method="POST" action="{{ route('product_stock_transfers.store') }}">
    @csrf

    <div class="app-title">
      <div>
        <h1><i class="fa fa-edit"></i> Product Stock Transfer Information</h1>
        <p>Create Product Stock Transfer Form</p>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Product Stock Transfers</li>
        <li class="breadcrumb-item"><a href="#">Add Product Stock Transfer</a></li>
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

          <a href="{{route('product_stock_transfers.index')}}" class="btn btn-primary pull-right" style="float: right;"><i class="fa fa-eye"></i>View Product Stock Transfer</a>
          <h3 class="tile-title">Add New Product Stock Transfer</h3>

          <div class="tile-body">



            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Transfer From</label>
              <div class="col-md-8">
                <select name="from_branch" class="form-control">
                  @foreach($branches as $id => $name)
                  <option value="{{ $id }}" {{ $id == old('from_branch') ? 'selected':'' }}>{{ $name }}</option>
                  @endforeach
                </select>
                <div class="text-danger">{{ $errors->has('transfer_from') ? $errors->first('transfer_from'):'' }}</div>
              </div>
            </div>

            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Transfer To</label>
              <div class="col-md-8">
                <select name="to_branch" class="form-control">
                  @foreach($branches as $id => $name)
                  <option value="{{ $id }}" {{ $id == old('to_branch') ? 'selected':'' }}>{{ $name }}</option>
                  @endforeach
                </select>
                <div class="text-danger">{{ $errors->has('transfer_to') ? $errors->first('transfer_to'):'' }}</div>
              </div>
            </div>


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Quantity</label>
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" name="available_quantity" id="available_quantity" class="form-control" readonly="readonly" value="" placeholder="current stock">
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control" name="quantity" value="" step="0.01">
                    <div class="text-danger">{{ $errors->has('quantity') ? $errors->first('quantity'):'' }}</div>
                  </div>
                </div>

              </div>
            </div>


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Pack</label>
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" name="available_pack" id="available_pack" class="form-control" readonly="readonly" value="" placeholder="current stock">
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control" name="pack" value="" step="0.01">
                    <div class="text-danger">{{ $errors->has('pack') ? $errors->first('pack'):'' }}</div>
                  </div>
                </div>
              </div>
            </div>


            <div class="form-group row add_asterisk">
              <label class="control-label col-md-3">Weight</label>
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" name="available_weight" id="available_weight" class="form-control" readonly="readonly" value="" placeholder="current stock">
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control" name="weight" value="" step="0.01">
                    <div class="text-danger">{{ $errors->has('weight') ? $errors->first('weight'):'' }}</div>
                  </div>
                </div>
              </div>
            </div>

          </div>



          <div class="tile-footer">
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add Product Stock Transfer</button>
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