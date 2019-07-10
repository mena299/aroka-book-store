@extends('layout.main')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <h1 class="page-header">
                        Orders
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="{!! url('cms/dashboard') !!}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i><a href="{!! url('cms/products') !!}"> Orders </a>
                        </li>
                    </ol>
                </div>
            </div>
            {!! isset($error) ? $errors->first('products'): null !!}

            <form onsubmit="return js_searchData('orders')" class="form-inline">
                <div class="form-group">
                    <div class="col-xl-10">
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                               aria-describedby="button-addon2" id="search" name="search">
                        <div class="input-group-append">
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <a href="{!! url('cms/products/create') !!}"
                       class="btn btn-xs btn-icon btn-circle btn-grey" data-click="panel-collapse" title="Add Data">Add
                        New Product</a>

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
                            @foreach($products as $p)
                                <tr>
                                    <td>{!! $p->id !!}</td>
                                    <td>{!! $p->title_th !!} @if(isset($p->title_en))({!! $p->title_en !!}) @endif</td>
                                    <td>{!! $p->sku !!}</td>
                                    <td>{!! $p->pen_name !!}</td>
                                    <td>{!! $p->cost !!}</td>
                                    <td>{!! $p->register !!}</td>
                                    <td>{!! $p->ems !!}</td>
                                    <td>{!! $p->stock !!}</td>
                                    <td>{!! $p->status !!}</td>
                                    <td>
                                        <a href="{!! url('cms/products/'.$p->id) !!}" target="_blank"
                                           class="btn btn-default btn-xs btn-rounded p-l-10 p-r-10"><i
                                                class="fa fa-fw fa-edit"></i> Edit</a>
{{--                                        <a href="javascript:void(0)" onclick="deleteProduct({{ $p->id }})"--}}
{{--                                           class="btn btn-danger btn-xs btn-rounded p-l-10 p-r-10"><i--}}
{{--                                                class="fa fa-fw fa-trash"></i>Delete</a>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 10px;">
{{--                <div class="col-lg-5 col-md-5 col-sm-5">--}}
{{--                    Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }}--}}
{{--                    entries--}}
{{--                </div>--}}

{{--                <div class="col-xl-7 col-lg-7 text-right">--}}
{{--                    {{ $customers->render() }}--}}
{{--                </div>--}}
            </div>
        </div>
    </div>



@endsection


<script type="text/javascript">

    function deleteProduct(id) {
        swal({
            title: 'Are you sure?',
            text: "Would you like to delete this Product?",
            buttons: {
                cancel: "Close",
                confirm: 'Confirm',
            },
        }).then((result) => {
            if (result) {
                window.location.href = "/cms/products/delete/" + id;
            }
        });
    }

</script>
