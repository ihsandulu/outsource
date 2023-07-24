<?php

namespace App\Controllers\front;

use App\Controllers\baseController;



class utama extends baseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\front\utama_m();
        // $sesi_user->ceksesi();
    }

    public function index()
    {
        return view('front/utama_v');
    }

    public function logout()
    {
        $this->session->destroy();
        $this->session->setFlashdata("message", "Silahkan Login !");
        return redirect()->to(base_url());
    }
    
    public function goback()
    {
        return redirect()->back();
    }
}
