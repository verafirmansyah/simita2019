<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/maskedinput/jquery.maskedinput.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
<script>
        jQuery(function($){
            $("#npwp").mask("99.999.999.9-999.999");
            $("#ktp").mask("9999999999999999");
        });
</script>
<section class="content-header">
    <h1>
        Tambah
        <small>Master Supplier</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Supplier</li>
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
                    echo form_open('supplier/add');
                ?> 
                  
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Nama Supplier</label>
                            <input type="tex" onkeyup="this.value = this.value.toUpperCase()"  name="nama" class="form-control" required oninvalid="setCustomValidity('Nama Supplier Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Supplier" >
                                   <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="example">NPWP</label>
                            <input type="text" id="npwp" name="nomor_npwp" class="form-control" required oninvalid="setCustomValidity('Nomor NPWP Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="00.000.000.0-000.000" >
                                   <?php echo form_error('npwp', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="example">No.KTP (Jika Tidak Memiliki NPWP)</label>
                            <input type="text" id="ktp" name="nomor_ktp" class="form-control" required oninvalid="setCustomValidity('Nomor KTP Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="" >
                                   <?php echo form_error('ktp', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="example">Alamat Lengkap</label>
                            <textarea name="alamat" onkeyup="this.value = this.value.toUpperCase()" class="form-control" required oninvalid="setCustomValidity('Alamat Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Alamat Supplier" ></textarea>
                                   <?php echo form_error('alamat', '<div class="text-red">', '</div>'); ?>
                        </div>             
                        <div class="form-group">
                            <label for="example">Nama PIC / Sales</label>
                            <input type="tex" onkeyup="this.value = this.value.toUpperCase()"  name="namapic" class="form-control" required oninvalid="setCustomValidity('Nama PIC atau Sales Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama PIC/Sales" >
                                   <?php echo form_error('namapic', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="example">Telepon</label>
                            <input type="number" name="telepon" class="form-control" required oninvalid="setCustomValidity('Nomor Telepon Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="089637079030" >
                                   <?php echo form_error('telepon', '<div class="text-red">', '</div>'); ?>
                        </div>       
                        <div class="form-group">
                            <label>Status</label>
                            <select name="isactive" class="form-control " >
                                <option value="">-- Pilih Status --</option>
                                <option value='True'>AKTIF</option>
                                <option value='False'>NON AKTIF</option>                                                         
                            </select>
                            <?php echo form_error('isactive', '<div class="text-red">', '</div>'); ?>
                        </div>                   
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('supplier'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>