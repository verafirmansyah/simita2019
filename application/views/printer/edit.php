<section class="content-header">
    <h1>
        Edit
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
                    echo form_open('printer/edit');
                ?>
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">No. Inventaris</label>
                            <input type="hidden"  name="kode" value="<?php echo $record['id_printer'] ?>" >
                            <input type="text" name="no_inv" disabled class="form-control" id="inputError" value="<?php echo $record['kode_printer']; ?>" >
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
                            <label>Jenis printer</label>
                            <select name="jenis" class="form-control " >
                                <option value='<?php echo $record['jenis_printer']; ?>'><?php echo $record['jenis_printer'];'selected' ?></option>
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
                            <label for="">Spesifikasi</label>
                            <textarea name="spek" class="form-control" rows="3"  required oninvalid="setCustomValidity('Spesifikasi printer Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Spesifikasi"><?php echo $record['spesifikasi']; ?></textarea>
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
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