@extends('crudbooster::admin_template')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Add New Author
        </div>
        <div class="panel-body">
            {!! Form::open(['url'=>'admin/author/create','method'=>'POST', 'files' => true,'class'=>"form-horizontal"]) !!}

            <div class="form-group">
                {!! Form::label("author_name", "Author Name", ['class' => 'col-sm-3 control-label','for'=>"author_name"]) !!}
                <div class="col-sm-6">
                    {!! Form::text("author_name", null, ['class' => 'form-control', 'id' => 'author_name', 'placeholder'=>"name"]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label("bank_name", "Bank Name", ['class' => 'col-sm-3 control-label','for'=>"bank_name"]) !!}
                <div class="col-sm-6">
                    {!! Form::text("bank_name", null, ['class' => 'form-control', 'id' => 'bank_name', 'placeholder'=>"bank name"]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label("bank_account", "Bank Account", ['class' => 'col-sm-3 control-label','for'=>"bank_account"]) !!}
                <div class="col-sm-6">
                    {!! Form::text("bank_account", null, ['class' => 'form-control', 'id' => 'bank_account', 'placeholder'=>"Account Number"]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label("pen_name", "Pen Name", ['class' => 'col-sm-3 control-label','for'=>'pen_name']) !!}
                <div class="col-sm-6">
                    {!! Form::select('pen_names[]',$pen_name, null, ['class' => 'form-control','id' => 'pen_name',"multiple"=>true]) !!}
                </div>
            </div>

            {{--            {!! Form::select('order_status[]',@$arr_data["orderStatusLabel"], @$filters['order_status'], ['class' => 'form-control','id' => 'order_status','placeholder'=>"","disabled"=>false,"multiple"=>true]) !!}--}}

            {!! Form::close() !!}
        </div>
    </div>








@endsection

