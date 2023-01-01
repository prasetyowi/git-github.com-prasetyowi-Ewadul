<!-- Menghubungkan dengan view template master -->
@extends('../layout/layout_admin')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Jenis Pengaduan')

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jenis Pengaduan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Jenis Pengaduan</li>
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
                                <button type="button" class="btn btn-info" id="btn_add_jenis_pengaduan" data-toggle="modal" data-target="#modal-add">
                                    <i class="fas fa-plus"></i> Jenis Pengaduan
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
                    <table id="table-jenis-pengaduan" class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr class="bg-info">
                                <th style="vertical-align:middle; text-align:center;">#</th>
                                <th style="vertical-align:middle; text-align:center;">No Pengaduan</th>
                                <th style="vertical-align:middle; text-align:center;">Jenis Pengaduan</th>
                                <th style="vertical-align:middle; text-align:center;">Status</th>
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
                <h4 class="modal-title">Tambah Jenis Pengaduan</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jenis Pengaduan</label>
                            <input type="text" class="form-control" id="JenisPengaduan-jenis_pengaduan_desc" name="JenisPengaduan[jenis_pengaduan_desc]" style="width: 100%;" value="">
                            <div class="text-danger d-none" role="alert" id="alert-jenis_pengaduan_desc"></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingadd" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" class="btn btn-success" id="btn_save_jenis_pengaduan">
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
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-xl">
        <div class="modal-header">
            <h4 class="modal-title">Edit Jenis Pengaduan</h4>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jenis Pengaduan</label>
                            <input type="hidden" class="form-control" id="JenisPengaduan-jenis_pengaduan_id_update" name="JenisPengaduan[jenis_pengaduan_id_update]" value="">
                            <input type="text" class="form-control" id="JenisPengaduan-jenis_pengaduan_desc_update" name="JenisPengaduan[jenis_pengaduan_desc_update]" style="width: 100%;" value="">
                            <div class="text-danger d-none" role="alert" id="alert-jenis_pengaduan_desc_update"></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class=" col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2" id="JenisPengaduan-is_aktif_update" name="JenisPengaduan[is_aktif_update]" style="width: 100%;">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            <div class="text-danger d-none" role="alert" id="alert-is_aktif_update"></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <div class="modal-footer">
                <span id="loadingedit" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                <button type="button" class="btn btn-success" id="btn_update_jenis_pengaduan">
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
        GetJenisPengaduan();
    });

    $("#btn_save_jenis_pengaduan").click(function() {
        // console.log($("#filter-tanggal").val());

        $("#loadingadd").show();
        $("#btn_save_jenis_pengaduan").prop("disabled", true);

        $.ajax({
            async: false,
            type: 'POST',
            url: "/jenispengaduan/store",
            data: {
                jenis_pengaduan_desc: $("#JenisPengaduan-jenis_pengaduan_desc").val(),
                is_aktif: 1,
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            dataType: "JSON",
            success: function(response) {
                $("#loadingadd").hide();
                $("#btn_save_jenis_pengaduan").prop("disabled", false);

                if (response.success === true) {
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $("#modal-add").modal('hide');
                    GetJenisPengaduan();

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
                $("#btn_save_jenis_pengaduan").prop("disabled", false);

                if (error.responseJSON['jenis_pengaduan_desc']) {

                    //show alert
                    $('#alert-jenis_pengaduan_desc').show();
                    $('#alert-jenis_pengaduan_desc').removeClass('d-none');
                    $('#alert-jenis_pengaduan_desc').addClass('d-block');

                    //add message to alert
                    $('#alert-jenis_pengaduan_desc').html(error.responseJSON['jenis_pengaduan_desc'][0]);
                }
            }
        });
    });

    $("#btn_update_jenis_pengaduan").click(function() {
        // console.log($("#filter-tanggal").val());

        $("#loadingedit").show();
        $("#btn_update_jenis_pengaduan").prop("disabled", true);

        $.ajax({
            async: false,
            type: 'POST',
            url: "/jenispengaduan/update",
            data: {
                jenis_pengaduan_id: $("#JenisPengaduan-jenis_pengaduan_id_update").val(),
                jenis_pengaduan_desc: $("#JenisPengaduan-jenis_pengaduan_desc_update").val(),
                is_aktif: 1,
                "_token": $("meta[name='csrf-token']").attr("content")
            },
            dataType: "JSON",
            success: function(response) {
                $("#loadingedit").hide();
                $("#btn_update_jenis_pengaduan").prop("disabled", false);

                if (response.success === true) {
                    Swal.fire({
                        type: 'success',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $("#modal-edit").modal('hide');
                    GetJenisPengaduan();

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
                $("#btn_update_jenis_pengaduan").prop("disabled", false);

                if (error.responseJSON['jenis_pengaduan_desc']) {

                    //show alert
                    $('#alert-jenis_pengaduan_desc_update').show();
                    $('#alert-jenis_pengaduan_desc_update').removeClass('d-none');
                    $('#alert-jenis_pengaduan_desc_update').addClass('d-block');

                    //add message to alert
                    $('#alert-jenis_pengaduan_desc_update').html(error.responseJSON['jenis_pengaduan_desc'][0]);
                }
            }
        });
    });

    function GetJenisPengaduan() {
        $("#loading").show();

        $.ajax({
            async: false,
            type: 'GET',
            url: "/jenispengaduan/get_jenis_pengaduan",
            // data: {
            //     tgl: $("#filter-tanggal").val(),
            //     status: $("#filter-status").val()
            // },
            dataType: "JSON",
            success: function(response) {
                $("#loading").hide();

                $("#table-jenis-pengaduan > tbody").empty();

                if ($.fn.DataTable.isDataTable('#table-jenis-pengaduan')) {
                    $('#table-jenis-pengaduan').DataTable().clear();
                    $('#table-jenis-pengaduan').DataTable().destroy();
                }

                $.each(response, function(i, v) {
                    $("#table-jenis-pengaduan > tbody").append(`
                        <tr>
                            <td style="vertical-align:middle; text-align:center;">${i+1}</td>
                            <td style="vertical-align:middle; text-align:center;">${v.jenis_pengaduan_id}</td>
                            <td style="vertical-align:middle; text-align:center;">${v.jenis_pengaduan_desc}</td>
                            <td style="vertical-align:middle; text-align:center;"><button class="btn ${v.is_aktif == '1' ? 'btn-success' : 'btn-danger'} btn-sm">${v.is_aktif == '1' ? 'Aktif' : 'Tidak Aktif'}</button></td>
                            <td style="vertical-align:middle; text-align:center;">
                                <button class="btn btn-primary btn-sm" onclick="EditJenisPengaduan('${v.jenis_pengaduan_id}')"><i class="fa fa-pen"></i></button>
                                <button class="btn btn-danger btn-sm" onclick="DeleteJenisPengaduan('${v.jenis_pengaduan_id}')"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    `)
                });


                //datatable
                $("#table-jenis-pengaduan").DataTable();

            }
        });
    }

    function EditJenisPengaduan(id) {
        $("#loadingedit").show();

        $.ajax({
            async: false,
            type: 'GET',
            url: "/jenispengaduan/get_jenis_pengaduan_by_id",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                $("#loadingedit").hide();
                $("#modal-edit").modal('show');

                $("#JenisPengaduan-is_aktif_update").html('');

                $.each(response, function(i, v) {
                    $("#JenisPengaduan-jenis_pengaduan_id_update").val(v.jenis_pengaduan_id);
                    $("#JenisPengaduan-jenis_pengaduan_desc_update").val(v.jenis_pengaduan_desc);
                    $("#JenisPengaduan-is_aktif_update").append(`<option value="1" ${v.is_aktif_update == '1' ? 'selected' : ''}>Aktif</option>`);
                    $("#JenisPengaduan-is_aktif_update").append(`<option value="0" ${v.is_aktif_update == '0' ? 'selected' : ''}>Tidak Aktif</option>`);
                });
            }
        });
    }

    function DeleteJenisPengaduan(id) {

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
                    url: "/jenispengaduan/delete",
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
                            GetJenisPengaduan();

                        } else {
                            Swal.fire({
                                type: 'error',
                                icon: 'error',
                                title: 'Jenis Pengaduan Gagal Dihapus!'
                            });
                        }

                    },
                    error: function(error) {

                        $("#loading").hide();

                        Swal.fire({
                            type: 'error',
                            icon: 'error',
                            title: 'Jenis pengaduan gagal dihapus!',
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