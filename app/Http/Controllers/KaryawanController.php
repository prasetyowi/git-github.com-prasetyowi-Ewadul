<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class KaryawanController extends Controller
{
    public function index()
    {
        if (Session::get('login') == TRUE) {
            $pengguna_id = "";

            $kode = "USR";
            $num_rows = DB::table('pengguna')->count() + 1;

            if ($num_rows >= 0 && $num_rows < 10) {
                $pengguna_id = $kode . "/000" . $num_rows;
            } else if ($num_rows >= 10 && $num_rows < 100) {
                $pengguna_id = $kode . "/00" . $num_rows;
            } else if ($num_rows >= 100 && $num_rows < 1000) {
                $pengguna_id = $kode . "/0" . $num_rows;
            } else if ($num_rows >= 1000) {
                $pengguna_id = $kode . "/" . $num_rows;
            }

            $data['pengguna_id'] = $pengguna_id;
            $data['Level'] = DB::table('pengguna_level')->get();
            $data['notifikasi'] = app('App\Http\Controllers\NotifikasiController')->get_notifikasi();

            return view('master/karyawan/index', compact('data'));
        } else {
            return redirect()->to('/auth/login');
        }
    }

    public function get_pengguna_by_id(Request $request)
    {
        $data = DB::table('pengguna')->where('pengguna_id', $request->id)->get();
        return $data;
    }

    public function get_pengguna()
    {
        $data = DB::select("SELECT
                            pengguna.*,
                            pengguna_level.pengguna_level
                            FROM pengguna
                            LEFT JOIN pengguna_level
                            ON pengguna_level.pengguna_level_id = pengguna.pengguna_level_id
                            WHERE pengguna.pengguna_level_id IN ('1','2')
                            ORDER BY pengguna.pengguna_nama ASC");
        return $data;
    }

    public function form()
    {

        $pengguna_id = "";

        $kode = "USR";
        $num_rows = DB::table('pengguna')->count() + 1;

        if ($num_rows >= 0 && $num_rows < 10) {
            $pengguna_id = $kode . "/000" . $num_rows;
        } else if ($num_rows >= 10 && $num_rows < 100) {
            $pengguna_id = $kode . "/00" . $num_rows;
        } else if ($num_rows >= 100 && $num_rows < 1000) {
            $pengguna_id = $kode . "/0" . $num_rows;
        } else if ($num_rows >= 1000) {
            $pengguna_id = $kode . "/" . $num_rows;
        }

        $data['Level'] = DB::table('pengguna_level')->get();

        if (Session::get('login') == TRUE) {
            return view('master/karyawan/form', compact('data'));
        } else {
            return redirect()->to('/auth/login');
        }
    }

    public function edit(Request $request)
    {
        $data['Level'] = DB::table('pengguna_level')->get();

        if (Session::get('login') == TRUE) {
            return view('karyawan/edit', compact('data'));
        } else {
            return redirect()->to('/auth/login');
        }
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'pengguna_id'     => 'required|max:50',
                'pengguna_nama'     => 'required|max:250',
                'pengguna_nik'     => 'required|max:50|unique:pengguna',
                'pengguna_email'     => 'required|max:250|email|unique:pengguna',
                'pengguna_password'     => 'required|max:250'
            ],
            [
                'pengguna_id.required' => 'Pengguna ID tidak boleh kosong!',
                'pengguna_id.max' => 'Pengguna ID maksimal 50 karakter!',
                'pengguna_nama.required' => 'Nama tidak boleh kosong!',
                'pengguna_nama.max' => 'Nama maksimal 250 karakter!',
                'pengguna_nik.required' => 'NIK tidak boleh kosong!',
                'pengguna_nik.max' => 'NIK maksimal 50 karakter!',
                'pengguna_nik.unique' => 'NIK sudah terdaftar!',
                'pengguna_email.required'     => 'Email tidak boleh kosong!',
                'pengguna_email.max'     => 'Email maksimal 50 karakter!',
                'pengguna_email.email'     => 'Email tidak valid!',
                'pengguna_email.unique'     => 'Email sudah terdaftar!',
                'pengguna_password.required'     => 'Password tidak boleh kosong!',
                'pengguna_password.max'     => 'Password maksimal 50 karakter!'
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = DB::table('pengguna')->insert([
            'pengguna_id' => $request->pengguna_id,
            'pengguna_nama' => $request->pengguna_nama,
            'pengguna_nik' => $request->pengguna_nik,
            'pengguna_email' => $request->pengguna_email,
            'pengguna_password' => md5($request->pengguna_password),
            'pengguna_level_id' => $request->pengguna_level_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Karyawan Berhasil Disimpan!',
            'data'    => $post
        ]);
    }

    public function update(Request $request)
    {
        //define validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'pengguna_id'     => 'required|max:50',
                'pengguna_nama'     => 'required|max:250',
                'pengguna_nik'     => 'required|max:50',
                'pengguna_email'     => 'required|max:250|email',
                'pengguna_password'     => 'required|max:250'
            ],
            [
                'pengguna_id.required' => 'Pengguna ID tidak boleh kosong!',
                'pengguna_id.max' => 'Pengguna ID maksimal 50 karakter!',
                'pengguna_nama.required' => 'Nama tidak boleh kosong!',
                'pengguna_nama.max' => 'Nama maksimal 250 karakter!',
                'pengguna_nik.required' => 'NIK tidak boleh kosong!',
                'pengguna_nik.max' => 'NIK maksimal 50 karakter!',
                'pengguna_email.required'     => 'Email tidak boleh kosong!',
                'pengguna_email.max'     => 'Email maksimal 50 karakter!',
                'pengguna_email.email'     => 'Email tidak valid!',
                'pengguna_password.required'     => 'Password tidak boleh kosong!',
                'pengguna_password.max'     => 'Password maksimal 50 karakter!'
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = DB::table('pengguna')->where('pengguna_id', $request->pengguna_id)->update([
            'pengguna_nama' => $request->pengguna_nama,
            'pengguna_nik' => $request->pengguna_nik,
            'pengguna_email' => $request->pengguna_email,
            'pengguna_password' => md5($request->pengguna_password),
            'pengguna_level_id' => $request->pengguna_level_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Karyawan Berhasil Diubah!',
            'data'    => $post
        ]);
    }
}
