<?php

namespace App\Controllers\worker;

use App\Controllers\baseController;
use App\Models\worker\login_m;

class login extends baseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new login_m();
        // $sesi_user->ceksesi();
        $data["sukses"] = "0";
    }


    public function index()
    {        
        $data["sukses"] = "0";
        return view('worker/login_v', $data);
    }

    public function register()
    {        
        try {
            $data = new login_m();
            $data = $data->register();
            return view('worker/login_v', $data);
        } catch (\Exception $e) {
            $data1["sukses"] = -1;
            if ( $e->getCode() == 1062) {
                $data1["message"] = "Data email atau nomor wa sudah terdaftar. Harap memasukkan data lain!";
            } else {
                $data1["message"] = "Terjadi kesalahan. Mohon kembali mengulangi pendaftaran di waktu lain.";
            }
            return view('worker/login_v', $data1);
        }
       
    }

    public function login()
    {
        $data = new login_m();
        $data = $data->data();
        return view('worker/login_v', $data);
    }
}
