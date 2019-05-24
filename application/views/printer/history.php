<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
<section class="content-header">
    <h1>
        Tambah
        <small>Mutasi Inventaris Printer</small>
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
                    echo form_open('printer/history');
                ?>                   
                    <div class="box-body">                        
                        <div class="form-group">                                                
                          <table class="table">
                            <tr>
                              <td style="text-align:right ">No. Inventaris :</td>
                              <td style="width:70%"><?php echo $recordall['kode_printer'] ?></td>
                              <input type="hidden"  name="no_inv" value="<?php echo $recordall['kode_printer'] ?>" >
                            </tr>
                            <tr>
                              <td style="text-align:right">Pengguna Lama :</td>
                              <td><?php echo $recordall['nama_pengguna']?></td>  
                              <input type="hidden"  name="pengguna_awal" value="<?php echo $recordall['id_pengguna'] ?>" >                  
                            </tr>
                            <tr>
                              <td style="text-align:right">Type Monitor :</td>
                              <td><?php echo $recordall['jenis_printer']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Spesifikasi :</td>
                              <td><?php echo $recordall['spesifikasi']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tgl Inventaris :</td>
                              <td><?php echo tgl_lengkap($recordall['tgl_inv']);?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Status :</td>
                              <td>
                                <select name="status" class="form-control " >                                 
                                <option value='Mutasi'>Mutasi</option> 
								<option value='Dipinjamkan'>Dipinjamkan</option> 
                                <option value='Kembali'>Kembali</option>
                                <option value='Buat Baru'>Inventory Baru</option>                                                               
                            </select>
                              </td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tanggal :</td>
                              <td>
                                <div class="input-group">                                                                   
                                    <input type="text" name="tgl_update" class="form-control datepicker" id="datetimepicker" placeholder="yyyy-mm-dd hh:mm">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div> 
                                </div><!-- /.input group -->
                                <?php echo form_error('tgl_update', '<div class="text-red">', '</div>'); ?>
                              </td>                    
                            </tr>
                            <tr>
                                <td style="text-align:right">Pengguna Baru :</td>
                                <td>
                                    <select name="pengguna" class="combobox form-control" id="dept">
                                    <option value='' selected="selected">- Pilih Pengguna Baru -</option>
                                        <?php
                                        if (!empty($pengguna)) {
                                            foreach ($pengguna as $row) {
                                                echo "<option value=".$row->id_pengguna.">".strtoupper($row->nama_pengguna)."</option>";                                        
                                            }
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
                                   oninput="setCustomValidity('')" placeholder="Catatan / Keterangan"></textarea>
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
