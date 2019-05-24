<section class="content-header">
    <h1>
        Data Departemen
        <small>Master Departemen</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Departemen</li>
    </ol>
</section>
<section class="content"> 
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('departemen/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' ></label>
                </div>
                            
                 <section class="panel default blue_title h3">
                 <div class="panel-heading"><u>Unit <?php echo $this->session->userdata('group') ?></u></div>
                 <div class="panel-body">
                 <ul id="navigation" class="treeview">
                    <?php                      
                        foreach ($record as $m) {
                            $sub = $this->db->get_where('tb_departemen', array('parent' => $m->id_dept));
                            if ($sub->num_rows() > 0){
                                echo '<li class="expandable"><div class="hitarea expandable-hitarea"></div>';
                                echo '<a href="?'.$m->nama.'" class="">'.strtoupper($m->nama).'  </a>'
                                .anchor('departemen/edit/' . $m->id_dept,'<i class="btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>')
                                .anchor('departemen/delete/'.$m->id_dept,'<i class="btn-sm glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')"));
                                echo '<ul style="display: none;">';
                                foreach ($sub->result() as $s) {
                                    echo '<li><a href="?'.$m->nama.'">'.strtoupper($s->nama).'  </a>'
                                    .anchor('departemen/edit/' . $s->id_dept,'<i class="btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>')
                                    .anchor('departemen/delete/'.$s->id_dept,'<i class="btn-sm glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i></li>', array('onclick' => "return confirm('Data Akan di Hapus?')"));
                                }
                                echo "</ul>";
                                echo '</li>';
                            }else {
                             echo '<li><a href="?'.$m->nama.'" class="">'.strtoupper($m->nama).'</a>'
                             .anchor('departemen/edit/' . $m->id_dept,'<i class="btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>')
                             .anchor('departemen/delete/'.$m->id_dept,'<i class="btn-sm glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i></li>', array('onclick' => "return confirm('Data Akan di Hapus?')"));
                             
                            }
                        } 

                    ?>
                        
             </div>
     
            </div>
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
