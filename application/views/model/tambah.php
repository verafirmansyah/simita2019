<section class="content-header">
    <h1>
        Tambah
        <small>Master Model</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Model</li>
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
                    echo form_open('model/add');
                ?> 
                  
                    <div class="box-body">
                        <div class="form-group">
                            <label>Brand</label>
                            
                                <select name="id_manufacture" class="form-control" id="inputError">
                                    <option value='0'>- Pilih Brand -</option>
                                    <?php
                                    if (!empty($manufacture)) {
                                        foreach ($manufacture as $row) {
                                            echo "<option value=".$row->id_manufacture.">".$row->nama_manufacture."</option>";                                        
                                        }
                                    }
                                    ?>
                                </select>     
                        </div>
                        <div class="form-group">
                            <label for="example">Model/Tipe</label>
                            <input type="text" name="tipe" onkeyup="this.value = this.value.toUpperCase()" class="form-control" required oninvalid="setCustomValidity('Merk Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Tipe" >
                                   <?php echo form_error('tipe', '<div class="text-red">', '</div>'); ?>
                        </div>                 
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('model'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>