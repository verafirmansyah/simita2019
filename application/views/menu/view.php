<section class="content-header">
    <h1>
        Slide Menu
        <small>Seting Menu</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Seting</a></li>
        <li class="active">Menu</li>
    </ol>
</section>
<section class="content">   

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('menu/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' ></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-datatables" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Menu</th>
                                <th>Icon</th>
                                <th>Link</th>
                                <th>Kat. Menu</th>                                                              
                                <th>Edit</th>   
                                <th>Delete</th>                                 
                            </tr>
                        </thead>
                       <?php
                       $no=1;
                       function chek($id) {
                            $CI = get_instance();
                            $result = $CI->db->get_where('tb_menu', array('id_menu' => $id))->row_array();
                            return $result['nama_menu'];
                        }
                       foreach ($record as $r){    
                        $katmenu = $r->parent == 0 ? 'Menu Utama' : chek($r->parent);
                           echo"
                               <tr>
                               <td>$no</td>
                               <td>".$r->nama_menu."</td>
                               <td>".$r->icon."</td>
                               <td>".$r->link."</td>
                               <td>".$katmenu."</td>                                                       
                               <td>" . anchor('menu/edit/' . $r->id_menu, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') . "</td>
                               <td>" . anchor('menu/delete/' . $r->id_menu, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")) . "</td>
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
