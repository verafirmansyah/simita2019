<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/maskedinput/jquery.maskedinput.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
<script>
var ckeditor = CKEDITOR.replace('spek',{
	height:'600px'
});
CKEDITOR.disableAutoInline = true;
CKEDITOR.inline('editable');
</script>
<!-- Notifikasi -->
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
<section class="content-header">
    <h1>
        Tambah
        <small>Data Lisensi Software</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Lisensi & Password</a></li>
        <li class="active">AntiVirus & Software</li>
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
                    echo form_open('lisensi/add');
                ?> 
                    <div class="box-body">                        
                        <div class="form-group">
                            <label>Supplier/Vendor</label>
                            <select name="id_supplier" class="combobox form-control" id="supplier"> 
                                <option value="">- Pilih Nama Supplier -</option>                               
                                    <?php
                                    if (!empty($supplier)) {
                                        foreach ($supplier as $row) {
                                            echo "<option value=".$row->id_supplier.">".strtoupper($row->nama_supplier)."</option>";                                        
                                        }
                                    }
                                ?>
                            </select>                          
                        </div>    
                        <div class="form-group">
                            <label>Jenis Lisensi</label>
                            <select name="jenis_lisensi" class="form-control " >
                                <option value="">-- Pilih Jenis Lisensi --</option>
                                <option value='AntiVirus'>AntiVirus</option>
                                <option value='OS'>OS</option>
                                <option value='Office'>Office</option>
                                <option value='Lain-Lain'>Lain-Lain</option>                                                               
                            </select>
                            <?php echo form_error('jenis_lisensi', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Cabang</label>
                            <select name="id_cabang" class="combobox form-control" id="cabang"> 
                                <option value="">- Pilih Cabang -</option>                               
                                    <?php
                                    if (!empty($cabang)) {
                                        foreach ($cabang as $row) {
                                            echo "<option value=".$row->id_cabang.">".strtoupper($row->namacabang)."</option>";                                        
                                        }
                                    }
                                ?>
                            </select>                          
                        </div>
                        <div class="form-group">
                            <label for="example">Key Lisensi</label>
                            <input type="text" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" name="key_lisensi" class="form-control" required oninvalid="setCustomValidity('Nomor Pelanggan Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="License Key" >
                                   <?php echo form_error('key_lisensi', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pembelian</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              
                                 <input type="text" autocomplete="off" name="tgl_pembelian" class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tanggal Pembelian Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >
                            
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Tanggal Masa Berlaku</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              
                                 <input type="text" autocomplete="off" name="tgl_habis" class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tanggal Masa Berlaku Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >
                            
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label for="example">Jumlah Lisensi</label>
                            <input type="number" name="jumlah_lisensi" class="form-control" required oninvalid="setCustomValidity('Biaya Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="20" >
                                   <?php echo form_error('jumlah_lisensi', '<div class="text-red">', '</div>'); ?>
                        </div>  
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea name="keterangan" onkeyup="this.value = this.value.toUpperCase()"  class="ckeditor" rows="3" required oninvalid="setCustomValidity('Spesifikasi Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Kapasitas Bandwidth Download dan Upload serta keterangan lainnya"></textarea>
                            <?php echo form_error('keterangan', '<div class="text-red">', '</div>'); ?>
                        </div>
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('lisensi'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>