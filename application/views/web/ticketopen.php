<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IT Asset Management</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/web/animate.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/web/admin.css'); ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#kategori").change(function(){
      load_inv();
        });  
  });
$(document).ready(function(){
    $(".combobox").combobox();
});

function load_inv(){ 
    var group = $('#group').val();  
    var kategori=$("#kategori").val();
    $.ajax({
        url:"<?php echo base_url('web/tampil_inv');?>",
        data: "kategori=" + kategori+"&group="+group,        
        type  : 'GET',
        success: function(html) { 
           $("#inventaris").html(html);       
        }
    });
}
</script>
<script>
var ckeditor = CKEDITOR.replace('form_ticket_question',{
	height:'800px'
  weigt : '800px'
});
CKEDITOR.disableAutoInline = true;
CKEDITOR.inline('editable');
</script>
</head>
<body class="light_theme  fixed_header left_nav_fixed">
<div class="wrapper">
<div class="header_bar">   
    <div class="header_top_bar">
      <div class="top_right_bar">
        <div class="top_right">
         <div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo base_url('web');?>">Home</a></li>
				<li><a href="<?php echo base_url('login');?>">Login</a></li>
			</ul>
		</div>
        </div>
        
      </div>
    </div>
  </div>
 <div class="inner">
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="container clear_both padding_fix">
        <!--\\\\\\\ container  start \\\\\\-->
        <div class="row">
          <div class="col-sm-8">
          <?php
                echo form_open('web/addcomment');
            ?>  
			     <div class="ticket_open">
              <div class="ticket_open_heading">
                <h3 class="pull-left"><span class="semi-bold">No.Bantuan #<?php echo $this->uri->segment(3);?></span></h3>
              </div>
              <div class="clearfix"></div>
              <div class="open_ticket">
              	<div class="open_ticket_rating pull-left">
                	<div class="rating">
                    
                    </div>
                </div>
                
                <div class="open_ticket_rating pull-right">Average Respones Speed
                	<div class="rating">
                    <i class="fa fa-clock-o rating_i"></i>
                     <span>36.9 Minutes</span>
                    </div>
                </div>
                
              </div>
              <?php 
              if(!empty($detail)){
                foreach ($detail->result() as $r) {
                  echo '
                      <a href="#" class="open_ticket_comment">
                      <div class="open_ticket_thumnail">
                      <div class="btn-group">
                      <i class="fa fa-user"></i>
                      </div>
                      dari :
                      '.strtoupper($r->user).'
                      </div>
                      <p><strong><div class="ticket_problem">'.$r->catatan.'</div></strong></p>
                      <span>Pesan Balasan</span>
                      <p>'.timeAgo($r->tgl_proses).'</p>
                      </a>
                    ';
                  }
                }              
              ?>              
              <div class="input-group">
               <textarea name="catatan" cols="" rows="" class="form_ticket_question2" required oninvalid="setCustomValidity('Not Empty Comment !')" oninput="setCustomValidity('')" placeholder="balas pesan anda disini atau tambahkan catatan"></textarea>
               <input type="text" hidden name="kode" value="<?php echo $this->uri->segment(3);?>">
              </div>
              <?php echo form_error('catatan', '<div class="text-red">', '</div>'); ?>
              <br>
              <div class="btn-group">
                <button type="submit" name="submit" class="btn ticket_btn"><i class="fa fa-share-square" aria-hidden="true"></i> Kirim</button> 
                <a href="javascript:history.back()" class="btn ticket_btn"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Kembali</a>
              </div>
            </div>
            </form>
          </div>
          <div class="col-sm-4"></div>
        </div>
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
</div>
<script src="<?php echo base_url('assets/js/common-script.js'); ?>"></script>
</body>
</html>
