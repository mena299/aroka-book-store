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
                            <i class="fa fa-table"></i> <a href="{!! url('cms/customers/list') !!}"> Customers </a>
                        </li>
                    </ol>
                </div>
            </div>


            <form action="{{ url('cms/customers/save/'.$customer->id) }}" method="POST"
                  id="customer-form">
                {{ csrf_field() }}
                @include('cms.customers._form')
            </form>

        </div>
    </div>



@endsection
