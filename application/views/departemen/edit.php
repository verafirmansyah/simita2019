<section class="content-header">
    <h1>
        Edit
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
                    echo form_open('departemen/edit');
                ?> 
                  
                    <div class="box-body">
                        <div class="form-group">
                            <label>Unit Group</label>
                            <input type='hidden' class="form-control" name="id" value="<?php echo $record['id_dept']; ?>">
                            <input type='hidden' class="form-control" name="gid" value="<?php echo $this->session->userdata('gid'); ?>">
                            <input type='text' class="form-control" disabled name="group" value="<?php echo $this->session->userdata('group'); ?>">
                        </div> 
                        <div class="form-group">
                            <label for="">Nama Departeman/ Subdepartemen</label>
                            <input type='text' name="nama" class="form-control" rows="3" required oninvalid="setCustomValidity('input Departemen / Subdepartemen masih kosong')"
                                   oninput="setCustomValidity('')" placeholder="Nama Departement / Subdepartemen" value="<?php echo $record['nama']; ?>">
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Departeman</label>
                            <select name='parent' class="form-control ">
                            <option value='0'>- Departemen -</option>
                                <?php
                                foreach ($group as $g) {
                                        echo "<option value='$g->id_dept'";
                                        echo $record['parent'] == $g->id_dept ? 'selected' : '';
                                        echo">$g->nama</option>";
                                    }
                                ?>
                            </select>
                        </div>   
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