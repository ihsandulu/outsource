<?php

namespace App\Controllers\worker;


use App\Controllers\baseController;

class pelatihan extends baseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function index()
    {
        $data = new \App\Models\worker\pelatihan_m();
        $data = $data->data();
        return view('worker/pelatihan_v', $data);
    }
}
