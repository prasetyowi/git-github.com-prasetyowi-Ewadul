<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (Session::get('login') == TRUE) {
            $data['jenis_pengaduan'] = DB::table('jenis_pengaduan')->count();
            $data['pengguna'] = DB::table('pengguna')->where('pengguna_level_id', "3")->count();
            $data['karyawan'] = DB::table('pengguna')->where('pengguna_level_id', "2")->count();
            $data['notifikasi'] = app('App\Http\Controllers\NotifikasiController')->get_notifikasi();

            if (Session::get('pengguna_level_id') == "1") {
                $data['pengaduan'] = DB::table('tr_ewadul')->count();
                $data['baru'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BARU")->count();
                $data['batal'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BATAL")->count();
                $data['pending'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "PENDING")->count();
                $data['dalam_proses'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "DALAM PROSES")->count();
                $data['butuh_persetujuan'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BUTUH PERSETUJUAN")->count();
                $data['selesai'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "SELESAI")->count();

                $data['pengaduan_terbaru'] = DB::select("SELECT
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
                            ORDER BY DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y'),pengaduan.tr_ewadul_id DESC
                            LIMIT 5");

                return view('dashboard/admin/index', compact('data'));
            } else if (Session::get('pengguna_level_id') == "2") {
                $data['pengaduan'] = DB::table('tr_ewadul')->count();
                $data['baru'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BARU")->count();
                $data['batal'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BATAL")->count();
                $data['pending'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "PENDING")->count();
                $data['dalam_proses'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "DALAM PROSES")->count();
                $data['butuh_persetujuan'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BUTUH PERSETUJUAN")->count();
                $data['selesai'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "SELESAI")->count();

                $data['pengaduan_terbaru'] = DB::select("SELECT
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
                            ORDER BY DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y'),pengaduan.tr_ewadul_id DESC
                            LIMIT 5");

                return view('dashboard/karyawan/index', compact('data'));
            } else if (Session::get('pengguna_level_id') == "3") {

                $data['pengaduan'] = DB::table('tr_ewadul')->where('pengguna_id', Session::get('pengguna_id'))->count();
                $data['baru'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BARU")->where('pengguna_id', Session::get('pengguna_id'))->count();
                $data['batal'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BATAL")->where('pengguna_id', Session::get('pengguna_id'))->count();
                $data['pending'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "PENDING")->where('pengguna_id', Session::get('pengguna_id'))->count();
                $data['dalam_proses'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "DALAM PROSES")->where('pengguna_id', Session::get('pengguna_id'))->count();
                $data['butuh_persetujuan'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BUTUH PERSETUJUAN")->where('pengguna_id', Session::get('pengguna_id'))->count();
                $data['selesai'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "SELESAI")->where('pengguna_id', Session::get('pengguna_id'))->count();

                $data['pengaduan_terbaru'] = DB::select("SELECT
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
                            ORDER BY DATE_FORMAT(pengaduan.tr_ewadul_tgl,'%d-%m-%Y'),pengaduan.tr_ewadul_id DESC
                            LIMIT 5");

                return view('dashboard/pengguna/index', compact('data'));
            }
        } else {
            return redirect()->to('/auth/login');
        }
    }
}
