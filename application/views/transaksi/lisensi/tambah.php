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
                <div class="col-md-5">
                <?php
                    echo form_open('masuk/add');
                ?>                   
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Nama Supplier</label>
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
                            <?php echo form_error('supplier', '<div class="text-red">', '</div>'); ?>
                        </div> 
                        <div class="form-group">
                            <label for="">No. PO</label>
                                <input type="text" class="form-control" name="no_po"  required oninvalid="setCustomValidity('No PO Harus di Isi !')"
                                 oninput="setCustomValidity('')" placeholder="No. PO dari pembelian">
                            <?php echo form_error('no_po', '<div class="text-red">', '</div>'); ?>                                                 
                        </div>
                        <div class="form-group">
                            <label for="example">Kategori Barang</label>
                            <select name="kategori" class="form-control" id="kategori"> 
                                    <option value="0">- Select -</option>                               
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
                        <div class="form-group">
                            <label for="example">Nama Barang</label>
                                <select name="namabarang" class="form-control" id="namabarang">                                    
                                    <option value="">- Select -</option>
                                </select>  
                            <?php echo form_error('namabarang', '<div class="text-red">', '</div>'); ?>
                        </div>                       
                        <div class="form-group">
                            <label for="">Spesifikasi</label>
                            <textarea name="spek" class="form-control" id="spek" rows="3"></textarea>
                            <?php echo form_error('spek', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"> 
                                <div class="form-group">
                                    <label for="">QTY</label>
                                    <input type="number" class="form-control" name="qty" id="qty" placeholder="QTY">
                                    <?php echo form_error('qty', '<div class="text-red">', '</div>'); ?>                                                 
                                </div> 
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="">Harga Beli</label>
                                    <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga">
                                    <?php echo form_error('harga', '<div class="text-red">', '</div>'); ?>                                                 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" class="form-control" name="catatan" id="catatan"  placeholder="Catatan/ Keterangan">
                                    <?php echo form_error('keterangan', '<div class="text-red">', '</div>'); ?>                                                 
                                </div>
                            </div>

                        </div>                        
                    </div><!-- /.box-body -->
                     
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>                        
                        <button type="button" onclick="add_barang()" class="btn btn-primary" name="add"><i class="glyphicon glyphicon-save"></i> Add Barang</button>
                        <a href="<?php echo site_url('masuk'); ?>" class="btn btn-primary">Kembali</a>
                    </div>

                </form>                
            </div><!-- div cal-md-5 -->
            <br>
            <div class="box-body table-responsive">
                <div id="view">
                </div>
           </div>
         </div>
        </div>
    </div>
</div>
</section>