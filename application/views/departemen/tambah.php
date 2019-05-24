<section class="content-header">
    <h1>
        Tambah
        <small>Master Departemen</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Departemen</li>
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
                    echo form_open('departemen/add');
                ?> 
                  
                    <div class="box-body">
                        <div class="form-group">
                            <label>Unit Group</label>
                            <input type='hidden' class="form-control" name="gid" value="<?php echo $this->session->userdata('gid'); ?>">
                            <input type='text' class="form-control" disabled name="group" value="<?php echo $this->session->userdata('group'); ?>">
                        </div> 
                        <div class="form-group">
                            <label for="">Nama Departeman/ Subdepartemen</label>
                            <input type='text' name="nama" class="form-control" rows="3" required oninvalid="setCustomValidity('input Departemen / Subdepartemen masih kosong')"
                                   oninput="setCustomValidity('')" placeholder="Nama Departement / Subdepartemen">
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                        </div>                        
                        <div class="form-group">
                            <label for="">Departeman</label>
                            <select name='parent' class="form-control ">
                            <option value='0'>- Departemen -</option>
                                <?php
                                if (!empty($record)) {
                                    foreach ($record as $r) {
                                        echo "<option value=".$r->id_dept.">".$r->nama."</option>";                                        
                                    }
                                }
                                ?>
                            </select>
                        </div>   
                        <!-- <div class="form-group">
                            <label for="">Departeman</label>
                            <td><?php //echo dropdown('parent', 'tb_departemen', 'nama', 'id_dept', array('parent' => 0,'gid'=>$this->session->userdata('gid')), '', array('- DEPARTEMEN -' => 0)) ?></td>
                        </div>
                        -->
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('departemen'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>