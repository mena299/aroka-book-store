<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-toggleable-sm navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav list-group">
        <li class="list-group-item">
            <a href="<?php echo url('cms/dashboard'); ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="list-group-item">
            <a href="javascript:;" data-toggle="collapse" data-target="#author"><i class="fa fa-fw fa-arrows-v"></i>
                Authors <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="author" class="list-group collapse">
                <li class="list-group-item">
                    <a href="<?php echo url('cms/authors/list'); ?>">Authors</a>
                </li>
                <li class="list-group-item">
                    <a href="<?php echo url('cms/authors/pen-names/list'); ?>">Pen Name</a>
                </li>
            </ul>
        </li>
        <li class="list-group-item">
            <a href="<?php echo url('cms/customers/list'); ?>"><i class="fa fa-fw fa-table"></i> Customer</a>
        </li>
        <li class="list-group-item">
            <a href="<?php echo url('cms/products/list'); ?>"><i class="fa fa-fw fa-table"></i> Products</a>
        </li>
        <li class="list-group-item">
            <a href="javascript:;" data-toggle="collapse" data-target="#orders"><i class="fa fa-fw fa-arrows-v"></i>
                Orders <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="orders" class="list-group collapse">
                <li class="list-group-item">
                    <a href="<?php echo url('cms/orders/list'); ?>">Orders</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- /.navbar-collapse -->
<?php /**PATH /home/vagrant/code/aroka-book-store/resources/views/layout/sidebar.blade.php ENDPATH**/ ?>