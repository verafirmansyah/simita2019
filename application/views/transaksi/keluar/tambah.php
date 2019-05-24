<body onload="load_data_temp()"></body>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#kategori").change(function(){
      loadbarang();
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

function loadbarang(){
    var kategori=$("#kategori").val();
    $.ajax({
        url:"<?php echo base_url('keluar/tampilbarang');?>",
        data:"kategori=" + kategori ,
        success: function(html) { 
           $("#namabarang").html(html);       
        }
    });
}

function loadspek() {
    var namabarang=$("#namabarang").val();
    $.ajax({
        url:"<?php echo base_url('keluar/tampilspek');?>",
        data:"namabarang=" + namabarang ,
        success: function(html) { 
           $("#spek").html(html);       
        }
    });
}
function loadqtytersedia(){
    var kodebarang=$("#kodebarang").val();
    $.ajax({
        url:"<?php echo base_url('keluar/tampilqty');?>",
        data:"koderbarang=" + kodebarang ,
        success: function(html) { 
           $("#qtyonhand").html(html);       
        }
    });
}

function add_barang(){
    var barang=$("#namabarang").val();
    var qty=$("#qty").val();    
    var catatan=$("#catatan").val();
    if (barang==''){
        alert('Pilih Nama Barang');
        die;
    }else if(qty==''){
        alert('keluaran QTY Barang');
        die;
    }else if(catatan==''){
        alert('Input Catatan Barang');
        die;
    }else{
         $.ajax({
            type:"GET",
            url:"<?php echo base_url('keluar/keluar_ajax');?>",
            data:"barang="+barang+"&qty="+qty+"&catatan="+catatan,
            success:function(html){
                load_data_temp();
            }
        });
    }
   
}
function load_data_temp(){
$.ajax({
    type:"GET",
    url:"<?php echo base_url('keluar/load_temp');?>",
    data:"",
    success:function(html){
        $("#view").html(html);
        }
    })    
}

function hapus(id){
    $.ajax({
       type:"GET",
       url:"<?php echo base_url('keluar/hapus_temp');?>",
       data:"id="+id,
       success:function(html){
           $("#dataku"+id).hide(1000);
       }
    });
}
</script>

<section class="content-header">
    <h1>
        Tambah
        <small>Barang keluar</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Transkasi</a></li>
        <li class="active">Barang keluar</li>
    </ol>
</section>

<section class="content">
<div class="row">
        <!-- left column -->
    <div class="col-md-12">
            <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">  
                <h3 class="box-title"><?php echo tanggal_new() ;?></h3>              
                <div class="box-tools">                
                 No. Transaksi : <label><?php echo $kode ?></label> 
              </div>
            </div>
            <?php
                echo form_open('keluar/add');
            ?>            
            <table class="table">
                <tr>
                    <td style="width:15%">Cabang</td>
                    <td>
                        <div class="col-sm-4">
                            <select name="cabang" class="combobox form-control" id="cabang"> 
                                <option value="">- Select -</option>                               
                                    <?php
                                    if (!empty($cabang)) {
                                        foreach ($cabang as $row) {
                                            echo "<option value='".$row->namacabang."'>".strtoupper($row->namacabang)."</option>";                                       
                                        }
                                    }
                                ?>
                            </select>  
                            <?php echo form_error('cabang', '<div class="text-red">', '</div>'); ?>
                        </div>                                          
                    </td>                
                </tr>
                <tr>
                    <td style="width:15%">Nama Penerima</td>
                    <td>
                        <div class="col-sm-4">
                            <select name="penerima" class="combobox form-control" id="penerima"> 
                                <option value="">- Select -</option>                               
                                    <?php
                                    if (!empty($pengguna)) {
                                        foreach ($pengguna as $row) {
                                            echo "<option value=".$row->id_pengguna.">".strtoupper($row->nama_pengguna)."</option>";                                        
                                        }
                                    }
                                ?>
                            </select>  
                            <?php echo form_error('penerima', '<div class="text-red">', '</div>'); ?>
                        </div>                                          
                    </td>                
                </tr>
                <tr>
                    <td>BARANG</td>
                    <td>
                        <div class="col-sm-4">
                            <select name="kategori" class="form-control" id="kategori"> 
                                <option value="0">- Select Category Barang -</option>                               
                                <?php
                                    if (!empty($kategori)) {
                                        foreach ($kategori as $row) {
                                            echo "<option value=".$row->id_kategori.">".strtoupper($row->nama_kategori)."</option>";                                        
                                        }
                                    }
                                ?>
                            </select>  
                            <?php echo form_error('kategori', '<div class="text-red">', '</div>'); ?>
                        </div>                        
                    </td>
                    
                <tr>
                <tr>
                    <td>                        
                    </td>
                    <td>
                        <div class="col-sm-4">
                            <select name="namabarang" class="form-control" id="namabarang">                                    
                                    <option value="">- Select Barang -</option>
                                </select>  
                            <?php echo form_error('namabarang', '<div class="text-red">', '</div>'); ?> 
                        </div>
                        <div class="col-sm-4">
                            <textarea name="spek" class="form-control" id="spek" rows="3" placeholder="Spesifikasi Barang"></textarea>
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                        </div>
                     
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="qty" id="qty" placeholder="QTY">
                           <?php echo form_error('qty', '<div class="text-red">', '</div>'); ?>

                        </div>                                                    
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="catatan" id="catatan"  placeholder="Catatan/ Keterangan">
                           <?php echo form_error('keterangan', '<div class="text-red">', '</div>'); ?> 
                        </div>                       
                    </td>
                </tr>        
            </table>     
            <div class="box-footer">
                <button type="button" onclick="add_barang()" class="btn btn-primary" name="add"><i class="fas fa-cart-arrow-down"></i> Add Barang</button>
                <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button> 
                <a href="<?php echo site_url('keluar'); ?>" class="btn btn-primary"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
            </div>
            </form>       
            <div class="box-body table-responsive">
                <div id="view">
                </div>
            </div>  
        </div>
    </div>
</div>
</section>