<section class="content-header">
    <h1>
        Edit
        <small>User Pengguna</small>
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
                    echo form_open('user/edit');
                ?>                    
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Username</label>
                            <input type="hidden"  name="id" value="<?php echo $record['id_user'] ?>" >
                            <input type="text" disabled name="u_name" class="form-control" required oninvalid="setCustomValidity('Username Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Username Login" value="<?php echo $record['username']; ?>" >
                                   <?php echo form_error('u_name', '<div class="text-red">', '</div>'); ?>
                        </div>                                           
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" required oninvalid="setCustomValidity('Nama Lengkap Masih Kosong!')"
                                   oninput="setCustomValidity('')" placeholder="Nama Penggguna" value="<?php echo $record['nama_user']; ?>">
                            <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="">Group User</label>
                            <select name='group' class="form-control ">                           
                                <?php
                                if (!empty($group)) {
                                    foreach ($group as $g) {
                                        echo "<option value='$g->gid'";
                                        echo $record['gid'] == $g->gid ? 'selected' : '';
                                        echo">$g->nama_group</option>";
                                    }
                                }
                                ?>
                            </select>
                            <?php echo form_error('group', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">User Level</label>
                            <select name='level' class="form-control ">
                                <?php 
                                  if ($record['role']=="Admin"){
                                    echo "<option value='Admin' selected>Admin</option>
                                        <option value='Administrator'>Administrator</option>";
                                  }else{
                                    echo "<option value='Admin'>Admin</option>
                                        <option value='Administrator'  selected>Administrator</option>";
                                  }
                                ?>                             
                            </select>
                            <?php echo form_error('level', '<div class="text-red">', '</div>'); ?>
                        </div> 
                         <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="passwd" required oninvalid="setCustomValidity('Password Masih Kosong')"
                                   oninput="setCustomValidity('')" placeholder="Password">
                            <?php echo form_error('passwd', '<div class="text-red">', '</div>'); ?>
                        </div>                                            
                    </div>
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