<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/maskedinput/jquery.maskedinput.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
<script>
        jQuery(function($){
            $("#nomor_npwp").mask("99.999.999.9-999.999");
            $("#nomor_ktp").mask("9999999999999999");
        });
</script>
<section class="content-header">
    <h1>
        Edit
        <small>Master Supplier</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Supplier</li>
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
                    echo form_open('supplier/edit');
                ?>
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Nama Supplier</label>
                            <input type="hidden"  name="id" value="<?php echo $record['id_supplier'] ?>" >
                            <input type="text" name="nama" onkeyup="this.value = this.value.toUpperCase()" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama Barang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Barang" value="<?php echo $record['nama_supplier']; ?>" >
                        </div>             
                        <div class="form-group">
                            <label for="example">NPWP</label>
                            <input type="text" name="nomor_npwp" id="nomor_npwp" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nomor NPWP Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="" value="<?php echo $record['nomor_npwp']; ?>" >
                        </div> 
                        <div class="form-group">
                            <label for="example">No.KTP</label>
                            <input type="text" name="nomor_ktp" id="nomor_ktp" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nomor KTP Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="" value="<?php echo $record['nomor_ktp']; ?>" >
                        </div>           
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea name="alamat" onkeyup="this.value = this.value.toUpperCase()" class="form-control" rows="3" required oninvalid="setCustomValidity('Spesifikasi Barang Harus di Isi !')"
                            oninput="setCustomValidity('')" placeholder="Spesifikasi" ><?php echo $record['alamat_supplier']; ?>
                            </textarea>
                        </div>        
                        <div class="form-group">
                            <label for="example">Nama PIC / Sales</label>
                            <input type="text" name="nama_pic" onkeyup="this.value = this.value.toUpperCase()" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama PIC/Sales Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Sales" value="<?php echo $record['nama_pic']; ?>" >
                        </div>          
                        <div class="form-group">
                            <label for="">Telepon</label>
                            <input type="number" class="form-control" name="telepon" required oninvalid="setCustomValidity('Telepon Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="telepon" value="<?php echo $record['telepon']; ?>">
                        </div>               
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name='isactive' class="form-control">
                                <?php 
                                  if ($record['isactive']=="False"){
                                    echo "<option value='False' selected>NON AKTIF</option>
                                          <option value='True'>AKTIF</option>";
                                  }else{
                                    echo "<option value='False'>NON AKTIF</option>
                                          <option value='True'  selected>AKTIF</option>";
                                  }
                                ?>                             
                            </select>
                        </div>  
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                        <a href="<?php echo site_url('supplier'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>