<section class="content-header">
    <h1>
        Tambah
        <small>Master Referensi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Master Referensi</li>
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
                    echo form_open('manufacture/add');
                ?> 
                  
                    <div class="box-body">
                    <div class="form-group">
                            <label>Tipe Referensi</label>
                            <select name="jenis" class="form-control " >
                                <option value="">-- Pilih Tipe Referensi --</option>
                                <option value='MERK-PC'>Merk PC</option>
                                <option value='MERK-LAPTOP'>Merk Laptop</option>
                                <option value='TIPE'>Tipe Kategori</option>
                                <option value='MERK-PRINTER'>Merk Printer</option>  
                                <option value='MERK-PERIPERAL'>Merk Periperal</option>   
                                <option value='MODEL-PC'>Model PC</option>  
                                <option value='MODEL-LAPTOP'>Model Laptop</option>   
                                <option value='MODEL-PERIPERAL'>Model Periperal</option>   
                                <option value='JENIS-DEVICE'>Jenis Device</option>                                                         
                            </select>
                            <?php echo form_error('jenis', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="example">Manufacture (Merk)</label>
                            <input type="tex" name="nama_manufacture" onkeyup="this.value = this.value.toUpperCase()" class="form-control" required oninvalid="setCustomValidity('Merk Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Merk" >
                                   <?php echo form_error('nama_manufacture', '<div class="text-red">', '</div>'); ?>
                        </div>                 
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('manufacture'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>