<section class="content-header">
    <h1>
        Users Pengguna
        <small>Seting Users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Seting</a></li>
        <li class="active">Users</li>
    </ol>
</section>
<section class="content">   

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('user/add'); ?>" class="btn btn-primary btn-small">
                      <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                  <label calss='control-label' ></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-datatables" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pengguna</th>
                                <th>Username</th>
                                <th>Level User</th>
                                <th>User Group</th>                                                              
                                <th>Edit</th>   
                                <th>Delete</th>                                 
                            </tr>
                        </thead>
                       <?php
                       $no=1;                       
                       foreach ($record as $r){
                       $gid=$this->db->get_where('tb_group',array('gid'=>$r->gid))->row_array();  
                           echo"
                               <tr>
                               <td>$no</td>
                               <td>".$r->nama_user."</td>
                               <td>".$r->username."</td>
                               <td>".$r->role."</td>
                               <td>".$gid['nama_group']."</td>                                                       
                               <td>" . anchor('user/edit/' . $r->id_user, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                               <td>" . anchor('user/delete/' . $r->id_user, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")) . "</td>
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
