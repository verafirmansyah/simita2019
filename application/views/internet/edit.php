<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/maskedinput/jquery.maskedinput.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/ckeditor/ckeditor.js'); ?>"></script>
<script>
        jQuery(function($){
            $("#asethrd").mask("aaaa99/9/9/9/999/9");
            $("#ip").mask("999.999.999.999");
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
        Edit
        <small>Data Inventaris Internet</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">Internet</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                <div class="col-md-5">
                <?php
                    echo form_open('internet/edit');
                ?>
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Nama Provider</label>
                            <input type="hidden"  name="id" value="<?php echo $record['nama_provider'] ?>" >
                            <input type="text" name="nama_provider" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')" disabled class="form-control" placeholder="Masukan Nama Barang" value="<?php echo $record['nama_provider']; ?>" >
                        </div>                 
                        <div class="form-group">
                            <label for="example">Cabang</label>
                            <input type="hidden"  name="id" value="<?php echo $record['nama_cabang'] ?>" >
                            <input type="text" name="nama_cabang" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama PIC/Sales Harus di Isi !')"
                                   oninput="setCustomValidity('')" disabled class="form-control" placeholder="Masukan Email Provider" value="<?php echo $record['nama_cabang']; ?>" >
                        </div>        
                        <div class="form-group">
                            <label>Jenis Koneksi</label>
                            <select name="jenis" class="form-control " >
                                <option value='<?php echo $record['tipe_koneksi']; ?>'><?php echo $record['tipe_koneksi'];'selected' ?></option>
                                <option value='WIRELESS'>WIRELESS BROADBAND</option>
                                <option value='FIBER OPTIC'>FIBER OPTIC</option>
                                <option value='TV CABLE'>TV CABLE</option>
                                <option value='MODEM'>MODEM</option>                                                               
                            </select>
                            <?php echo form_error('jenis', '<div class="text-red">', '</div>'); ?>
                        </div>     
                        <div class="form-group">
                            <label for="example">Nomor Pelanggan</label>
                            <input type="hidden"  name="id" value="<?php echo $record['nomor_pelanggan'] ?>" >
                            <input type="text" name="nomor_pelanggan" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')"  placeholder="Masukan Nama Barang" value="<?php echo $record['nomor_pelanggan']; ?>" >
                        </div>          
                        <div class="form-group">
                            <label>IP Public</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                              </div>
                              <input name="ip_public" type="text" class="form-control" id="ip" value="<?php echo $record['ip_public']; ?>" />
                            </div><!-- /.input group -->
                            <?php echo form_error('ip', '<div class="text-red">', '</div>'); ?>
                        </div><!-- /.form group -->
                        <div class="form-group">
                            <label for="">Spesifikasi & Informasi Lain</label>
                            <textarea name="spesifikasi" onkeyup="this.value = this.value.toUpperCase()"  class="ckeditor" rows="3" required oninvalid="setCustomValidity('Spesifikasi Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Kapasitas Bandwidth Download dan Upload serta keterangan lainnya"><?php echo $record['spesifikasi']; ?></textarea>
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kontrak</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              
                                 <input type="text" name="tanggal_kontrak" value="<?php echo $record['tanggal_kontrak']; ?>"  class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tanggal Kontrak Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >
                            
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Tanggal Akhir Kontrak</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                                 <input type="text" name="masa_kontrak" value="<?php echo $record['masa_kontrak']; ?>" class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tanggal Akhir Kontrak Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >

                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label for="example">Biaya Per-Bulan</label>
                            <input type="number" name="biaya" value="<?php echo $record['biaya']; ?>" class="form-control" required oninvalid="setCustomValidity('Biaya Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="2000000" >
                                   <?php echo form_error('biaya', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control " >
                                <option value='<?php echo $record['tipe_koneksi']; ?>'><?php echo $record['status'];'selected' ?></option>
                                <option value='AKTIF'>AKTIF</option>
                                <option value='HABIS KONTRAK'>HABIS KONTRAK</option>
                                <option value='DIPUTUS'>DIPUTUS</option>                                                          
                            </select>
                        </div>  

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                        <a href="<?php echo site_url('internet'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>