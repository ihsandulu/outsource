<?php

namespace App\Controllers\worker;


use App\Controllers\baseController;

class rtransaction extends baseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function index()
    {
        $data = new \App\Models\worker\rtransaction_m();
        $data = $data->data();
        return view('worker/rtransaction_v', $data);
    }
}
