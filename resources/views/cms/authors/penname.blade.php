@extends('layout.main')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <h1 class="page-header">
                        Pen Names
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="{!! url('cms/dashboard') !!}">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Pen Names
                        </li>
                    </ol>
                </div>
            </div>
            {!! isset($error) ? $errors->first('penname'): null !!}
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <a href="javascript:void(0)" onclick="createPenName()"
                       class="btn btn-xs btn-icon btn-circle btn-grey" data-click="panel-collapse" title="Add Data">Add
                        New Pen Name</a>

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
                            @foreach($pennames as $pn)
                                <tr>
                                    <td>{!! $pn->id !!}</td>
                                    <td>{!! $pn->code !!}</td>
                                    <td>{!! $pn->pen_name !!}</td>
                                    <td>{!! $pn->author_name !!}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           onclick="editPenName( '{!! $pn->id !!}','{!! $pn->pen_name  !!}','{!! $pn->author_id !!}','{!! $pn->code !!}')"
                                           class="btn btn-default btn-xs btn-rounded p-l-10 p-r-10"><i
                                                class="fa fa-fw fa-edit"></i> Edit</a>
                                        <a href="javascript:void(0)" onclick="deletePenName({{ $pn->id }})"
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
                    Showing {{ $pennames->firstItem() }} to {{ $pennames->lastItem() }} of {{ $pennames->total() }}
                    entries
                </div>

                <div class="col-xl-7 col-lg-7 text-right">
                    {{ $pennames->render() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="penname-modal" tabindex="-1" role="dialog" aria-labelledby="penname-modal-label"
         aria-hidden="true">
        <form action="{{ url('cms/authors/pen-names/save') }}" method="POST"
              id="vendor-form">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="penname-modal-title">Add New Pen Name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {{ csrf_field() }}
                            <label for="penname-label" class="col-form-label">Pen Name :</label>

                            <input type="text" class="form-control" id="penname-label" name="penname">
                            <input type="hidden" class="form-control" id="penname-id" name="penname_id">
                        </div>

                        <div class="form-group">
                            <label for="penname-code" class="col-form-label">Code :</label>

                            <input type="text" class="form-control" id="penname-code" name="code">
                        </div>

                        <label for="author" class="col-form-label">Author :</label>
                        <select class="form-control " name="author" id="author">
                            <option value="0">not select</option>
                            @foreach($authors as $a)
                                <option value="{!! $a->id !!}">{!! $a->name !!}</option>
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


    function editPenName(id, penname, author_id,code) {
        $('#penname-modal').modal({});
        $('#penname-modal #penname-modal-title').html("Add Pen Name");
        $('#penname-modal #penname-id').val(id);
        $('#penname-modal #penname-code').val(code);
        $('#penname-modal #penname-label').val(penname);
        $('#penname-modal #author').val(author_id);
    }

    function createPenName() {
        $('#penname-modal').modal({});
        $('#penname-modal #penname-modal-title').html("Add Pen Name");
    }

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
