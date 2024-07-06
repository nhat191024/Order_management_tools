<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{url('') . '/'}}vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{url('') . '/'}}css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Chào mừng trở lại!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('admin.login') }}">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="username"
                                                placeholder="Nhập tên tài khoản">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="exampleInputPassword" placeholder="Nhập mật khẩu">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Đăng nhập
                                        </button>
                                        <hr>
                                        <a href="" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng nhập với Google
                                        </a>
                                        <a href="" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng nhập với Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">Quên mật khẩu?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="#">Tạo tài khoản!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{url('') . '/'}}vendor/jquery/jquery.min.js"></script>
    <script src="{{url('') . '/'}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{url('') . '/'}}vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{url('') . '/'}}js/sb-admin-2.min.js"></script>

</body>

</html>