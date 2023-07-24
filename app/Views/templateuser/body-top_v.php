<!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="<?=base_url();?>#page-top">Outsource</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Register</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?=base_url("register-pekerja");?>">Cari Pekerjaan</a></li>
                                <li><a class="dropdown-item" href="<?=base_url("register-perusahaan");?>">Rekrut Karyawan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Login</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?=base_url("login-pekerja");?>">Cari Pekerjaan</a></li>
                                <li><a class="dropdown-item" href="<?=base_url("login-perusahaan");?>">Rekrut Karyawan</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>