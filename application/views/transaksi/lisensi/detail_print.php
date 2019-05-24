<html>
  <head>
    <meta charset="UTF-8">
      <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <!-- Ionicons -->
      <link href="<?php echo base_url('assets/css/ionicons.min.css'); ?>" rel="stylesheet">

  </head>
  <body onload="window.print();">
  <style type="text/css">
    table td {
      border-top: none !important;      
    }
    
  </style>
    <section class="invoice">
      <div class="row">
        <div class="col-md-12">     
            <div class="box-header">  
              <h3 class="box-title" align="center"><p class="lead"><i class="fa fa-archive"></i>  <label>KARTU STOK BARANG</label></p> </h3>                
            </div>
            <div class="col-xs-8">                   
              <table>
                <tr>
                  <td style="width:30%">Kode Barang</td>
                  <td>: </td>
                  <td><?php echo $record['kode_barang']?></td>
                </tr>
                <tr>
                  <td style="width:25%">Kategori Barang</td>
                  <td>: </td>
                  <td><?php echo $record['nama_kategori']?></td>                    
                </tr>
                <tr>
                  <td style="width:25%">Nama Barang</td>
                  <td>: </td>
                  <td><?php echo $record['nama_barang']?></td>                    
                </tr>
                <tr>
                  <td style="width:25%">Spesifikasi</td>
                  <td>: </td>
                  <td><?php echo $record['spesifikasi']?></td>                    
                </tr>
              </table>
            </div>
            <div class="col-xs-12">
              <table class="table table-bordered ">
              <br>
                  <tr>
                    <th>Tgl. Transaksi</th>
                    <th>No. Transaksi</th>
                    <th>Keterangan</th>
                    <th style="width:15%" class="text-center">Qty Masuk</th>
                    <th style="width:15%" class="text-center">Qty Keluar</th>
                  </tr>
                  <tr>
                    <?php 
                      $stok=chek_stok($record['kode_barang']);
                      foreach ($detail as $r ) {                    
                        echo'
                          <tr>
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
              </table>              
                <small class="pull-right">Date: <?php echo tanggal_indo();?></small>       
            </div>
            <div class="row">           
            </div>
          </div>        
      </div>
    </section>
  </body>
</html>