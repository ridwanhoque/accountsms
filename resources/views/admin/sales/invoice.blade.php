@extends('admin.master')

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>Order Receive Invoice</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> {{ $sale->company->name }} </h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: {{ $sale->sale_date }}</h5><br>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-6">
                  From <address><strong>{{ $sale->party->name }}</strong><br>
                    Address : {{ $sale->party->address }}<br>
                    Phone : {{ $sale->party->phone }}<br>
                    Email: {{ $sale->party->email }}
                  </address>
                </div>
                <div class="col-6">To
                  <address><strong>{{ $sale->company->name }}</strong><br>
                    Address :  {{ $sale->company->address }}<br>
                    Phone : {{ $sale->company->phone }}<br>
                    Email: {{ $sale->company->email }}
                  </address>  
                </div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">

                  
                  <table class="table no-spacing">
                    <thead>
                      <tr>
                        <th>Order Receive Reference : {{ $sale->sale_reference }}</th>
                        <th>Delivery Date (expected) : {{ $sale->sale_delivery_date }}</th>
                        <th colspan="2"></th>
                      </tr>
                      <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sale->sale_details as $details)
                      <tr>
                        <td>{{ $details->product->name }}</td>
                        <td>{{ $details->quantity }}</td>
                      </tr>
                      @endforeach

                      <tr>
                        <td>Tax : </td>
                        <td>{{ $sale->invoice_tax }}</td>
                      </tr>
                      {{-- <tr>
                        <td>Vat : </td>
                        <td>{{ $sale->invoice_vat }}</td>
                      </tr> --}}
                      <tr>
                        <td> <b> Supplier : {{ $sale->party->name }} </b><br> <br><br> <hr>Signature and Date</td>
                        <td style="text-align:right" colspan="5"> <b>Issued By : {{ $sale->company->name }} </b> <br> <br> <br> <hr> Signature and Date</td>
                      </tr>
                      <tr></tr>
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