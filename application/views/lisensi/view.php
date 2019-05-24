
<section class="content-header">
    <h1>
        Data Lisensi AntiVirus & Software
        <small>Daftar Data Lisensi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Lisensi & Password</a></li>
        <li class="active">AntiVirus & Software</li>
    </ol>
</section>
<section class="content">   

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('lisensi/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <a href="<?php echo base_url('lisensi/export_excel'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-save-file"></i> Export to Excel</a></h3>
                            <label calss='control-label' ></label>
                            <label calss='control-label' ></label>
                </div>
               
                <div class="box-body table-responsive">
                    <table id="tb-datatables" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Cabang</th>
                                <th>Jenis Lisensi </th>  
                                <th>Tanggal Pembelian</th>
                                <th>Tanggal Habis</th>                                                      
                                <th>Tools</th>                                    
                            </tr>
                        </thead>
                       <?php
					   $no=1;
					   foreach ($record as $r){
						   echo"
							   <tr>
							   <td>$no</td>
							   <td>".$r->namacabang."</td>
							   <td>".$r->jenis_lisensi."</td>	
                               <td>".$r->tgl_pembelian."</td>	
                               <td>".$r->tgl_habis."</td>							   
							   <td>" . anchor('lisensi/detail/' . $r->id_lisensi, '<i class="btn btn-info btn-sm glyphicon glyphicon-list-alt" data-toggle="tooltip" title="Lihat Detail Data"></i>') . "
                               " . anchor('lisensi/edit/' . $r->id_lisensi, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit Data"></i>') . "
							   " . anchor('lisensi/delete/' . $r->id_lisensi, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Hapus Data"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")) . "</td>
                               </tr>";
						   $no++;
					   }
					   ?>
                    </Table> 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
