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
                                    <select class="form-control select2" id="TrEwadul-jenis_pengaduan_id" name="TrEwadul[jenis_pengaduan_id]" style="width: 100%;" disabled>
                                        <option value="">** Pilih **</option>
                                        @foreach($data['jenis'] as $value)
                                        <option value="{{ $value->jenis_pengaduan_id }}" <?= $data['header']->jenis_pengaduan_id == $value->jenis_pengaduan_id ? 'selected' : '' ?>>{{ $value->jenis_pengaduan_desc }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-jenis_pengaduan_id"></div>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <input readonly="readonly" type="text" class="form-control" id="TrEwadul-tr_ewadul_status" name="TrEwadul[tr_ewadul_status]" style="width: 100%;" value="{{ $data['header']->tr_ewadul_status }}">
                                </div>
                                <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_status"></div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" id="TrEwadul-tr_ewadul_desc" name="TrEwadul[tr_ewadul_desc]" style="height:130px;" disabled>{{ $data['header']->tr_ewadul_desc }}</textarea>
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
                                    <input readonly="readonly" type="text" class="form-control" id="TrEwadul-tr_ewadul_alamat" name="TrEwadul[tr_ewadul_alamat]" style="width: 100%;" value="{{ $data['header']->tr_ewadul_alamat }}">
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_alamat"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_kelurahan" name="TrEwadul[tr_ewadul_kelurahan]" style="width: 100%;" disabled>
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_kelurahan"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_kecamatan" name="TrEwadul[tr_ewadul_kecamatan]" style="width: 100%;" disabled>
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_kecamatan"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class=" col-md-4">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_kota" name="TrEwadul[tr_ewadul_kota]" style="width: 100%;" disabled>
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_kota"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_provinsi" name="TrEwadul[tr_ewadul_provinsi]" style="width: 100%;" disabled>
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_provinsi"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kodepos</label>
                                    <select class="form-control select2" id="TrEwadul-tr_ewadul_kodepos" name="TrEwadul[tr_ewadul_kodepos]" style="width: 100%;" disabled>
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                    <div class="text-danger d-none" role="alert" id="alert-tr_ewadul_kodepos"></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class=" col-md-12">
                                <label>Upload Bukti</label><br><br>
                                <img src="{{ asset('assets/upload/images/pengaduan/'.$data['header']->tr_ewadul_attechment) }}" style="width:350px;">
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
@endsection

@section('script_function')


@endsection