<section class="content-header">
    <h1>
        Tambah
        <small>Master Cabang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Cabang</li>
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
                    echo form_open('cabang/add');
                ?> 
                  
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Nama Cabang</label>
                            <input type="tex" autocomplete="off" name="namacabang" class="form-control" required oninvalid="setCustomValidity('Nama Cabang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Cabang" >
                                   <?php echo form_error('namacabang', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="example">Wilayah</label>
                            <input type="tex" autocomplete="off" name="wilayah" class="form-control" required oninvalid="setCustomValidity('Wilayah Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Wilayah Cabang" ></textarea>
                                   <?php echo form_error('wilayah', '<div class="text-red">', '</div>'); ?>
                        </div>      
                        <div class="form-group">
                            <label>Wilayah</label>
                            <select name="wilayah" class="combobox form-control" id="wilayah"> 
                                <option value="">- Pilih Wilayah -</option>                               
                                    <?php
                                    if (!empty($wilayah)) {
                                        foreach ($wilayah as $row) {
                                            echo "<option value='".$row->nama_group."'>".strtoupper($row->nama_group)."</option>";                                        
                                        }
                                    }
                                ?>
                            </select>                          
                        </div>        
                        <tr>
                                
                </tr>                    
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('cabang'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>