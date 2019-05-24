<section class="content-header">
    <h1>
        Edit
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
                    echo form_open('barang/edit');
                ?>
                    
                    <div class="box-body">
                        <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori" class="form-control">
                                    <?php
                                    foreach ($katbarang as $k) {
                                        echo "<option value='$k->id_kategori'";
                                        echo $record['id_kategori'] == $k->id_kategori ? 'selected' : '';
                                        echo">$k->nama_kategori</option>";
                                    }
                                    ?>
                                </select>
                        </div> 
                        <div class="form-group">
                            <label for="example">Nama Barang</label>
                            <input type="hidden"  name="kode" value="<?php echo $record['kode_barang'] ?>" >
                            <input type="text" name="nama" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Barang" value="<?php echo $record['nama_barang']; ?>" >
                        </div>       
                        <div class="form-group">
                            <label for="">Brand</label>
                            <input type="text" class="form-control" name="merek" required oninvalid="setCustomValidity('Merek Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Merek" value="<?php echo $record['merek_barang']; ?>">
                        </div>   
                        <div class="form-group">
                            <label for="">Spesifikasi</label>
                            <textarea name="spek" class="form-control" rows="3" required oninvalid="setCustomValidity('Spesifikasi Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Spesifikasi" ><?php echo $record['spesifikasi']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <select name="satuan" class="form-control " >                              
                                <option value='<?php echo $record['satuan']; ?>'><?php echo $record['satuan'];'selected' ?></option>        
                                <option value='PCS'>PCS</option>
                                <option value='UNIT'>UNIT</option>
                                <option value='PACK'>PACK</option>
                                <option value='BUAH'>BUAH</option>
                                <option value='METER'>METER</option>
                                <option value='ROLL'>ROLL</option>                                
                            </select>
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