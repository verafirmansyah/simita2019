<section class="content-header">
    <h1>
        Tambah
        <small>Users Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Seting</a></li>
        <li class="active">Users</li>
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
                            <label for="example">Username</label>
                            <input type="text" name="u_name" class="form-control" required oninvalid="setCustomValidity('Username Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Username Login" >
                                   <?php echo form_error('u_name', '<div class="text-red">', '</div>'); ?>
                        </div>                                           
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" required oninvalid="setCustomValidity('Nama Lengkap Masih Kosong!')"
                                   oninput="setCustomValidity('')" placeholder="Nama Penggguna">
                            <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="">Group User</label>
                            <select name='group' class="form-control ">
                            <option value='0'>- Select Group-</option>
                                <?php
                                if (!empty($record)) {
                                    foreach ($record as $r) {
                                        echo "<option value=".$r->gid.">".$r->nama_group."</option>";
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('group', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="">User Level</label>
                            <select name='level' class="form-control ">
                                <option value='Admin'>Admin</option>
                                <option value='Administrator'>Administrator</option>                                
                            </select>
                            <?php echo form_error('level', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="passwd" required oninvalid="setCustomValidity('Password Masih Kosong')"
                                   oninput="setCustomValidity('')" placeholder="Password">
                            <?php echo form_error('passwd', '<div class="text-red">', '</div>'); ?>
                        </div>          
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('user'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>