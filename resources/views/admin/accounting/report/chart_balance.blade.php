@extends('admin.master')
@section('title','Accounts Payable')

@section('content')


<main class="app-content">

    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i> @yield('title')</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">@yield('title')</a></li>
        </ul>
    </div>



    @if ($errors->any())
    <div class="alert alert-dismissible alert-danger">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (Session::get('error'))
    <div class="alert alert-dismissible alert-danger">
        <button class="close" type="button" data-dismiss="alert">×</button>
        <strong>Error !</strong> {{ Session::get('error') }}
    </div>
    @endif


    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title"> @yield('title') </div>

                <div class="tile-body">


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="60%">Particular</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chart_of_accounts as $key => $chart)
                            <tr>
                                <td>
                                    <a href="{{ request()->root().'/reports/chart_balance/'.$chart->id }}">
                                        {{ $chart->head_name }}
                                    </a>
                                </td>
                                <td>{{ $chart->balance }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $chart_of_accounts->links() }}

                </div>

            </div>


        </div>


    </div>

</main>


@endsection


@section('js')
<script type="text/javascript" src="{{ asset('assets/admin/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<script>
    $('.date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
        });
</script>
@stop