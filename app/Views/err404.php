<?php //defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>404 Page</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        img {
        width: 100%;
        height: auto;
        object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-12">
            <a class="col-12" href="<?=base_url();?>">
                <img class="" src="<?=base_url();?>/images/404.jpg"/>
            </a>
        </div>
    </div>
</body>
</html>