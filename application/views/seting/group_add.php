<section class="content-header">
    <h1>
        Tambah Group
        <small>Group</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Seting</a></li>
        <li class="active">Group</li>
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
                    echo form_open('user/add');
                ?> 
                  
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Nama Group/ Kantor Cabang</label>
                            <input type="text" name="nama" class="form-control" required oninvalid="setCustomValidity('Username Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Username Login" >
                                   <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                        </div>                                           
                        <div class="form-group">
                            <label for="">Kode Group</label>
                            <input type="text" class="form-control" name="kode" required oninvalid="setCustomValidity('Kode Group Harus di isi')"
                                   oninput="setCustomValidity('')" placeholder="kode group 3 karakter">
                            <?php echo form_error('kode', '<div class="text-red">', '</div>'); ?>
                        </div>                         
                         <div class="form-group">
                            <label for="">Alamat Kantor</label>
                            <textarea name="spek" class="form-control" rows="3" required oninvalid="setCustomValidity('Spesifikasi Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Spesifikasi"></textarea>
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Logo</label>
                            <input type="password" class="form-control" name="passwd" required oninvalid="setCustomValidity('Password Masih Kosong')"
                                   oninput="setCustomValidity('')" placeholder="Password">
                            <?php echo form_error('passwd', '<div class="text-red">', '</div>'); ?>
                        </div>          
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('seting'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>