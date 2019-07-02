@extends('layout.main')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <h1 class="page-header">
                        Customers
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="{!! url('cms/dashboard') !!}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Customers
                        </li>
                    </ol>
                </div>
            </div>
            {!! isset($error) ? $errors->first('penname'): null !!}
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <a href="{!! url('cms/customers/create') !!}"
                       class="btn btn-xs btn-icon btn-circle btn-grey" data-click="panel-collapse" title="Add Data">Add
                        New Customer</a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="penname-table">
                            <thead>
                            <tr>
                                @foreach($header as $h)
                                    <th>{!! $h !!}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $c)
                                <tr>
                                    <td>{!! $c->id !!}</td>
                                    <td>{!! $c->name !!}</td>
                                    <td>{!! $c->email !!}</td>
                                    <td>{!! $c->phone_number !!}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           onclick="editPenName( '{!! $c->id !!}','{!! $c->pen_name  !!}','{!! $c->author_id !!}','{!! $c->code !!}')"
                                           class="btn btn-default btn-xs btn-rounded p-l-10 p-r-10"><i
                                                class="fa fa-fw fa-edit"></i> Edit</a>
                                        <a href="javascript:void(0)" onclick="deletePenName({{ $c->id }})"
                                           class="btn btn-danger btn-xs btn-rounded p-l-10 p-r-10"><i
                                                class="fa fa-fw fa-trash"></i>Delete</a>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 10px;">
                <div class="col-lg-5 col-md-5 col-sm-5">
                    Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }}
                    entries
                </div>

                <div class="col-xl-7 col-lg-7 text-right">
                    {{ $customers->render() }}
                </div>
            </div>
        </div>
    </div>



@endsection


<script type="text/javascript">

    function deletePenName(id) {
        swal({
            title: 'Are you sure?',
            text: "Would you like to delete this Pen Name?",
            buttons: {
                cancel: "Close",
                confirm: 'Confirm',
            },
        }).then((result) => {
            if (result) {
                window.location.href = "delete/"+id;
            }
        });
    }

</script>
