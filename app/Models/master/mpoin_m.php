<?php

namespace App\Models\master;

use App\Models\core_m;

class mpoin_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        //cek poin
        if ($this->request->getVar("poin_id")) {
            $poind["poin_id"] = $this->request->getVar("poin_id");
        } else {
            $poind["poin_id"] = -1;
        }
            $poind["store_id"] = session()->get("store_id");
        $us = $this->db
            ->table("poin")
            ->getWhere($poind);
        /* echo $this->db->getLastquery();
        die; */
        $larang = array("log_id", "id", "user_id", "action", "data", "poin_id_dep", "trx_id", "trx_code");
        if ($us->getNumRows() > 0) {
            foreach ($us->getResult() as $poin) {
                foreach ($this->db->getFieldNames('poin') as $field) {
                    if (!in_array($field, $larang)) {
                        $data[$field] = $poin->$field;
                    }
                }
            }
        } else {
            foreach ($this->db->getFieldNames('poin') as $field) {
                $data[$field] = "";
            }
        }

        

        //delete
        if ($this->request->getPost("delete") == "OK") {  
            $poin_id=   $this->request->getPost("poin_id");
            $cek=$this->db->table("product")
            ->where("poin_id", $poin_id) 
            ->get()
            ->getNumRows();
            if($cek>0){
                $data["message"] = "poin masih dipakai di data product!";
            } else{            
                $this->db
                ->table("poin")
                ->delete(array("poin_id" => $this->request->getPost("poin_id"),"store_id" =>session()->get("store_id")));
                $data["message"] = "Delete Success";
            }
        }

        //insert
        if ($this->request->getPost("create") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create' && $e != 'poin_id') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["store_id"] = session()->get("store_id");

            $builder = $this->db->table('poin');
            $builder->insert($input);
            /* echo $this->db->getLastQuery();
            die; */
            $poin_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";
        }
        //echo $_POST["create"];die;
        
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'poin_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["store_id"] = session()->get("store_id");
            $this->db->table('poin')->update($input, array("poin_id" => $this->request->getPost("poin_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
