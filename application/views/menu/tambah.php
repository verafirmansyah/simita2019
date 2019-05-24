<section class="content-header">
    <h1>
        Tambah
        <small>Menu Dinamis</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Seting</a></li>
        <li class="active">Menu Dinamis</li>
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
                    echo form_open('menu/add');
                ?> 
                  
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Nama Menu</label>
                            <input type="tex" name="nama" class="form-control" required oninvalid="setCustomValidity('Nama Menu Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Menu" >
                                   <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                        </div>                                           
                        <div class="form-group">
                            <label for="">Icon</label>
                            <input type="text" class="form-control" name="icon" required oninvalid="setCustomValidity('Icon di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="ex : fa fa-dashboard">
                            <?php echo form_error('merek', '<div class="text-red">', '</div>'); ?>
                        </div>   
                         <div class="form-group">
                            <label for="">Link</label>
                            <input type="text" class="form-control" name="link" required oninvalid="setCustomValidity('Link Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="ex : menu/add atau #">
                            <?php echo form_error('merek', '<div class="text-red">', '</div>'); ?>
                        </div>   
                        <div class="form-group">
                            <label for="">Kat. Menu</label>
                            <select name='kat_menu' class="form-control ">
                            <option value='0'>Menu Utama</option>
                                <?php
                                if (!empty($record)) {
                                    foreach ($record as $r) {
                                        echo "<option value=".$r->id_menu.">".$r->nama_menu."</option>";                                        
                                    }
                                }
                                ?>
                            </select>
                        </div>   
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <a href="<?php echo site_url('menu'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>