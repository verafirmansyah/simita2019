<section class="content-header">
    <h1>
        Edit
        <small>Inventaris Laptop</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">Laptop</li>
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
                    echo form_open('laptop/edit');
                ?>
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">No. Inventaris</label>
                            <input type="hidden"  name="kode" value="<?php echo $record['id_laptop'] ?>" >
                            <input type="text" name="no_inv" disabled class="form-control" id="inputError" value="<?php echo $record['kode_laptop']; ?>" >
                        </div>                                            
                        <div class="form-group">
                                <label>Pengguna</label>
                                <select name="pengguna" class="form-control">
                                    <?php
                                    $gid=$record['gid'];
                                    $pengguna=$this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.gid FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept 
                                    	WHERE tb_departemen.gid ='$gid' ORDER BY tb_pengguna.nama_pengguna ASC");
                                    foreach ($pengguna->result() as $r) {
                                        echo "<option value='$r->id_pengguna'";
                                        echo $record['id_pengguna'] == $r->id_pengguna ? 'selected' : '';
                                        echo">".strtoupper($r->nama_pengguna)."</option>";
                                    }
                                    ?>
                                </select>
                        </div>     
                        <div class="form-group">
                            <label for="example">Nomor Aset HRD</label>
                            <input type="text" name="aset_hrd" class="form-control" value="<?php echo $record['aset_hrd']; ?>" required oninvalid="setCustomValidity('Merek/brand Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="ex : ASUS, LENOVO" >
                                   <?php echo form_error('aset_hrd', '<div class="text-red">', '</div>'); ?>
                        </div>                 
                         <div class="form-group">
                            <label for="example">Brand Laptop</label>
                            <input type="text" onkeyup="this.value = this.value.toUpperCase()"  name="merek" class="form-control" value="<?php echo $record['nama_laptop']; ?>" required oninvalid="setCustomValidity('Merek/brand Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="ex : ASUS, LENOVO" >
                                   <?php echo form_error('merek', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Spesifikasi</label>
                            <textarea name="spek" onkeyup="this.value = this.value.toUpperCase()"  class="form-control" rows="3"  required oninvalid="setCustomValidity('Spesifikasi Laptop Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Spesifikasi"><?php echo $record['spesifikasi']; ?></textarea>
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="example">Serial Number</label>
                            <input type="text" onkeyup="this.value = this.value.toUpperCase()"  name="sn" class="form-control" value="<?php echo $record['serial_number']; ?>" required oninvalid="setCustomValidity('Serial Number Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Serial Number Laptop" >
                                   <?php echo form_error('sn', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Tgl. Inventaris</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>                              
                                 <input type="text" name="tgl_inv" value="<?php echo $record['tgl_inv']; ?>" class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tgl. Inventaris harus di isi')"
                                   oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >                            
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Masa Garansi Sampai</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              
                                 <input type="text" name="tgl_garansi" class="form-control datepicker" data-date-format="dd-mm-yyyy" required oninvalid="setCustomValidity('Masa Garansi Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="dd-mm-yyyy" >
                            
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label for="example">Harga Beli</label>
                            <input type="text" name="sn" class="form-control" value="<?php echo $record['harga_beli']; ?>" required oninvalid="setCustomValidity('Harga Beli Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Harga Beli Laptop" >
                                   <?php echo form_error('harga', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>IP Address</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-laptop"></i>
                              </div>
                              <input name="ip" type="text" class="form-control" value="<?php echo $record['network']; ?>" data-inputmask="'alias': 'ip'" data-mask required/>
                            </div><!-- /.input group -->
                            <?php echo form_error('ip', '<div class="text-red">', '</div>'); ?>
                        </div><!-- /.form group -->             
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                        <a href="<?php echo site_url('laptop'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>