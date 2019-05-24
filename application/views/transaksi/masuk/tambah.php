<body onload="load_data_temp()"></body>
<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
<script type="text/javascript">
$(document).ready(function(){
  $("#kategori").change(function(){
      loadbrand();
        });
  $("#merek_barang").change(function(){
      loadbarang();
        });
  $("#namabarang").change(function(){
      loadspek();
        });
    });
</script>

<script type="text/javascript">

function loadbarang(){
    var kategori=$("#kategori").val();
    $.ajax({
        url:"<?php echo base_url('masuk/tampilbarang');?>",
        data:"kategori=" + kategori ,
        success: function(html) { 
           $("#namabarang").html(html);       
        }
    });
}

function loadbrand(){
    var kategori=$("#kategori").val();
    $.ajax({
        url:"<?php echo base_url('masuk/tampilbrand');?>",
        data:"kategori=" + kategori ,
        success: function(html) { 
           $("#merek_barang").html(html);       
        }
    });
}

function loadspek() {
    var namabarang=$("#namabarang").val();
    $.ajax({
        url:"<?php echo base_url('masuk/tampilspek');?>",
        data:"namabarang=" + namabarang ,
        success: function(html) { 
           $("#spek").html(html);       
        }
    });
}

function add_barang(){
    var barang=$("#namabarang").val();
    var qty=$("#qty").val();
    var harga=$("#harga").val();
    var catatan=$("#catatan").val();
    if (barang==''){
        alert('Pilih Nama Barang');
        die;
    }else if(qty==''){
        alert('Masukan QTY Barang');
        die;
    }else if(harga==''){
        alert('Masukan Harga Barang');
        die;
    }else if(catatan==''){
        alert('Input Catatan Barang');
        die;
    }else{
         $.ajax({
            type:"GET",
            url:"<?php echo base_url('masuk/masuk_ajax');?>",
            data:"barang="+barang+"&qty="+qty+"&harga="+harga+"&catatan="+catatan,
            success:function(html){
                load_data_temp();
            }
        });
    }
   
}
function load_data_temp(){
$.ajax({
    type:"GET",
    url:"<?php echo base_url('masuk/load_temp');?>",
    data:"",
    success:function(html){
        $("#view").html(html);
        }
    })    
}

function hapus(id){
    $.ajax({
       type:"GET",
       url:"<?php echo base_url('masuk/hapus_temp');?>",
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
        <small>Barang Masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Transkasi</a></li>
        <li class="active">Barang Masuk</li>
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
                echo form_open('masuk/add');
            ?>
            <table class="table">
                <tr>
                    <td>Nama Suplier</td>
                    <td>
                        <div class="col-sm-4">
                            <select name="supplier" class="form-control" id="supplier"> 
                            <option value="">- Select -</option>                               
                                <?php
                                if (!empty($supplier)) {
                                foreach ($supplier as $row) {
                                    echo "<option value=".$row->id_supplier.">".strtoupper($row->nama_supplier)."</option>";                                        
                                    }
                                }
                                ?>
                            </select> 
                        </div>                                          
                    </td>
                <tr>
                <tr>
                    <td>Nomor PO</td>
                    <td>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="no_po" required oninvalid="setCustomValidity('Nomor PO Harus di isi !')"
                                   oninput="setCustomValidity('')" placeholder="No. PO dari pembelian">
                        </div>
                    </td>
                <tr>
                    <td>Tanggal PO</td>
                    <td>
                        <div class="col-sm-4">
                            <input type="text" name="tgl_po" class="form-control datepicker" data-date-format="yyyy-mm-dd" required oninvalid="setCustomValidity('Tgl. PO Harus Diisi')"
                                   oninput="setCustomValidity('')" placeholder="yyyy-mm-dd" >
                        </div>
                    </td> 
                </tr>
             
                <tr>
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
                    <td></td>
                    <td>
                        <div class="col-sm-4">
                            <select name="merek_barang" class="form-control" id="merek_barang">                                    
                                <option value="">- Select Brand -</option>
                            </select>  
                            <?php echo form_error('merek_barang', '<div class="text-red">', '</div>'); ?>
                        </div>
                       
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="col-sm-4">
                            <select name="namabarang" class="form-control" id="namabarang">                                    
                                <option value="">- Select Barang -</option>
                            </select>  
                            <?php echo form_error('namabarang', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="col-sm-5">
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
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga">
                            <?php echo form_error('harga', '<div class="text-red">', '</div>'); ?>
                        </div>   
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="catatan" id="catatan"  placeholder="Catatan/ Keterangan">
                           <?php echo form_error('keterangan', '<div class="text-red">', '</div>'); ?> 
                        </div>   
                                        
                    </td>
                </tr>                
            </table>
            <div class="box-footer">
                <button type="button" onclick="add_barang()" class="btn btn-primary" name="add"><i class="glyphicon glyphicon-save"></i> Add Barang</button>
                <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>  
                <a href="<?php echo site_url('masuk'); ?>" class="btn btn-primary">Kembali</a>
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