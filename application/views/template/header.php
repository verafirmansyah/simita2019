<header class="main-header">
    <a href="<?php echo site_url('web'); ?> " class="logo">
		<span class="logo-mini"><b>IT</b>A</span>
		<span class="logo-lg"><b>ITAsset</b> (SIMITA)</span>
	</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- Notifications: style can be found in dropdown.less -->

                <!-- Tasks: style can be found in dropdown.less -->

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Selamat Datang, <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo $this->session->userdata('username'); ?> </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url('assets/img/avatar5.png'); ?>" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo $this->session->userdata('role'); ?> 
                                <small>Terakhir Login , <i class="fas fa-clock"></i> <?php echo tgl_lengkap($this->session->userdata('last_login')); ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->                                    
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <!--
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profil</a>
                            </div>
                            -->
                            <div class="pull-right">
                                <a href="<?php echo site_url('login/logout'); ?>" class="btn btn-default btn-flat">Keluar <i class="fas fa-sign-out-alt"></i></a>
                            </div>
                        </li>                        
                    </ul>
                </li>
                
            </ul>
        </div>
    </nav>
</header>
