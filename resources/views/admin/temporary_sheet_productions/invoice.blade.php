@extends('admin.master')

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>Sheet Production Invoice</p>
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
                  <h2 class="page-header"><i class="fa fa-globe"></i> {{ $sheet_production->company->name }} </h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: {{ $sheet_production->sheet_production_date }}</h5><br>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-6">
                  From <address><strong>{{ $sheet_production->batch->name }}</strong><br>
                    Address : {{ $sheet_production->batch->address }}<br>
                    Phone : {{ $sheet_production->batch->phone }}<br>
                    Email: {{ $sheet_production->batch->email }}
                  </address>
                </div>
                <div class="col-6">To
                  <address><strong>{{ $sheet_production->company->name }}</strong><br>
                    Address :  {{ $sheet_production->company->address }}<br>
                    Phone : {{ $sheet_production->company->phone }}<br>
                    Email: {{ $sheet_production->company->email }}
                  </address>  
                </div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sheet Production Reference : {{ $sheet_production->sheet_production_reference }}</th>
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
                      @foreach ($sheet_production->sheet_production_details as $details)
                      <tr>
                        <td>{{ $details->sub_raw_material->name }}</td>
                        <td>{{ $details->unit_price }}</td>
                        <td>{{ $details->quantity }}</td>
                        <td>{{ $details->raw_material_sub_total }}</td>
                      </tr>
                      @endforeach
                      <tr>
                        <td colspan="3" style="text-align:right">Total : </td>
                        <td>{{ $sheet_production->sub_total }}</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right">Discount : </td>
                        <td>{{ $sheet_production->invoice_discount }}</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right">Tax : </td>
                        <td>{{ $sheet_production->invoice_tax }}</td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right">Total Payable : </td>
                        <td>{{ $sheet_production->total_payable }}</td>
                      </tr>
                      <tr>
                        <td colspan="4">&nbsp;</td>
                      </tr>
                      <tr>
                        <td> <b> Batch : {{ $sheet_production->batch->name }} </b><br> <br><br> <hr>Signature and Date</td>
                        <td>&nbsp;</td>
                        <td style="text-align:right"> <b>Issued By : {{ $sheet_production->company->name }} </b> <br> <br> <br> <hr> Signature and Date</td>
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