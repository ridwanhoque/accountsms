@extends('admin.master')

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>Payment Voucher Invoice</p>
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
                  <h2 class="page-header"><i class="fa fa-globe"></i> {{ $payment_voucher->company->name }} </h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: {{ $payment_voucher->payment_date }}</h5><br>
                </div>
              </div>
              {{-- <div class="row invoice-info">
                <div class="col-6">
                  From <address><strong>{{ $payment_voucher->chart_of_account->head_name ?? '' }}</strong><br>
                    Address : {{ $payment_voucher->chart_of_account->address }}<br>
                    Phone : {{ $payment_voucher->chart_of_account->phone }}<br>
                    Email: {{ $payment_voucher->chart_of_account->email }}
                  </address>
                </div>
                <div class="col-6">To
                  <address><strong>{{ $payment_voucher->company->name }}</strong><br>
                    Address :  {{ $payment_voucher->company->address }}<br>
                    Phone : {{ $payment_voucher->company->phone }}<br>
                    Email: {{ $payment_voucher->company->email }}
                  </address>  
                </div>
              </div> --}}
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table no-spacing">
                    <thead>
                      <tr>
                        <th colspan="4">Order ID : {{ $payment_voucher->id }}</th>
                      </tr>
                      <tr>
                        <th>Chart Of Account</th>
                        <th>Description</th>
                        <th class="text-right">Debit</th>
                        <th class="text-right">Credit</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($payment_voucher->payment_voucher_details as $details)
                      <tr>
                        <td>{{ $details->chart_of_account->head_name ?? '' }}</td>
                        <td>{{ $details->description }}</td>
                        <td class="text-right">
                          {{ $details->chart_of_account->owner_type_id == config('app.owner_party') ? $details->amount:0 }}
                        </td>
                        <td class="text-right">
                          {{ in_array($details->chart_of_account->owner_type_id, config('app.cash_bank_ids')) ? $details->amount:0 }}
                        </td>
                      </tr>
                      @endforeach
                      <tr>
                        <td colspan="4"></td>
                      </tr>
                      <tr>
                        <td colspan="3" style="text-align:right"><strong>{{ $payment_voucher->amount }}</strong></td>
                        <td style="text-align:right"><strong>{{ $payment_voucher->amount }}</strong></td>
                      </tr>
                      <tr>
                        <td colspan="4">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="4">Total : <strong>{{ Formatter::toWords($payment_voucher->amount) }} {{ config('app.tk') }}</strong></td>
                      </tr>
                      <tr>
                        <td> <b> {{ $payment_voucher->chart_of_account->head_name ?? '' }} </b><br> <br><br> <hr>Signature and Date</td>
                        <td>&nbsp;</td>
                        <td style="text-align:right"> <b>Issued By : {{ $payment_voucher->company->name }} </b> <br> <br> <br> <hr> Signature and Date</td>
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