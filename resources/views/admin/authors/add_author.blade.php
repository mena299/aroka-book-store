@extends('crudbooster::admin_template')
@section('content')


    <div class="form-group">
        {!! Form::label("customer_name", "Customer Name", ['class' => 'col-sm-3 control-label','for'=>"customer_name"]) !!}
        <div class="col-sm-6">
            {!! Form::text("customer_name", null, ['class' => 'form-control', 'id' => 'customer_name', 'placeholder'=>"ชื่อลูกค้า"]) !!}
        </div>
    </div>


    <div class="form-group">
        {!! Form::label("order_status", "Order Status", ['class' => 'col-sm-3 control-label','for'=>'order_status']) !!}
{{--        <div class="col-sm-6">--}}
{{--            {!! Form::select('order_status[]',$arr_data["orderStatusLabel"], $filters['order_status'], ['class' => 'form-control','id' => 'order_status','placeholder'=>"","disabled"=>false,"multiple"=>true]) !!}--}}
{{--        </div>--}}
    </div>

@endsection
