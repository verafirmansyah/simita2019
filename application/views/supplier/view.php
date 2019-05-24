<section class="content-header">
    <h1>
        Data Master
        <small>Master Supplier</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Supplier</li>
    </ol>
</section>
<section class="content">   

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('supplier/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' ></label>
                    <h3 class='box-title'><a href="<?php echo base_url('supplier/export_excel'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-save-file"></i> Export to Excel</a></h3>
                            <label calss='control-label' ></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-datatables" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Supplier</th>
                                <th>Alamat </th>
                                <th>Nama Sales</th>
                                <th>Telepon</th>   
                                <th>NPWP</th>
                                <th>KTP</th>                                                           
                                <th>TOOLS</th>                                  
                            </tr>
                        </thead>
                       <?php
					   $no=1;
					   foreach ($record as $r){
						   echo"
							   <tr>
							   <td>$no</td>
							   <td>".$r->nama_supplier."</td>
							   <td>".$r->alamat_supplier."</td>
                               <td>".$r->nama_pic."</td>
							   <td>".$r->telepon."</td>		
                               <td>".$r->nomor_npwp."</td>
                               <td>".$r->nomor_ktp."</td>				   					   
							   <td>" . anchor('supplier/edit/' . $r->id_supplier, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . " " . anchor('supplier/delete/' . $r->id_supplier, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")) . "</td>
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
