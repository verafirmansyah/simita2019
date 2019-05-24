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
                                <label>Supplier/Vendor</label>
                                <select name="id_supplier" class="form-control">
                                    <?php
                                    foreach ($supplier->result() as $row) {
                                        echo "<option value='.$row->id_supplier.'";
                                        echo $record['id_supplier'] == $r->id_supplier? 'selected' :'' ;
                                        echo">".strtoupper($row->nama_supplier)."</option>";
                                    }
                                    ?>
                                </select>
                            </div>                 
                        <div class="form-group">
                            <label>Jenis Lisensi</label>
                            <select name="jenis_lisensi" class="form-control " >
                                <option value='<?php echo $record['jenis_lisensi']; ?>'><?php echo $record['jenis_lisensi'];'selected' ?></option>
                                <option value='AntiVirus'>AntiVirus</option>
                                <option value='OS'>OS</option>
                                <option value='Office'>Office</option>
                                <option value='Lain-Lain'>Lain-Lain</option>                                                               
                            </select>
                            <?php echo form_error('jenis_lisensi', '<div class="text-red">', '</div>'); ?>
                        </div>         
                        <div class="form-group">
                            <label for="example">Key Lisensi</label>
                            <input type="hidden"  name="key_lisensi" value="<?php echo $record['key_lisensi'] ?>" >
                            <input type="text" name="key_lisensi" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')"  placeholder="Masukan Nama Barang" value="<?php echo $record['key_lisensi']; ?>" >
                        </div>          
                        <div class="form-group">
                            <label>Tanggal Pembelian</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              
                                 <input type="text" name="tgl_pembelian" value="<?php echo $record['tgl_pembelian']; ?>"  class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tanggal Kontrak Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >
                            
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Tanggal Masa Berlaku</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                                 <input type="text" name="tgl_habis" value="<?php echo $record['tgl_habis']; ?>" class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tanggal Akhir Kontrak Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >

                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label for="example">Jumlah Lisensi</label>
                            <input type="number" name="jumlah_lisensi" value="<?php echo $record['jumlah_lisensi']; ?>" class="form-control" required oninvalid="setCustomValidity('Biaya Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="20" >
                                   <?php echo form_error('biaya', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea name="keterangan" onkeyup="this.value = this.value.toUpperCase()"  class="ckeditor" rows="3" required oninvalid="setCustomValidity('Spesifikasi Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Kapasitas Bandwidth Download dan Upload serta keterangan lainnya"><?php echo $record['keterangan']; ?></textarea>
                            <?php echo form_error('keterangan', '<div class="text-red">', '</div>'); ?>
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