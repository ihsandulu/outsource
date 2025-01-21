<?php

namespace App\Models\company;

use App\Models\core_m;

class pengajuan_m extends core_m
{
    public function data()
    {
        $data = array();
        $data["message"] = "";
        if(!isset($_POST["new"])&&!isset($_POST["edit"])){
            //cek transaction
            if ($this->request->getVar("transaction_id")) {
                $transactiond["transaction_id"] = $this->request->getVar("transaction_id");
            } else {
                $transactiond["transaction_id"] = -1;
            }
                $transactiond["store_id"] = session()->get("store_id");
            $us = $this->db
                ->table("transaction")
                ->getWhere($transactiond);
            // echo $this->db->getLastquery();die;
            $larang = array("log_id", "id", "user_id", "action", "data", "transaction_id_dep", "trx_id", "trx_code");
            if ($us->getNumRows() > 0) {
                foreach ($us->getResult() as $transaction) {
                    foreach ($this->db->getFieldNames('transaction') as $field) {
                        if (!in_array($field, $larang)) {
                            $data[$field] = $transaction->$field;
                        }
                    }
                }
            } else {
                foreach ($this->db->getFieldNames('transaction') as $field) {
                    $data[$field] = "";
                }
            }
        }
        
        foreach ($this->db->getFieldNames('transactiond') as $field) {
            $data[$field] = "";
        }
        if(isset($_POST["transaction_id"])){
            $data["transaction_id"]=$_POST["transaction_id"];
        }

        

        //delete transaction_id
        if ($this->request->getPost("delete") == "OK") {  
            $transaction_id=   $this->request->getPost("transaction_id");
            $cek=$this->db->table("transactiond")
            ->where("transaction_id", $transaction_id) 
            ->get()
            ->getNumRows();
            if($cek>0){
                $tambahan="";
                // $tambahan.=$this->db->getLastQuery();
                $data["message"] = "Transaksi masih dipakai di detail transaksi!".$tambahan;
            } else{            
                $this->db
                ->table("transaction")
                ->delete(array("transaction_id" => $this->request->getPost("transaction_id"),"store_id" =>session()->get("store_id")));
                $data["message"] = "Delete Success";
            }
        }

        //delete
        if ($this->request->getPost("delete_transactiond_id") == "OK") {          
            $this->db
            ->table("transactiond")
            ->delete(array("transactiond_id" => $this->request->getPost("transactiond_id"),"store_id" =>session()->get("store_id")));
            $data["message"] = "Delete Success";
        }

        //new
       
        if ($this->request->getPost("create") == "OK" ) {             
            if(isset($_POST["transaction_id"]) && $_POST["transaction_id"]>0){
                $transaction_id=$_POST["transaction_id"];
            }else{
            
                $inputt["transaction_date"] = date("Y-m-d");
                $inputt["transaction_no"] = "POS".date("YmdHis").session()->get("store_id");
                $inputt["cashier_id"] = 0;
                $inputt["store_id"] = session()->get("store_id");
                $inputt["transaction_status"] = 3;
                $inputt["transaction_shift"] = 0;
                $inputt["transaction_pengajuan"] = 1;
                $inputt["member_id"] = session()->get("member_id");

                $builder = $this->db->table('transaction');
                $builder->insert($inputt);
                // $data["message"] = $this->db->getLastQuery();
                $transaction_id = $this->db->insertID();
            }
            

            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'create') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["store_id"] = session()->get("store_id");
            $input["transaction_id"]=$transaction_id;

            $builder = $this->db->table('transactiond');
            $builder->insert($input);
            // echo $this->db->getLastQuery();die;
            $transaction_id = $this->db->insertID();

            $data["message"] = "Insert Data Success";            

        }

        //data edit                
        if ($this->request->getPost("edit") == "OK") {            
            $transactiond_id = $this->request->getPost("transactiond_id");
            $transactiondd["transactiond_id"] = $transactiond_id;
            $us = $this->db
                ->table("transactiond")
                ->getWhere($transactiondd);
            // echo $this->db->getLastquery();
            // die;
            $larang = array("log_id", "id",  "action", "data", "transaction_id_dep", "trx_id", "trx_code");
            if ($us->getNumRows() > 0) {
                foreach ($us->getResult() as $transactiond) {
                    foreach ($this->db->getFieldNames('transactiond') as $field) {
                        if (!in_array($field, $larang)) {
                            $data[$field] = $transactiond->$field;
                        }
                    }
                }
            } else {
                foreach ($this->db->getFieldNames('transactiond') as $field) {
                    $data[$field] = "";
                }
            }

        }

        
        
        //update
        if ($this->request->getPost("change") == "OK") {
            foreach ($this->request->getPost() as $e => $f) {
                if ($e != 'change' && $e != 'transactiond_picture') {
                    $input[$e] = $this->request->getPost($e);
                }
            }
            $input["store_id"] = session()->get("store_id");
            $this->db->table('transactiond')->update($input, array("transactiond_id" => $this->request->getPost("transactiond_id")));
            $data["message"] = "Update Success";
            //echo $this->db->last_query();die;
        }
        return $data;
    }
}
