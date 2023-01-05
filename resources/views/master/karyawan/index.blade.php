<!-- Menghubungkan dengan view template master -->
@extends('../layout/layout_admin')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Karyawan')

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Karyawan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Filter Data</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <span id="loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                <button type="button" class="btn btn-info" id="btn_add_pengguna" data-toggle="modal" data-target="#modal-add">
                                    <i class="fas fa-plus"></i> Karyawan
                                </button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- TABLE -->
            <div class="card card-default">
                <div class="card-body">
                    <table id="table-karyawan" class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr class="bg-info">
                                <th style="vertical-align:middle; text-align:center;">#</th>
                                <th style="vertical-align:middle; text-align:center;">Karyawan</th>
                                <th style="vertical-align:middle; text-align:center;">Email</th>
                                <th style="vertical-align:middle; text-align:center;">Sebagai</th>
                                <th style="vertical-align:middle; text-align:center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-add">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Karyawan</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="hidden" class="form-control" id="Pengguna-pengguna_id" name="Pengguna[pengguna_id]" style="width: 100%;" value="{{ $data['pengguna_id'] }}">
                            <input type="text" class="form-control" id="Pengguna-pengguna_nik" name="Pengguna[pengguna_nik]" style="width: 100%;" value="">
                            <div class="text-danger d-none" role="alert" id="alert-pengguna_nik"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="Pengguna-pengguna_nama" name="Pengguna[pengguna_nama]" style="width: 100%;" value="">
                            <div class="text-danger d-none" role="alert" id="alert-pengguna_nama"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pengguna Level</label>
                            <select class="form-control select2" id="Pengguna-pengguna_level_id" name="Pengguna[pengguna_level_id]" style="width: 100%;">
                                <option value="">** Pilih **</option>
                                @foreach($data['Level'] as $value)
                                <option value="{{ $value->pengguna_level_id }}">{{ $value->pengguna_level }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger d-none" role="alert" id="alert-pengguna_level_id"></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="Pengguna-pengguna_email" name="Pengguna[pengguna_email]" style="width: 100%;" value="">
                            <div class="text-danger d-none" role="alert" id="alert-pengguna_email"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="Pengguna-pengguna_password" name="Pengguna[pengguna_password]" style="width: 100%;" value="">
                            <div class="text-danger d-none" role="alert" id="alert-pengguna_password"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingadd" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" class="btn btn-success" id="btn_save_pengguna">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <i class="fa fa-times"></i> Tutup
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-header">
            <h4 class="modal-title">Edit Karyawan</h4>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="hidden" class="form-control" id="Pengguna-pengguna_id_update" name="Pengguna[pengguna_id_update]" style="width: 100%;" value="">
                            <input type="text" class="form-control" id="Pengguna-pengguna_nik_update" name="Pengguna[pengguna_nik_update]" style="width: 100%;" value="">
                            <div class="text-danger d-none" role="alert" id="alert-pengguna_nik_update"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="Pengguna-pengguna_nama_update" name="Pengguna[pengguna_nama_update]" style="width: 100%;" value="">
                            <div class="text-danger d-none" role="alert" id="alert-pengguna_nama_update"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pengguna Level</label>
                            <select class="form-control select2" id="Pengguna-pengguna_level_id_update" name="Pengguna[pengguna_level_id_update]" style="width: 100%;">
                                <option value="">** Pilih **</option>
                                @foreach($data['Level'] as $value)
                                <option value="{{ $value->pengguna_level_id }}">{{ $value->pengguna_level }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger d-none" role="alert" id="alert-pengguna_level_id_update"></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="Pengguna-pengguna_email_update" name="Pengguna[pengguna_email_update]" style="width: 100%;" value="">
                            <div class="text-danger d-none" role="alert" id="alert-pengguna_email_update"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="Pengguna-pengguna_password_update" name="Pengguna[pengguna_password_update]" style="width: 100%;" value="">
                            <div class="text-danger d-none" role="alert" id="alert-pengguna_password_update"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingedit" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" class="btn btn-success" id="btn_update_pengguna">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                    <i class="fa fa-times"></i>Tutup
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

@section('script_function')
<script>
    $(document).ready(function() {
        GetKaryawan();
    });

    $("#btn_save_pengguna").click(function() {
        // console.log($("#filter-tanggal").val());

        $("#loadingadd").show();
        $("#btn_save_pengguna").prop("disabled", true);

        $.ajax({
            async: false,
            type: 'POST',
            url: "/karyawan/store",
            data: {
                pengguna_id: $("#Pengguna-pengguna_id").val(),
                pengguna_nik: $("#Pengguna-pengguna_nik").val(),
                pengguna_nama: $("#Pengguna-pengguna_nama").val(),
                pengguna_email: $("#Pengguna-pengguna_email").val(),
                pengguna_password: $("#Pengguna-pengguna_password").val(),
                pengguna_level_id: $("#Pengguna-pengguna_level_id").val(),
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            dataType: "JSON",
            success: function(response) {
                $("#loadingadd").hide();
                $("#btn_save_pengguna").prop("disabled", false);

                if (response.success === true) {
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $("#modal-add").modal('hide');
                    GetKaryawan();

                } else {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'Pengaduan Gagal Dibuat!'
                    });
                }

            },
            error: function(error) {

                $("#loadingadd").hide();
                $("#btn_save_pengguna").prop("disabled", false);

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

                if (error.responseJSON.pengguna_level_id) {

                    //show alert
                    $('#alert-pengguna_level_id').show();
                    $('#alert-pengguna_level_id').removeClass('d-none');
                    $('#alert-pengguna_level_id').addClass('d-block');

                    //add message to alert
                    $('#alert-pengguna_level_id').html(error.responseJSON.pengguna_level_id[0]);
                }
            }
        });
    });

    $("#btn_update_pengguna").click(function() {
        // console.log($("#filter-tanggal").val());

        $("#loadingedit").show();
        $("#btn_update_pengguna").prop("disabled", true);

        $.ajax({
            async: false,
            type: 'POST',
            url: "/karyawan/update",
            data: {
                pengguna_id: $("#Pengguna-pengguna_id_update").val(),
                pengguna_nik: $("#Pengguna-pengguna_nik_update").val(),
                pengguna_nama: $("#Pengguna-pengguna_nama_update").val(),
                pengguna_email: $("#Pengguna-pengguna_email_update").val(),
                pengguna_password: $("#Pengguna-pengguna_password_update").val(),
                pengguna_level_id: $("#Pengguna-pengguna_level_id_update").val(),
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            dataType: "JSON",
            success: function(response) {
                $("#loadingedit").hide();
                $("#btn_update_pengguna").prop("disabled", false);

                if (response.success === true) {
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $("#modal-edit").modal('hide');
                    GetKaryawan();

                } else {
                    Swal.fire({
                        type: 'error',
                        icon: 'error',
                        title: 'Pengaduan Gagal Dibuat!'
                    });
                }

            },
            error: function(error) {

                $("#loadingedit").hide();
                $("#btn_update_pengguna").prop("disabled", false);

                if (error.responseJSON.pengguna_nama) {

                    //show alert
                    $('#alert-pengguna_nama_update').show();
                    $('#alert-pengguna_nama_update').removeClass('d-none');
                    $('#alert-pengguna_nama_update').addClass('d-block');

                    //add message to alert
                    $('#alert-pengguna_nama_update').html(error.responseJSON.pengguna_nama[0]);
                }

                if (error.responseJSON.pengguna_nik) {

                    //show alert
                    $('#alert-pengguna_nik_update').show();
                    $('#alert-pengguna_nik_update').removeClass('d-none');
                    $('#alert-pengguna_nik_update').addClass('d-block');

                    //add message to alert
                    $('#alert-pengguna_nik_update').html(error.responseJSON.pengguna_nik[0]);
                }

                if (error.responseJSON.pengguna_email) {

                    //show alert
                    $('#alert-pengguna_email_update').show();
                    $('#alert-pengguna_email_update').removeClass('d-none');
                    $('#alert-pengguna_email_update').addClass('d-block');

                    //add message to alert
                    $('#alert-pengguna_email_update').html(error.responseJSON.pengguna_email[0]);
                }

                if (error.responseJSON.pengguna_password) {

                    //show alert
                    $('#alert-pengguna_password_update').show();
                    $('#alert-pengguna_password_update').removeClass('d-none');
                    $('#alert-pengguna_password_update').addClass('d-block');

                    //add message to alert
                    $('#alert-pengguna_password_update').html(error.responseJSON.pengguna_password[0]);
                }

                if (error.responseJSON.pengguna_level_id) {

                    //show alert
                    $('#alert-pengguna_level_id_update').show();
                    $('#alert-pengguna_level_id_update').removeClass('d-none');
                    $('#alert-pengguna_level_id_update').addClass('d-block');

                    //add message to alert
                    $('#alert-pengguna_level_id_update').html(error.responseJSON.pengguna_level_id[0]);
                }
            }
        });
    });

    function GetKaryawan() {
        $("#loading").show();

        $.ajax({
            async: false,
            type: 'GET',
            url: "/karyawan/get_pengguna",
            // data: {
            //     tgl: $("#filter-tanggal").val(),
            //     status: $("#filter-status").val()
            // },
            dataType: "JSON",
            success: function(response) {
                $("#loading").hide();

                $("#table-karyawan > tbody").empty();

                if ($.fn.DataTable.isDataTable('#table-karyawan')) {
                    $('#table-karyawan').DataTable().clear();
                    $('#table-karyawan').DataTable().destroy();
                }

                $.each(response, function(i, v) {
                    $("#table-karyawan > tbody").append(`
                        <tr>
                            <td style="vertical-align:middle; text-align:center;">${i+1}</td>
                            <td style="vertical-align:middle; text-align:center;">${v.pengguna_nama}</td>
                            <td style="vertical-align:middle; text-align:center;">${v.pengguna_email}</td>
                            <td style="vertical-align:middle; text-align:center;">${v.pengguna_level}</td>
                            <td style="vertical-align:middle; text-align:center;">
                                <button class="btn btn-primary btn-sm" onclick="EditKaryawan('${v.pengguna_id}')"><i class="fa fa-pen"></i></button>
                            </td>
                        </tr>
                    `)
                });


                //datatable
                $("#table-karyawan").DataTable();

            }
        });
    }

    function EditKaryawan(id) {
        $("#loadingedit").show();

        $.ajax({
            async: false,
            type: 'GET',
            url: "/karyawan/get_pengguna_by_id",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                $("#loadingedit").hide();
                $("#modal-edit").modal('show');

                $("#Pengguna-pengguna_level_id_update").html('');

                $.each(response, function(i, v) {
                    $("#Pengguna-pengguna_id_update").val(v.pengguna_id);
                    $("#Pengguna-pengguna_nama_update").val(v.pengguna_nama);
                    $("#Pengguna-pengguna_nik_update").val(v.pengguna_nik);
                    $("#Pengguna-pengguna_email_update").val(v.pengguna_email);
                    $("#Pengguna-pengguna_password_update").val(v.pengguna_password);

                    <?php foreach ($data['Level'] as $value) : ?>
                        $("#Pengguna-pengguna_level_id_update").append(`<option value="<?= $value->pengguna_level_id ?>" ${v.pengguna_level_id == '<?= $value->pengguna_level_id ?>' ? 'selected' : ''}><?= $value->pengguna_level ?></option>`);
                    <?php endforeach; ?>
                });
            }
        });
    }

    function DeleteKaryawan(id) {

        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Pastikan data yang sudah anda input benar!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan",
            cancelButtonText: "Tidak, Tutup"
        }).then((result) => {
            if (result.value == true) {
                $("#loading").show();
                //ajax save data

                $.ajax({
                    async: false,
                    type: 'POST',
                    url: "/karyawan/delete",
                    data: {
                        id: id,
                        "_token": $("meta[name='csrf-token']").attr("content")
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $("#loading").hide();

                        if (response.success === true) {
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 3000
                            });
                            GetKaryawan();

                        } else {
                            Swal.fire({
                                type: 'error',
                                icon: 'error',
                                title: 'Karyawan Gagal Dihapus!'
                            });
                        }

                    },
                    error: function(error) {

                        $("#loading").hide();

                        Swal.fire({
                            type: 'error',
                            icon: 'error',
                            title: 'Karyawan gagal dihapus!',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                });
            }
        });
    }
</script>

@endsection