<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ewadul - Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <b class="h1">Ewadul</b>
            </div>
            <div class="card-body">
                <!-- <p class="login-box-msg">Sign in to start your session</p> -->

                <form action="#" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="text-danger d-none" role="alert" id="alert-email"></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="text-danger d-none" role="alert" id="alert-password"></div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="button" class="btn btn-primary btn-block" id="btn_login">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- <div class=" social-auth-links text-center mt-2 mb-3">
                                <a href="#" class="btn btn-block btn-primary">
                                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                                </a>
                                <a href="#" class="btn btn-block btn-danger">
                                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                                </a>
                        </div> -->
                <!-- /.social-auth-links -->

                <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
                <p class="mb-0">
                    <a href="/auth/register" class="text-center">Daftar akun baru</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#btn_login").click(function() {
            var pengguna_id = "";

            $("#loading").show();
            $("#btn_login").prop("disabled", true);

            $.ajax({
                async: false,
                type: 'POST',
                url: "/auth/proses_login",
                data: {
                    email: $("#email").val(),
                    password: $("#password").val(),
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
                dataType: "JSON",
                success: function(response) {
                    $("#loading").hide();
                    $("#btn_login").prop("disabled", false);

                    // console.log(response);

                    if (response.success === true) {
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: 'Berhasil Login',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        window.location = "/dashboard";
                    } else {
                        if (response.message == 2) {
                            Swal.fire({
                                type: 'error',
                                icon: 'error',
                                title: 'Password Salah !'
                            });
                        } else if (response.message == 0) {
                            Swal.fire({
                                type: 'error',
                                icon: 'error',
                                title: 'Password atau Email, Salah !'
                            });
                        }
                    }

                },
                error: function(error) {

                    $("#loading").hide();
                    $("#btn_login").prop("disabled", false);;

                    if (error.responseJSON.email) {

                        //show alert
                        $('#alert-email').show();
                        $('#alert-email').removeClass('d-none');
                        $('#alert-email').addClass('d-block');

                        //add message to alert
                        $('#alert-email').html(error.responseJSON.email[0]);
                    }

                    if (error.responseJSON.password) {

                        //show alert
                        $('#alert-password').show();
                        $('#alert-password').removeClass('d-none');
                        $('#alert-password').addClass('d-block');

                        //add message to alert
                        $('#alert-password').html(error.responseJSON.password[0]);
                    }
                }
            });

        });
    </script>
</body>

</html>