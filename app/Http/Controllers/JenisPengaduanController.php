<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class JenisPengaduanController extends Controller
{
    public function index()
    {
        if (Session::get('login') == TRUE) {
            return view('master/jenis_pengaduan/index');
        } else {
            return redirect()->to('/auth/login');
        }
    }

    public function get_jenis_pengaduan()
    {
        $data = DB::table('jenis_pengaduan')->get();
        return $data;
    }

    public function get_jenis_pengaduan_by_id(Request $request)
    {
        $data = DB::table('jenis_pengaduan')->where('jenis_pengaduan_id', $request->id)->get();
        return $data;
    }

    public function store(Request $request)
    {
        $jenis_pengaduan_id = "";

        $kode = "J";
        $num_rows = DB::table('jenis_pengaduan')->count() + 1;

        if ($num_rows >= 0 && $num_rows < 10) {
            $jenis_pengaduan_id = $kode . "000" . $num_rows;
        } else if ($num_rows >= 10 && $num_rows < 100) {
            $jenis_pengaduan_id = $kode . "00" . $num_rows;
        } else if ($num_rows >= 100 && $num_rows < 1000) {
            $jenis_pengaduan_id = $kode . "0" . $num_rows;
        } else if ($num_rows >= 1000) {
            $jenis_pengaduan_id = $kode . $num_rows;
        }

        //define validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'jenis_pengaduan_desc'     => 'required'
            ],
            [
                'jenis_pengaduan_desc.required' => 'Jenis pengaduan tidak boleh kosong!'
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = DB::table('jenis_pengaduan')->insert([
            'jenis_pengaduan_id' => $jenis_pengaduan_id,
            'jenis_pengaduan_desc' => $request->jenis_pengaduan_desc,
            'is_aktif' => $request->is_aktif
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jenis Pengaduan Berhasil Disimpan!',
            'data'    => $post
        ]);
    }

    public function update(Request $request)
    {

        //define validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'jenis_pengaduan_desc'     => 'required'
            ],
            [
                'jenis_pengaduan_desc.required' => 'Jenis pengaduan tidak boleh kosong!'
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = DB::table('jenis_pengaduan')->where('jenis_pengaduan_id', $request->jenis_pengaduan_id)->update([
            'jenis_pengaduan_id' => $request->jenis_pengaduan_id,
            'jenis_pengaduan_desc' => $request->jenis_pengaduan_desc,
            'is_aktif' => $request->is_aktif
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jenis Pengaduan Berhasil Disimpan!',
            'data'    => $post
        ]);
    }

    public function delete(Request $request)
    {

        //define validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'id'     => 'required'
            ],
            [
                'id.required' => 'Jenis pengaduan ID tidak boleh kosong!'
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = DB::table('jenis_pengaduan')->where('jenis_pengaduan_id', $request->id)->update([
            'is_aktif' => 0
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jenis Pengaduan Berhasil Dihapus!',
            'data'    => $post
        ]);
    }
}
