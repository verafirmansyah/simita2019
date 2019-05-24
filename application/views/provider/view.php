
<section class="content-header">
    <h1>
        Data Provider
        <small>Master Provider</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Provider</li>
    </ol>
</section>
<section class="content">   

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('provider/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' ></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-datatables" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Provider</th>
                                <th>Telpon </th>  
                                <th>Nama Sales</th>
                                <th>Telpon Sales</th> 
                                <th>Email Support</th>                                                          
                                <th>Edit</th>   
                                <th>Delete</th>                                 
                            </tr>
                        </thead>
                       <?php
					   $no=1;
					   foreach ($record as $r){
						   echo"
							   <tr>
							   <td>$no</td>
							   <td>".$r->nama_provider."</td>
							   <td>".$r->telpon_provider."</td>	
                               <td>".$r->nama_sales."</td>	
                               <td>".$r->telpon_sales."</td>
                               <td>".$r->email_provider."</td>			   					   
							   <td>" . anchor('provider/edit/' . $r->id_provider, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
							   <td>" . anchor('provider/delete/' . $r->id_provider, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")) . "</td>
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
