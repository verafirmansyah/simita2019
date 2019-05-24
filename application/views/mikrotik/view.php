
<section class="content-header">
    <h1>
        Data Password Mikrotik Cabang
        <small>Daftar Data Lisensi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Lisensi & Password</a></li>
        <li class="active">Mikrotik</li>
    </ol>
</section>
<section class="content">   

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('mikrotik/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <a href="<?php echo base_url('mikrotik/export_excel'); ?>" class="btn btn-primary btn-small">
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
                                <th>IP Public </th>  
                                <th>Provider</th>                                                     
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
							   <td>".$r->ip_public."</td>	
                               <td>".$r->provider."</td>								   
							   <td>" . anchor('mikrotik/detail/' . $r->id_mikrotik, '<i class="btn btn-info btn-sm glyphicon glyphicon-list-alt" data-toggle="tooltip" title="Lihat Detail Data"></i>') . "
                               " . anchor('mikrotik/edit/' . $r->id_mikrotik, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit Data"></i>') . "
							   " . anchor('mikrotik/delete/' . $r->id_mikrotik, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Hapus Data"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")) . "</td>
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
