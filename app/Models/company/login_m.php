<?php

namespace App\Models\company;

use App\Models\core_m;

class login_m extends core_m
{
    public function register()
    {
        foreach ($this->request->getPost() as $e => $f) {
            if ($e != 'create' && $e != 'member_id') {
                $input[$e] = $this->request->getPost($e);
            }
        }
        $input["store_id"] = 1;
        // dd($input);
        $builder = $this->db->table('member');
        $builder->insert($input);
        // echo $this->db->getLastQuery();
        // die;
        $member_id = $this->db->insertID();

        //Kirim Email//
        $store=$this->db->table("store")->where("store_id","1")->get()->getRow();
        $storepicture=$store->store_picture;
        $storename=$store->store_name;
        $store_image=base_url("images/store_picture/".$storepicture);
        // dd($store_image);
        $to = $input["member_email"];
        $subject = "Registrasi Perusahaan (".$storename.")";
        $message = "
        <div style='margin-bottom:20px;'><img src='".$store_image."' style='width:100px;height:auto;'/></div>
        <div>Halo ".$input["member_name"].". Selamat ya telah berhasil mendaftar sebagai Perusahaan Pencari Pekerja.</div>
        <div>Silahkan <a href=".base_url("passwordperusahaan/".$member_id)." style='background-color:#1C881A; color:white;'>KLIK DI SINI</a> untuk membuat password.</div>
        ";
        
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('qithycv@gmail.com', 'Confirm Registration');
        
        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) 
		{
            $email = 'Email successfully sent';
        } 
		else 
		{
            $email = 'Email unsuccessfully!';
            // $data = $email->printDebugger(['headers']);
            // print_r($data);
        }
        //selesai kirim email//

        $data["message"] = "Insert Data Success. ".$email;
        $data["sukses"] = "1";
        return $data;

    }

    public function login()
    {
        //require_once("meta_m.php");
        $data = array();
        
        $data["sukses"] = "0";
        $data["message"] = "";
        $data["hasil"] = "";
        $data['masuk'] = 0;




        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $builder = $this->db->table("member")
                ->select("*, member.store_id AS store_id")
                ->join("positionm", "positionm.positionm_id=member.positionm_id", "left")
                ->join("store", "store.store_id=member.store_id", "left")
                ->where("member_email", $this->request->getVar("email"))
                ->where("member.store_id", $this->request->getVar("storeid"));
            $member1 = $builder
                ->get();

                
         
            // define('production',$this->db->database);
            // echo production;
            // $lastquery = $this->db->getLastQuery();
            // echo $lastquery;
            // die;
            //    $query = $this->db->query("SELECT * FROM `user`  WHERE `user_email` = 'ihsan.dulu@gmail.com'");
            //     echo $query->getFieldCount();
            // die;

            $halaman = array();
            if ($member1->getNumRows() > 0) {
                foreach ($member1->getResult() as $member) {
                    $password = $member->member_password;
                    if (password_verify($this->request->getVar("password"), $password)) {

                        // echo $member->store_id;die;
                        $this->session->set("positionm_name", $member->positionm_name);
                        $this->session->set("member_name", $member->member_name);
                        $this->session->set("member_id", $member->member_id);
                        $this->session->set("store_id", $member->store_id);
                        $this->session->set("store_name", $member->store_name);
                        $this->session->set("store_picture", $member->store_picture);
                        $this->session->set("store_phone", $member->store_phone);
                        $this->session->set("store_address", $member->store_address);
                        $this->session->set("store_noteinvoice", $member->store_noteinvoice);
                        $this->session->set("store_web", $member->store_web);
                        $this->session->set("store_member", $member->store_member);
                        $this->session->set("store_akun", $member->store_akun);

                         
                       
                        $data["hasil"] = " Selamat Datang  " . $member->member_name;
                        $this->session->setFlashdata('hasil', $data["hasil"]);
                        $data['masuk'] = 1;
                    } else {
                        $data["hasil"] = " Password Salah !";
                        // $data["hasil"]=password_verify('123456', '123456').">>>".$this->request->getVar("password").">>>".$password;
                    }
                }
            } else {
                $data["hasil"] = " Email Salah !";
            }
        }

        $this->session->setFlashdata('message', $data["hasil"]);
        return $data;
    }

    public function addpassword()
    {
        foreach ($this->request->getPost() as $e => $f) {
            if ($e != 'create' ) {
                $input[$e] = $this->request->getPost($e);
            }
        }        
        $input["store_id"] = 1;
        $input["member_password"] = password_hash($input["member_password"], PASSWORD_DEFAULT);

        // dd($input);
        $where["member_id"]=$input["member_id"];
        $builder = $this->db->table('member');
        $builder->update($input,$where);
        // echo $this->db->getLastQuery();
        // die;
        $member_id = $this->db->insertID();
        

        $data["message"] = "Insert Password Success.";
        $data["sukses"] = "1";
        return $data;

    }
}
