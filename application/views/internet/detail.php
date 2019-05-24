<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
       $(".combobox").combobox();
    });
</script>
<?php
function terbilang($x){
  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . " Belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " Seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " Seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}
?>
<section class="content-header">
    <h1>
        Detail Data
        <small>Inventaris Internet</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">Internet</li>
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">DETAIL PROVIDER INTERNET</a></li>
                        <li class="pull-right"><a href="<?php echo site_url('internet'); ?>" class="text-muted"><i class="fa fa-remove"></i></a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                        <div class="col-md-6 ">                        
                          <table class="table">
                          <br>
                            <tr>
                              <td style="text-align:right ">Cabang :</td>
                              <td style="width:70%"><?php echo $recordall['nama_cabang'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right ">IP Public :</td>
                              <td style="width:70%"><?php echo $recordall['ip_public'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right ">Tipe Koneksi :</td>
                              <td style="width:70%"><?php echo $recordall['tipe_koneksi'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right ">Provider :</td>
                              <td style="width:70%"><?php echo $recordall['nama_provider'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right ">Telpon :</td>
                              <td style="width:70%"><?php echo $recordall['telpon_provider'] ?></td>
                            </tr>
                            <tr>
                              <td style="text-align:right">Email :</td>
                              <td><?php echo $recordall['email_provider']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Sales :</td>
                              <td><?php echo $recordall['nama_sales'] ?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Telp Sales :</td>
                              <td><?php echo $recordall['telpon_sales']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">No.Pelanggan :</td>
                              <td><?php echo $recordall['nomor_pelanggan']?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Spesifikasi :</td>
                              <td><?php echo ($recordall['spesifikasi'])?></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tgl. Kontrak :</td>
                              <td><p><span style="color: #04B404;"><?php echo tgl_lengkap($recordall['tanggal_kontrak'])?></span></p></td>                    
                            </tr>
                            <tr>
                              <td style="text-align:right">Tgl. Habis Kontrak :</td>
                              <td><p><span style="color: #04B404;"><?php echo tgl_lengkap($recordall['masa_kontrak'])?>                
                            </tr>
                            <!-- Menghitung Jumlah Hari Berakhir Kontrak dari Tanggal Saat ini -->
                            <tr>
                              <td style="text-align:right">Berakhir Pada :</td>
                              <td>
                                <span style="color: #ff0000;"><strong>
                                  <?php 
                                  $start_date = new DateTime("now");
                                  $end_date = new DateTime($recordall['masa_kontrak']);
                                  $interval = $start_date->diff($end_date);
                                  echo "$interval->days Hari Lagi "; 
                                  ?>
                                </strong></span>   
                              </td>               
                            </tr>
                            <!-- Akhir -->
                            <tr>
                              <td style="text-align:right">Status :</td>
                              <td><?php echo $recordall['status']?></td>                    
                            </tr>
                              
                              <td style="text-align:right">Biaya Bulanan :</td>
                              <td><span style="color: #0404B4;"><strong><?php echo 'Rp.'.rupiah($recordall['biaya'])?> (<i><?php echo "".terbilang($recordall['biaya'])?>Rupiah </i>)</strong></td>                    
                            </tr>
                          </table>
                          <a href="<?php echo site_url('internet'); ?>" class="btn btn-danger"><i class="fas fa-caret-square-left"></i> Kembali</a>
                        </div>
                      </div><!-- /.tab-pane -->              
                      
                </div>
            </div>
        </div>
    </div>
</section>