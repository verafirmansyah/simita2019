<section class="content-header">
    <h1>
        Tambah
        <small>Master Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Barang</li>
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
                    echo form_open('barang/add');
                ?> 
                    <div class="box-body">
                     <div class="form-group">
                            <label>Kategori</label>
                            <div class="input-group">
                                <select name="kategori" class="form-control" id="inputError">
                                    <?php
                                    if (!empty($katBarang)) {
                                        foreach ($katBarang as $row) {
                                            echo "<option value=".$row->id_kategori.">".$row->nama_kategori."</option>";                                        
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-toggle="tooltip" title="Add Kategori"><?php echo anchor('barang/addkategori','<i class="fa fa-plus"></i>')?> </button>
                                </div>                             
                            </div>  
                            <?php echo form_error('kategori', '<div class="text-red">', '</div>'); ?>                          
                        </div>  
                        <div class="form-group">
                            <label for="example">Nama/Tipe Barang</label>
                            <input type="text" name="nama" class="form-control" required oninvalid="setCustomValidity('Nama Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Barang" >
                                   <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Brand</label>
                            <div class="input-group">

                                <select name="merek" class="form-control" id="inputError">
                                    <option value="">-- Pilih Brand --</option>
                                    <?php
                                    if (!empty($merek)) {
                                        foreach ($merek as $row) {
                                            echo "<option value=".$row->nama_manufacture.">".$row->nama_manufacture."</option>";                                        
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-toggle="tooltip" title="Tambah Brand"><?php echo anchor('manufacture/add','<i class="fa fa-plus"></i>')?> </button>
                                </div>                             
                            </div>  
                            <?php echo form_error('kategori', '<div class="text-red">', '</div>'); ?>                          
                        </div>                   
                        <div class="form-group">
                            <label for="">Spesifikasi</label>
                            <textarea name="spek" class="form-control" rows="3" required oninvalid="setCustomValidity('Spesifikasi Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Spesifikasi"></textarea>
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <select name="satuan" class="form-control " >
                                <option value='PCS'>PCS</option>
                                <option value='UNIT'>UNIT</option>
                                <option value='PACK'>PACK</option>
                                <option value='BUAH'>BUAH</option>
                                <option value='METER'>METER</option>
                                <option value='ROLL'>ROLL</option>
                            </select>
                            <?php echo form_error('satuan', '<div class="text-red">', '</div>'); ?>
                        </div>       
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('barang'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>