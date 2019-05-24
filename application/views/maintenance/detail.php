<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/ckeditor/ckeditor.js'); ?>"></script>
<!-- Notifikasi -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
<script>   
    $('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>
<style>
#notifications {
  
    position: fixed;
    right: 0px;
    z-index: 9999;
    bottom: 0px;
    margin-bottom: 22px;
    margin-right: 15px;
    min-width: 300px; 
    max-width: 800px;  
}
</style>
-<!-- Akhir Notifikasi -->
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
<script>
var ckeditor = CKEDITOR.replace('form_ticket_question',{
	height:'800px'
  weigt : '800px'
});
CKEDITOR.disableAutoInline = true;
CKEDITOR.inline('editable');
</script>
<?php
function terbilang($x){
  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . " Belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " Seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " Seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}
?>
<section class="content-header">
    <h1>
        Detail Maintenance
        <small>Maintenance Inventaris</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Maintenance</a></li>
        <li class="active">Inventaris</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">   
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fas fa-address-card"></i> DETAIL</a></li>
                        <li><a href="#tab_2" data-toggle="tab"><i class="fas fa-edit"></i> EDIT</a></li>  
                        <li class="pull-right"><a href="<?php echo site_url('maintenance'); ?>" class="text-muted"><i class="fa fa-remove"></i></a></li>                      
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                        <div class="col-md-6 ">                        
                          <table class="table">
                          <br>
                            <tr>
                              <td style="text-align:right ">No Permohonan/ Ticket :</td>
                              <td style="width:60%"><?php echo $recordall['no_permohonan'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right">Tgl. Permohonan :</td>
                              <td><?php echo tgl_lengkap($recordall['tgl_permohonan'])?></td>                    
                            </tr>      
                       
                            <tr>
                              <td style="text-align:right">Maintenance Type :</td>
                              <td><?php echo $recordall['jenis_permohonan']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Kategori Inventaris :</td>
                              <td><?php echo $recordall['nama_kategori']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">No Inventaris :</td>
                              <td><?php echo anchor(''.$recordall['nama_kategori'].'/detail/'.$recordall['no_inventaris'],$recordall['no_inventaris'])?></td>                  
                            </tr>
                            <tr>
                              <td style="text-align:right">Spesifikasi :</td>
                              <td><?php echo $inv['spesifikasi']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Status :</td>
                              <td><?php echo $inv['status']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">User Pengguna :</td>
                              <td><?php echo $inv['nama_pengguna']?></td>                   
                            </tr>
                            <tr>
                              <td style="text-align:right">Catatan Permohonan :</td>
                              <td><?php echo $recordall['catatan_pemohon']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tgl. Selesai :</td>
                              <td><?php echo tgl_lengkap($recordall['tgl_selesai'])?></td>                    
                            </tr>
                             <tr>
                              <td style="text-align:right" >Catatan Perbaikan :</td>
                              <td><?php echo $recordall['catatan_perbaikan']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Nama Supplier :</td>
                              <td><?php echo strtoupper($recordall['nama_supplier'])?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Biaya :</td>
                              <td><?php echo "Rp ".rupiah($recordall['biaya'])?> (<i><?php echo "".terbilang($recordall['biaya'])?> Rupiah </i>)</td>                    
                            </tr>
                             <tr>
                              <td style="text-align:right">Status :</td>
                              <td>
                              <?php 
                                  if ($recordall['status'] =="OPEN"){
                                      $status="<span class='label label-danger'>" . $recordall['status']. "</span>";
                                  }elseif($recordall['status'] =="CLOSED") {
                                      $status="<span class='label label-success'>" .$recordall['status']."</span>";
                                  }else{
                                       $status="<span class='label label-warning'>" .$recordall['status']."</span>";
                                  }  
                                echo $status;
                                ?>                             
                              </td>                    
                            </tr>
                          </table>
                        </div>
                        <div class="col-md-5 "> 
                        <br>
                            <div class="box box-primary direct-chat direct-chat-primary">
                          <div class="box-header with-border">
                            <h3 class="box-title"><i class="fas fa-clipboard-list"></i> History Proses Perbaikan</h3>
                            
                          </div><!-- /.box-header -->
                          <div class="box-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages">
							<?php 
								if(!empty($detail)){
									foreach ($detail->result() as $r ){
										if($r->user=="Admin"){
											echo '
												<div class="direct-chat-msg right">
												<div class="direct-chat-info clearfix">
												  <span class="direct-chat-name pull-right">'.strtoupper($r->user).'</span>
												  <span class="direct-chat-timestamp pull-left">'.tgl_lengkap($r->tgl_proses).'</span>
												</div>
												<img class="direct-chat-img" src='.base_url('assets/img/avatar5.png').' alt="message user image">
												<div class="direct-chat-text">'.$r->catatan.'</div>
											  </div> 
											';
										}else {
											echo '
												<div class="direct-chat-msg">
												<div class="direct-chat-info clearfix">
												  <span class="direct-chat-name pull-left">'.strtoupper($r->user).'</span>
												  <span class="direct-chat-timestamp pull-right"><i class="far fa-clock"></i> '.tgl_lengkap($r->tgl_proses).'</span>
												</div>
												<img class="direct-chat-img" src='.base_url('assets/img/avataruser.jpg').' alt="message user image">
												<div class="direct-chat-text">'.$r->catatan.'</div>
											  </div>
											';
										}										
									}
								}
							?>                                                 
                            </div>                           
                          </div><!-- /.box-body -->
                          <div class="box-footer">
                            <?php
								echo form_open('maintenance/chat_simpan');
							?>  
                              <div class="input-group">
								<input type="text" hidden name="kode" value="<?php echo $recordall['no_permohonan'] ?>">
                                <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="catatan" placeholder="Type Message ..." class="form-control" required oninvalid="setCustomValidity('Not Empty Message !')" oninput="setCustomValidity('')">
                                <span class="input-group-btn">
                                  <button type="submit" name="submit" class="btn btn-primary btn-flat"><i class="fas fa-paper-plane"></i> Send</button>								  
                                </span>
                              </div>
                            </form>
                          </div><!-- /.box-footer-->
                        </div>


                        </div>
                      </div><!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">                        
                        <?php echo form_open('maintenance/update'); ?>                            
                          <div class="box-body">
                            <table class="table">
                              <br>
                              <tr>
                                  <td style="width:15%">No Ticket</td>
                                  <td>
                                    <div class=" col-sm-4">
                                    <input type="hidden"  name="no_permohonan" value="<?php echo $recordall['no_permohonan'] ?>" >
                                      <?php echo ': ',$recordall['no_permohonan']?>                   
                                    </div>
                                  </td>
                              <tr>
                              <tr>
                                  <td style="width:15%">Jenis Inventaris</td>
                                  <td>
                                    <div class=" col-sm-4">
                                    <input type="hidden"  name="kategori" value="<?php echo $recordall['nama_kategori'] ?>" >
                                       <?php echo ': ',$recordall['nama_kategori']?>                   
                                    </div>
                                  </td>
                              <tr>
                              <tr>
                                  <td>No.Inventaris</td>
                                  <td>
                                    <div class=" col-sm-4">
                                      <?php echo ': ',$recordall['no_inventaris']?>
                                      <input type="hidden" name="no_inv" value="<?php echo $recordall['no_inventaris']?>" >                     
                                    <div>
                                  </td>
                              <tr> 
                              <tr>
                                  <td>Maintenance Type</td>
                                  <td>
                                    <div class=" col-sm-4">                                        
                                      <select name="type" class="form-control " >                              
                                          <option value='<?php echo $recordall['jenis_permohonan']; ?>'><?php echo $recordall['jenis_permohonan'];'selected' ?></option>        
                                          <option value="Hardware">Hardware</option>                               
                                	        <option value="Software">Software</option> 
				  	                              <option value="Hardware & Software">Hardware & Software</option> 
					                                <option value="Network">Network/ Jaringan</option> 
                                      </select>         
                                    </div>
                                  </td>
                              <tr> 
                        
                              <tr>
                                  <td>Tgl. Permohonan</td>
                                  <td>
                                    <div class=" col-sm-4"> 
                                      <?php echo ': ', tgl_lengkap($recordall['tgl_permohonan'])?> 
                                    </div>
                                  </td>
                              <tr> 
                              <tr>
                                  <td>Catatan Pemohon</td>
                                  <td>
                                      <div class=" col-sm-4">                                                         
                                          <textarea name="catatan" class="ckeditor" onkeyup="this.value = this.value.toUpperCase()" class="form-control" rows="3" required oninvalid="setCustomValidity('Catatan Pemohon Harus di Isi !')"
                                                 oninput="setCustomValidity('')" placeholder="catatan Permohonan"><?php echo $recordall['catatan_pemohon']?></textarea>
                                          <?php echo form_error('catatan', '<div class="text-red">', '</div>'); ?>
                                      </div>               
                                  </td>
                              <tr>
                              <tr>
                                  <td>Tgl. Selesai</td>
                                  <td>
                                      <div class=" col-sm-4">
                                          <div class=" input-group">
                                            <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                            </div>                              
                                          <input type="datetime" name="tgl_selesai" class="form-control datepicker" id="datetimepicker2" value="<?php echo $recordall['tgl_selesai']?>" placeholder="yyyy-mm-dd hh:mm" >                            
                                          </div>
                                      </div><!-- /.input group -->                  
                                  </td>
                              <tr>    
                              <tr>
                                  <td>Catatan Perbaikan</td>
                                  <td>
                                      <div class=" col-sm-4">                                                         
                                          <textarea name="catatan_perbaikan" onkeyup="this.value = this.value.toUpperCase()" class="form-control" rows="3" required oninvalid="setCustomValidity('Catatan Pemohon Harus di Isi !')"
                                                 oninput="setCustomValidity('')" placeholder="Catatan Perbaikan"><?php echo $recordall['catatan_perbaikan']?></textarea>
                                          <?php echo form_error('catatan_perbaikan', '<div class="text-red">', '</div>'); ?>
                                      </div>               
                                  </td>
                              <tr>
                              <tr>
                                  <td>Nama Suplier/Rekanan</td>
                                  <td>
                                      <div class="col-sm-4">
                                          <select name="supplier" class="form-control" > 
                                              <option value="">- Select -</option>                               
                                              <?php
                                                foreach ($record as $k) {
                                                    echo "<option value='$k->nama_supplier'";
                                                    echo $recordall['nama_supplier'] == $k->nama_supplier ? 'selected' : '';
                                                    echo">$k->nama_supplier</option>";
                                                }
                                              ?>
                                          </select>
                                          *Note : di isi ketika service di rekanan
                                      </div>                                          
                                  </td>
                              <tr> 
                              <tr>
                                  <td>Cost /Biaya</td>
                                  <td>
                                      <div class="col-sm-4">
                                          <input type="text" class="form-control" name="biaya" placeholder="Cost / Biaya" value="<?php echo $recordall['biaya']?>" > 
                                      </div>                                          
                                  </td>
                              <tr>
                              <tr>
                                  <td>Status Maintenance</td>
                                  <td>
                                    <div class=" col-sm-4">                                        
                                      <select name="status" class="form-control " >                              
                                          <option value='<?php echo $recordall['status']; ?>'><?php echo $recordall['status'];'selected' ?></option>        
                                          <option value="OPEN">OPEN</option>                               
                                          <option value="PROCESS">PROCESS</option> 
                                          <option value="PENDING">PENDING</option>
                                          <option value="CLOSED">CLOSED</option>                                
                                      </select>         
                                    </div>
                                  </td>
                              <tr>     
                          </table>                
                          </div><!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Update</button>
                            <a href="<?php echo site_url('maintenance'); ?>" class="btn btn-primary">Kembali</a>
                          </div>
                        </form>
                        
                      </div>
                      
                    </div><!-- /.tab-content -->                

                </div>
            </div>
        </div>
    </div>
</section>