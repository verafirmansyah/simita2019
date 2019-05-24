<section class="content-header">
    <h1>
        Edit
        <small>Inventaris Network Device</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">Network</li>
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
                    echo form_open('device/edit');
                ?>
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">No. Inventaris</label>
                            <input type="hidden" onkeyup="this.value = this.value.toUpperCase()" name="kode" value="<?php echo $record['id_network'] ?>" >
                            <input type="text" name="no_inv" disabled class="form-control" id="inputError" value="<?php echo $record['kode_network']; ?>" >
                        </div>                                            
                        <div class="form-group">
                            <label for="example">Network Device</label>                           
                            <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="jenis" class="form-control" id="inputError" oninvalid="setCustomValidity('Network Device Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="ex: Switch, HUB, Router" value="<?php echo $record['jenis_network']; ?>" >
                        </div> 
                        <div class="form-group">
                            <label for="">Spesifikasi</label>
                            <textarea name="spek" onkeyup="this.value = this.value.toUpperCase()" class="form-control" rows="3"  required oninvalid="setCustomValidity('Spesifikasi network Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Spesifikasi"><?php echo $record['spesifikasi']; ?></textarea>
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                        </div>  
                        <div class="form-group">
                            <label for="example">Lokasi Penggunaan</label>                           
                            <input type="text" onkeyup="this.value = this.value.toUpperCase()" name="lokasi" class="form-control" id="inputError" oninvalid="setCustomValidity('Lokasi Device  Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="ex: Ruang Core server" value="<?php echo $record['lokasi']; ?>" >
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
                        <a href="<?php echo site_url('network'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>