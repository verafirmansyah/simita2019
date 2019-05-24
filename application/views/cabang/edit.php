<section class="content-header">
    <h1>
        Edit
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
                    echo form_open('cabang/edit');
                ?>
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Nama Cabang</label>
                            <input type="hidden"  name="id" value="<?php echo $record['id_cabang'] ?>" >
                            <input type="text" name="namacabang" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Cabang" value="<?php echo $record['namacabang']; ?>" >
                        </div>                        
                        <div class="form-group">
                            <label for="">Wilayah</label>
                            <input type="text" name="wilayah" class="form-control" rows="3" required oninvalid="setCustomValidity('Wilayah Wajib Diisi !')"
                                   oninput="setCustomValidity('')" placeholder="Wilayah" ><?php echo $record['wilayah']; ?></textarea>
                        </div>                               
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