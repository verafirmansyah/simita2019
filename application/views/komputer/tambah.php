<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/maskedinput/jquery.maskedinput.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
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
        Tambah
        <small>Inventaris Komputer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">Komputer</li>
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
                    echo form_open('komputer/add');
                ?>                   
                    <div class="box-body">                        
                        <div class="form-group">
                            <label>Pengguna Komputer</label>
                            <select name="pengguna" class="combobox form-control" id="dept">
                            <option value=''>- Pilih Pengguna Komputer -</option>
                                <?php
                                if (!empty($pengguna)) {
                                    foreach ($pengguna as $row) {
                                        echo "<option value=".$row->id_pengguna.">".strtoupper($row->nama_pengguna)."</option>";                                        
                                    }
                                }
                                ?>
                            </select> 
                            <?php echo form_error('pengguna', '<div class="text-red">', '</div>'); ?>                           
                        </div>    
                        <div class="form-group">
                            <label for="example">Nomor Aset HRD</label>
                            <input type="text" autocomplete="off" id="asethrd" name="aset_hrd" class="form-control" required oninvalid="setCustomValidity('Nomor Aset HRD Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="BITJ01/0/1/2/345/6" >
                                   <?php echo form_error('aset_hrd', '<div class="text-red">', '</div>'); ?>
                        </div>                
                        <div class="form-group">
                            <label>Brand</label>
                            <select name="merek" class="combobox form-control" id="merek"> 
                                <option value="">- Pilih Brand Komputer -</option>                               
                                    <?php
                                    if (!empty($merek)) {
                                        foreach ($merek as $row) {
                                            echo "<option value='".$row->nama_manufacture."'>".strtoupper($row->nama_manufacture)."</option>";                                        
                                        }
                                    }
                                ?>
                            </select>                          
                        </div> 
                        <div class="form-group">
                            <label>Tipe PC</label>
                            <select name="tipe" class="combobox form-control" id="tipe"> 
                                <option value="">- Pilih Tipe PC -</option>                               
                                    <?php
                                    if (!empty($tipe)) {
                                        foreach ($tipe as $row) {
                                            echo "<option value='".$row->nama_manufacture."'>".strtoupper($row->nama_manufacture)."</option>";                                        
                                        }
                                    }
                                ?>
                            </select>                          
                        </div>   
                        <div class="form-group">
                            <label>Lisensi AntiVirus</label>
                            <select name="kode_lisensi" class="combobox form-control" id="kode_lisensi">
                            <option value='' selected="selected">- Pilih Lisensi AntiVirus -</option>
                                <?php
                                if (!empty($lisensi)) {
                                    foreach ($lisensi as $row) {
                                        echo "<option value=".$row->kode_lisensi.">".strtoupper($row->key_lisensi)."</option>";                                        
                                    }
                                }
                                ?>
                            </select> 
                            <?php echo form_error('kode_lisensi', '<div class="text-red">', '</div>'); ?>                           
                        </div> 
                        <div class="form-group">
                            <label for="">Spesifikasi</label>
                            <textarea name="spek" onkeyup="this.value = this.value.toUpperCase()" class="ckeditor" rows="3" required oninvalid="setCustomValidity('Spesifikasi Laptop Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Spesifikasi"></textarea>
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="example">Service TAG</label>
                            <input type="text" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" name="sn" class="form-control" required oninvalid="setCustomValidity('Serial Number Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Serial Number Laptop" >
                                   <?php echo form_error('sn', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Tgl. Inventaris</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              
                                 <input type="text" autocomplete="off" name="tgl_inv" class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tgl. Inventaris harus di isi')"
                                   oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >
                            
                            </div><!-- /.input group -->
                            <div class="form-group">
                            <label>Tgl. Masa Berlaku Garansi</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              
                                 <input type="text" autocomplete="off" name="tgl_garansi" class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tgl. Masa Garansi harus di isi')"
                                   oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >
                            
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label for="example">Harga Beli</label>
                            <input type="number" name="harga" class="form-control" required oninvalid="setCustomValidity('Harga Beli Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Harga Beli Komputer" >
                                   <?php echo form_error('harga', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>IP Address</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                              </div>
                              <input name="ip" autocomplete="off" type="text" class="form-control" id="ip" required/>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->  
                        <?php echo form_error('ip', '<div class="text-red">', '</div>'); ?> 
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('komputer'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
