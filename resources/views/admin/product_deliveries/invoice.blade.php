@extends('admin.master')

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>Product Delivery Invoice</p>
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
                  <h2 class="page-header"><i class="fa fa-globe"></i> {{ $product_delivery->company->name }} </h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: {{ $product_delivery->product_delivery_date }}</h5><br>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-6">
                  From <address><strong>{{ $product_delivery->party->name }}</strong><br>
                    Address : {{ $product_delivery->party->address }}<br>
                    Phone : {{ $product_delivery->party->phone }}<br>
                    Email: {{ $product_delivery->party->email }}
                  </address>
                </div>
                <div class="col-6">To
                  <address><strong>{{ $product_delivery->company->name }}</strong><br>
                    Address :  {{ $product_delivery->company->address }}<br>
                    Phone : {{ $product_delivery->company->phone }}<br>
                    Email: {{ $product_delivery->company->email }}
                  </address>  
                </div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Product Delivery Reference : {{ $product_delivery->product_delivery_reference }}</th>
                        <th colspan="3"></th>
                      </tr>
                      <tr>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($product_delivery->product_delivery_details as $details)
                      <tr>
                        <td>{{ $details->product->name }}</td>
                        <td>{{ $details->unit_price }}</td>
                        <td>{{ $details->quantity }}</td>
                        <td>{{ $details->product_sub_total }}</td>
                      </tr>
                      @endforeach
                      <tr>
                        <td colspan="3" style="text-align:right">Total : </td>
                        <td>{{ $product_delivery->sub_total }}</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right">Tax : </td>
                        <td>{{ $product_delivery->invoice_tax }}</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right">Total Payable : </td>
                        <td>{{ $product_delivery->total_payable }}</td>
                      </tr>
                      <tr>
                        <td colspan="4">&nbsp;</td>
                      </tr>
                      <tr>
                        <td> <b> Supplier : {{ $product_delivery->party->name }} </b><br> <br><br> <hr>Signature and Date</td>
                        <td>&nbsp;</td>
                        <td style="text-align:right"> <b>Issued By : {{ $product_delivery->company->name }} </b> <br> <br> <br> <hr> Signature and Date</td>
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