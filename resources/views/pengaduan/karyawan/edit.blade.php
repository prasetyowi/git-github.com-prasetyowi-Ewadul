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
                    <h3 class="card-title">Form Data</h3>

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

                <form method="post" id="upload_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No Pengaduan</label>
                                    <input readonly="readonly" type="text" class="form-control" id="TrEwadul-tr_ewadul_id" name="TrEwadul[tr_ewadul_id]" style="width: 100%;" value="{{ $data['header']->tr_ewadul_id }}">
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_id"></div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input readonly="readonly" type="date" class="form-control" id="TrEwadul-tr_ewadul_tgl" name="TrEwadul[tr_ewadul_tgl]" style="width: 100%;" value="<?= date('Y-m-d', strtotime($data['header']->tr_ewadul_tgl)) ?>">
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_tgl"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class=" col-md-4">
                                <div class="form-group">
                                    <label>Jenis Pengaduan</label>
                                    <select class="form-control select2" id="TrEwadul-jenis_pengaduan_id" name="TrEwadul[jenis_pengaduan_id]" style="width: 100%;" readonly>
                                        <option value="">** Pilih **</option>
                                        @foreach($data['jenis'] as $value)
                                        <option value="{{ $value->jenis_pengaduan_id }}" <?= $data['header']->jenis_pengaduan_id == $value->jenis_pengaduan_id ? 'selected' : '' ?>>{{ $value->jenis_pengaduan_desc }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-jenis_pengaduan_id"></div>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_status" name="TrEwadul[tr_ewadul_status]" style="width: 100%;">
                                        @foreach($data['status'] as $value)
                                        <option value="{{ $value->tr_ewadul_status }}" <?= $data['header']->tr_ewadul_status == $value->tr_ewadul_status ? 'selected' : '' ?>>{{ $value->tr_ewadul_status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_status"></div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" id="TrEwadul-tr_ewadul_desc" name="TrEwadul[tr_ewadul_desc]" style="height:130px;" readonly>{{ $data['header']->tr_ewadul_desc }}</textarea>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_desc"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" id="TrEwadul-tr_ewadul_alamat" name="TrEwadul[tr_ewadul_alamat]" style="width: 100%;" value="{{ $data['header']->tr_ewadul_alamat }}">
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_alamat"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_provinsi" name="TrEwadul[tr_ewadul_provinsi]" style="width: 100%;" onchange="get_kota_by_provinsi(this.value)">
                                        <option value="">** Pilih **</option>
                                        @foreach($data['Provinsi'] as $value)
                                        <option value="{{ $value->kodepos_propinsi }}" {{ $data['header']->tr_ewadul_provinsi == $value->kodepos_propinsi ? 'selected' : '' }}>{{ $value->kodepos_propinsi }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_provinsi"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class=" col-md-4">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_kota" name="TrEwadul[tr_ewadul_kota]" style="width: 100%;" onchange="get_kecamatan_by_kota(this.value)">
                                        <option value="">** Pilih **</option>
                                        @foreach($data['Kota'] as $value)
                                        <option value="{{ $value->kodepos_kota }}" {{ $data['header']->tr_ewadul_kota == $value->kodepos_kota ? 'selected' : '' }}>{{ $value->kodepos_kota }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_kota"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_kecamatan" name="TrEwadul[tr_ewadul_kecamatan]" style="width: 100%;" onchange="get_kelurahan_by_kota_kecamatan(this.value)">
                                        <option value="">** Pilih **</option>
                                        @foreach($data['Kecamatan'] as $value)
                                        <option value="{{ $value->kodepos_kecamatan }}" {{ $data['header']->tr_ewadul_kecamatan == $value->kodepos_kecamatan ? 'selected' : '' }}>{{ $value->kodepos_kecamatan }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_kecamatan"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_kelurahan" name="TrEwadul[tr_ewadul_kelurahan]" style="width: 100%;">
                                        <option value="">** Pilih **</option>
                                        @foreach($data['Kelurahan'] as $value)
                                        <option value="{{ $value->kodepos_kelurahan }}" {{ $data['header']->tr_ewadul_kelurahan == $value->kodepos_kelurahan ? 'selected' : '' }}>{{ $value->kodepos_kelurahan }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_kelurahan"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kodepos</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_kodepos" name="TrEwadul[tr_ewadul_kodepos]" style="width: 100%;">
                                        <option value="">** Pilih **</option>
                                        @foreach($data['Kodepos'] as $value)
                                        <option value="{{ $value->kodepos }}" {{ $data['header']->tr_ewadul_kodepos == $value->kodepos ? 'selected' : '' }}>{{ $value->kodepos }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_kodepos"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class=" col-md-12">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-bukti"><i class="fa fa-search"></i>
                                    Bukti Pengaduan
                                </button>
                                <input type="hidden" id="TrEwadul-tr_ewadul_attechment_edit" name="TrEwadul[tr_ewadul_attechment_edit]" value="{{$data['header']->tr_ewadul_attechment}}">
                                <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_attechment"></div>
                                <!-- <div id="TrEwadul-tr_ewadul_attechment" name="TrEwadul[tr_ewadul_attechment]" class=" row">
                                    <div class="col-lg-6">
                                        <div class="btn-group w-100">
                                            <span class="btn btn-success col fileinput-button">
                                                <i class="fas fa-plus"></i>
                                                <span>Add files</span>
                                            </span>
                                            <button type="submit" class="btn btn-primary col start">
                                                <i class="fas fa-upload"></i>
                                                <span>Start upload</span>
                                            </button>
                                            <button type="reset" class="btn btn-warning col cancel">
                                                <i class="fas fa-times-circle"></i>
                                                <span>Cancel upload</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div class="fileupload-process w-100">
                                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table table-striped files" id="previews">
                                    <div id="template" class="row mt-2">
                                        <div class="col-auto">
                                            <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                        </div>
                                        <div class="col d-flex align-items-center">
                                            <p class="mb-0">
                                                <span class="lead" data-dz-name></span>
                                                (<span data-dz-size></span>)
                                            </p>
                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                        </div>
                                        <div class="col-4 d-flex align-items-center">
                                            <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                            <div class="btn-group">
                                                <button class="btn btn-primary start">
                                                    <i class="fas fa-upload"></i>
                                                    <span>Start</span>
                                                </button>
                                                <button data-dz-remove class="btn btn-warning cancel">
                                                    <i class="fas fa-times-circle"></i>
                                                    <span>Cancel</span>
                                                </button>
                                                <button data-dz-remove class="btn btn-danger delete">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-right">
                        <span id="loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                        <button type="submit" class="btn btn-success" id="btn_save_pengaduan">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="/pengaduan" class="btn btn-danger">
                            <i class="fas fa-undo"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-bukti">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ asset('assets/upload/images/pengaduan/'.$data['header']->tr_ewadul_attechment) }}" style="width: 1000px;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times"></i>Tutup</button>
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

        $('#upload_form').on('submit', function(event) {
            event.preventDefault();

            $("#loading").show();
            $("#btn_save_pengaduan").prop("readonly", true);

            $.ajax({
                url: "/pengaduan/update",
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    $("#loading").hide();
                    $("#btn_save_pengaduan").prop("readonly", false);

                    if (response.success === true) {
                        Swal.fire({
                            type: 'success',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3000
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            icon: 'error',
                            title: 'Pengaduan Gagal Dibuat!'
                        });
                    }

                },
                error: function(error) {

                    $("#loading").hide();
                    $("#btn_save_pengaduan").prop("readonly", false);

                    if (error.responseJSON['TrEwadul.tr_ewadul_id']) {

                        //show alert
                        $('#alert-tr_ewadul_id').show();
                        $('#alert-tr_ewadul_id').removeClass('d-none');
                        $('#alert-tr_ewadul_id').addClass('d-block');

                        //add message to alert
                        $('#alert-tr_ewadul_id').html(error.responseJSON['TrEwadul.tr_ewadul_id'][0]);
                    }

                    if (error.responseJSON['TrEwadul.jenis_pengaduan_id']) {

                        //show alert
                        $('#alert-jenis_pengaduan_id').show();
                        $('#alert-jenis_pengaduan_id').removeClass('d-none');
                        $('#alert-jenis_pengaduan_id').addClass('d-block');

                        //add message to alert
                        $('#alert-jenis_pengaduan_id').html(error.responseJSON['TrEwadul.jenis_pengaduan_id'][0]);
                    }

                    if (error.responseJSON['TrEwadul.tr_ewadul_desc']) {

                        //show alert
                        $('#alert-tr_ewadul_desc').show();
                        $('#alert-tr_ewadul_desc').removeClass('d-none');
                        $('#alert-tr_ewadul_desc').addClass('d-block');

                        //add message to alert
                        $('#alert-tr_ewadul_desc').html(error.responseJSON['TrEwadul.tr_ewadul_desc'][0]);
                    }

                    if (error.responseJSON['TrEwadul.tr_ewadul_alamat']) {

                        //show alert
                        $('#alert-tr_ewadul_alamat').show();
                        $('#alert-tr_ewadul_alamat').removeClass('d-none');
                        $('#alert-tr_ewadul_alamat').addClass('d-block');

                        //add message to alert
                        $('#alert-tr_ewadul_alamat').html(error.responseJSON['TrEwadul.tr_ewadul_alamat'][0]);
                    }

                    if (error.responseJSON['TrEwadul.tr_ewadul_kelurahan']) {

                        //show alert
                        $('#alert-tr_ewadul_kelurahan').show();
                        $('#alert-tr_ewadul_kelurahan').removeClass('d-none');
                        $('#alert-tr_ewadul_kelurahan').addClass('d-block');

                        //add message to alert
                        $('#alert-tr_ewadul_kelurahan').html(error.responseJSON['TrEwadul.tr_ewadul_kelurahan'][0]);
                    }

                    if (error.responseJSON['TrEwadul.tr_ewadul_kecamatan']) {

                        //show alert
                        $('#alert-tr_ewadul_kecamatan').show();
                        $('#alert-tr_ewadul_kecamatan').removeClass('d-none');
                        $('#alert-tr_ewadul_kecamatan').addClass('d-block');

                        //add message to alert
                        $('#alert-tr_ewadul_kecamatan').html(error.responseJSON['TrEwadul.tr_ewadul_kecamatan'][0]);
                    }

                    if (error.responseJSON['TrEwadul.tr_ewadul_kota']) {

                        //show alert
                        $('#alert-tr_ewadul_kota').show();
                        $('#alert-tr_ewadul_kota').removeClass('d-none');
                        $('#alert-tr_ewadul_kota').addClass('d-block');

                        //add message to alert
                        $('#alert-tr_ewadul_kota').html(error.responseJSON['TrEwadul.tr_ewadul_kota'][0]);
                    }

                    if (error.responseJSON['TrEwadul.tr_ewadul_provinsi']) {

                        //show alert
                        $('#alert-tr_ewadul_provinsi').show();
                        $('#alert-tr_ewadul_provinsi').removeClass('d-none');
                        $('#alert-tr_ewadul_provinsi').addClass('d-block');

                        //add message to alert
                        $('#alert-tr_ewadul_provinsi').html(error.responseJSON['TrEwadul.tr_ewadul_provinsi'][0]);
                    }

                    if (error.responseJSON['TrEwadul.tr_ewadul_kodepos']) {

                        //show alert
                        $('#alert-tr_ewadul_kodepos').show();
                        $('#alert-tr_ewadul_kodepos').removeClass('d-none');
                        $('#alert-tr_ewadul_kodepos').addClass('d-block');

                        //add message to alert
                        $('#alert-tr_ewadul_kodepos').html(error.responseJSON['TrEwadul.tr_ewadul_kodepos'][0]);
                    }

                    if (error.responseJSON['TrEwadul.tr_ewadul_tgl']) {

                        //show alert
                        $('#alert-tr_ewadul_tgl').show();
                        $('#alert-tr_ewadul_tgl').removeClass('d-none');
                        $('#alert-tr_ewadul_tgl').addClass('d-block');

                        //add message to alert
                        $('#alert-tr_ewadul_tgl').html(error.responseJSON['TrEwadul.tr_ewadul_tgl'][0]);
                    }

                    if (error.responseJSON['TrEwadul.tr_ewadul_attechment']) {

                        //show alert
                        $('#alert-tr_ewadul_attechment').show();
                        $('#alert-tr_ewadul_attechment').removeClass('d-none');
                        $('#alert-tr_ewadul_attechment').addClass('d-block');

                        //add message to alert
                        $('#alert-tr_ewadul_attechment').html(error.responseJSON['TrEwadul.tr_ewadul_attechment'][0]);
                    }
                }
            })
        });

    });
    //datatable
    $("#table-pengaduan").DataTable();
</script>

@endsection