<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aroka Book Store</title>

    <!-- Custom fonts for this template-->
    <link href="{!! url('fontawesome-free/css/all.min.css') !!}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{!! url('css/sb-admin2.css') !!}" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-register mx-auto mt-5">
        <form action="{!! url('cms/login') !!}" method="POST" id="login-form">
            <div class="card-header">Login to CMS Aroka Book Store</div>
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="username" class="form-control" placeholder="Username" required="required"
                               name="username">
                        <label for="username">Username</label>
                        <small class="text-danger">{{ $errors->first('username') }}</small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="password" class="form-control" placeholder="Username" required="required"
                               name="password">
                        <label for="password">Password</label>
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Login</button>

                <div class="text-center">
                    <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{!! url('js/jquery/jquery.min.js') !!}"></script>
<script src="{!! url('bootstrap/js/bootstrap.bundle.min.js') !!}"></script>

<!-- Core plugin JavaScript-->
<script src="{!! url('jquery-easing/jquery.easing.min.js') !!}"></script>

</body>

</html>
