<!DOCTYPE html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMITA - SIstem Management IT Aset</title>
    <link href='<?php echo base_url("assets/img/favicon.png"); ?>' rel='shortcut icon' type='image/x-icon'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- Google fonts - Montserrat for headings, Cardo for copy-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/google-fonts.css'); ?>">
    <!-- onepage scroll stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/web/onepage-scroll.css'); ?>">
    <link href="<?php echo base_url('assets/css/web/animate.css'); ?>" rel="stylesheet">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.default.css'); ?>" id="theme-stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/web/custom.css'); ?>" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->   
  </head>
 <body>
    <div class="wrapper">
      <div class="main"> 
        <!-- page 1-->
        <section id="page1">
          <div class="overlay"></div>
          <div class="content">
            <div class="container clearfix">
              <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-12">
                  <p class="italic">SIMITA - Sistem Management IT Asset</p>
                  <h1>SIMITA</h1>
                  <p class="italic">Sistem Management IT Asset</p>
                  <p class="italic">Kini telah tersedia aplikasi pengaduan gangguan Komputer,Laptop, dan Printer </p>
                  <p class="italic">Anda Request di isi, kami akan secepatnya memproses permohonan anda</p>
                </div>
              </div>
			  <div class="row">
			   <div class="col-md-12 col-xs-12">
                    <div id="Carousel" class="carousel slide">
                 
                <ol class="carousel-indicators">
                    <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#Carousel" data-slide-to="1"></li>
                </ol>                 
                <!-- Carousel items -->
                <div class="carousel-inner">                    
                <div class="item active">
                    <div class="row">
                      <?php 
          						 if (!empty($group)){
          							foreach ($group as $g) {
          							 echo '
          								<div class="col-md-3 col-sm-12 col-xs-12">
          								<div class="team-member animated fadeInDown" data-animate="fadeInDown">
                          <center>
          									<div class="image">
          										<a href='.base_url('web/ticket/'.$g->gid).'>
          										  <img src='.base_url('assets/img/'.$g->logo).' alt="" >
          										</a>
          									</div>
                          </center>
          									  <h3><a href='.base_url('web/ticket/'.$g->gid).'>'.$g->nama_group.'</a></h3>
          									  <p class="italic">'.$g->alamat.'</p>
          								</div>
          							</div>
          							 ';
          							}
          						 } 
          						 ?>
               
                    </div><!--.row-->
                </div><!--.item-->
                 
                <div class="item">
                    <div class="row">
						 <?php 
						 if (!empty($group2)){
							foreach ($group2 as $g) {
							 echo '
								<div class="col-md-3 col-sm-12 col-xs-12">
								<div class="team-member animated fadeInDown" data-animate="fadeInDown">
									<div class="image">
										<a href='.base_url('web/ticket/'.$g->gid).'>
										  <img src='.base_url('assets/img/'.$g->logo).' alt="" class="img-responsive img-circle">
										</a>
									</div>
									  <h3><a href='.base_url('web/ticket/'.$g->gid).'>'.$g->nama_group.'</a></h3>
									  <p class="italic">'.$g->alamat.'</p>
								</div>
							</div>
							 ';
							}
						 } 
						 ?>
                        
                    </div><!--.row-->
                </div><!--.item-->
                 
                </div><!--.carousel-inner-->
                  <a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
                  <a data-slide="next" href="#Carousel" class="right carousel-control">›</a>
                </div><!--.Carousel-->
				</div>	
			  </div>
            </div>
          </div>
        </section>
        
         
      </div>
    </div>
    <!-- Javascript files-->
    <script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.cookie.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.onepage-scroll.js'); ?>"></script>
   
   <script type="text/javascript">
    $(document).ready(function() {
        $('#Carousel').carousel({
            interval: 5000
        })
    });
   </script>

  </body>
</html>