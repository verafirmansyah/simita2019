<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
<section class="content-header">
    <h1>
        Detail Data Inventory
        <small>Lisensi AntiVirus & Software</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Lisensi & Password</a></li>
        <li class="active">AntiVirus & Software/li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">   
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">DETAIL Data Lisensi</a></li>
                        <li class="pull-right"><a href="<?php echo site_url('lisensi'); ?>" class="text-muted"><i class="fa fa-remove"></i></a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                        <div class="col-md-6 ">                        
                          <table class="table">
                          <br>
                            <tr>
                              <td style="text-align:right ">Kode Inventory :</td>
                              <td style="width:70%"><?php echo $recordall['kode_lisensi'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right ">Cabang :</td>
                              <td style="width:70%"><?php echo $recordall['namacabang'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right ">Jenis Lisensi :</td>
                              <td style="width:70%"><?php echo $recordall['jenis_lisensi'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right ">Key Lisensi :</td>
                              <td style="width:70%"><?php echo $recordall['key_lisensi'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right ">Supplier/Vendor :</td>
                              <td style="width:70%"><?php echo $recordall['nama_supplier'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right">Nama PIC Vendor :</td>
                              <td><?php echo $recordall['nama_pic']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Telpon :</td>
                              <td><?php echo $recordall['telepon'] ?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Keterangan :</td>
                              <td><?php echo ($recordall['keterangan'])?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tgl. Pembelian:</td>
                              <td><p><span style="color: #04B404;"><?php echo tgl_lengkap($recordall['tgl_pembelian'])?></span></p></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tgl. Masa Berlaku :</td>
                              <td><p><span style="color: #04B404;"><?php echo tgl_lengkap($recordall['tgl_habis'])?>                
                            </tr>
                            <!-- Menghitung Jumlah Hari Berakhir Kontrak dari Tanggal Saat ini -->
                            <tr>
                              <td style="text-align:right">Sisa :</td>
                              <td>
                                <span style="color: #ff0000;"><strong>
                                  <?php 
                                  $start_date = new DateTime("now");
                                  $end_date = new DateTime($recordall['tgl_habis']);
                                  $interval = $start_date->diff($end_date);
                                  echo "$interval->days Hari Lagi "; 
                                  ?>
                                </strong></span>   
                              </td>               
                            </tr>
                            <!-- Akhir -->
                        
                          </table>
                          <a href="<?php echo site_url('lisensi'); ?>" class="btn btn-warning">Kembali</a>
                        </div>
                      </div><!-- /.tab-pane -->              

                </div>
            </div>
        </div>
    </div>
</section>