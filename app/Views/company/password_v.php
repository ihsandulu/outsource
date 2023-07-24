<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->include("templateuser/header_v"); ?>    
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        $(document).ready(function(){
            $("#pesan").hide();
        });
        </script>

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
                                        Please, login to enter your account.
                                        <br />
                                        <br />
                                        <br />
                                        <a class="btn btn-warning mb-2" href="<?=base_url("login-perusahaan");?>">Login</a>
                                        <a class="btn btn-primary mb-2" href="<?=base_url();?>">Home</a>
                                        <a class="btn btn-success mb-2" href="https://wa.me/628567148813">Butuh Bantuan</a>
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
                                        <a class="btn btn-primary" href="<?=base_url();?>">Home</a>
                                        <a class="btn btn-success" href="https://wa.me/628567148813">Butuh Bantuan</a>
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
                            <h2 class="mt-0">Buat Password Baru!</h2>
                            <hr class="divider" />
                            <p class="text-muted mb-5">Minimal 8 Character!</p>
                        </div>
                    </div>
                    <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                        <div class="col-lg-6">                        
                            <form data-sb-form-api-token="API_TOKEN" method="post" action="">
                                <!-- Name input-->
                                <div class="form-floating mb-3">
                                    <input onkeyup="cek()" minlength="8" required class="form-control" id="member_password" name="member_password" type="text" placeholder="Enter your password"  />
                                    <label for="name">Password</label>
                                </div>
                                <!-- Email address input-->
                                <div class="form-floating mb-3">
                                    <input onkeyup="cek()" required class="form-control" id="ulangi"type="password" placeholder="Ulangi Password"  />
                                    <label for="email">Ulangi Password</label>
                                </div>     
                                <div id="pesan" class="alert alert-success">
                                    <strong>Perhatian!</strong> <span id="isipesan"></span>.
                                </div>
                                <script>
                                    function cek(){
                                        // alert();
                                        $member_password=$("#member_password").val();
                                        $ulangi=$("#ulangi").val();
                                        $pesan="";
                                        if($member_password==""){
                                            $("#submit").attr("disabled","disabled");
                                            $pesan="Kolom 'Ulangi Password' Mohon diisi!";
                                        }else if($ulangi==""){
                                            $("#submit").attr("disabled","disabled");
                                            $pesan="Kolom 'Ulangi Password' Mohon diisi!";
                                        }else if($member_password!=$ulangi){
                                            $("#submit").attr("disabled","disabled");
                                            $pesan="Password tidak sama!";
                                        }else{
                                            $pesan="";
                                            $("#submit").removeAttr("disabled");
                                        }
                                        if($pesan!=""){
                                            $("#isipesan").html($pesan);
                                            $("#pesan").show();
                                        }else{
                                            $("#pesan").hide();
                                        }
                                    }
                                </script>
                                
                                <input type="hidden" id="member_id" name="member_id" value="<?=$this->request->uri->getSegment(2);?>"/>
                                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                                <!-- Submit Button-->
                                <div class="d-grid"><button disabled class="btn btn-primary btn-xl" id="submit" type="submit">Submit</button></div>
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