@extends('admin.master')

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>Chalan Receive Invoice</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
        </ul>
      </div>
      <div class="row print-area">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> {{ $purchase_receive->company->name }} </h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: {{ $purchase_receive->purchase_receive_date }}</h5><br>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-6">
                  From <address><strong>{{ $purchase_receive->purchase->party->name }}</strong><br>
                    Address : {{ $purchase_receive->purchase->party->address }}<br>
                    Phone : {{ $purchase_receive->purchase->party->phone }}<br>
                    Email: {{ $purchase_receive->purchase->party->email }}
                  </address>
                </div>
                <div class="col-6">To
                  <address><strong>{{ $purchase_receive->company->name }}</strong><br>
                    Address :  {{ $purchase_receive->company->address }}<br>
                    Phone : {{ $purchase_receive->company->phone }}<br>
                    Email: {{ $purchase_receive->company->email }}
                  </address>  
                </div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Batch : {{ $purchase_receive->purchase->batch->name ?? '-' }}</th>
                        <th>Chalan Number : #{{ $purchase_receive->chalan_number }}</th>
                        <th colspan="3"></th>
                      </tr>
                      <tr>
                        <th>Raw Material</th>
                        <th>Received Quantity</th>
                        <th>Received Bag</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($purchase_receive->purchase_receive_details as $details)
                      <tr>
                        <td>{{ $details->sub_raw_material->raw_material->name.' - '.$details->sub_raw_material->name }}</td>
                        <td>{{ $details->quantity.' '.config('app.kg') }}</td>
                        <td>{{ $details->quantity_bag }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" ><i class="fa fa-print"></i> Print</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
    @endsection