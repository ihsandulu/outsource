<?php

namespace App\Models\master;

use App\Models\core_m;

class mpenilaian_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek penilaian
        if ($this->request->getVar("penilaian_id")) {
            $penilaiand["penilaian_id"] = $this->request->getVar("penilaian_id");
        } else {
            $penilaiand["penilaian_id"] = -1;
        }
            $penilaiand["store_id"] = session()->get("store_id");
        $us = $this->db
            ->table("penilaian")
            ->getWhere($penilaiand);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "penilaian_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $penilaian) {
                foreach ($this->db->getFieldNames('penilaian') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $penilaian->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('penilaian') as $field) {
                $data[$field] = "";
            }
                $data["poingrade_id"] = "0";
                $data["poin_id"] = "0";
                $data["penilaian_pekerja"] = "0";
                $data["penilaian_trainer"] = "0";
        }

        

        //delete
        if ($this->request->getPost("delete") == "OK") {  
            $penilaian_id=   $this->request->getPost("penilaian_id");
            $cek=$this->db->table("product")
            ->where("penilaian_id", $penilaian_id) 
            ->get()
            ->getNumRows();
            if($cek>0){
                $data["message"] = "penilaian masih dipakai di data product!";
            } else{            
                $this->db
                ->table("penilaian")
                ->delete(array("penilaian_id" => $this->request->getPost("penilaian_id"),"store_id" =>session()->get("store_id")));
                $data["message"] = "Delete Success";
            }
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'penilaian_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["store_id"] = session()->get("store_id");

            $builder = $this->db->table('penilaian');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $penilaian_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'penilaian_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["store_id"] = session()->get("store_id");
            $this->db->table('penilaian')->update($input, array("penilaian_id" => $this->request->getPost("penilaian_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
