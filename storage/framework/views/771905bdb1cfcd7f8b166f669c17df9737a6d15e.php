<?php $__env->startSection('content'); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Add New Author
        </div>
        <div class="panel-body">
            <?php echo Form::open(['url'=>'admin/author/create','method'=>'POST', 'files' => true,'class'=>"form-horizontal"]); ?>


            <div class="form-group">
                <?php echo Form::label("author_name", "Author Name", ['class' => 'col-sm-3 control-label','for'=>"author_name"]); ?>

                <div class="col-sm-6">
                    <?php echo Form::text("author_name", null, ['class' => 'form-control', 'id' => 'author_name', 'placeholder'=>"name"]); ?>

                </div>
            </div>

            <div class="form-group">
                <?php echo Form::label("bank_name", "Bank Name", ['class' => 'col-sm-3 control-label','for'=>"bank_name"]); ?>

                <div class="col-sm-6">
                    <?php echo Form::text("bank_name", null, ['class' => 'form-control', 'id' => 'bank_name', 'placeholder'=>"bank name"]); ?>

                </div>
            </div>

            <div class="form-group">
                <?php echo Form::label("bank_account", "Bank Account", ['class' => 'col-sm-3 control-label','for'=>"bank_account"]); ?>

                <div class="col-sm-6">
                    <?php echo Form::text("bank_account", null, ['class' => 'form-control', 'id' => 'bank_account', 'placeholder'=>"Account Number"]); ?>

                </div>
            </div>

            <div class="form-group">
                <?php echo Form::label("pen_name", "Pen Name", ['class' => 'col-sm-3 control-label','for'=>'pen_name']); ?>

                <div class="col-sm-6">
                    <?php echo Form::select('pen_names[]',$pen_name, array(), ['class' => 'form-control select2-selection--multiple','id' => 'pen_name',"multiple"=>true]); ?>

                </div>
            </div>

            

            <?php echo Form::close(); ?>

        </div>
    </div>








<?php $__env->stopSection(); ?>

<?php echo $__env->make('crudbooster::admin_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/aroka-book-store/resources/views/admin/authors/add_author.blade.php ENDPATH**/ ?>