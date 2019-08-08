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
                            <i class="fa fa-table"></i><a href="{!! url('cms/orders/list') !!}"> Orders </a>
                        </li>
                    </ol>
                </div>
            </div>
            {!! isset($error) ? $errors->first('products'): null !!}

            <div class="row">
                <div class="form-group">
                    <form class="form-inline">

                        <div class="col-xl-6">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                                   aria-describedby="button-addon2" id="search" name="search">
                        </div>
                    </form>

                    <form action="{{ url('cms/orders/upload') }}" class="form-inline" method="POST"
                          id="order-upload-form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-xl-6">
                            <input type="file" class="form-control" id="order" name="order">
                            <input type="submit" value="upload" class="btn">
                        </div>
                    </form>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
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
                            @foreach($orders as $o)
                                <tr>
                                    <td>{!! $o['order_id'] !!}</td>
                                    <td>{!! $o['old_order_id'] !!}</td>
                                    <td>{!! $o['customer_name'] !!}</td>
                                    <td>{!! $o['email'] !!}</td>
                                    <td>{!! $o['phone_number'] !!}</td>
                                    <td>{!! $o['products'] !!}</td>
                                    <td>{!! $o['status'] !!}</td>
                                    <td>{!! $o['price'] !!}</td>
                                    <td>{!! $o['is_preorder'] !!}</td>
                                    <td>{!! $o['shipping_type'] !!}</td>
                                    <td>{!! $o['tracking'] !!}</td>
                                    <td>{!! $o['transporter'] !!}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick=""
                                           class="btn btn-info btn-xs btn-rounded p-l-10 p-r-10">View</a>
                                        <a href="javascript:void(0)"
                                           onclick="updateTracking('{!! $o['order_id'] !!}','{!! $o['shipping_date'] !!}','{!! $o['tracking'] !!}','{!! $o['transporter_id'] !!}')"
                                           class="btn btn-info btn-xs btn-rounded p-l-10 p-r-10">Tracking</a>
                                        <a href="javascript:void(0)" onclick="sendMail('{{ $o['order_id']  }}','{!! $o['old_order_id'] !!}')"
                                           class="btn btn-primary btn-xs btn-rounded p-l-10 p-r-10">Send Mail</a>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 10px;">
                <div class="col-lg-5 col-md-5 col-sm-5">
                    Showing {{ $order_data->firstItem() }} to {{ $order_data->lastItem() }}
                    of {{ $order_data->total() }}
                    entries
                </div>

                <div class="col-xl-7 col-lg-7 text-right">
                    {{ $order_data->render() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tracking-modal" tabindex="-1" role="dialog" aria-labelledby="penname-modal-label"
         aria-hidden="true">
        <form action="{{ url('cms/orders/update-tracking') }}" method="POST"
              id="vendor-form">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tracking-modal-title">Update Tracking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <label for="tracking-label" class="col-form-label">Tracking :</label>

                            <input type="text" class="form-control" id="tracking-label" name="tracking">
                            <input type="hidden" class="form-control" id="order_id" name="order_id">
                        </div>

                        <div class="form-group">
                            <label for="shipping-date" class="col-form-label">Shipping Date :</label>

                            <input type="date" class="form-control" id="shipping-date" name="shipping_date">
                        </div>

                        <label for="author" class="col-form-label">Transporter :</label>
                        <select class="form-control " name="transporter" id="transporter">
                            <option value="0">not select</option>
                            @foreach($transporter as $key => $t)
                                <option value="{!! $key !!}">{!! $t !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



@endsection


<script type="text/javascript">

    function updateTracking(id, date, tracking, transporter) {
        $('#tracking-modal').modal({});
        $('#tracking-modal #tracking-modal-title').html("Update Tracking");
        $('#tracking-modal #order_id').val(id);
        $('#tracking-modal #shipping-date').val(date);
        $('#tracking-modal #tracking-label').val(tracking);
        $('#tracking-modal #transporter').val(transporter);
    }

    function sendMail(order_id, wix_order_id) {
        swal({
            title: 'Are you sure?',
            text: "Send Mail Tracking To Order " + wix_order_id + " ?",
            buttons: {
                cancel: "Close",
                confirm: 'Confirm',
            },
        }).then((result) => {
            if (result) {
                window.location.href = "/cms/orders/tracking-sendmail/" + order_id;
            }
        });
    }

</script>
