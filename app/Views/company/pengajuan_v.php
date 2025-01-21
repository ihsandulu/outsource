<?php echo $this->include("company/header_v"); ?>

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
                            
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="transaction_id" value="0" />
                                </h1>
                            </form>
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update transaction";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah transaction";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">  
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="category_id">Kategori:</label>
                                    <div class="col-sm-10">
                                        <select required onchange="product()" class="form-control" id="category_id" name="category_id">
                                            <option value="0" <?=($category_id=="0")?"selected":"";?>>Pilih Kategori</option>
                                            <?php
                                            $category=$this->db->table("category")
                                            ->orderBy("category_name","ASC")
                                            ->get();
                                            foreach($category->getResult() as $category){?>
                                            <option value="<?=$category->category_id;?>" <?=($category_id==$category->category_id)?"selected":"";?>><?=$category->category_name;?></option>
                                            <?php }?>
                                        </select>
                                        <script>
                                        function product(){
                                            let category_id = $("#category_id").val();
                                            let product_id = "<?=$product_id;?>";
                                            // alert("<?=base_url("pengajuan_product");?>?category_id="+category_id+"&product_id="+product_id);
                                            $.get("<?=base_url("pengajuan_product");?>",{category_id:category_id, product_id:product_id})
                                            .done(function(data){
                                                $("#product_id").html(data);
                                            });
                                        }
                                        product();
                                        </script>
                                    </div>
                                </div> 
                                 <div class="form-group">
                                    <label class="control-label col-sm-2" for="product_id">Product:</label>
                                    <div class="col-sm-10">
                                        <select required onchange="isiproduct()" class="form-control" id="product_id" name="product_id">
                                        </select>
                                        <script>
                                        function isiproduct(){
                                            let category_id = $("#category_id").val();
                                            let user_id = "<?=$user_id;?>";
                                            let product_id_selected = $("#product_id option:selected");
                                            let transactiond_price = product_id_selected.attr("transactiond_price");
                                            $("#transactiond_price").val(transactiond_price);
                                            // alert("<?=base_url("pengajuan_pekerja");?>?category_id="+category_id+"&user_id="+user_id);
                                            $.get("<?=base_url("pengajuan_pekerja");?>",{category_id:category_id, user_id:user_id})
                                            .done(function(data){
                                                $("#user_id_div").html(data);
                                            });
                                        }
                                        isiproduct();
                                        </script>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="user_id">Pekerja:</label>
                                    <div class="col-sm-10" id="user_id_div">
                                        
                                    </div>
                                </div>  

                                
                                <input type="hidden" name="store_id" value="<?= session()->get("store_id"); ?>" />
                                <input type="hidden" id="transactiond_price" name="transactiond_price" value="<?= $transactiond_price; ?>" />
                                <input type="hidden" name="transactiond_qty" value="1" />
                                <input type="text" name="transaction_id" value="<?= $transaction_id; ?>" />
                                <input type="hidden" name="transactiond_id" value="<?= $transactiond_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <button class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href=<?= site_url("transaction"); ?>">Back</button>
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
                                        <th>Aksi</th>
                                        <th>Tanggal</th>
                                        <th>Nomor Pengajuan</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $usr = $this->db
                                        ->table("transaction")
                                        ->join("store", "store.store_id=transaction.store_id", "left")
                                        ->where("transaction.store_id",session()->get("store_id"))
                                        ->where("transaction.member_id",session()->get("member_id"))
                                        ->where("transaction.transaction_status","3")
                                        ->orderBy("transaction_id", "DESC")
                                        ->get();
                                    //echo $this->db->getLastquery();
                                    $no = 1;
                                    foreach ($usr->getResult() as $usr) { ?>
                                        <tr>
                                            <td>
                                                <form method="post" class="btn-action" style="">
                                                    <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                    <input type="hidden" name="transaction_id" value="<?= $usr->transaction_id; ?>" />
                                                </form>
                                            </td>
                                            <td><?= $usr->transaction_date; ?></td>
                                            <td>
                                                <form method="post" class="btn-action" style="">
                                                    <button class="btn btn-sm btn-info" name="new" value="OK">
                                                        <span class="" style="color:white;">New Worker</span> 
                                                    </button>
                                                    <input type="hidden" name="transaction_id" value="<?= $usr->transaction_id; ?>" />
                                                </form>
                                                <?= $usr->transaction_no; ?>
                                            </td>
                                            <td class="text-left">
                                                <?php
                                                $transactiond=$this->db->table("transactiond")
                                                ->join("user", "user.user_id=transactiond.user_id")
                                                ->join("position", "position.position_id=user.position_id")
                                                ->join("product", "product.product_id=transactiond.product_id")
                                                ->where("transactiond.transaction_id", $usr->transaction_id)
                                                ->get();
                                                // echo $this->db->getLastQuery();
                                                foreach($transactiond->getResult() as $transactiond){?>
                                                <form method="post" class="btn-action" style="">
                                                    <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                    <input type="hidden" name="transactiond_id" value="<?= $transactiond->transactiond_id; ?>" />
                                                </form>
                                                <form method="post" class="btn-action" style="">
                                                    <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete_transactiond_id" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                    <input type="hidden" name="transactiond_id" value="<?= $transactiond->transactiond_id; ?>" />
                                                </form>
                                                (<?= $transactiond->position_name; ?> | <?= $transactiond->product_name; ?> ) <?= $transactiond->user_name; ?>
                                                <br/>
                                                <?php }?>
                                            </td>
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
    var title = "Pengajuan";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("company/footer_v"); ?>