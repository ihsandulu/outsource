<?php

namespace App\Controllers\master;


use App\Controllers\baseController;

class mposition extends baseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function index()
    {
        $data = new \App\Models\master\mposition_m();
        $data = $data->data();
        $data["user"]="kantor";
        return view('master/mposition_v', $data);
    }


    public function pekerja()
    {
        $data = new \App\Models\master\mposition_m();
        $data = $data->data();
        $data["user"]="pekerja";
        return view('master/mposition_v', $data);
    }
}
