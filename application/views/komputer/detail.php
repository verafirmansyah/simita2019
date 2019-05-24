<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
<script>
var ckeditor = CKEDITOR.replace('spek',{
	height:'600px'
});
CKEDITOR.disableAutoInline = true;
CKEDITOR.inline('editable');
</script>
<section class="content-header">
    <h1>
        Detail Komputer
        <small>Inventaris Komputer (asset no:<?php echo $recordall['kode_komputer'] ?>)</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">Komputer</li>
        <li class="active"><?php echo $recordall['kode_komputer'] ?></li>
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
                        <li><a href="#tab_3" data-toggle="tab"><i class="fas fa-cogs"></i> MAINTENANCE</a></li>                    
                        <li><a href="#tab_4" data-toggle="tab"><i class="fas fa-clipboard-list"></i> HISTORY</a></li>
                        <li class="pull-right"><a href="<?php echo site_url('komputer'); ?>" class="text-muted"><i class="fa fa-remove"></i></a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                        <div class="col-md-6 ">                        
                          <table class="table">
                          <br>
                            <tr>
                              <td style="text-align:right ">No. Inventaris :</td>
                              <td style="width:70%"><?php echo $recordall['kode_komputer'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right ">No. Aset HRD :</td>
                              <td style="width:70%"><?php echo $recordall['aset_hrd'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right">Pengguna :</td>
                              <td><?php echo anchor('pengguna/edit/'.$recordall['id_pengguna'],$recordall['nama_pengguna']);?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right">Cabang :</td>
                              <td><?php echo $recordall['namacabang']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Manufacture :</td>
                              <td><?php echo $recordall['nama_komputer']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tipe Komputer :</td>
                              <td><?php echo $recordall['tipe']?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right">Spesifikasi :</td>
                              <td><?php echo $recordall['spesifikasi']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Service TAG :</td>
                              <td><?php echo $recordall['serial_number']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tgl. Inventaris :</td>
                              <td><?php echo tgl_lengkap($recordall['tgl_inv'])?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tgl. Habis Garansi :</td>
                              <td><p><span style="color: #ff0000;"><strong><?php echo tgl_lengkap($recordall['tgl_garansi'])?></td></strong</p></span>                  
                            </tr>
                            <tr>
                              <td style="text-align:right">IP Address :</td>
                              <td><?php echo $recordall['network']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Key Lisensi :</td>
                              <td><?php echo anchor('lisensi/detail/'.$recordall['id_lisensi'],$recordall['key_lisensi']);?></td>
                            </tr>
                               <!-- Menghitung Jumlah Hari Berakhir Kontrak dari Tanggal Saat ini -->
                               <tr>
                              <td style="text-align:right">Masa Berlaku Lisensi :</td>
                              <td>
                                <span style="color: #ff0000;"><strong>
                                  <?php 
                                  $start_date = new DateTime("now");
                                  $end_date = new DateTime($recordall['tgl_habis']);
                                  $interval = $start_date->diff($end_date);
                                  echo "$interval->days Hari Lagi "; 
                                  ?>
                                </strong></span>   
                              </td>               
                            </tr>
                            <!-- Akhir -->
                            <tr>
                              <td style="text-align:right">Status :</td>
                              <td><?php echo $recordall['status']?></td>                    
                            </tr>
							<tr>
                              <td style="text-align:right">Note/ Catatan :</td>
                              <td><?php echo $recordall['note']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Harga Beli :</td>
                              <td><?php echo 'Rp '.rupiah($recordall['harga_beli'])?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Last Update :</td>
                              <td></td>                    
                            </tr>
                          </table>
                        </div>
                      </div><!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">
                        <div class="col-md-5">
                        <?php
                            echo form_open('komputer/update');
                        ?>
                            
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="example">No. Inventaris</label>
                                    <input type="hidden"  name="kode" value="<?php echo $record['kode_komputer'] ?>" >
                                    <input type="text" name="no_inv" disabled class="form-control" id="inputError" value="<?php echo $record['kode_komputer']; ?>" >
                                </div>   
                                <div class="form-group">
                                    <label for="example">No. Aset HRD</label>
                                    <input type="hidden"  name="aset_hrd" value="<?php echo $record['aset_hrd'] ?>" >
                                    <input type="text" name="aset_hrd" disabled class="form-control" id="inputError" value="<?php echo $record['aset_hrd']; ?>" >
                                </div>                                        
                                <div class="form-group">
                                        <label>Pengguna</label>
                                        <select name="pengguna" class="form-control">
                                            <?php
                                            $gid=$record['gid'];
                                            $pengguna=$this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.gid FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept 
                                              WHERE tb_departemen.gid ='$gid' ORDER BY tb_pengguna.nama_pengguna ASC");
                                            foreach ($pengguna->result() as $r) {
                                                echo "<option value='$r->id_pengguna'";
                                                echo $record['id_pengguna'] == $r->id_pengguna ? 'selected' : '';
                                                echo">".strtoupper($r->nama_pengguna)."</option>";
                                            }
                                            ?>
                                        </select>
                                </div>                      
                                 <div class="form-group">
                                    <label for="example">Brand komputer</label>
                                    <input type="text" name="merek" class="form-control" value="<?php echo $record['nama_komputer']; ?>" required oninvalid="setCustomValidity('Merek/brand Harus di Isi !')"
                                           oninput="setCustomValidity('')" placeholder="ex : ASUS, LENOVO" >
                                           <?php echo form_error('merek', '<div class="text-red">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Spesifikasi</label>
                                    <textarea name="spek" class="ckeditor" rows="3"  required oninvalid="setCustomValidity('Spesifikasi komputer Harus di Isi !')"
                                           oninput="setCustomValidity('')" placeholder="Spesifikasi"><?php echo $record['spesifikasi']; ?></textarea>
                                    <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="example">Serial Number</label>
                                    <input type="text" name="sn" class="form-control" value="<?php echo $record['serial_number']; ?>" required oninvalid="setCustomValidity('Serial Number Harus di Isi !')"
                                           oninput="setCustomValidity('')" placeholder="Serial Number komputer" >
                                           <?php echo form_error('sn', '<div class="text-red">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                  <label>Status</label>
                                    <select name="status" class="combobox form-control">
                                      <?php                                            
                                        $status=$this->db->get("tb_status");
                                        foreach ($status->result() as $r) {
                                          echo "<option value='$r->nama_status'";
                                          echo $record['status'] == $r->nama_status ? 'selected' : '';
                                          echo">".$r->nama_status."</option>";
                                        }
                                      ?>
                                    </select>
                                </div> 
								<div class="form-group">
                                    <label for="example">Note/ Catatan</label>
                                    <input type="text" name="note" class="form-control" value="<?php echo $record['note']; ?>" required oninvalid="setCustomValidity('Serial Number Harus di Isi !')"
                                           oninput="setCustomValidity('')" placeholder="Note / Catatan Status Inventory" >
                                           <?php echo form_error('note', '<div class="text-red">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Tgl. Inventaris</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>                              
                                         <input type="text" name="tgl_inv" value="<?php echo $record['tgl_inv']; ?>" class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tgl. Inventaris harus di isi')"
                                           oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >                            
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Tgl. Habis Garansi</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>                              
                                         <input type="text" name="tgl_garansi" value="<?php echo $record['tgl_garansi']; ?>" class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tgl. Garansi harus di isi')"
                                           oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >                            
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label for="example">Harga Beli</label>
                                    <input type="number" name="harga" class="form-control" value="<?php echo $record['harga_beli']; ?>" required oninvalid="setCustomValidity('Harga Beli Harus di Isi !')"
                                           oninput="setCustomValidity('')" placeholder="Harga Beli Laptop" >
                                           <?php echo form_error('harga', '<div class="text-red">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>IP Address</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-desktop"></i>
                                      </div>
                                      <input name="ip" type="text" class="form-control" value="<?php echo $record['network']; ?>" data-inputmask="'alias': 'ip'" data-mask required/>
                                    </div><!-- /.input group -->
                                    <?php echo form_error('ip', '<div class="text-red">', '</div>'); ?>
                                </div><!-- /.form group -->             
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                                <a href="<?php echo site_url('komputer'); ?>" class="btn btn-primary">Kembali</a>
                            </div>
                        </form>
                        </div>
                      </div>
                      <div class="tab-pane" id="tab_3">
                        <div class="col-md-10 "> 
                        <h4>Maintenance [ <a><?php echo anchor('komputer/maintadd/'.$record['kode_komputer'],'Add New') ?></a> ] 
                        <a href="<?php echo base_url('komputer/print_maintenance/'.$recordall['kode_komputer']) ?>" target="_blank" ><i class="btn fa fa-print" data-toggle="tooltip" title="Cetak"></i></a> </h4>
						                       
                          <table class="table ">
                          <br>
                            <tr>
                              <td><label>No Ticket</label></td>
                              <td><label>Tgl. Permohonan</label></td>
                              <td><label>Maintenance Type</label></td>
                              <td><label>Catatan Permohonan</label></td>                              
                              <td><label>Tgl. Selesai</label></td>
                              <td style="text-align:right"><label>Biaya/ Cost</label></td>
                              <td style="text-align:center"><label>Aksi</label></td>
                            </tr>                            
                             <?php 
                                foreach ($service as $s) {
                                  echo"
                                    <tr>
                                      <td>".anchor('maintenance/detail/'.$s->no_permohonan,$s->no_permohonan)."</td>
                                      <td>".tgl_lengkap($s->tgl_permohonan)."</td>
                                      <td>".$s->jenis_permohonan."</td>
                                      <td>".$s->catatan_pemohon."</td>                                      
                                      <td>".tgl_lengkap($s->tgl_selesai)."</td>
                                      <td style='text-align:right'>".rupiah($s->biaya)."</td>
                                      <td style='text-align:center'>".anchor('maintenance/detail/' . $s->no_permohonan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') ."</td>
                                    </tr> ";
                                }

                             ?>                      
                          </table>
                        </div>
                      </div>
                      <div class="tab-pane" id="tab_4">
                        <div class="col-md-10 ">  
                          <h4>History / Mutasi [ <a><?php echo anchor('komputer/history/'.$recordall['kode_komputer'],'Add New') ?></a> ]</h4>                         
                          <table class="table ">
                          <br>
                            <tr>
                              <td><label>Tanggal</label></td>
                              <td><label>Admin</label></td>
                              <td><label>Status</label></td>
                              <td><label>User Pengguna</label></td>                              
                              <td><label>Note</label></td> 
                              <td><label>Aksi</label></td>                              
                            </tr>                            
                             <?php 
                                foreach ($history as $s) {
                                  echo"
                                    <tr>                                     
                                      <td>".tgl_lengkap($s->tgl_update)."</td>
                                      <td>".$s->admin."</td>
                                      <td>".$s->status."</td>                                      
                                      <td>".anchor('pengguna/edit/'.$s->id_pengguna,$s->nama_pengguna)."</td>
                                      <td>".$s->note."</td> 
                                      <td>" . anchor('komputer/edithistory/' . $s->id_history, '<i class="btn glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>')."<a href=".base_url('komputer/print_history/'.$s->id_history)." target='_blank' ><i class='btn fa fa-print' data-toggle='tooltip' title='Print'></i></td>  									                       
                                    </tr> ";
                                }
                             ?>                      
                          </table>
                        </div>
                      </div>
                    </div><!-- /.tab-content -->                

                </div>
            </div>
        </div>
    </div>
</section>