<section class="content-header">
    <h1>
        Group Unit
        <small>Seting Group Unit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Seting</a></li>
        <li class="active">Group</li>
    </ol>
</section>
<section class="content">   

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('seting/group_add'); ?>" class="btn btn-primary btn-small">
                      <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                  <label calss='control-label' ></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-datatables" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Group</th>
                                <th>Alamat</th>
                                <th>Kode Group</th>
                                <th>Logo</th>                                                              
                                <th>AKsi</th>                 
                            </tr>
                        </thead>
                       <?php
                       $no=1;                       
                       foreach ($record as $r){
                       //$gid=$this->db->get_where('tb_group',array('gid'=>$r->gid))->row_array();  
                           echo"
                               <tr>
                               <td>$no</td>
                               <td>".$r->nama_group."</td>
                               <td>".$r->alamat."</td>
                               <td>".$r->nama_alias."</td>
                               <td><img src=" . base_url() . 'assets/img/' . $r->logo . " whith='50' height='50' >
                               </td>                                                     
                               <td>" . anchor('seting/edit_group/' . $r->gid, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
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
