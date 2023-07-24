<?php
$this->session = \Config\Services::session();
$this->request = \Config\Services::request();

use Config\Database;

$this->db = Database::connect("default");
?>
<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Outsource</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="<?=base_url("assets/favicon.ico");?>" />
        <!-- Bootstrap Icons-->
        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> -->
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?=base_url("front/css/styles.css");?>" rel="stylesheet" />
        <link href="<?=base_url("front/css/whatsapp.css");?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <style>
            ul.no-bullets {
                list-style-type: none; /* Remove bullets */
                padding: 0; /* Remove padding */
                margin: 0; /* Remove margins */
                text-align: left;
                margin: 0;
                padding: 0;
            }
            ul.no-bullets>li>.text-pink::after {
                content: " "; /* Spasi kosong */
                display: inline-block;
                margin-left: 10px; /* Atur lebar ruang setelah elemen */
            }
            .register-img{
                width:inherit; 
                height: auto;
                transition: transform 0.3s, background-color 0.3s;}
            .register-img:hover {
                transform: scale(1.2);
            }
            .tinggilayar{height: 90vh;}
            .border{border:black solid 1px!important;}
            .tengahfixed{
                position:fixed;
                left:50%;
                top:50%;
                transform:translate(-50%,-50%);
            }
            .tengahabsolute{
                position:absolute;
                left:50%;
                top:50%;
                transform:translate(-50%,-50%);
            }
        </style>