<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
<section class="content-header">
    <h1>
        Detail
        <small>Inventaris Device Suport</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">Device Suport</li>
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">DETAIL</a></li>
                        <li><a href="#tab_2" data-toggle="tab">EDIT</a></li>                   
                        <li><a href="#tab_3" data-toggle="tab">HISTORY</a></li>
                        <li class="pull-right"><a href="<?php echo site_url('device'); ?>" class="text-muted"><i class="fa fa-remove"></i></a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                        <div class="col-md-6 ">                        
                          <table class="table">
                          <br>
                            <tr>
                              <td style="text-align:right ">No. Inventaris :</td>
                              <td style="width:70%"><?php echo $recordall['kode_network'] ?></td>
                            </tr>                            
                            <tr>
                              <td style="text-align:right">Device Type :</td>
                              <td><?php echo $recordall['jenis_network']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Spesifikasi :</td>
                              <td><?php echo $recordall['spesifikasi']?></td>                    
                            </tr>                            
                            <tr>
                              <td style="text-align:right">Tgl. Inventaris :</td>
                              <td><?php echo tgl_lengkap($recordall['tgl_inv'])?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Lokasi :</td>
                              <td><?php echo $recordall['lokasi']?></td>                    
                            </tr>                            
                            <tr>
                              <td style="text-align:right">Status :</td>
                              <td><?php echo $recordall['status']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Harga Beli :</td>
                              <td><?php echo 'Rp '.rupiah($recordall['harga_beli'])?></td>                    
                            </tr>
                            
                          </table>
                        </div>
                      </div><!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">
                        <div class="col-md-5">
                          <?php
                            echo form_open('device/edit');
                          ?>                          
                          <div class="box-body">
                              <div class="form-group">
                                  <label for="example">No. Inventaris</label>
                                  <input type="hidden"  name="kode" value="<?php echo $record['kode_network'] ?>" >
                                  <input type="text" name="no_inv" disabled class="form-control" id="inputError" value="<?php echo $record['kode_network']; ?>" >
                              </div>                                            
                              <div class="form-group">
                                  <label for="example">Device Type</label>                           
                                  <input type="text" name="jenis" class="form-control" id="inputError" oninvalid="setCustomValidity('Network Device Harus di Isi !')"
                                         oninput="setCustomValidity('')" placeholder="ex: Switch, HUB, Router" value="<?php echo $record['jenis_network']; ?>" >
                              </div> 
                              <div class="form-group">
                                  <label for="">Spesifikasi</label>
                                  <textarea name="spek" class="form-control" rows="3"  required oninvalid="setCustomValidity('Spesifikasi network Harus di Isi !')"
                                         oninput="setCustomValidity('')" placeholder="Spesifikasi"><?php echo $record['spesifikasi']; ?></textarea>
                                  <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                              </div>  
                              <div class="form-group">
                                  <label for="example">Lokasi Penggunaan</label>                           
                                  <input type="text" name="lokasi" class="form-control" id="inputError" oninvalid="setCustomValidity('Lokasi Device  Harus di Isi !')"
                                         oninput="setCustomValidity('')" placeholder="ex: Ruang Core server" value="<?php echo $record['lokasi']; ?>" >
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
                                <label for="example">Harga Beli</label>
                                  <input type="number" name="harga" class="form-control" value="<?php echo $record['harga_beli']; ?>" required oninvalid="setCustomValidity('Harga Beli Harus di Isi !')"
                                    oninput="setCustomValidity('')" placeholder="Harga Beli Laptop" >
                                  <?php echo form_error('harga', '<div class="text-red">', '</div>'); ?>
                              </div>
                                       
                          </div><!-- /.box-body -->

                          <div class="box-footer">
                              <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                              <a href="<?php echo site_url('device'); ?>" class="btn btn-primary">Kembali</a>
                          </div>
                      </form>                          
                        </div>
                      </div>
                      
                      <div class="tab-pane" id="tab_3">
                        <div class="col-md-10 ">  
                          <h4>History / Mutasi [ <a><?php echo anchor('device/history/'.$recordall['kode_network'],'Add New') ?></a> ]</h4>                         
                          <table class="table ">
                          <br>
                            <tr>
                              <td><label>Tanggal</label></td>
                              <td><label>Admin</label></td>
                              <td><label>Status</label></td>
                              <td><label>Lokasi</label></td>                              
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
                                      <td>".$s->lokasi."</td>
                                      <td>".$s->note."</td> 
                                      <td>" . anchor('device/edithistory/' . $s->id_history, '<i class="btn glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>                                      
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