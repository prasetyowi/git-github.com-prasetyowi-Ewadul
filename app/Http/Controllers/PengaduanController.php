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
        return view('pengaduan/index');
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

        return view('pengaduan/form', compact('data'));
    }

    public function get_kecamatan_by_kota($kota)
    {
        //get all posts from Models
        $data = "Tandes";

        //return view with data
        return $data;
    }

    public function get_kelurahan_by_kota_kecamatan($kota, $kecamatan)
    {
        //get all posts from Models
        $data = "Manukan";

        //return view with data
        return $data;
    }

    public function get_kodepos_by_kota_kecamatan_kelurahan($kota, $kecamatan, $kelurahan)
    {
        //get all posts from Models
        $data = "60185";

        //return view with data
        return $data;
    }

    public function get_pengaduan_today()
    {
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
                            ORDER BY DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y'),pengaduan.tr_ewadul_id ASC");


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

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan Berhasil Dibuat!',
            'data'    => $post
        ]);
    }
}
