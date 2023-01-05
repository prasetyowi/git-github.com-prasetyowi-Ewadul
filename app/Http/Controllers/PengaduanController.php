<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PengaduanController extends Controller
{
    public function index()
    {
        if (Session::get('login') == TRUE) {
            $data['notifikasi'] = app('App\Http\Controllers\NotifikasiController')->get_notifikasi();

            return view('pengaduan/index', compact('data'));
        } else {
            return redirect()->to('/auth/login');
        }
    }

    public function form()
    {

        $tr_ewadul_id = "";

        $kode = "SBY/" . date('ymd');
        $num_rows = DB::table('tr_ewadul')->where('tr_ewadul_id', 'like', '%' . $kode . '%')->count() + 1;

        if ($num_rows >= 0 && $num_rows < 10) {
            $tr_ewadul_id = $kode . "/000" . $num_rows;
        } else if ($num_rows >= 10 && $num_rows < 100) {
            $tr_ewadul_id = $kode . "/00" . $num_rows;
        } else if ($num_rows >= 100 && $num_rows < 1000) {
            $tr_ewadul_id = $kode . "/0" . $num_rows;
        } else if ($num_rows >= 1000) {
            $tr_ewadul_id = $kode . "/" . $num_rows;
        }

        $data['jenis'] = DB::table('jenis_pengaduan')->where('is_aktif', 1)->get();
        $data['kota'] = "Surabaya";
        $data['tr_ewadul_id'] = $tr_ewadul_id;
        $data['notifikasi'] = app('App\Http\Controllers\NotifikasiController')->get_notifikasi();

        $data['Provinsi'] = DB::table('wilayah_kodepos')->select('kodepos_propinsi')->groupByRaw('kodepos_propinsi')->where('kodepos_propinsi', "JAWA TIMUR")->get();
        $data['Kota'] = DB::table('wilayah_kodepos')->select('kodepos_kota')->groupByRaw('kodepos_kota')->where('kodepos_propinsi', "JAWA TIMUR")->get();
        $data['Kecamatan'] = DB::table('wilayah_kodepos')->select('kodepos_kecamatan')->groupByRaw('kodepos_kecamatan')->where('kodepos_propinsi', "JAWA TIMUR")->get();
        $data['Kelurahan'] = DB::table('wilayah_kodepos')->select('kodepos_kelurahan')->groupByRaw('kodepos_kelurahan')->where('kodepos_propinsi', "JAWA TIMUR")->get();
        $data['Kodepos'] = DB::table('wilayah_kodepos')->select('kodepos')->groupByRaw('kodepos')->where('kodepos_propinsi', "JAWA TIMUR")->get();

        if (Session::get('pengguna_level_id') == "1") {
            $data['status'] = DB::table('tr_ewadul_status')->get();
        } else {
            $data['status'] = DB::table('tr_ewadul_status')->whereNotIn('tr_ewadul_status', array("BATAL", "SELESAI"))->get();
        }

        if (Session::get('login') == TRUE) {
            return view('pengaduan/form', compact('data'));
        } else {
            return redirect()->to('/auth/login');
        }
    }

    public function edit(Request $request)
    {
        $data['header'] = DB::table('tr_ewadul')->where('tr_ewadul_id', $request->id)->get()[0];
        $data['jenis'] = DB::table('jenis_pengaduan')->where('is_aktif', 1)->get();
        $data['notifikasi'] = app('App\Http\Controllers\NotifikasiController')->get_notifikasi();

        $data['Provinsi'] = DB::table('wilayah_kodepos')->select('kodepos_propinsi')->groupByRaw('kodepos_propinsi')->where('kodepos_propinsi', "JAWA TIMUR")->get();
        $data['Kota'] = DB::table('wilayah_kodepos')->select('kodepos_kota')->groupByRaw('kodepos_kota')->where('kodepos_propinsi', "JAWA TIMUR")->get();
        $data['Kecamatan'] = DB::table('wilayah_kodepos')->select('kodepos_kecamatan')->groupByRaw('kodepos_kecamatan')->where('kodepos_propinsi', "JAWA TIMUR")->get();
        $data['Kelurahan'] = DB::table('wilayah_kodepos')->select('kodepos_kelurahan')->groupByRaw('kodepos_kelurahan')->where('kodepos_propinsi', "JAWA TIMUR")->get();
        $data['Kodepos'] = DB::table('wilayah_kodepos')->select('kodepos')->groupByRaw('kodepos')->where('kodepos_propinsi', "JAWA TIMUR")->get();

        if (Session::get('pengguna_level_id') == "1") {
            $data['status'] = DB::table('tr_ewadul_status')->get();
        } else {
            $data['status'] = DB::table('tr_ewadul_status')->whereNotIn('tr_ewadul_status', array("BATAL", "SELESAI"))->get();
        }

        if (Session::get('pengguna_level_id') == "1") {
            return view('pengaduan/karyawan/edit', compact('data'));
        } else if (Session::get('pengguna_level_id') == "2") {
            return view('pengaduan/karyawan/edit', compact('data'));
        } else if (Session::get('pengguna_level_id') == "3") {
            return view('pengaduan/edit', compact('data'));
        }
    }

    public function detail(Request $request)
    {
        $data['header'] = DB::table('tr_ewadul')->where('tr_ewadul_id', $request->id)->get()[0];
        $data['jenis'] = DB::table('jenis_pengaduan')->where('is_aktif', 1)->get();
        $data['notifikasi'] = app('App\Http\Controllers\NotifikasiController')->get_notifikasi();

        return view('pengaduan/detail', compact('data'));
    }

    public function get_kota_by_provinsi($provinsi)
    {
        $data = DB::table('wilayah_kodepos')->where('kodepos_provinsi', $provinsi)->get();
        return $data;
    }

    public function get_kecamatan_by_kota($kota)
    {
        $data = DB::table('wilayah_kodepos')->where('kodepos_kota', $kota)->get();
        return $data;
    }

    public function get_kelurahan_by_kota_kecamatan($kota, $kecamatan)
    {
        $data = DB::table('wilayah_kodepos')->where('kodepos_kota', $kota)->where('kodepos_kecamatan', $kecamatan)->get();
        return $data;
    }

    public function get_kodepos_by_kota_kecamatan_kelurahan($kota, $kecamatan, $kelurahan)
    {
        $data = DB::table('wilayah_kodepos')->where('kodepos_kota', $kota)->where('kodepos_kecamatan', $kecamatan)->where('kodepos_kelurahan', $kelurahan)->get();
        return $data;
    }

    public function get_pengaduan_today()
    {
        if (Session::get('pengguna_level_id') == "3") {

            //get all posts from Models
            $data = DB::select("SELECT
                            pengaduan.tr_ewadul_id,
                            pengaduan.jenis_pengaduan_id,
                            pengaduan.jenis_pengaduan_id,
                            jenis.jenis_pengaduan_desc,
                            DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y') AS tr_ewadul_tgl,
                            pengaduan.tr_ewadul_status
                            FROM tr_ewadul pengaduan
                            LEFT JOIN jenis_pengaduan jenis
                            ON jenis.jenis_pengaduan_id = pengaduan.jenis_pengaduan_id
                            WHERE DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%Y-%m-%d') = '" . date('Y-m-d') . "'
                            AND pengaduan.pengguna_id = '" . Session::get('pengguna_id') . "'
                            ORDER BY DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y'),pengaduan.tr_ewadul_id ASC");
        } else {

            //get all posts from Models
            $data = DB::select("SELECT
                            pengaduan.tr_ewadul_id,
                            pengaduan.jenis_pengaduan_id,
                            pengaduan.jenis_pengaduan_id,
                            jenis.jenis_pengaduan_desc,
                            DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y') AS tr_ewadul_tgl,
                            pengaduan.tr_ewadul_status
                            FROM tr_ewadul pengaduan
                            LEFT JOIN jenis_pengaduan jenis
                            ON jenis.jenis_pengaduan_id = pengaduan.jenis_pengaduan_id
                            WHERE DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%Y-%m-%d') = '" . date('Y-m-d') . "'
                            ORDER BY DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y'),pengaduan.tr_ewadul_id ASC");
        }

        //return view with data
        return $data;
    }

    public function get_pengaduan_by_filter(Request $request)
    {
        $status = $request->status;
        $tgl = explode(" - ", $request->tgl);

        $tgl1 = date('Y-m-d', strtotime($tgl[0]));
        $tgl2 = date('Y-m-d', strtotime($tgl[1]));

        if ($status == "") {
        } else {
            $status = " AND pengaduan.tr_ewadul_status IN (" . implode(",", $status) . ")";
        }

        if (Session::get('pengguna_level_id') == "3") {

            //get all posts from Models
            $data = DB::select("SELECT
                            pengaduan.tr_ewadul_id,
                            pengaduan.jenis_pengaduan_id,
                            pengaduan.jenis_pengaduan_id,
                            jenis.jenis_pengaduan_desc,
                            DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y') AS tr_ewadul_tgl,
                            pengaduan.tr_ewadul_status
                            FROM tr_ewadul pengaduan
                            LEFT JOIN jenis_pengaduan jenis
                            ON jenis.jenis_pengaduan_id = pengaduan.jenis_pengaduan_id
                            WHERE DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%Y-%m-%d') BETWEEN'" . $tgl1 . "' AND'" . $tgl2 . "'
                            AND pengaduan.pengguna_id = '" . Session::get('pengguna_id') . "'
                            " . $status . "
                            ORDER BY DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y') DESC, pengaduan.tr_ewadul_id DESC");
        } else {

            //get all posts from Models
            $data = DB::select("SELECT
                            pengaduan.tr_ewadul_id,
                            pengaduan.jenis_pengaduan_id,
                            pengaduan.jenis_pengaduan_id,
                            jenis.jenis_pengaduan_desc,
                            DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y') AS tr_ewadul_tgl,
                            pengaduan.tr_ewadul_status
                            FROM tr_ewadul pengaduan
                            LEFT JOIN jenis_pengaduan jenis
                            ON jenis.jenis_pengaduan_id = pengaduan.jenis_pengaduan_id
                            WHERE DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%Y-%m-%d') BETWEEN'" . $tgl1 . "' AND'" . $tgl2 . "'
                            " . $status . "
                            ORDER BY DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y') DESC, pengaduan.tr_ewadul_id DESC");
        }

        //return view with data
        return $data;
    }

    public function store(Request $request)
    {

        //define validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'TrEwadul.tr_ewadul_id'     => 'required',
                'TrEwadul.jenis_pengaduan_id'     => 'required',
                'TrEwadul.tr_ewadul_desc'     => 'required',
                'TrEwadul.tr_ewadul_alamat'     => 'required',
                'TrEwadul.tr_ewadul_kelurahan'     => 'required',
                'TrEwadul.tr_ewadul_kecamatan'     => 'required',
                'TrEwadul.tr_ewadul_kota'     => 'required',
                'TrEwadul.tr_ewadul_provinsi'     => 'required',
                'TrEwadul.tr_ewadul_kodepos'     => 'required',
                'TrEwadul.tr_ewadul_tgl'     => 'required',
                'TrEwadul.tr_ewadul_attechment'     => 'required'
            ],
            [
                'TrEwadul.tr_ewadul_id.required' => 'TR Ewadul ID tidak boleh kosong!',
                'TrEwadul.jenis_pengaduan_id.required' => 'Jenis Pengaduan tidak boleh kosong!',
                'TrEwadul.tr_ewadul_desc.required' => 'Deskripsi tidak boleh kosong!',
                'TrEwadul.tr_ewadul_alamat.required' => 'Alamat tidak boleh kosong!',
                'TrEwadul.tr_ewadul_kelurahan.required' => 'Keluarahan tidak boleh kosong!',
                'TrEwadul.tr_ewadul_kecamatan.required' => 'Kecamatan tidak boleh kosong!',
                'TrEwadul.tr_ewadul_kota.required' => 'Kota tidak boleh kosong!',
                'TrEwadul.tr_ewadul_provinsi.required' => 'Provinsi tidak boleh kosong!',
                'TrEwadul.tr_ewadul_kodepos.required' => 'Kodepos tidak boleh kosong!',
                'TrEwadul.tr_ewadul_tgl.required' => 'Tanggal tidak boleh kosong!',
                'TrEwadul.tr_ewadul_attechment.required' => 'Upload Bukti tidak boleh kosong!'
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->TrEwadul['tr_ewadul_attechment'];
        // return $request->TrEwadul['jenis_pengaduan_id'];

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/upload/images/pengaduan'), $new_name);

        $post = DB::table('tr_ewadul')->insert([
            'tr_ewadul_id' => $request->TrEwadul['tr_ewadul_id'],
            'jenis_pengaduan_id' => $request->TrEwadul['jenis_pengaduan_id'],
            'tr_ewadul_desc' => $request->TrEwadul['tr_ewadul_desc'],
            'tr_ewadul_alamat' => $request->TrEwadul['tr_ewadul_alamat'],
            'tr_ewadul_kelurahan' => $request->TrEwadul['tr_ewadul_kelurahan'],
            'tr_ewadul_kecamatan' => $request->TrEwadul['tr_ewadul_kecamatan'],
            'tr_ewadul_kota' => $request->TrEwadul['tr_ewadul_kota'],
            'tr_ewadul_provinsi' => $request->TrEwadul['tr_ewadul_provinsi'],
            'tr_ewadul_kodepos' => $request->TrEwadul['tr_ewadul_kodepos'],
            'tr_ewadul_tgl' => $request->TrEwadul['tr_ewadul_tgl'],
            'tr_ewadul_status' => $request->TrEwadul['tr_ewadul_status'],
            'tr_ewadul_attechment' => $new_name,
            'tgl_created' => date('Y-m-d H:i:s'),
            'tgl_updated' => date('Y-m-d H:i:s'),
            'pengguna_id' => Session::get('pengguna_id')
        ]);

        $post = DB::table('notifikasi_pengaduan')->insert([
            'tr_ewadul_id' => $request->TrEwadul['tr_ewadul_id'],
            'tgl_buat' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'pengguna_id' => Session::get('pengguna_id'),
            'is_lihat' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan Berhasil Dibuat!',
            'data'    => $post
        ]);
    }

    public function update(Request $request)
    {
        //define validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'TrEwadul.tr_ewadul_id'     => 'required',
                'TrEwadul.jenis_pengaduan_id'     => 'required',
                'TrEwadul.tr_ewadul_desc'     => 'required',
                'TrEwadul.tr_ewadul_alamat'     => 'required',
                'TrEwadul.tr_ewadul_kelurahan'     => 'required',
                'TrEwadul.tr_ewadul_kecamatan'     => 'required',
                'TrEwadul.tr_ewadul_kota'     => 'required',
                'TrEwadul.tr_ewadul_provinsi'     => 'required',
                'TrEwadul.tr_ewadul_kodepos'     => 'required',
                'TrEwadul.tr_ewadul_tgl'     => 'required',
                'TrEwadul.tr_ewadul_attechment_edit'     => 'required'
            ],
            [
                'TrEwadul.tr_ewadul_id.required' => 'TR Ewadul ID tidak boleh kosong!',
                'TrEwadul.jenis_pengaduan_id.required' => 'Jenis Pengaduan tidak boleh kosong!',
                'TrEwadul.tr_ewadul_desc.required' => 'Deskripsi tidak boleh kosong!',
                'TrEwadul.tr_ewadul_alamat.required' => 'Alamat tidak boleh kosong!',
                'TrEwadul.tr_ewadul_kelurahan.required' => 'Keluarahan tidak boleh kosong!',
                'TrEwadul.tr_ewadul_kecamatan.required' => 'Kecamatan tidak boleh kosong!',
                'TrEwadul.tr_ewadul_kota.required' => 'Kota tidak boleh kosong!',
                'TrEwadul.tr_ewadul_provinsi.required' => 'Provinsi tidak boleh kosong!',
                'TrEwadul.tr_ewadul_kodepos.required' => 'Kodepos tidak boleh kosong!',
                'TrEwadul.tr_ewadul_tgl.required' => 'Tanggal tidak boleh kosong!',
                'TrEwadul.tr_ewadul_attechment_edit.required' => 'Upload Bukti tidak boleh kosong!'
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        // return $request->TrEwadul['jenis_pengaduan_id'];

        if (!isset($request->TrEwadul['tr_ewadul_attechment'])) {

            $post = DB::table('tr_ewadul')->where('tr_ewadul_id', $request->TrEwadul['tr_ewadul_id'])->update([
                'jenis_pengaduan_id' => $request->TrEwadul['jenis_pengaduan_id'],
                'tr_ewadul_desc' => $request->TrEwadul['tr_ewadul_desc'],
                'tr_ewadul_alamat' => $request->TrEwadul['tr_ewadul_alamat'],
                'tr_ewadul_kelurahan' => $request->TrEwadul['tr_ewadul_kelurahan'],
                'tr_ewadul_kecamatan' => $request->TrEwadul['tr_ewadul_kecamatan'],
                'tr_ewadul_kota' => $request->TrEwadul['tr_ewadul_kota'],
                'tr_ewadul_provinsi' => $request->TrEwadul['tr_ewadul_provinsi'],
                'tr_ewadul_kodepos' => $request->TrEwadul['tr_ewadul_kodepos'],
                'tr_ewadul_tgl' => $request->TrEwadul['tr_ewadul_tgl'],
                'tr_ewadul_status' => $request->TrEwadul['tr_ewadul_status'],
                'tr_ewadul_attechment' => $request->TrEwadul['tr_ewadul_attechment_edit'],
                'tgl_updated' => date('Y-m-d H:i:s')
            ]);
        } else {

            $image = $request->TrEwadul['tr_ewadul_attechment'];

            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/upload/images/pengaduan'), $new_name);

            $post = DB::table('tr_ewadul')->where('tr_ewadul_id', $request->TrEwadul['tr_ewadul_id'])->update([
                'jenis_pengaduan_id' => $request->TrEwadul['jenis_pengaduan_id'],
                'tr_ewadul_desc' => $request->TrEwadul['tr_ewadul_desc'],
                'tr_ewadul_alamat' => $request->TrEwadul['tr_ewadul_alamat'],
                'tr_ewadul_kelurahan' => $request->TrEwadul['tr_ewadul_kelurahan'],
                'tr_ewadul_kecamatan' => $request->TrEwadul['tr_ewadul_kecamatan'],
                'tr_ewadul_kota' => $request->TrEwadul['tr_ewadul_kota'],
                'tr_ewadul_provinsi' => $request->TrEwadul['tr_ewadul_provinsi'],
                'tr_ewadul_kodepos' => $request->TrEwadul['tr_ewadul_kodepos'],
                'tr_ewadul_tgl' => $request->TrEwadul['tr_ewadul_tgl'],
                'tr_ewadul_status' => $request->TrEwadul['tr_ewadul_status'],
                'tr_ewadul_attechment' => $new_name,
                'tgl_updated' => date('Y-m-d H:i:s')
            ]);
        }

        $post = DB::table('notifikasi_pengaduan')->insert([
            'tr_ewadul_id' => $request->TrEwadul['tr_ewadul_id'],
            'tgl_buat' => date('Y-m-d H:i:s'),
            'tgl_update' => date('Y-m-d H:i:s'),
            'pengguna_id' => Session::get('pengguna_id'),
            'is_lihat' => 0
        ]);

        if (($request->TrEwadul['tr_ewadul_status'] == "DALAM PROSES" || $request->TrEwadul['tr_ewadul_status'] == "BUTUH PERSETUJUAN") && (Session::get('pengguna_level_id') == "1" || Session::get('pengguna_level_id') == "2")) {
            $post = DB::table('tr_ewadul_proses')->insert([
                'tr_ewadul_id' => $request->TrEwadul['tr_ewadul_id'],
                'tgl_proses_pengaduan' => date('Y-m-d H:i:s'),
                'pengguna_id' => Session::get('pengguna_id')
            ]);
        } else if (($request->TrEwadul['tr_ewadul_status'] == "SELESAI" || $request->TrEwadul['tr_ewadul_status'] == "BATAL") && Session::get('pengguna_level_id') == "1") {
            $post = DB::table('tr_ewadul_approval')->insert([
                'tr_ewadul_id' => $request->TrEwadul['tr_ewadul_id'],
                'tgl_approval_pengaduan' => date('Y-m-d H:i:s'),
                'pengguna_id' => Session::get('pengguna_id')
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan Berhasil Diubah!',
            'data'    => $post
        ]);
    }

    public function update_pengaduan_kemarin(Request $request)
    {
        $post = DB::table('tr_ewadul')->where('tr_ewadul_status', "BARU")->where('tr_ewadul_tgl', '<', date('Y-m-d'))->update([
            'tr_ewadul_status' => "PENDING"
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan Berhasil Diubah!',
            'data'    => $post
        ]);
    }
}
