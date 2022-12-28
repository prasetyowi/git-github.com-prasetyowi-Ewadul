<!-- Menghubungkan dengan view template master -->
@extends('../layout/layout')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Pengaduan')

@section('konten')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengaduan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengaduan</li>
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
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="filter-tanggal">
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="select2" multiple="multiple" id="filter-status" data-placeholder="Pilih Status" style="width: 100%;">
                                    <option value="'BARU'">BARU</option>
                                    <option value="'BATAL'">BATAL</option>
                                    <option value="'PENDING'">PENDING</option>
                                    <option value="'SELESAI'">SELESAI</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <span id="loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                <button type="button" class="btn btn-info" id="btn_search_pengaduan">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="/pengaduan/form" target="_blank" class="btn btn-info">
                                    <i class="fas fa-plus"></i> Form Pengaduan
                                </a>
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
                    <table id="table-pengaduan" class="table table-striped" style="width: 100%;">
                        <thead>
                            <tr class="bg-info">
                                <th style="vertical-align:middle; text-align:center;">#</th>
                                <th style="vertical-align:middle; text-align:center;">No Pengaduan</th>
                                <th style="vertical-align:middle; text-align:center;">Tanggal</th>
                                <th style="vertical-align:middle; text-align:center;">Jenis</th>
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
@endsection

@section('script_function')
<script>
    $("#btn_search_pengaduan").click(function() {
        // console.log($("#filter-tanggal").val());

        $("#loading").show();
        $("#btn_search_pengaduan").prop("disabled", true);

        $.ajax({
            async: false,
            type: 'GET',
            url: "/pengaduan/get_pengaduan_by_filter",
            data: {
                tgl: $("#filter-tanggal").val(),
                status: $("#filter-status").val()
            },
            dataType: "JSON",
            success: function(response) {
                $("#loading").hide();
                $("#btn_search_pengaduan").prop("disabled", false);

                $("#table-pengaduan > tbody").empty();

                if ($.fn.DataTable.isDataTable('#table-pengaduan')) {
                    $('#table-pengaduan').DataTable().clear();
                    $('#table-pengaduan').DataTable().destroy();
                }

                $.each(response, function(i, v) {
                    $("#table-pengaduan > tbody").append(`
                        <tr>
                            <td style="vertical-align:middle; text-align:center;">${i+1}</td>
                            <td style="vertical-align:middle; text-align:center;">${v.tr_ewadul_id}</td>
                            <td style="vertical-align:middle; text-align:center;">${v.tr_ewadul_tgl}</td>
                            <td style="vertical-align:middle; text-align:center;">${v.jenis_pengaduan_desc}</td>
                            <td style="vertical-align:middle; text-align:center;">
                                <button class="btn btn-sm ${v.tr_ewadul_status == 'BARU' ? 'btn-primary' : v.tr_ewadul_status == 'BATAL' ? 'btn-danger': v.tr_ewadul_status == 'PENDING' ? 'btn-warning': v.tr_ewadul_status == 'SELESAI' ? 'btn-success' : '' }">${v.tr_ewadul_status}</button>
                            </td>
                            <td style="vertical-align:middle; text-align:center;">
                                <a href="/pengaduan/edit/?id=${v.tr_ewadul_id}" class="btn btn-sm btn-info" target="_blank"><i class="fa fa-pen"></i></a>
                            </td>
                        </tr>
                    `)
                });


                //datatable
                $("#table-pengaduan").DataTable();

            }
        });
    });
</script>

@endsection