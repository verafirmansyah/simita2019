<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#kategori").change(function(){
      load_inv();
        });
  $("#namabarang").change(function(){
      loadspek();
        });
});
$(document).ready(function(){
    $(".combobox").combobox();
});
 
</script>

<script type="text/javascript">

function load_inv(){
    var kategori=$("#kategori").val();
    $.ajax({
        url:"<?php echo base_url('maintenance/tampil_inv');?>",
        data:"kategori=" + kategori ,
        success: function(html) { 
           $("#inventaris").html(html);       
        }
    });
}
</script>

<section class="content-header">
    <h1>
        Tambah
        <small>Maintenance Inventaris</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Transkasi</a></li>
        <li class="active">Maintenance</li>
    </ol>
</section>

<section class="content">
<div class="row">
        <!-- left column -->
    <div class="col-md-12">
            <!-- general form elements -->
        <div class="box box-primary">
        <div class="box-header"> 
            <?php
                echo form_open('printer/maintadd');
            ?>            
            <table class="table">               
                <tr>
                    <td><label>No.Inventaris</label></td>
                    <td>
                        <input type="hidden" name="inventaris" value="<?php echo $record['kode_printer']; ?>">
                        <div class="col-sm-4"><label><?php echo $record['kode_printer']; ?></label></div>                        
                    </td>
                <tr>
                <tr>
                    <td style="width:15%"><label>Jenis Inventaris</label></td>
                    <td>
                        <div class="col-sm-4"><label>Printer</label></div>                        
                    </td>
                <tr> 
                <tr>
                    <td><label>Maintenance Type</label></td>
                    <td>
                        <div class=" col-sm-4">                                                         
                            <select name="type" class="form-control" id="inventaris"> 
                                <option value="" selected="selected">- Select Maintenance Type-</option> 
                                <option value="Hardware">Hardware</option>                               
                                <option value="Software">Software</option> 
                                <option value="Hardware & Software">Hardware & Software</option> 
                                <option value="Network">Network/ Jaringan</option>  
                            </select>  
                            <?php echo form_error('type', '<div class="text-red">', '</div>'); ?>
                        </div>               
                    </td>
                <tr>   
                <tr>
                    <td><label>Tgl. Permohonan</label></td>
                    <td>
                        <div class=" col-sm-4">
                            <div class=" input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>                              
                                <input type="datetime" name="tgl_permohonan" class="form-control datepicker" id="datetimepicker1" placeholder="yyyy-mm-dd hh:mm" >                            
                            </div>
                        </div>
                        <?php echo form_error('tgl_permohonan', '<div class="text-red">', '</div>'); ?>
                    </td>
                <tr> 
                <tr>
                    <td><label>Catatan Pemohon</label></td>
                    <td>
                        <div class=" col-sm-4">                                                         
                            <textarea name="catatan" class="form-control" rows="3" required oninvalid="setCustomValidity('Catatan Pemohon Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="catatan Permohonan"></textarea>
                            <?php echo form_error('catatan', '<div class="text-red">', '</div>'); ?>
                        </div>               
                    </td>
                <tr>
                <tr>
                    <td><label>Tgl. Selesai</label></td>
                    <td>
                        <div class=" col-sm-4">
                            <div class=" input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>                              
                            <input type="datetime" name="tgl_selesai" class="form-control datepicker " id="datetimepicker2" data-date-format="yyyy-mm-dd hh:mm" placeholder="yyyy-mm-dd hh:mm" >                            
                            </div>
                        </div><!-- /.input group -->                  
                    </td>
                <tr>     
                <td><label>Lama Garansi</label></td>
                    <td>
                        <div class=" col-sm-4">                                                         
                            <select name="lama_garansi" class="form-control" id=""> 
                                <option value="" selected="selected">- Pilih Lama Garansi-</option> 
                                <option value="1 Bulan">1 Bulan</option>                               
                                <option value="2 Bulan">2 Bulan</option> 
				                <option value="3 Bulan">3 Bulan</option> 
				                <option value="1 Tahun">1 Tahun</option> 
                            </select>  
                            *Note : Lama Garansi terhitung sejak tanggal selesai.
                            <?php echo form_error('type', '<div class="text-red">', '</div>'); ?>
                        </div>               
                    </td>
                
                <tr>
                    <td><label>Catatan Perbaikan</label></td>
                    <td>
                        <div class=" col-sm-4">                                                         
                            <textarea name="catatan_perbaikan" class="form-control" rows="3" required oninvalid="setCustomValidity('Catatan Pemohon Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Catatan Perbaikan"></textarea>
                            <?php echo form_error('catatan_perbaikan', '<div class="text-red">', '</div>'); ?>
                        </div>               
                    </td>
                <tr>
                <tr>
                    <td><label>Nama Suplier/Rekanan</label></td>
                    <td>
                        <div class="col-sm-4">
                            <select name="supplier" class="form-control" > 
                                <option value="">- Select -</option>                               
                                <?php
                                    if (!empty($supplier)) {
                                        foreach ($supplier as $row) {
                                            echo "<option value='$row->nama_supplier'>".strtoupper($row->nama_supplier)."</option>";                                        
                                        }
                                    }
                                ?>
                            </select>
                            *Note : di isi ketika service di rekanan
                        </div>                                          
                    </td>
                <tr> 
                <tr>
                    <td><label>Cost /Biaya</label></td>
                    <td>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="biaya" placeholder="Cost / Biaya"> 
                        </div>                                          
                    </td>
                <tr>  
            </table>     
            <div class="box-footer">
                
                <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button> 
                <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
            </div>
            </form>       
            <div class="box-body table-responsive">
                <div id="view">
                </div>
            </div> 
        </div> 
        </div>
    </div>
</div>
</section>