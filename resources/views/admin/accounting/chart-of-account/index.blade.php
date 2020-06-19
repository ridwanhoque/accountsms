@extends('admin.master')

@section('title')
Chart Of Account
@stop

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


    {{-- Add New Modal--}}
    <div class="modal fade" id="addnew" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Chart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>



                <form class="form-horizontal" action="{{ route('chart-of-account.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group row add_asterisk">
                            <label for="type" class="control-label col-md-3">Type </label>
                            <div class="col-md-9">
                                <select name="chart_of_account_type_id" id="chart_of_account_type_id" class="form-control @error('type') is-invalid @enderror">
                                    @foreach($chart_of_account_types as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>

                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="parent_id" class="control-label col-md-3">Parent </label>
                            <div class="col-md-9">
                                <select name="parent_id" id="parent_id" class="form-control select2 @error('parent_id') is-invalid @enderror">
                                    <option value="">Self</option>
                                    @foreach ($chart_list as $key => $chart)
                                        <option value="{{ $chart->id }}">{{ $chart->head_name }}</option>
                                    @endforeach
                                </select>

                                @error('parent_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row add_asterisk">
                            <label for="head_name" class="control-label col-md-3">Head Name </label>
                            <div class="col-md-9">
                                <input id="head_name" name="head_name" value="{{ old('head_name') }}" type="text" class="form-control @error('head_name') is-invalid @enderror" placeholder="Head Name">

                                @error('head_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row add_asterisk">
                            <label for="head_name" class="control-label col-md-3">Opening Balance </label>
                            <div class="col-md-9">
                                <input id="opening_balance" name="opening_balance" value="{{ old('opening_balance') }}" type="text" class="form-control @error('opening_balance') is-invalid @enderror" placeholder="Opening Balance">

                                @error('opening_balance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="head_name" class="control-label col-md-3">Is Posting </label>
                            <div class="col-md-9">
                                <select name="is_posting" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>

                                @error('is_posting')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="head_name" class="control-label col-md-3">Status </label>
                            <div class="col-md-9">
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="status" value="1" checked><span class="label-text">Published</span>
                                    </label>
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                    <label>
                                        <input type="radio" name="status" value="0"><span class="label-text">Unpublished</span>
                                    </label>
                                </div>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-circle"></i> Save
                        </button>
                    </div>

                </form>



            </div>
        </div>
    </div>



    {{--List Table--}}

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addnew"><i class="fa fa-plus"></i>Add New</button>
                <h3 class="tile-title"><i class="fa fa-list"></i> &nbsp; List</h3>

                <br>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Type</th>
                                <th>Head Name</th>
                                <th>Parent Head</th>
                                <th>Tire</th>
                                <th>Status</th>
                                {{-- <th>Created At</th>
                                <th>Updated At</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($chartOfAccounts as $key => $chartOfAccount)

                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $chartOfAccount->type }}</td>
                                <td>{{ $chartOfAccount->head_name }}</td>
                                <td>{{ $chartOfAccount->parent ? $chartOfAccount->parent->head_name:'' }}</td>
                                <td>{{ $chartOfAccount->tire }}</td>
                                <td>
                                    @if ($chartOfAccount->status == 1)
                                    <span class="badge badge-success">Published</span>
                                    @else
                                    <span class="badge badge-danger">Un-Published</span>
                                    @endif
                                </td>
                                {{-- <td>{{ $chartOfAccount->created_at->format('F d, Y  h:i s A') }}</td>
                                <td>{{ $chartOfAccount->updated_at->format('F d, Y  h:i s A') }}</td> --}}
                                <td>
                                    <button class="btn btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#edit_{{ $chartOfAccount->id }}">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>

                                    <button class="btn btn-success btn-sm" title="View Details" data-toggle="modal" data-target="#view_{{ $chartOfAccount->id }}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm" title="Delete" onclick="formSubmit('{{ $chartOfAccount->id }}')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>

                                <form action="{{ route('chart-of-account.destroy',$chartOfAccount->id) }}" id="deleteForm_{{ $chartOfAccount->id }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                </form>

                            </tr>

                            <div class="modal fade" id="edit_{{ $chartOfAccount->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Chart</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="form-horizontal" action="{{ route('chart-of-account.update',$chartOfAccount->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">
                                                <div class="form-group row add_asterisk">
                                                    <label for="type" class="control-label col-md-3">Type </label>
                                                    <div class="col-md-9">
                                                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                                            <option value="">- Select Type -</option>
                                                            <option {{ $chartOfAccount->type == 'income'? 'selected':'' }} value="income">Income</option>
                                                            <option {{ $chartOfAccount->type == 'expenses'? 'selected':'' }} value="expenses">Expenses</option>
                                                            <option value="asset" {{ $chartOfAccount->type == 'asset' ? 'selected':'' }}>Asset</option>
                                                            <option value="liability" {{ $chartOfAccount->type == 'liability' ? 'selected':'' }}>Liability</option>
                                                        </select>

                                                        @error('type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="form-group row add_asterisk">
                                                    <label for="parent_id" class="control-label col-md-3">Parent </label>
                                                    <div class="col-md-9">
                                                        <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                                            <option value="">Self</option>
                                                            @foreach ($chart_list as $id => $name)
                                                            <option value="{{ $id }}" {{ $id == $chartOfAccount->parent_id ? 'selected':'' }}>{{ $name }}</option>
                                                            @endforeach
                                                        </select>

                                                        @error('parent_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="form-group row add_asterisk">
                                                    <label for="head_name" class="control-label col-md-3">Head Name
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input id="head_name" name="head_name" value="{{ $chartOfAccount->head_name ?: old('head_name') }}" type="text" class="form-control @error('head_name') is-invalid @enderror" placeholder="Head Name">

                                                        @error('head_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="form-group row add_asterisk">
                                                    <label for="head_name" class="control-label col-md-3">Opening Balance </label>
                                                    <div class="col-md-9">
                                                        <input id="opening_balance" name="opening_balance" value="{{ old('opening_balance') ?: $chartOfAccount->opening_balance }}" type="text" class="form-control @error('opening_balance') is-invalid @enderror" placeholder="Opening Balance">

                                                        @error('opening_balance')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="form-group row add_asterisk">
                                                    <label for="head_name" class="control-label col-md-3">Is Posting </label>
                                                    <div class="col-md-9">
                                                        <select name="is_posting" class="form-control">
                                                            <option value="1">Yes</option>
                                                            <option value="2">No</option>
                                                        </select>

                                                        @error('is_posting')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror

                                                    </div>
                                                </div>

                                                <div class="form-group row add_asterisk">
                                                    <label for="head_name" class="control-label col-md-3">Status
                                                    </label>
                                                    <div class="col-md-9">
                                                        <div class="animated-radio-button">
                                                            <label>
                                                                <input type="radio" name="status" value="1" {{ $chartOfAccount->status == 1 ? 'checked' : '' }}><span class="label-text">Published</span>
                                                            </label>
                                                            &nbsp;
                                                            &nbsp;
                                                            &nbsp;
                                                            <label>
                                                                <input type="radio" name="status" value="0" {{ $chartOfAccount->status == 0 ? 'checked' : '' }}><span class="label-text">Unpublished</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-check-circle"></i> Update
                                                </button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="view_{{ $chartOfAccount->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Chart Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form class="form-horizontal">
                                            <div class="modal-body">

                                                <div class="col-md-10 offset-1">
                                                    <div class="row">


                                                        <dt class="col-sm-4">Type</dt>
                                                        <dd class="col-sm-8">{{ $chartOfAccount->type }}</dd>

                                                        <dt class="col-sm-4">Head Name</dt>
                                                        <dd class="col-sm-8">{{ $chartOfAccount->head_name }}</dd>

                                                        <dt class="col-sm-4">status</dt>
                                                        <dd class="col-sm-8">
                                                            @if ($chartOfAccount->status == 1)
                                                            <span class="badge badge-success">Published</span>
                                                            @else
                                                            <span class="badge badge-danger">Un-Published</span>
                                                            @endif
                                                        </dd>

                                                        <dt class="col-sm-4">Created At</dt>
                                                        <dd class="col-sm-8">
                                                            {{ $chartOfAccount->created_at->format('F d, Y  h:i s A') }}
                                                        </dd>

                                                        <dt class="col-sm-4">Updated At</dt>
                                                        <dd class="col-sm-8">
                                                            {{ $chartOfAccount->updated_at->format('F d, Y  h:i s A') }}
                                                        </dd>


                                                    </div>
                                                </div>

                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>

                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</main>



<script>
    function formSubmit(id) {
        swal({
            title: "Are you sure ?",
            text: "You want to delete this data ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it.",
            cancelButtonText: "No, cancel it.",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                $('#deleteForm_' + id).submit();;
            }
        });
    }
</script>




@endsection