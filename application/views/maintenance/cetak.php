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
              <h3 class="box-title" align="center"><p class="lead"><i class="fa fa-archive"></i>  <label>FORM PERBAIKAN IT ASSET</label></p> </h3>              
               
            </div>
            <div class="col-md-6">
              <table>
                <tr>
                  <td>No. Perbaikan</td> <td style="width: 2%"> : </td>                 
                  <td><?php echo $recordall['no_permohonan']?></td>
                  <td style="width: 3%"></td>
                  <td >Tgl Selesai</td><td>: </td>                  
                  <td><?php echo tgl_lengkap($recordall['tgl_selesai'])?></td> 
            <!--      <td >Catatan Pemohon</td><td style="width: 2%"> : </td>                  
                  <td><?php echo $recordall['catatan_pemohon']?></td> -->
                </tr>
                <tr>
                  <td >Tgl Permohonan</td> <td>: </td>                 
                  <td><?php echo tgl_lengkap($recordall['tgl_permohonan'])?></td> 
                  <td></td>   
                  <td >Nama Supplier</td><td>: </td>                  
                  <td><?php echo $recordall['nama_supplier']?></td>                 
                </tr>
                <tr>
                  <td >Jenis Perbaikan</td> <td>: </td>                 
                  <td><?php echo $recordall['jenis_permohonan']?></td>  
                  <td></td>                  
               <!--   <td >Catatan Perbaikan</td><td>: </td>                 
                  <td><?php echo $recordall['catatan_perbaikan']?></td> -->
                </tr>
                <tr>
                  <td >Nama Pemohon</td><td>: </td>                  
                  <td><?php echo $inv['nama_pengguna']?></td>
                  <td></td>                    
                  <td >Cost/ Biaya</td><td>: </td>                  
                  <td><span style="color: #ff0000; font-size: 14pt;">Rp.<?php echo rupiah($recordall['biaya']);?></span></td> 
                </tr>               
                <tr>
                  <td >No Inventaris</td><td>: </td>                 
                  <td><?php echo $recordall['no_inventaris'],'/ ',$recordall['nama_kategori'],' - ',$recordall['aset_hrd']?></td> 
                  <td></td>                   
                  
                </tr>  
              </table>  
               <p><p><p>  
        <table>
          <tr>   
            <td>Catatan Pemohon</td><td style="width: 2%"><td>:</td><br>
            <td><?php echo $recordall['catatan_pemohon']?>    </td>
          </tr>
          <tr>
            <td>Catatan Perbaikan</td><td style="width: 2%"><td>:</td>
            <td><?php echo $recordall['catatan_perbaikan']?></td>
          </tr>
        </table>       
          </div>         
          </div>  
      </div><br>
      <div class="row">
        <div class="col-xs-4">
        </div>
        <div class="col-xs-4">
          <p>Mengetahui,</p>
          <br><br>
          <p>........................</p>
        </div>
        <div class="col-xs-4">
          <p>Pemohon</p>
          <br><br>
          <p><?php echo $inv['nama_pengguna'] ?></p>
        </div>
      </div>
      <br/>
      <center><span style="color: #808080; font-size: 8pt;"><em>Tanda terima atau form perbaikan ini di print dengan : SIMITA (SIstem Management IT Aset)</em><br/><?php echo "Printed date : ".date("d/m/Y");?></span></center>
    </section>
  </body>
</html>