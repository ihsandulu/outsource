<?php

namespace App\Controllers\company;


use App\Controllers\baseController;

class pengajuan extends baseController
{

    protected $sesi_user;
    public function __construct()
    {
        $sesi_user = new \App\Models\global_m();
        $sesi_user->ceksesi();
    }


    public function index()
    {
        $data = new \App\Models\company\pengajuan_m();
        $data = $data->data();
        return view('company/pengajuan_v', $data);
    }

    public function product(){
        $product_id=$_GET["product_id"];
        ?>
        <option value="0" <?=($product_id=="0")?"selected":"";?>>Pilih Product</option>
        <?php
        $product=$this->db->table("product")
        ->where("category_id",$_GET["category_id"])
        ->orderBy("product_name","ASC")
        ->get();
        foreach($product->getResult() as $product){?>
        <option transactiond_price="<?=$product->product_sell;?>" value="<?=$product->product_id;?>" <?=($product_id==$product->product_id)?"selected":"";?>><?=$product->product_name;?></option>
        <?php }?>
        <?php
    }

    public function pekerja(){
        $user_id=$_GET["user_id"];
        $category_id=$_GET["category_id"];
        ?>
        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead class="">
                <tr>
                    <th>Pilih</th>
                    <th>Nama</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $category=$this->db->table("user")
                ->join("position","position.position_id=user.position_id","left")
                ->join("category","category.position_id=position.position_id","left")
                ->join("poingrade","poingrade.poingrade_id=user.poingrade_id","left")
                ->where("category.category_id",$category_id)
                // ->having("")
                ->get();
                foreach($category->getResult() as $category){?>
                <tr>
                    <td><input <?=($user_id>0)?"checked":"";?> type="radio" id="user_id" name="user_id" value="<?=$category->user_id;?>"></td>
                    <td>
                        <?=$category->user_name;?>
                        <?php //echo $this->db->getLastquery();?>
                    </td>
                    <td><?=$category->poingrade_name;?></td>
                </tr>                                                
                <?php }?>
            </tbody>
        </table>
    <?php }
}
