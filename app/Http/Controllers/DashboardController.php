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

            $data['baru'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BARU")->count();
            $data['batal'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "BATAL")->count();
            $data['pending'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "PENDING")->count();
            $data['selesai'] = DB::table('tr_ewadul')->where('tr_ewadul_status', "SELESAI")->count();
            $data['jenis_pengaduan'] = DB::table('jenis_pengaduan')->count();
            $data['pengaduan'] = DB::table('tr_ewadul')->count();
            $data['pengguna'] = DB::table('pengguna')->count();

            return view('dashboard/index', compact('data'));
        } else {
            return redirect()->to('/auth/login');
        }
    }
}
