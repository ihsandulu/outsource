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
                            <h2 class="mt-0">Daftarkan Perusahaanmu!</h2>
                            <hr class="divider" />
                            <p class="text-muted mb-5">Gunakan layanan kami untuk mendapatkan pekerja terbaik dambaanmu!</p>
                        </div>
                    </div>
                    <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                        <div class="col-lg-6">                        
                            <form id="contactForm" data-sb-form-api-token="API_TOKEN" method="post" action="">
                                <!-- Name input-->
                                <div class="form-floating mb-3">
                                    <input required class="form-control" id="member_name" name="member_name" type="text" placeholder="Enter your company name..." data-sb-validations="required" />
                                    <label for="name">Company name</label>
                                    <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                                </div>
                                <!-- Email address input-->
                                <div class="form-floating mb-3">
                                    <input required class="form-control" id="member_email" name="member_email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                    <label for="email">Email address</label>
                                    <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                    <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                                </div>
                                <!-- Phone number input-->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="member_phone" name="member_phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                    <label for="phone">Phone number (opsional)</label>
                                    <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                                </div>
                                <!-- Phone number input-->
                                <div class="form-floating mb-3">
                                    <input required class="form-control" id="member_no " name="member_no" type="tel" placeholder="6284567811455" data-sb-validations="required" />
                                    <label for="phone">Whatsapp number</label>
                                    <div class="invalid-feedback" data-sb-feedback="phone:required">A Whatsapp number is required.</div>
                                </div>
                                <!-- Message input-->
                                <div class="form-floating mb-3">
                                    <textarea required class="form-control" id="member_address" name="member_address" type="text" placeholder="Enter your address..." style="height: 10rem" data-sb-validations="required"></textarea>
                                    <label for="message">Your address</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">Address is required.</div>
                                </div>
                                <!-- Message input-->
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="member_message" name="member_message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                    <label for="message">Description of the ideal worker</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                                </div>                                
                                
                                
                                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                                <!-- Submit Button-->
                                <div class="d-grid"><button class="btn btn-primary btn-xl" id="submit" type="submit">Submit</button></div>
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