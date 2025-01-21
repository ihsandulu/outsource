<?php

namespace App\Controllers\company;


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
        $data = new \App\Models\company\rtransaction_m();
        $data = $data->data();
        return view('company/rtransaction_v', $data);
    }
}
