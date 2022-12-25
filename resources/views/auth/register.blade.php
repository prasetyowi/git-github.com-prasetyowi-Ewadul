<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ewadul - Daftar akun baru</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <b class="h1">Ewadul</b>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Daftar akun baru</p>

                <form action="#" method="post">
                    <input type="hidden" id="num_rows" value="{{ $data['num_rows'] + 1 }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="Pengguna-pengguna_nama" placeholder="Nama Lengkap">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="text-danger d-none" role="alert" id="alert-pengguna_nama"></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="Pengguna-pengguna_nik" placeholder="NIK">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-pen"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="text-danger d-none" id="alert-pengguna_nik"></div>
                    </div>
                    <!-- <div class="input-group mb-3">
                        <input type="text" class="form-control" id="Pengguna-pengguna_alamat" placeholder="alamat">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="Pengguna-pengguna_kelurahan" placeholder="kelurahan">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="Pengguna-pengguna_kecamatan" placeholder="kecamatan">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="Pengguna-pengguna_kota" placeholder="kota">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="Pengguna-pengguna_provinsi" placeholder="provinsi">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="Pengguna-pengguna_kodepos" placeholder="kode pos">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div> -->
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="Pengguna-pengguna_email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="text-danger d-none" role="alert" id="alert-pengguna_email"></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="Pengguna-pengguna_password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="text-danger d-none" role="alert" id="alert-pengguna_password"></div>
                    </div>
                    <!-- <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div> -->
                    <input type="hidden" class="form-control" id="Pengguna-pengguna_foto" value="Retype password">
                    <input type="hidden" class="form-control" id="Pengguna-pengguna_foto_ktp" value="Retype password">
                    <!-- <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> -->
                    <!-- /.col -->
                    <div class="col-4">
                        <span id="loading" style="display: none;"><i class="fa fa-refresh fa-spin"></i> Loading...</span>
                        <button type="button" class="btn btn-primary btn-block" id="btn_register">Register</button>
                    </div>
                    <!-- /.col -->
            </div>
            </form>

            <!-- <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div> -->

            <a href="/auth/login" class="text-center">Saya sudah punya akun</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#btn_register").click(function() {
            var pengguna_id = "";

            $("#loading").show();
            $("#btn_regist").prop("disabled", true);

            if ($("#num_rows").val() >= 0 && $("#num_rows").val() < 10) {
                pengguna_id = "USR000" + $("#num_rows").val();
            } else if ($("#num_rows").val() >= 10 && $("#num_rows").val() < 100) {
                pengguna_id = "USR00" + $("#num_rows").val();
            } else if ($("#num_rows").val() >= 100 && $("#num_rows").val() < 1000) {
                pengguna_id = "USR0" + $("#num_rows").val();
            } else if ($("#num_rows").val() >= 1000) {
                pengguna_id = "USR" + $("#num_rows").val();
            }

            $.ajax({
                async: false,
                type: 'POST',
                url: "/auth/proses_register",
                data: {
                    pengguna_id: pengguna_id,
                    pengguna_nama: $("#Pengguna-pengguna_nama").val(),
                    pengguna_nik: $("#Pengguna-pengguna_nik").val(),
                    pengguna_email: $("#Pengguna-pengguna_email").val(),
                    pengguna_password: $("#Pengguna-pengguna_password").val(),
                    "_token": $("meta[name='csrf-token']").attr("content")
                },
                dataType: "JSON",
                success: function(response) {
                    $("#loading").hide();
                    $("#btn_regist").prop("disabled", false);

                    if (response.success === true) {
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: `${response.message}`,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }

                },
                error: function(error) {

                    $("#loading").hide();
                    $("#btn_regist").prop("disabled", false);;

                    if (error.responseJSON.pengguna_nama) {

                        //show alert
                        $('#alert-pengguna_nama').show();
                        $('#alert-pengguna_nama').removeClass('d-none');
                        $('#alert-pengguna_nama').addClass('d-block');

                        //add message to alert
                        $('#alert-pengguna_nama').html(error.responseJSON.pengguna_nama[0]);
                    }

                    if (error.responseJSON.pengguna_nik) {

                        //show alert
                        $('#alert-pengguna_nik').show();
                        $('#alert-pengguna_nik').removeClass('d-none');
                        $('#alert-pengguna_nik').addClass('d-block');

                        //add message to alert
                        $('#alert-pengguna_nik').html(error.responseJSON.pengguna_nik[0]);
                    }

                    if (error.responseJSON.pengguna_email) {

                        //show alert
                        $('#alert-pengguna_email').show();
                        $('#alert-pengguna_email').removeClass('d-none');
                        $('#alert-pengguna_email').addClass('d-block');

                        //add message to alert
                        $('#alert-pengguna_email').html(error.responseJSON.pengguna_email[0]);
                    }

                    if (error.responseJSON.pengguna_password) {

                        //show alert
                        $('#alert-pengguna_password').show();
                        $('#alert-pengguna_password').removeClass('d-none');
                        $('#alert-pengguna_password').addClass('d-block');

                        //add message to alert
                        $('#alert-pengguna_password').html(error.responseJSON.pengguna_password[0]);
                    }
                }
            });

        });
    </script>

</body>

</html>