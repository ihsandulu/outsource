<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->include("templateuser/header_v"); ?>    
    </head>
    <body id="page-top">
        <?php echo  $this->include("templateuser/body-top_v"); ?>
        
        <!-- Contact-->
        <?php if($sukses==1){?>        
            <section class="page-section tinggilayar" id="registerperusahan">
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5 justify-content-center ">
                        <div class="" id="successMessage">
                            <div class="text-center mb-3">
                                <div class="row tengahfixed">
                                    <div class="col-6 text-right">
                                        <img src="<?=base_url("images/sukses.gif");?>" style="height:200px; width:200px;"/>
                                    </div>
                                    <div class="col-6 text-left">
                                        <div class="fw-bolder">Form submission successful!</div>
                                        Please, Check your email to activate.
                                        <br />
                                        <br />
                                        <br />
                                        <a class="btn btn-primary" href="<?=base_url();?>">Home</a>
                                        <a class="btn btn-success" href="https://wa.me/628567148813">Butuh Bantuan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php }elseif($sukses==-1){?>
            <section class="page-section tinggilayar" id="registerperusahan">
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5 justify-content-center ">
                        <div class="" id="successMessage">
                            <div class="text-center mb-3">
                                <div class="row tengahfixed">
                                    <div class="col-6 text-right">
                                        <img src="<?=base_url("images/gagal.gif");?>" style="height:200px; width:200px;"/>
                                    </div>
                                    <div class="col-6 text-left">
                                        <div class="fw-bolder">Form submission failed!</div>
                                        <?=$message;?>
                                        <br />
                                        <br />
                                        <br />
                                        <a onclick="goBack()" class="btn btn-warning" href="#">Ulangi</a>
                                        <a class="btn btn-primary" href="<?=base_url();?>">Home</a>
                                        <a class="btn btn-success" href="https://wa.me/628567148813">Butuh Bantuan</a>

                                        <script>
                                            // Fungsi untuk kembali ke halaman sebelumnya
                                            function goBack() {
                                                window.history.back();
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php }else{?>
            <section class="page-section" id="registerperusahan">
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6 text-center">
                            <h2 class="mt-0">Cari Pekerjaan Dambaanmu!</h2>
                            <hr class="divider" />
                            <p class="text-muted mb-5">Gunakan layanan kami untuk mendapatkan pekerjaan terbaik dambaanmu!</p>
                        </div>
                    </div>
                    <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                        <div class="col-lg-6">                        
                            <form id="contactForm" data-sb-form-api-token="API_TOKEN" method="post" action="" enctype="multipart/form-data">
                                
                                <div class="form-floating mb-3">
                                    <input required class="form-control" id="user_name" name="user_name" type="text" placeholder="Enter your company name..." data-sb-validations="required" />
                                    <label for="name">Full name</label>
                                    <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <input required class="form-control" id="user_email" name="user_email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                    <label for="email">Email address</label>
                                    <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                    <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="user_npwp" name="user_npwp" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                    <label for="phone">NPWP (opsional)</label>
                                    <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <input required class="form-control" id="user_wa " name="user_wa" type="tel" placeholder="6284567811455" data-sb-validations="required" />
                                    <label for="phone">Whatsapp number</label>
                                    <div class="invalid-feedback" data-sb-feedback="phone:required">A Whatsapp number is required.</div>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <textarea required class="form-control" id="user_address" name="user_address" type="text" placeholder="Enter your address..." style="height: 10rem" data-sb-validations="required"></textarea>
                                    <label for="message">Your address</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">Address is required.</div>
                                </div>
                                
                                <div class="form-floating mb-3">
                                    <select onchange="posisi();" class="form-control" id="category_id" name="category_id">
                                        <option position_id="0" value="0">Pilih Kategori</option>
                                        <?php $category= $this->db->table("category")
                                        ->where("position_id!=","0")
                                        ->orderBy("category_name","asc")
                                        ->get();
                                        foreach($category->getResult() as $category){?>
                                            <option position_id="<?=$category->position_id;?>" value="<?=$category->category_id;?>"><?=$category->category_name;?></option>
                                        <?php }?>
                                    </select>
                                    <label for="message">Job Category</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                                </div>  
                                <input type="hidden" id="position_id" name="position_id"/>
                                <div class="form-floating mb-3">
                                    <select class="form-control" id="product_id" name="product_id">
                                        
                                    </select>
                                    <label for="message">Job Position</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                                </div>  
                                <script>
                                    function posisi(){
                                        let category_id=$("#category_id").val();
                                        let position_id = $('#category_id option:selected').attr('position_id');
                                        $("#position_id").val(position_id);
                                        $.get("<?=base_url("api/posisi");?>",{category_id:category_id})
                                        .done(function(data){
                                            $("#product_id").html(data);
                                        });
                                    }
                                </script>
                                <div class="form-floating mb-3">
                                    <input required onchange="readURL(this);" type="file" class="form-control" id="user_ktp" name="user_ktp" placeholder="" >
                                        <?php $user_image=base_url("images/user_ktp/KTP.png");?>
                                        <img id="user_ktp_image" width="100" height="100" src="<?=$user_image;?>"/>                                        
                                    <label for="message">KTP (png,jpg)</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">A KTP is required.</div>
                                </div> 
                                
                                <div class="form-floating mb-3">
                                    <input required onchange="readURL(this);" type="file" class="form-control" id="user_picture" name="user_picture" placeholder="" >
                                        <?php $user_image=base_url("images/user_picture/photo.png");?>
                                        <img id="user_picture_image" width="100" height="100" src="<?=$user_image;?>"/>
                                    <label for="message">Picture (png,jpg)</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">A Picture is required.</div>
                                </div> 
                                
                                <script>
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function (e) {
                                                $("#"+input.id+"_image").attr('src', e.target.result);
                                            }

                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>

                                <div class="form-floating mb-3">
                                    <input required onchange="readURL(this);" type="file" class="form-control" id="user_cv" name="user_cv" placeholder="" >                                        
                                    <label for="message">Curriculum Vitae (doc,docx)</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">A CV is required.</div>
                                </div> 
                                
                                
                                <div class="d-none" id="submitErrorMessage">
                                    <div class="text-center text-danger mb-3">Error sending message!</div>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-xl" id="submit" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-lg-4 text-center mb-5 mb-lg-0">
                            <i class="bi-phone fs-2 mb-3 text-muted"></i>
                            <div>+62 (21) 123-4567</div>
                        </div>
                    </div>
                </div>
            </section>
        <?php }?>
        <?php echo  $this->include("templateuser/footer_v"); ?>
    </body>
</html>