@extends('admin.master')
@section('content')
<main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-edit"></i> Show Sale Quotation</h1>
            <p>Show Sale Quotation</p>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Sale Quotations</li>
            <li class="breadcrumb-item"><a href="#">Show Sale Quotation</a></li>
          </ul>
        </div>
        <div class="row">
        
          <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Sale Quotations</h3>
            <table class="table table-bordered">
              
              <tbody>
                <tr>
                  <th>Sale Quotation Date</th>
                  <td>{{ $saleQuotation->sale_quotation_date }}</td>
                </tr>
                <tr>
                  <th>Order ID</th>
                  <td>{{ $saleQuotation->id }}</td>
                </tr>
                <tr>
                  <th>Sale Quotation Subtotal</th>
                  <td>{{ $saleQuotation->sub_total }}</td>
                </tr>
                <tr>
                  <th>Sale Quotation Discount</th>
                  <td>{{ $saleQuotation->invoice_discount }}</td>
                </tr>
                <tr>
                  <th>Sale Quotation Tax</th>
                  <td>{{ $saleQuotation->invoice_tax }}</td>
                </tr>
                <tr>
                  <th>Sale Quotation Party</th>
                  <td>{{ $saleQuotation->party->name }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        </div>
</main>
        @endsection