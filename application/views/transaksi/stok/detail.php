<section class="content-header">
    <h1>
        Kartu Stok Barang
        <small> Kartu Stok Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Kartu Stok</a></li>
        <li class="active">Kartu Stok Barang</li>
    </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">  
          <h3 class="box-title"><p class="lead"><i class="fa fa-archive"></i> KARTU STOK BARANG</p> </h3>              
          <div class="box-tools"> 
            <a href="<?php echo site_url('stok/detail_print/'.$record["kode_barang"].''); ?>" target="_blank" class="btn btn-default" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i> Print</a>
            <a href="<?php echo site_url('stok'); ?>" class="btn btn-box-tool" data-toggle="tooltip" title="Close"><i class="fa fa-remove"></i></a>
          </div>
        </div>
        <div class="col-xs-7 ">
          <table class="table">
            <tr>
              <td style="width:25%">Kode Barang</td>
              <td>: <?php echo $record['kode_barang']?></td>
            </tr>
            <tr>
              <td style="width:25%">Kategori Barang</td>
              <td>: <?php echo $record['nama_kategori']?></td>                    
            </tr>
            <tr>
              <td style="width:25%">Nama Barang</td>
              <td>: <?php echo $record['nama_barang']?></td>                    
            </tr>
            <tr>
              <td style="width:25%">Spesifikasi</td>
              <td>: <?php echo $record['spesifikasi']?></td>                    
            </tr>
          </table>
        </div>
        <div class="col-xs-10">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Cabang</th>
                <th>Tgl. Transaksi</th>
                <th>No. Transaksi</th>
                <th>Keterangan</th>
                <th style="width:10%" class="text-center">Qty Masuk</th>
                <th style="width:10%" class="text-center">Qty Keluar</th>
              </tr>
            <thead>
            <tbody>
              <tr>
                <?php 
                  $stok=chek_stok($record['kode_barang']);
                  foreach ($detail as $r ) {                    
                    echo'
                      <tr>
                      <td>'.$r->id_cabang.'</td>
                      <td>'.tgl_indo($r->tgl_transaksi).'</td>
                      <td>'.$r->kode_transaksi.'</td>
                      <td>'.$r->catatan.'</td>                            
                      <td class="text-center">'.$r->qty_masuk.'</td> 
                      <td class="text-center">'.$r->qty_keluar.'</td> 
                      </tr>';
                  }
                ?>
              </tr>
              <tr>
                <th colspan="3" class="text-center">STOK AKHIR </th>
                <th colspan="2" class="text-center"><?php echo $stok ?></th>
              </tr>              
            </tbody>
          </table>          
        </div>
        <div class="row">           
        </div>

      </div>
    </div>
  </div>
</section>