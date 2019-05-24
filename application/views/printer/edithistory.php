<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
<section class="content-header">
    <h1>
        Edit
        <small>Mutasi Inventaris</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Mutasi Inventaris</a></li>
        <li class="active">Printer</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                <div class="col-md-7">
                <?php
                    echo form_open('printer/edithistory');
                ?>                   
                    <div class="box-body">                        
                        <div class="form-group">                                                
                          <table class="table">
                          <br>
                            <tr>
                              <td style="text-align:right ">No. Inventaris :</td>
                              <td style="width:70%"><?php echo $record['no_inventaris'] ?></td>
                              <input type="hidden"  name="no_inv" value="<?php echo $record['no_inventaris'] ?>" >
                              <input type="hidden"  name="id" value="<?php echo $record['id_history'] ?>" >
                            </tr>
                            
                            <tr>
                              <td style="text-align:right">Type Printer :</td>
                              <td><?php echo $record['jenis_printer']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Spesifikasi :</td>
                              <td><?php echo $record['spesifikasi']?></td>                    
                            </tr>                            
                            <tr>
                              <td style="text-align:right">Status :</td>
                              <td>
                                <select name="status" class="form-control " >
                                <?php 
                                  if ($record['status']=="Mutasi"){
                                    echo "	<option value='Mutasi' selected>Mutasi</option>
											<option value='Dipinjamkan'>Dipinjamkan</option>
											<option value='Kembali'>Kembali</option>
											<option value='Buat Baru'>Inventory Baru</option>";
                                  }else if ($record['status']=="Dipinjamkan"){
                                    echo "	<option value='Mutasi' >Mutasi</option>
											<option value='Dipinjamkan' selected>Dipinjamkan</option>
											<option value='Kembali'>Kembali</option>
											<option value='Buat Baru'>Inventory Baru</option>";
                                  }else if ($record['status']=="Kembali"){
                                    echo "	<option value='Mutasi'>Mutasi</option>
											<option value='Dipinjamkan'>Dipinjamkan</option>
											<option value='Kembali' selected>Kembali</option>
											<option value='Buat Baru'>Inventory Baru</option>";
                                  }else{
                                    echo " 	<option value='Mutasi'>Mutasi</option>
											<option value='Dipinjamkan'>Dipinjamkan</option>
											<option value='Kembali'>Kembali</option>
											<option value='Buat Baru'  selected>Inventory Baru</option>";
                                  }
                                ?>      
                                </select>                                                              
                              </td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tanggal Mutasi:</td>
                              <td>
                                <div class="input-group">                                              
                                    <input type="text" name="tgl_update" class="form-control datepicker" id="datetimepicker" placeholder="yyyy-mm-dd hh:mm" value="<?php echo $record['tgl_update'];?>">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div> 
                                </div><!-- /.input group -->
                                </div><!-- /.input group -->
                                <?php echo form_error('tgl_update', '<div class="text-red">', '</div>'); ?>
                              </td>                    
                            </tr>
                            <tr>
                                <td style="text-align:right">Pengguna :</td>
                                <td>
                                    <select name="pengguna" class="combobox form-control" id="dept">
                                    <option value='' selected="selected">- Pilih Pengguna -</option>
                                        <?php   
                                          $gid=$this->session->userdata('gid');                                     
                                            $pengguna=$this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.gid FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept 
                                              WHERE tb_departemen.gid ='$gid' ORDER BY tb_pengguna.nama_pengguna ASC");
                                            foreach ($pengguna->result() as $r) {
                                                echo "<option value='$r->id_pengguna'";
                                                echo $record['id_pengguna'] == $r->id_pengguna ? 'selected' : '';
                                                echo">".strtoupper($r->nama_pengguna)."</option>";
                                            }
                                            ?>
                                    </select> 
                                    <?php echo form_error('pengguna', '<div class="text-red">', '</div>'); ?>
                                </td>
                            </tr>
                            <tr>
                              <td style="text-align:right">Catatan :</td>
                              <td>
                                  <textarea name="catatan" class="form-control" rows="3" required oninvalid="setCustomValidity('Spesifikasi Laptop Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Catatan / Keterangan"><?php echo $record['note'];?></textarea>
                                <?php echo form_error('catatan', '<div class="text-red">', '</div>'); ?>
                              </td>                    
                            </tr>
                            <tr>
                               <td></td>
                               <td>                                
                                <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                                <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>                                
                               </td> 
                            </tr>
                          </table>                           
                        
                        </div>                      
                    </div><!-- /.box-body -->

                    
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
