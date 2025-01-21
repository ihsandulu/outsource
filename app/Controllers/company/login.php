<?php

namespace App\Controllers\company;

use App\Controllers\baseController;
use App\Models\company\login_m;

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
        return view('company/register_v', $data);
    }

    public function register()
    {        
        
        try {
            $data = new login_m();
            $data = $data->register();
            return view('company/register_v', $data);
        } catch (\Exception $e) {
            $data1["sukses"] = -1;
            if ( $e->getCode() == 1062) {
                $data1["message"] = "Data email atau nomor wa sudah terdaftar. Harap memasukkan data lain!";
            } else {
                $data1["message"] = "Terjadi kesalahan. Mohon kembali mengulangi pendaftaran di waktu lain.";
            }
            // $data1["message"] = $e;
            return view('company/register_v', $data1);
        }
       
    }

    public function logout()
    {
        $this->session->destroy();
        $this->session->setFlashdata("message", "Silahkan Login !");
        return redirect()->to(base_url("login-perusahaan"));
    }

    public function login()
    {
        $data = new login_m();
        $data = $data->login();
        // dd($data);
        if ($data['masuk'] == 1) {
            return redirect()->to(base_url('company_utama?message=' . $data["hasil"]));
        }
        return view('company/login_v', $data);
    }

    public function password()
    {        
        $data["sukses"] = "0";
        return view('company/password_v', $data);
    }

    public function addpassword()
    {      
        try {
            $data = new login_m();
            $data = $data->addpassword();
            return view('company/password_v', $data);
        } catch (\Exception $e) {
            $data1["sukses"] = -1;
            if ( $e->getCode() == 1062) {
                $data1["message"] = "Harap memasukkan password lain!";
            } else {
                $data1["message"] = "Terjadi kesalahan. Mohon kembali mengulangi di waktu lain.";
            }
            return view('company/password_v', $data1);
        }
       
    }
}
