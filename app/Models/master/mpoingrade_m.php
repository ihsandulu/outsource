<?php

namespace App\Models\master;

use App\Models\core_m;

class mpoingrade_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek poingrade
        if ($this->request->getVar("poingrade_id")) {
            $poingraded["poingrade_id"] = $this->request->getVar("poingrade_id");
        } else {
            $poingraded["poingrade_id"] = -1;
        }
            $poingraded["store_id"] = session()->get("store_id");
        $us = $this->db
            ->table("poingrade")
            ->getWhere($poingraded);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "poingrade_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $poingrade) {
                foreach ($this->db->getFieldNames('poingrade') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $poingrade->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('poingrade') as $field) {
                $data[$field] = "";
            }
        }

        

        //delete
        if ($this->request->getPost("delete") == "OK") {  
            $poingrade_id=   $this->request->getPost("poingrade_id");
            $cek=$this->db->table("product")
            ->where("poingrade_id", $poingrade_id) 
            ->get()
            ->getNumRows();
            if($cek>0){
                $data["message"] = "poingrade masih dipakai di data product!";
            } else{            
                $this->db
                ->table("poingrade")
                ->delete(array("poingrade_id" => $this->request->getPost("poingrade_id"),"store_id" =>session()->get("store_id")));
                $data["message"] = "Delete Success";
            }
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'poingrade_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["store_id"] = session()->get("store_id");

            $builder = $this->db->table('poingrade');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $poingrade_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'poingrade_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["store_id"] = session()->get("store_id");
            $this->db->table('poingrade')->update($input, array("poingrade_id" => $this->request->getPost("poingrade_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
