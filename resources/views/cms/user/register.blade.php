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
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin2.css" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-register mx-auto mt-5">
        <form action="/register" method="POST" id="redirect-form">
            <div class="card-header">Register an Account For CMS</div>
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="name" class="form-control" placeholder="Name" required="required"
                               autofocus="autofocus" name="name">
                        <label for="name">Name</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="username" class="form-control" placeholder="Username" required="required"
                               name="username">
                        <label for="username">Username</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" id="email" class="form-control" placeholder="Email address"
                               required="required" name="email">
                        <label for="email">Email address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password"
                                       required="required" name="password">
                                <label for="inputPassword">Password</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="password" id="confirmPassword" class="form-control"
                                       placeholder="Confirm password" required="required" name="password_confirmation">
                                <label for="confirmPassword">Confirm password</label>
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>

                <div class="text-center">
                    <a class="d-block small mt-3" href="login.html">Login Page</a>
                    <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="js/jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
