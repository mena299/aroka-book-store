@extends('layout.main')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <h1 class="page-header">
                        Authors
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="{!! url('cms/dashboard') !!}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Author
                        </li>
                    </ol>
                </div>
            </div>
            {!! isset($error) ? $errors->first('name'): null !!}
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <a href="javascript:void(0)" onclick="createAuthor()"
                       class="btn btn-xs btn-icon btn-circle btn-grey" data-click="panel-collapse" title="Add Data">Add
                        New Author</a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="author-table">
                            <thead>
                            <tr>
                                @foreach($header as $h)
                                    <th>{!! $h !!}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($authors as $author)
                                <tr>
                                    <td>{!! $author->id !!}</td>
                                    <td>{!! $author->name !!}</td>
                                    <td>{!! \Illuminate\Support\Str::replaceLast(',','<br>',$author->email) !!}</td>
                                    <td>{!! $author->phone_number !!}</td>
                                    <td>{!! $author->bank_name !!} : {!! $author->bank_account !!}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           onclick="editAuthor('{!! $author->id !!}','{!! $author->name !!}','{!! $author->bank_name !!}','{!! $author->bank_account !!}','{!! $author->phone_number !!}','{!! $author->email !!}')"
                                           class="btn btn-default btn-xs btn-rounded p-l-10 p-r-10"><i
                                                class="fa fa-fw fa-edit"></i> Edit</a>
                                        <a href="javascript:void(0)" onclick="deleteAuthor({{ $author->id }})"
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
                    Showing {{ $authors->firstItem() }} to {{ $authors->lastItem() }} of {{ $authors->total() }}
                    entries
                </div>

                <div class="col-xl-7 col-lg-7 text-right">
                    {{ $authors->render() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="author-modal" tabindex="-1" role="dialog" aria-labelledby="author-modal-label"
         aria-hidden="true">
        <form action="{{ url('cms/authors/save') }}" method="POST"
              id="vendor-form">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="author-modal-title">Add Author</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <label for="author-name" class="col-form-label">Name :</label>

                            <input type="text" class="form-control" id="author-name" name="author_name" required>
                            <input type="hidden" class="form-control" id="author-id" name="author_id">
                        </div>

                        <div class="form-group">
                            <label for="author-bank-name" class="col-form-label">Bank Name :</label>

                            <input type="text" class="form-control" id="author-bank-name" name="author_bank_name" required>
                        </div>

                        <div class="form-group">
                            <label for="author-bank-account" class="col-form-label">Bank Account :</label>

                            <input type="text" class="form-control" id="author-bank-account" name="author_bank_account" required>
                        </div>
                        <div class="form-group">
                            <label for="author-phone-number" class="col-form-label">Phone Number :</label>

                            <input type="text" class="form-control" id="author-phone-number" name="phone_number">
                        </div>
                        <div class="form-group">
                            <label for="author-email" class="col-form-label">Email :</label>

                            <input type="text" class="form-control" id="author-email" name="email">
                        </div>

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


    function editAuthor(id,name,bname,baccount,phone_number,email) {
        $('#author-modal').modal({});
        $('#author-modal #author-modal-title').html("Edit Author");
        $('#author-modal #author-id').val(id);
        $('#author-modal #author-name').val(name);
        $('#author-modal #author-bank-name').val(bname);
        $('#author-modal #author-bank-account').val(baccount);
        $('#author-modal #author-phone-number').val(phone_number);
        $('#author-modal #author-email').val(email);
    }

    function createAuthor() {
        $('#author-modal').modal({});
        $('#author-modal #author-modal-title').html("Add Author");
    }

    function deleteAuthor(id) {
        swal({
            title: 'Are you sure?',
            text: "Would you like to delete this Author?",
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
