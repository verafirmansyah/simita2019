<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/maskedinput/jquery.maskedinput.js'); ?>"></script>
<script>
        jQuery(function($){
            $("#email").mask("*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]");
        });
</script>
<section class="content-header">
    <h1>
        Tambah
        <small>Master Provider Internet</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Provider</li>
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
                    echo form_open('provider/add');
                ?> 
                  
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Nama Provider</label>
                            <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="nama_provider" class="form-control" required oninvalid="setCustomValidity('Nama Provider Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Provider" >
                                   <?php echo form_error('nama_provider', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="example">Email Support</label>
                            <input type="text" id="email_provider" data-inputmask-regex="*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]" name="email_provider" class="form-control" required oninvalid="setCustomValidity('Nomor Aset HRD Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="" >
                                   <?php echo form_error('email_provider', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="example">Telpon Provider</label>
                            <input type="number" name="telpon_provider" class="form-control" required oninvalid="setCustomValidity('Nomor Telpon Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="089637079030" >
                                   <?php echo form_error('telpon_provider', '<div class="text-red">', '</div>'); ?>
                        </div>    
                        <div class="form-group">
                            <label for="example">Nama PIC / Sales</label>
                            <input type="tex" onkeyup="this.value = this.value.toUpperCase()" name="nama_sales" class="form-control" required oninvalid="setCustomValidity('Nama PIC atau Sales Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama PIC/Sales" >
                                   <?php echo form_error('nama_sales', '<div class="text-red">', '</div>'); ?>
                        </div>                    
                        <div class="form-group">
                            <label for="example">Telpon Sales</label>
                            <input type="number" name="telpon_sales" class="form-control" required oninvalid="setCustomValidity('Nomor Telpon Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="089637079030" >
                                   <?php echo form_error('telpon_sales', '<div class="text-red">', '</div>'); ?>
                        </div>            
                        <tr>
                                
                </tr>                    
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('provider'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>