<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar hidebar" style="overflow:auto;">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>
                <li>
                    <a class="" href="<?= base_url(); ?>" aria-expanded="false">
                        <i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span>
                    </a>

                </li>

                <!-- //Transaction// --> 
                <li class="nav-label">Transaksi</li>     
                <li> 
                    <a class="  " href="<?= base_url("pengajuan"); ?>" aria-expanded="false"><i class="fa fa-file-text-o"></i><span class="hide-menu">Pengajuan</span></a>
                </li> 
                <li> 
                    <a class="  " href="<?= base_url("transaksip"); ?>" aria-expanded="false"><i class="fa fa-file-text-o"></i><span class="hide-menu">Transaksi</span></a>
                </li>
               
            </ul>
        </nav>
    </div>
</div>