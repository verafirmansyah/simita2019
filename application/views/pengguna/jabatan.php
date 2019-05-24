<section class="content-header">
    <h1>
        Tambah
        <small>Master Jabatan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Jabatan</li>
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
                    echo form_open('pengguna/addjabatan');
                ?> 
                  
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Jabatan</label>
                            <input type="text" name="nama_jabatan" class="form-control" required oninvalid="setCustomValidity('Jabatan Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="ex: Staf" >
                                   <?php echo form_error('nama_jabatan', '<div class="text-red">', '</div>'); ?>
                        </div>                        
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('pengguna/add'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>