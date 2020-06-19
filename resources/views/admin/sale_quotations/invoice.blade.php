@extends('admin.master')

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>Purchase Invoice</p>
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
                  <h2 class="page-header"><i class="fa fa-globe"></i> {{ $saleQuotation->company->name }} </h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: {{ $saleQuotation->sale_quotation_date }}</h5><br>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-6">
                  From  <address><strong>{{ $saleQuotation->company->name }}</strong><br>
                    Address :  {{ $saleQuotation->company->address }}<br>
                    Phone : {{ $saleQuotation->company->phone }}<br>
                    Email: {{ $saleQuotation->company->email }}
                  </address> 
                </div>
                <div class="col-6">To
                  <address><strong>{{ $saleQuotation->party->name }}</strong><br>
                    Address : {{ $saleQuotation->party->address }}<br>
                    Phone : {{ $saleQuotation->party->phone }}<br>
                    Email: {{ $saleQuotation->party->email }}
                  </address>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <table class="table no-spacing">
                    <thead>
                      <tr>
                        <th>Order ID : {{ $saleQuotation->id }}</th>
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
                      @foreach ($saleQuotation->sale_quotation_details as $details)
                      <tr>
                        <td>{{ $details->product->name }}</td>
                        <td>{{ $details->unit_price }} {{ config('app.tk') }}</td>
                        <td>{{ $details->quantity }} {{ config('app.kg') }}</td>
                        <td>{{ $details->product_sub_total }} {{ config('app.tk') }}</td>
                      </tr>
                      @endforeach
                      <tr>
                        <td colspan="3" style="text-align:right">Total : </td>
                        <td><strong>{{ $saleQuotation->sub_total }} {{ config('app.tk') }}</strong></td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right">Discount : </td>
                        <td>{{ $saleQuotation->invoice_discount }} {{ config('app.tk') }}</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right">Vat : </td>
                        <td>{{ $saleQuotation->invoice_vat }} {{ config('app.tk') }}</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right">Tax : </td>
                        <td>{{ $saleQuotation->invoice_tax }} {{ config('app.tk') }}</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right">Total Payable : </td>
                        <td><strong>{{ $saleQuotation->total_payable }} {{ config('app.tk') }}</strong></td>
                      </tr>
                      <tr>
                        <td colspan="4">&nbsp;</td>
                      </tr>
                      <tr>
                        <td> <b> Customer : {{ $saleQuotation->party->name }} </b><br> <br><br> <hr>Signature and Date</td>
                        <td>&nbsp;</td>
                        <td style="text-align:right"> <b>Issued By : {{ $saleQuotation->company->name }} </b> <br> <br> <br> <hr> Signature and Date</td>
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