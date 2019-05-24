<section class="content-header">
    <h1>
        Edit
        <small>Master Provider</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Provider</li>
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
                    echo form_open('provider/edit');
                ?>
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Nama Provider</label>
                            <input type="hidden"  name="id" value="<?php echo $record['id_provider'] ?>" >
                            <input type="text" name="nama_provider" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Barang" value="<?php echo $record['nama_provider']; ?>" >
                        </div>                 
                        <div class="form-group">
                            <label for="example">Email Provider</label>
                            <input type="hidden"  name="id" value="<?php echo $record['email_provider'] ?>" >
                            <input type="text" name="email_provider" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama PIC/Sales Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Email Provider" value="<?php echo $record['email_provider']; ?>" >
                        </div>        
                        <div class="form-group">
                            <label for="">Telepon Provider</label>
                            <input type="number" class="form-control" name="telepon_provider" required oninvalid="setCustomValidity('Merek Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Telpon" value="<?php echo $record['telpon_provider']; ?>">
                        </div>      
                        <div class="form-group">
                            <label for="example">Nama PIC / Sales</label>
                            <input type="hidden"  name="id" value="<?php echo $record['id_provider'] ?>" >
                            <input type="text" name="nama_sales" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama PIC/Sales Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Sales" value="<?php echo $record['nama_sales']; ?>" >
                        </div>          
                        <div class="form-group">
                            <label for="">Telepon Sales</label>
                            <input type="number" class="form-control" name="telepon_sales" required oninvalid="setCustomValidity('Merek Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Merek" value="<?php echo $record['telpon_sales']; ?>">
                        </div>               
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                        <a href="<?php echo site_url('provider'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>