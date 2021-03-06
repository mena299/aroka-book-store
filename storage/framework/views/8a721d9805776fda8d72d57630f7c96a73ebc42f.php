

<?php $__env->startSection('content'); ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Dashboard <small>Statistics Overview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-primary card-inverse">
                        <div class="card-header card-primary">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-xs-right">
                                    <div class="huge">26</div>
                                    <div>New Comments!</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-default">
                            <a href="javascript:;">
                                <span class="pull-xs-left">View Details</span>
                                <span class="pull-xs-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-green card-inverse">
                        <div class="card-header card-green">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-xs-right">
                                    <div class="huge">12</div>
                                    <div>New Tasks!</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-green">
                            <a href="javascript:;">
                                <span class="pull-xs-left">View Details</span>
                                <span class="pull-xs-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-yellow card-inverse">
                        <div class="card-header card-yellow">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-xs-right">
                                    <div class="huge">124</div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-yellow">
                            <a href="javascript:;">
                                <span class="pull-xs-left">View Details</span>
                                <span class="pull-xs-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-red card-inverse">
                        <div class="card-header card-red">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-xs-right">
                                    <div class="huge">13</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-red">
                            <a href="javascript:;">
                                <span class="pull-xs-left">View Details</span>
                                <span class="pull-xs-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header card-default">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart
                        </div>
                        <div class="card-block">
                            <div id="morris-area-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-xl-4 col-lg-12">
                    <div class="card">
                        <div class="card-header card-default">
                            <i class="fa fa-long-arrow-right fa-fw"></i> Donut Chart
                        </div>
                        <div class="card-block">
                            <div id="morris-donut-chart"></div>
                            <div class="text-xs-right">
                                <a href="javascript:;">View Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-default">
                            <i class="fa fa-clock-o fa-fw"></i> Tasks Card
                        </div>
                        <div class="card-block">
                            <div class="list-group">
                                <a href="javascript:;" class="list-group-item">
                                    <span class="label label-pill label-default pull-xs-right">just now</span>
                                    <i class="fa fa-fw fa-calendar"></i> Calendar updated
                                </a>
                                <a href="javascript:;" class="list-group-item">
                                    <span class="label label-pill label-default pull-xs-right">4 minutes ago</span>
                                    <i class="fa fa-fw fa-comment"></i> Commented on a post
                                </a>
                                <a href="javascript:;" class="list-group-item">
                                    <span class="label label-pill label-default pull-xs-right">23 minutes ago</span>
                                    <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                                </a>
                                <a href="javascript:;" class="list-group-item">
                                    <span class="label label-pill label-default pull-xs-right">46 minutes ago</span>
                                    <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                                </a>
                                <a href="javascript:;" class="list-group-item">
                                    <span class="label label-pill label-default pull-xs-right">1 hour ago</span>
                                    <i class="fa fa-fw fa-user"></i> A new user has been added
                                </a>
                                <a href="javascript:;" class="list-group-item">
                                    <span class="label label-pill label-default pull-xs-right">2 hours ago</span>
                                    <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                                </a>
                                <a href="javascript:;" class="list-group-item">
                                    <span class="label label-pill label-default pull-xs-right">yesterday</span>
                                    <i class="fa fa-fw fa-globe"></i> Saved the world
                                </a>
                                <a href="javascript:;" class="list-group-item">
                                    <span class="label label-pill label-default pull-xs-right">two days ago</span>
                                    <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                                </a>
                            </div>
                            <div class="text-xs-right">
                                <a href="javascript:;">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card card-default">
                        <div class="card-header card-default">
                            <i class="fa fa-money fa-fw"></i> Transactions Card
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Order Date</th>
                                        <th>Order Time</th>
                                        <th>Amount (USD)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>3326</td>
                                        <td>10/21/2013</td>
                                        <td>3:29 PM</td>
                                        <td>$321.33</td>
                                    </tr>
                                    <tr>
                                        <td>3325</td>
                                        <td>10/21/2013</td>
                                        <td>3:20 PM</td>
                                        <td>$234.34</td>
                                    </tr>
                                    <tr>
                                        <td>3324</td>
                                        <td>10/21/2013</td>
                                        <td>3:03 PM</td>
                                        <td>$724.17</td>
                                    </tr>
                                    <tr>
                                        <td>3323</td>
                                        <td>10/21/2013</td>
                                        <td>3:00 PM</td>
                                        <td>$23.71</td>
                                    </tr>
                                    <tr>
                                        <td>3322</td>
                                        <td>10/21/2013</td>
                                        <td>2:49 PM</td>
                                        <td>$8345.23</td>
                                    </tr>
                                    <tr>
                                        <td>3321</td>
                                        <td>10/21/2013</td>
                                        <td>2:23 PM</td>
                                        <td>$245.12</td>
                                    </tr>
                                    <tr>
                                        <td>3320</td>
                                        <td>10/21/2013</td>
                                        <td>2:15 PM</td>
                                        <td>$5663.54</td>
                                    </tr>
                                    <tr>
                                        <td>3319</td>
                                        <td>10/21/2013</td>
                                        <td>2:13 PM</td>
                                        <td>$943.45</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-xs-right">
                                <a href="javascript:;">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/aroka-book-store/resources/views/table.blade.php ENDPATH**/ ?>