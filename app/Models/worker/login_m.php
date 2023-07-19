<?php

namespace App\Models\worker;

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

        //file
        $user_ktp = $this->request->getFile('user_ktp');
        $user_picture = $this->request->getFile('user_picture');
        $user_cv = $this->request->getFile('user_cv');
        
        //upload picture
        $data['uploaduser_picture'] = "";
        if (isset($_FILES['user_picture']) && $_FILES['user_picture']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('user_picture');
            $name = $file->getName(); // Mengetahui Nama File
            $originalName = $file->getClientName(); // Mengetahui Nama Asli
            $tempfile = $file->getTempName(); // Mengetahui Nama TMP File name
            $ext = $file->getClientExtension(); // Mengetahui extensi File
            $type = $file->getClientMimeType(); // Mengetahui Mime File
            $size_kb = $file->getSize('kb'); // Mengetahui Ukuran File dalam kb
            $size_mb = $file->getSize('mb'); // Mengetahui Ukuran File dalam mb


            //$namabaru = $file->getRandomName();//define nama fiel yang baru secara acak

            if ($type == 'image/jpg'||$type == 'image/jpeg'||$type == 'image/png') //cek mime file
            {    // File Tipe Sesuai   
                helper('filesystem'); // Load Helper File System
                $direktori = ROOTPATH . 'images\user_picture'; //definisikan direktori upload            
                $user_picture = str_replace(' ', '_', $name);
                $user_picture = date("H_i_s_") . $user_picture; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $user_picture) {
                        delete_files($direktori, $user_picture); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->store($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $user_picture)) {
                    $data['uploaduser_picture'] = "Upload Success !";
                    $input['user_picture'] = $user_picture;
                } else {
                    $data['uploaduser_picture'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploaduser_picture'] = "Format File Salah !";
            }
        }

        //upload ktp
        $data['uploaduser_ktp'] = "";
        if (isset($_FILES['user_ktp']) && $_FILES['user_ktp']['name'] != "") {
            // $request = \Config\Services::request();
            $file = $this->request->getFile('user_ktp');
            $name = $file->getName(); // Mengetahui Nama File
            $originalName = $file->getClientName(); // Mengetahui Nama Asli
            $tempfile = $file->getTempName(); // Mengetahui Nama TMP File name
            $ext = $file->getClientExtension(); // Mengetahui extensi File
            $type = $file->getClientMimeType(); // Mengetahui Mime File
            $size_kb = $file->getSize('kb'); // Mengetahui Ukuran File dalam kb
            $size_mb = $file->getSize('mb'); // Mengetahui Ukuran File dalam mb


            //$namabaru = $file->getRandomName();//define nama fiel yang baru secara acak

            if ($type == 'image/jpg'||$type == 'image/jpeg'||$type == 'image/png') //cek mime file
            {    // File Tipe Sesuai   
                helper('filesystem'); // Load Helper File System
                $direktori = ROOTPATH . 'images\user_ktp'; //definisikan direktori upload            
                $user_ktp = str_replace(' ', '_', $name);
                $user_ktp = date("H_i_s_") . $user_ktp; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori

                //Cek File apakah ada 
                foreach ($map as $key) {
                    if ($key == $user_ktp) {
                        delete_files($direktori, $user_ktp); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->store($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $user_ktp)) {
                    $data['uploaduser_ktp'] = "Upload Success !";
                    $input['user_ktp'] = $user_ktp;
                } else {
                    $data['uploaduser_ktp'] = "Upload Gagal !";
                }
            } else {
                // File Tipe Tidak Sesuai
                $data['uploaduser_ktp'] = "Format File Salah !";
            }
        }

        //upload cv
        $data['uploaduser_cv'] = "";
        if (isset($_FILES['user_cv']) && $_FILES['user_cv']['name'] != "") {
            $file = $this->request->getFile('user_cv');
            $name = $file->getName();
            $originalName = $file->getClientName();
            $tempfile = $file->getTempName();
            $ext = $file->getClientExtension();
            $type = $file->getClientMimeType();
            $size_kb = $file->getSize('kb');
            $size_mb = $file->getSize('mb');

            if ($type == 'application/msword' || $type == 'application/pdf' || $type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                helper('filesystem');
                $direktori = ROOTPATH . 'images\user_cv';
                $user_cv = str_replace(' ', '_', $name);
                $user_cv = date("H_i_s_") . $user_cv;
                $map = directory_map($direktori, FALSE, TRUE);

                foreach ($map as $key) {
                    if ($key == $user_cv) {
                        delete_files($direktori, $user_cv);
                    }
                }

                if ($file->move($direktori, $user_cv)) {
                    $data['uploaduser_cv'] = "Upload Success!";
                    $input['user_cv'] = $user_cv;
                } else {
                    $data['uploaduser_cv'] = "Upload Gagal!";
                }
            } else {
                $data['uploaduser_cv'] = "Format File Salah!";
            }
        }

        
        // dd($input);
        $builder = $this->db->table('user');
        $builder->insert($input);
        // echo $this->db->getLastQuery();
        // die;
        $member_id = $this->db->insertID();

        $data["message"] = "Insert Data Success";
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
            $builder = $this->db->table("user")
                ->select("*, user.store_id AS store_id")
                ->join("position", "position.position_id=user.position_id", "left")
                ->join("store", "store.store_id=user.store_id", "left")
                ->where("user_email", $this->request->getVar("email"))
                ->where("user.store_id", $this->request->getVar("storeid"));
            $user1 = $builder
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
            if ($user1->getNumRows() > 0) {
                foreach ($user1->getResult() as $user) {
                    $password = $user->user_password;
                    if (password_verify($this->request->getVar("password"), $password)) {

                        // echo $user->store_id;die;
                        $this->session->set("position_administrator", $user->position_administrator);
                        $this->session->set("position_name", $user->position_name);
                        $this->session->set("user_name", $user->user_name);
                        $this->session->set("user_id", $user->user_id);
                        $this->session->set("store_id", $user->store_id);
                        $this->session->set("store_name", $user->store_name);
                        $this->session->set("user_picture", $user->user_picture);
                        $this->session->set("store_phone", $user->store_phone);
                        $this->session->set("store_address", $user->store_address);
                        $this->session->set("store_noteinvoice", $user->store_noteinvoice);
                        $this->session->set("store_web", $user->store_web);
                        $this->session->set("store_member", $user->store_member);
                        $this->session->set("store_akun", $user->store_akun);
                        $this->session->set("user_lapor", $user->user_lapor);

                         //tambahkan modul di sini                         
                        $pages = $this->db->table("positionpages")
                        ->join("pages","pages.pages_id=positionpages.pages_id","left")
                        ->where("position_id", $user->position_id)
                        ->get();
                       foreach ($pages->getResult() as $pages) {
                            // $halaman = array(109, 110, 111, 112, 116, 117, 118, 119, 120, 121, 122, 123, 159, 173,187,188,189,190,192,196);
                            $halaman[$pages->pages_id]['act_read'] = $pages->positionpages_read;
                            $halaman[$pages->pages_id]['act_create'] = $pages->positionpages_create;
                            $halaman[$pages->pages_id]['act_update'] = $pages->positionpages_update;
                            $halaman[$pages->pages_id]['act_delete'] = $pages->positionpages_delete;
                            $halaman[$pages->pages_id]['act_approve'] = $pages->positionpages_approve;
                        }
                        $this->session->set("halaman", $halaman);
                       
                        $data["hasil"] = " Selamat Datang  " . $user->user_name;
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
}
