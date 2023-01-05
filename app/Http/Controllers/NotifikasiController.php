<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class NotifikasiController extends Controller
{
    public function get_notifikasi()
    {
        if (Session::get('pengguna_level_id') == "1" || Session::get('pengguna_level_id') == "2") {
            $data = DB::select("SELECT
                            notifikasi.notifikasi_id,
                            notifikasi.tr_ewadul_id,
                            tr_ewadul.tr_ewadul_status,
                            time_to_sec(timediff(NOW(), notifikasi.tgl_buat)) / 3600 AS hour_ago,
                            notifikasi.pengguna_id,
                            notifikasi.is_lihat
                            FROM notifikasi_pengaduan notifikasi
                            INNER JOIN tr_ewadul
                            ON tr_ewadul.tr_ewadul_id = notifikasi.tr_ewadul_id
                            WHERE notifikasi.is_lihat = '0'
                            ORDER BY notifikasi.tgl_buat DESC
                            LIMIT 10");
        } else {
            $data = DB::select("SELECT
                            notifikasi.notifikasi_id,
                            notifikasi.tr_ewadul_id,
                            tr_ewadul.tr_ewadul_status,
                            time_to_sec(timediff(NOW(), notifikasi.tgl_buat)) / 3600 AS hour_ago,
                            notifikasi.pengguna_id,
                            notifikasi.is_lihat
                            FROM notifikasi_pengaduan notifikasi
                            INNER JOIN tr_ewadul
                            ON tr_ewadul.tr_ewadul_id = notifikasi.tr_ewadul_id
                            WHERE notifikasi.pengguna_id = '" . Session::get('pengguna_id') . "'
                            AND notifikasi.is_lihat = '0'
                            ORDER BY notifikasi.tgl_buat DESC
                            LIMIT 10");
        }

        return $data;
    }

    public function update_lihat_notifikasi(Request $request)
    {
        //define validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'id'     => 'required'
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = DB::table('notifikasi_pengaduan')->where('notifikasi_id', $request->id)->update([
            'is_lihat' => 1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lihat Notifikasi Berhasil Disimpan!',
            'data'    => $post
        ]);
    }
}
