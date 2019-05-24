<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IT Asset Management</title>
<link href='<?php echo base_url("assets/img/favicon.ico"); ?>' rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/web/animate.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/web/admin.css'); ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
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
</head>
<body class="light_theme  fixed_header left_nav_fixed">
<div class="wrapper">
  <div class="header_bar">   
    <div class="header_top_bar">
    <h4>Suzuki Sejahtera Group</h4><br/>
      <div class="top_right_bar">
        <div class="top_right">
        </div>
        
      </div>
    </div>
  </div>
  <div class="inner">
    <div class="contentpanel">
        <div class="container clear_both padding_fix">
        <div class="row">
          <div class="col-md-5">
			     <?php
                echo form_open('web/addticket');
            ?>  
            <div class="ticket_form">
              <div class="btn-group"> <a href="javascript:void(0)" class="btn btn-sm ticket_btn">Perbaikan</a> </div>
              <div class="btn-group"> <a href="<?php echo base_url('login');?>" class="btn btn-sm ticket_btn">Login</a> </div> 
              <div class="btn-group"> <a href="<?php echo base_url('web');?>" class="btn btn-sm ticket_btn">Home</a> </div> 
              <br/>
              <br/>
              <h3><span class="semi-bold">Permohonan Perbaikan Aset IT</span></h3>
              <h4><span class="semi-bold">SIMITA (SIstem Managemen IT Aset) v.2.3</span></h4>
              <p>Buat Permohonan Perbaikan untuk Inventaris Anda, Masukan Nomor Inventaris dan berikan informasi keluhan anda</p>
              <div class="ticket_option">
                <div class="form_ticket_subject"> <span class="semi-bold">Group Inventory</span>
                  <div class="input-group ">
  					       <select name="group" class="form-control" id="group">                    
                      <?php
                        if (!empty($group)) {
  									       foreach ($group as $row) {
                            echo "<option value='$row->gid'>".strtoupper($row->nama_group)."</option>";
                          }
                        }
                      ?>
                    </select>                             
                    <?php echo form_error('group', '<div class="text-red">', '</div>'); ?>
                  </div>
                </div>              
                <div class="form_ticket_subject"> <span class="semi-bold">Type Inventory</span>
                  <div class="input-group">
                   <select name="kategori" class="form-control" id="kategori" >  
          						<option value="" selected="selected">- Jenis Inventaris -</option>                 
          						<option value="Laptop">LAPTOP</option> 
          						<option value="Komputer">KOMPUTER</option> 
          						<option value="Monitor">MONITOR</option> 
          						<option value="Printer">PRINTER</option> 
          						<option value="Network">NETWORK DEVICE</option> 
                    </select>                             
                    <?php echo form_error('kategori', '<div class="text-red">', '</div>'); ?>        
                  </div>
                </div>
              </div>
              
              <div class="ticket_option">
                <div class="form_ticket_subject"><span class="semi-bold">No. Inventory</span>
                    <div class="input-group">
                     <select name="inventaris" class="form-control" id="inventaris"> 
                        <option value="" selected="selected">- No. Inventaris-</option>
                      </select>                        
                    </div> 
                    <?php echo form_error('inventaris', '<div class="text-red">', '</div>'); ?>                      
                </div> 
				      <div class="form_ticket_subject"> <span class="semi-bold">Nama Pemohon</span>
                  <div class="">
                    <div class="input-group">
                      <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="pemohon" class="form-control" required oninvalid="setCustomValidity('Nama Pemohon masih kosong')" oninput="setCustomValidity('')" placeholder="Masukan nama anda" >
                    </div>
                  </div>
                  <?php echo form_error('pemohon', '<div class="text-red">', '</div>'); ?>
                </div>
              </div>		
              <div class="ticket_option_detail"><br><span class="semi-bold">Detail Permasalahan</span>
                <div class="input-group">
                 <textarea name="catatan" placeholder="Isi detail permasalahan" required oninvalid="setCustomValidity('Catatan Pemohon Harus di Isi !')"
                  oninput="setCustomValidity('')" class="ckeditor"></textarea>
                </div>
                <?php echo form_error('catatan', '<div class="text-red">', '</div>'); ?>
              </div>
              <div class="btn-group">
                <button type="submit" name="submit" class="btn ticket_btn">Kirim</button> 
              </div><br><br>
              <p><p><span style="color: #999999;"><em>CopyRight&nbsp;&copy; 2017-2018 - Divisi IT PT.Sejahtera Buana Trada</em></span></p></p>
            </div>
			     </form>
          </div>
          <div class="col-md-7">
            <div class="ticket_open">
              <div class="ticket_open_heading">
                <h3 class="pull-left"><span class="semi-bold">Open Ticket</span></h3>
                <div class="ticket_open_search">                  
                  <div class="input-group pull-left">
                    <input type="text" placeholder="Search Open Ticket ..." class="form-control">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="ticket_open_grid"><b class="pull-right">5 Data Load</b> <span class="ticket_open_grid_progress">Page Limits</span> </div>
              <?php 
              if ($ticket->num_rows()>0){
                foreach ($ticket->result() as $key =>$r) {
                  echo '
                      <a href="'.site_url('web/openticket/'.$r->no_permohonan).'" class="ticket_open_comment">
                        <div class="btn-group"><i class="fa fa-user"></i></div>
                        <span>'.strtoupper($r->nama_pemohon),' / ',$r->no_inventaris.'</span>                        
                        <p>'.$r->catatan_pemohon.'</p>
                        <p>catatan perbaikan : <font color="#A4A4A4"><b>menunggu respon IT</font></p></b>
                        <div class="ticket_action"> <p>status : <font color="orange">'.$r->status.'</p></font>
                        </div>                      
                    </a>
                  ';
                }
                echo $paging;
              }else{
                echo'
                  <div class="alert alert-success alert-dismissable">                
                    <h4><i  class="icon fa fa-check"></i> Status Open Ticket Masih Kosong</h4>
                    
                  </div>
                ';
              }
              ?>
            </div>
            <!-- Tiket On Progress -->
            <div class="ticket_open">
              <div class="ticket_open_heading">
                <h3 class="pull-left"><span class="semi-bold">On Progress</span></h3>
                <div class="ticket_open_search">                  
                  <div class="input-group pull-left">
                    <input type="text" placeholder="Search On Progress ..." class="form-control">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <?php 
              if ($ticketprogress->num_rows()>0){
                foreach ($ticketprogress->result() as $key =>$r) {
                  echo '
                      <a href="'.site_url('web/openticket/'.$r->no_permohonan).'" class="ticket_open_comment">
                        <div class="btn-group"><i class="fa fa-user"></i></div>
                        <span>'.strtoupper($r->nama_pemohon),' / ',$r->no_inventaris.'</span>                        
                        <p>'.$r->catatan_pemohon.'</p>
                        <p>catatan perbaikan : <font color="red"><b>'.$r->catatan_perbaikan.'</font></p></b>
                        <div class="ticket_action"> <p>status : <font color="blue">'.$r->status.'</p></font>
                          
                        </div>                      
                    </a>
                  ';
                }
                echo $paging;
              }else{
                echo'
                  <div class="alert alert-success alert-dismissable">                
                    <h4><i  class="icon fa fa-check"></i> Status On Progress Ticket Masih Kosong</h4>
                    
                  </div>
                ';
              }
              ?>
            </div>
            <!-- Akhir Tiket On Progress -->
            <div class="ticket_open">
              <div class="ticket_open_heading">
                <h3 class="pull-left"><span class="semi-bold">Closed Ticket</span></h3>
                <div class="ticket_open_search">
                  <div class="input-group pull-left">
                    <input type="text" class="form-control" placeholder="Search closed Ticket ...">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              
              <?php 
              if ($ticketclose->num_rows()>0){
                foreach ($ticketclose->result() as $key =>$r) {
                  echo '
                      <a href="'.site_url('web/openticket/'.$r->no_permohonan).'" class="ticket_open_comment">
                        <div class="btn-group"><i class="fa fa-user"></i></div>
                        <span>'.strtoupper($r->nama_pemohon),' / ',$r->no_inventaris.'</span>                        
                        <p>'.$r->catatan_pemohon.'</p>
                        <p>catatan dari IT : <font color="#40FF00"><b>'.$r->catatan_perbaikan.'</font></p></b>
                        <div class="ticket_action"><p>status : <i class="fa fa-check-square-o" aria-hidden="true" style="color:green"></i></i><font color="#40FF00">'.$r->status.'</p></font>
                        </div>                      
                    </a>
                  ';
                }                
              }else{
                echo'
                  <div class="alert alert-success alert-dismissable">                
                    <h4><i  class="icon fa fa-check"></i> Data Close Ticket Masih Kosong</h4>
                    
                  </div>
                ';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <!--\\\\\\\ container  end \\\\\\-->
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->
  </div>
  <!--\\\\\\\ inner end\\\\\\-->
</div>
<!--\\\\\\\ wrapper end\\\\\\-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Compose New Task</h4>
      </div>
      <div class="modal-body"> content </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- sidebar chats -->
<nav class="atm-spmenu atm-spmenu-vertical atm-spmenu-right side-chat">
	<div class="header">
    <input type="text" class="form-control chat-search" placeholder=" Search">
  </div>
  <div href="#" class="sub-header">
    <div class="icon"><i class="fa fa-user"></i></div> <p>Online (4)</p>
  </div>
  <div class="content">
    <p class="title">Family</p>
    <ul class="nav nav-pills nav-stacked contacts">
      <li class="online"><a href="#"><i class="fa fa-circle-o"></i> Steven Smith</a></li>
      <li class="online"><a href="#"><i class="fa fa-circle-o"></i> John Doe</a></li>
      <li class="online"><a href="#"><i class="fa fa-circle-o"></i> Michael Smith</a></li>
      <li class="busy"><a href="#"><i class="fa fa-circle-o"></i> Chris Rogers</a></li>
    </ul>
    
    <p class="title">Friends</p>
    <ul class="nav nav-pills nav-stacked contacts">
      <li class="online"><a href="#"><i class="fa fa-circle-o"></i> Vernon Philander</a></li>
      <li class="outside"><a href="#"><i class="fa fa-circle-o"></i> Kyle Abbott</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Dean Elgar</a></li>
    </ul>   
    
    <p class="title">Work</p>
    <ul class="nav nav-pills nav-stacked contacts">
      <li><a href="#"><i class="fa fa-circle-o"></i> Dale Steyn</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Morne Morkel</a></li>
    </ul>
    
  </div>
  <div id="chat-box">
    <div class="header">
      <span>Richard Avedon</span>
      <a class="close"><i class="fa fa-times"></i></a>    </div>
    <div class="messages nano nscroller has-scrollbar">
      <div class="content" tabindex="0" style="right: -17px;">
        <ul class="conversation">
          <li class="odd">
            <p>Hi John, how are you?</p>
          </li>
          <li class="text-right">
            <p>Hello I am also fine</p>
          </li>
          <li class="odd">
            <p>Tell me what about you?</p>
          </li>
          <li class="text-right">
            <p>Sorry, I'm late... see you</p>
          </li>
          <li class="odd unread">
            <p>OK, call me later...</p>
          </li>
        </ul>
      </div>
    <div class="pane" style="display: none;"><div class="slider" style="height: 20px; top: 0px;"></div></div></div>
    <div class="chat-input">
      <div class="input-group">
        <input type="text" placeholder="Enter a message..." class="form-control">
        <span class="input-group-btn">
        <button class="btn btn-danger" type="button">Send</button>
        </span>      </div>
    </div>
  </div>
</nav>
<!-- /sidebar chats -->   
<script src="<?php echo base_url('assets/js/common-script.js'); ?>"></script>
</body>
</html>
