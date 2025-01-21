<?php echo $this->include("worker/header_v"); ?>

<div class='container-fluid'>
    <div class='row'>
        <div class='col-12'>
            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <?php if (!isset($_GET['user_id']) && !isset($_POST['new']) && !isset($_POST['edit'])) {
                            $coltitle = "col-md-10";
                        } else {
                            $coltitle = "col-md-8";
                        } ?>
                        <div class="<?= $coltitle; ?>">
                            <h4 class="card-title"></h4>
                            <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                        </div>
                        <?php if (!isset($_POST['new']) && !isset($_POST['edit']) && !isset($_GET['report'])) { ?>
                            <?php if (isset($_GET["user_id"])) { ?>
                                <form action="<?= site_url("user"); ?>" method="get" class="col-md-2">
                                    <h1 class="page-header col-md-12">
                                        <button class="btn btn-warning btn-block btn-lg" value="OK" style="">Back</button>
                                    </h1>
                                </form>
                            <?php } ?>
                            <?php 
                            if (
                                (
                                    isset(session()->get("position_administrator")[0][0]) 
                                    && (
                                        session()->get("position_administrator") == "1" 
                                        || session()->get("position_administrator") == "2"
                                    )
                                ) ||
                                (
                                    isset(session()->get("halaman")['11']['act_create']) 
                                    && session()->get("halaman")['11']['act_create'] == "1"
                                )
                            ) { ?>
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="penilaian_id" />
                                </h1>
                            </form>
                            <?php } ?>
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update Penilaian";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah Penilaian";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">  

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="penilaian_date">Date:</label>
                                    <div class="col-sm-10">
                                        <input autofocus type="date"  class="form-control" id="penilaian_date" name="penilaian_date" placeholder="" value="<?= $penilaian_date; ?>">
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="penilaian_pekerja">Pekerja:</label>
                                    <div class="col-sm-10">
                                    <?php
                                    $builder = $this->db->table("user")
                                        ->join("position","position.position_id=user.position_id","left")
                                        ->where("user.store_id",session()->get("store_id"))
                                        ->where("position_loker","1");
                                    $pekerja = $builder->orderBy("user_name", "ASC")
                                        ->get();
                                    //echo $this->db->getLastQuery();
                                    ?>
                                    <select  class="form-control select" id="penilaian_pekerja" name="penilaian_pekerja">
                                        <option value="0" <?= ($penilaian_pekerja == "0") ? "selected" : ""; ?>>Pilih Pekerja</option>
                                        <?php
                                        foreach ($pekerja->getResult() as $pekerja) { ?>
                                            <option value="<?= $pekerja->user_id; ?>" <?= ($penilaian_pekerja == $pekerja->user_id) ? "selected" : ""; ?>><?= $pekerja->user_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="penilaian_trainer">Trainer:</label>
                                    <div class="col-sm-10">
                                    <?php
                                    $builder = $this->db->table("user")
                                        ->join("position","position.position_id=user.position_id","left")
                                        ->where("user.store_id",session()->get("store_id"))
                                        ->where("position_name","trainer")
                                        ->where("position_loker","0");
                                    $pekerja = $builder->orderBy("user_name", "ASC")
                                        ->get();
                                    //echo $this->db->getLastQuery();
                                    ?>
                                    <select  class="form-control select" id="penilaian_trainer" name="penilaian_trainer">
                                        <option value="0" <?= ($penilaian_trainer == "0") ? "selected" : ""; ?>>Pilih Trainer</option>
                                        <?php
                                        foreach ($pekerja->getResult() as $pekerja) { ?>
                                            <option value="<?= $pekerja->user_id; ?>" <?= ($penilaian_trainer == $pekerja->user_id) ? "selected" : ""; ?>><?= $pekerja->user_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="poingrade_id">Grade Poin:</label>
                                    <div class="col-sm-10">
                                    <?php
                                    $builder = $this->db->table("poingrade")
                                        ->where("store_id",session()->get("store_id"));
                                    $poingrade = $builder->orderBy("poingrade_name", "ASC")
                                        ->get();
                                    //echo $this->db->getLastQuery();
                                    ?>
                                    <select onchange="poinnya(this.value,<?=$poin_id;?>)" class="form-control select" id="poingrade_id" name="poingrade_id">
                                        <option value="0" <?= ($poingrade_id == "0") ? "selected" : ""; ?>>Pilih Grade</option>
                                        <?php
                                        foreach ($poingrade->getResult() as $poingrade) { ?>
                                            <option value="<?= $poingrade->poingrade_id; ?>" <?= ($poingrade_id == $poingrade->poingrade_id) ? "selected" : ""; ?>><?= $poingrade->poingrade_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <script>
                                        function poinnya(poingrade_id,poin_id){
                                            // alert(poingrade_id+","+poin_id);
                                            $.get("<?=base_url("api/poin");?>",{poingrade_id:poingrade_id,poin_id:poin_id})
                                            .done(function(data){
                                                $("#poin_id").html(data);
                                            });
                                        }
                                        poinnya(<?=$poingrade_id;?>,<?=$poin_id;?>);
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="poin_id">Poin:</label>
                                        <div class="col-sm-10">
                                        <?php
                                        $builder = $this->db->table("poin")
                                            ->where("store_id",session()->get("store_id"));
                                        $poin = $builder->orderBy("poin_name", "ASC")
                                            ->get();
                                        //echo $this->db->getLastQuery();
                                        ?>
                                        <select  class="form-control select" id="poin_id" name="poin_id">
                                        </select>
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="penilaian_lulus">Penilaian:</label>
                                    <div class="col-sm-10">
                                    <select class="form-control select" id="penilaian_lulus" name="penilaian_lulus">
                                        <option value="" <?= ($penilaian_lulus == "0") ? "selected" : ""; ?>>Lulus/Tidak Lulus</option>
                                        <option value="1" <?= ($penilaian_lulus == "1") ? "selected" : ""; ?>>Tidak Lulus</option>
                                        <option value="2" <?= ($penilaian_lulus == "2") ? "selected" : ""; ?>>Lulus</option>
                                    </select>
                                </div>  

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="penilaian_keterangan">Keterangan:</label>
                                    <div class="col-sm-10">
                                        <input type="text"  class="form-control" id="penilaian_keterangan" name="penilaian_keterangan" placeholder="" value="<?= $penilaian_keterangan; ?>">
                                    </div>
                                </div>  

                                <input type="hidden" name="penilaian_id" value="<?= $penilaian_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <button class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href=<?= site_url("penilaian"); ?>">Back</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } else { ?>
                        <?php if ($message != "") { ?>
                            <div class="alert alert-info alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $message; ?></strong>
                            </div>
                        <?php } ?>

                        <div class="table-responsive m-t-40">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <!-- <table id="dataTable" class="table table-condensed table-hover w-auto dtable"> -->
                                <thead class="">
                                    <tr>
                                        <?php if (!isset($_GET["report"])) { ?>
                                            <th>Action</th>
                                        <?php } ?>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Trainer</th>
                                        <th>Grade Poin</th>
                                        <th>Poin</th>
                                        <th>Penilaian</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subquery_pekerja = $this->db->table("user")
                                    ->select("user.user_name AS pekerja_name, user_id")
                                    ->where("position.position_loker", "1")
                                    ->join("position", "position.position_id = user.position_id", "left")
                                    ->getCompiledSelect();

                                    $subquery_trainer = $this->db->table("user")
                                    ->select("user.user_name AS trainer_name, user_id")
                                    ->where("position.position_loker", "0")
                                    ->join("position", "position.position_id = user.position_id", "left")
                                    ->getCompiledSelect();

                                    $usr = $this->db->table("penilaian")
                                    ->join("store", "store.store_id = penilaian.store_id", "left")
                                    ->join("($subquery_pekerja) AS pekerja", "pekerja.user_id = penilaian.penilaian_pekerja", "left")
                                    ->join("($subquery_trainer) AS trainer", "trainer.user_id = penilaian.penilaian_trainer", "left")
                                    ->join("poin", "poin.poin_id = penilaian.poin_id", "left")
                                    ->join("poingrade", "poingrade.poingrade_id = poin.poingrade_id", "left")
                                    ->where("penilaian.store_id", session()->get("store_id"))
                                    ->where("penilaian.penilaian_pekerja", session()->get("user_id"))
                                    ->orderBy("penilaian_id", "ASC")
                                    ->get();


                                    //echo $this->db->getLastquery();
                                    $no = 1;
                                    $lulus=array("","Tidak Lulus","Lulus");
                                    foreach ($usr->getResult() as $usr) { ?>
                                        <tr>
                                            <?php if (!isset($_GET["report"])) { ?>
                                                <td style="padding-left:0px; padding-right:0px;">
                                                    <?php 
                                                    if (
                                                        (
                                                            isset(session()->get("position_administrator")[0][0]) 
                                                            && (
                                                                session()->get("position_administrator") == "1" 
                                                                || session()->get("position_administrator") == "2"
                                                            )
                                                        ) ||
                                                        (
                                                            isset(session()->get("halaman")['11']['act_update']) 
                                                            && session()->get("halaman")['11']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                        <input type="hidden" name="penilaian_id" value="<?= $usr->penilaian_id; ?>" />
                                                    </form>
                                                    <?php }?>
                                                    
                                                    <?php 
                                                    if (
                                                        (
                                                            isset(session()->get("position_administrator")[0][0]) 
                                                            && (
                                                                session()->get("position_administrator") == "1" 
                                                                || session()->get("position_administrator") == "2"
                                                            )
                                                        ) ||
                                                        (
                                                            isset(session()->get("halaman")['11']['act_delete']) 
                                                            && session()->get("halaman")['11']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                        <input type="hidden" name="penilaian_id" value="<?= $usr->penilaian_id; ?>" />
                                                    </form>
                                                    <?php }?>
                                                </td>
                                            <?php } ?>
                                            <td><?= $no++; ?></td>
                                            <td><?= $usr->penilaian_date; ?></td>
                                            <td><?= $usr->trainer_name; ?></td>
                                            <td><?= $usr->poingrade_name; ?></td>
                                            <td><?= $usr->poin_name; ?></td>
                                            <td><?= $lulus[$usr->penilaian_lulus]; ?></td>
                                            <td><?= $usr->penilaian_keterangan; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.select').select2();
    var title = "Nilai Pelatihan";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("worker/footer_v"); ?>