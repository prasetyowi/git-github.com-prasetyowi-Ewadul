<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function login_admin()
    {
        return view('auth/login_admin');
    }

    public function proses_login(Request $request)
    {
        //define validation rules
        $validator = Validator::make(
            $request->all(),
            [
                'email'     => 'required',
                'password'     => 'required'
            ],
            [
                'email.required'     => 'Email tidak boleh kosong!',
                'password.required'     => 'Password tidak boleh kosong!'
            ]
        );

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $email = $request->email;
        $password = md5($request->password);

        $data = DB::table('pengguna')->where('pengguna_email', $email)->get()[0];

        if ($data) { //apakah email tersebut ada atau tidak
            if ($password == $data->pengguna_password) {
                Session::put('pengguna_id', $data->pengguna_id);
                Session::put('pengguna_nama', $data->pengguna_nama);
                Session::put('pengguna_email', $data->pengguna_email);
                Session::put('pengguna_nik', $data->pengguna_nik);
                Session::put('pengguna_level_id', $data->pengguna_level_id);
                Session::put('login', TRUE);

                // return session()->all();
                return response()->json([
                    'success' => true,
                    'message' => 1
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 2
                ]);

                // return redirect('login')->with('alert', 'Password atau Email, Salah !');
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 0
            ]);

            // return redirect('login')->with('alert', 'Password atau Email, Salah!');
        }
    }

    public function register()
    {
        //get all posts from Models
        $data['num_rows'] = DB::table('pengguna')->count();
        // $data['kota'] = DB::table('wilayah')->where('kota', "surabaya")->get();

        //return view with data
        return view('auth/register', compact('data'));
        // return view('auth/register');
    }

    public function proses_register(Request $request)
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
            'pengguna_level_id' => 3
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registratsi Berhasil!',
            'data'    => $post
        ]);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/auth/login');
    }
}
