<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/maskedinput/jquery.maskedinput.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
<script type="text/javascript">
    $(window).load(function(){
    $("#sewa").change(function() {
			console.log($("#sewa option:selected").val());
			if ($("#sewa option:selected").val() == "TIDAK") {
				$("#supplier").prop("hidden", "true");
			} else {
				$("#supplier").prop("hidden", false);
			}
		    });
    });
</script>
<script>
        jQuery(function($){
            $("#asethrd").mask("aaaa99/9/9/9/999/9");
        });
</script>
<section class="content-header">
    <h1>
        Tambah
        <small>Inventaris Printer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
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
                <div class="col-md-5">
                <?php
                    echo form_open('printer/add');
                ?>                   
                    <div class="box-body">                        
                        <div class="form-group">
                            <label>Pengguna Printer</label>
                            <select name="pengguna" class="combobox form-control" id="dept">
                            <option value=''>- Pilih Pengguna Printer -</option>
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
                            <input type="text" autocomplete="off" id="asethrd" name="aset_hrd" class="form-control" required oninvalid="setCustomValidity('Nomor Aset Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="BITJ01/0/1/2/345/6" >
                                   <?php echo form_error('aset_hrd', '<div class="text-red">', '</div>'); ?>
                        </div>  
                        <div class="form-group">
                            <label>Jenis Printer</label>
                            <select name="jenis" class="form-control " >
                                <option value='DESKJET'>DESKJET</option>
                                <option value='LASERJET'>LASERJET</option>
                                <option value='DOTMATRIX'>DOTMATRIX</option>
                                <option value='ALL-IN'>ALL-IN</option> 
                                <option value='SCANER'>SCANER</option>
                                <option value='FAX'>FAX</option>                                                               
                            </select>
                            <?php echo form_error('jenis', '<div class="text-red">', '</div>'); ?>
                        </div>      
                        <div class="form-group">
                            <label>Merk Printer</label>
                            <select name="merk" class="combobox form-control" id="merk">
                            <option value=''>- Pilih Merk Printer -</option>
                                <?php
                                if (!empty($merk)) {
                                    foreach ($merk as $row) {
                                        echo "<option value='".$row->nama_manufacture."'>".strtoupper($row->nama_manufacture)."</option>";                                        
                                    }
                                }
                                ?>
                            </select> 
                            <?php echo form_error('pengguna', '<div class="text-red">', '</div>'); ?>                           
                        </div>  
                        <div class="form-group">
                            <label for="">Spesifikasi</label>
                            <textarea name="spek" class="form-control" rows="3" required oninvalid="setCustomValidity('Spesifikasi Laptop Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Spesifikasi"></textarea>
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
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
                        </div>  
                        <div class="form-group">
                            <label>Printer Disewakan ?</label>
                            <select id="sewa" name="issewa" class="form-control " >
                                <option value=''>-- Pilih Salah Satu --</option>
                                <option value='True'>YA</option>
                                <option value='False'>TIDAK</option>                                                              
                            </select>
                            <?php echo form_error('issewa', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label>Supplier</label>
                            <select name="supplier" class="form-control" id="supplier">
                            <option value=''>- Pilih Supplier -</option>
                                <?php
                                if (!empty($supplier)) {
                                    foreach ($supplier as $row) {
                                        echo "<option value='".$row->id_supplier."'>".strtoupper($row->nama_supplier)."</option>";                                        
                                    }
                                }
                                ?>
                            </select> 
                            <?php echo form_error('pengguna', '<div class="text-red">', '</div>'); ?>                           
                        </div> 
                        <div class="form-group">
                            <label for="example">Harga Beli</label>
                            <input type="number" name="harga" class="form-control" required oninvalid="setCustomValidity('Harga Beli Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Harga Beli Printer" >
                                   <?php echo form_error('harga', '<div class="text-red">', '</div>'); ?>
                        </div>                     
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('printer'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
