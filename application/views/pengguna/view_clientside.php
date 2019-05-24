<section class="content-header">
    <h1>
        Data Pengguna 
        <small>Master Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Pengguna</li>
    </ol>
</section>
<section class="content">   

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('pengguna/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' ></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-datatables" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Pengguna</th>
                                <th>NIK</th>
                                <th>Nama</th>                                                                
                                <th>Departemen</th>
                                <th>Sub. Dept</th>
                                <th>Jabatan</th> 
                                <th>Ruang Kantor</th>                             
                                <th>Edit</th>   
                                <th>Delete</th>                                 
                            </tr>
                        </thead>
                       <?php
					   $no=1;
					   foreach ($record as $r){  
                        $dept=$this->db->get_where('tb_departemen',array('id_dept'=>$r->parent))->row_array();
                           if($r->parent==0){
                                $deptnama=$r->nama;
                           }else{
                                $deptnama=$dept['nama'];
                           }
                                                                                    
						   echo"
							   <tr>
							   <td>$no</td>
							   <td>".$r->id_pengguna."</td>
							   <td>".$r->nik."</td>
							   <td>".$r->nama_pengguna."</td>							   							   
                               <td>".strtoupper($deptnama)."</td>
                               <td>".strtoupper($r->nama)."</td>
                               <td>".$r->nama_jabatan."</td>
                               <td>".strtoupper($r->ruang_kantor)."</td>							   
							   <td>" . anchor('pengguna/edit/' . $r->id_pengguna, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
							   <td>" . anchor('pengguna/delete/' . $r->id_pengguna, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")) . "</td>
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
