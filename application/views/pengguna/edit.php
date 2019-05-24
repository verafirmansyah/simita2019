<section class="content-header">
    <h1>
        Data Pengguna 
        <small>Edit Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li><a href="#">Edit Data</a></li>
        <li class="active">Pengguna</li>
    </ol>
</section>
<script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script>
$(document).ready(function(){
  $("#dept").change(function(){
      loadsubdept();
  });
});
</script>


<script type="text/javascript">
function loadsubdept()
{
    var dept=$("#dept").val();
    $.ajax({
    url:"<?php echo base_url();?>pengguna/tampilsubdept",
    data:"dept=" + dept ,
    success: function(html)
    { 
       $("#subdept").html(html);       
    }
          });
}
</script>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                <div class="col-md-5">
                <?php
                    echo form_open('pengguna/edit');
                ?>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">Kode Pengguna</label>
                            <input type="hidden"  name="kode" value="<?php echo $record['id_pengguna'] ?>" >
                            <input type="tex" name="idpengguna" disabled class="form-control" id="inputError" value="<?php echo $record['id_pengguna']; ?>" >
                        </div>   
                        <div class="form-group">
                            <label for="example">NIK</label>                            
                            <input type="tex" name="nik" class="form-control" id="inputError" required oninvalid="setCustomValidity('NIK Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan NIK Karyawan" value="<?php echo $record['nik']; ?>" >
                        </div> 
                        <div class="form-group">
                            <label for="example">Nama Pengguna</label>                            
                            <input type="tex" onkeyup="this.value = this.value.toUpperCase()"  name="pengguna" class="form-control" id="inputError" required oninvalid="setCustomValidity('Nama Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Karyawan" value="<?php echo $record['nama_pengguna']; ?>" >
                        </div> 

                        <div class="form-group">
                                <label>Cabang</label>
                                <select name="cabang" class="form-control">
                                    <?php
                                    foreach ($cabang as $j) {
                                        echo "<option value='$j->namacabang'";
                                        echo $record['id_cabang'] == $j->namacabang ? 'selected' : '';
                                        echo">$j->namacabang</option>";
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                                <label>Jabatan</label>
                                <select name="jabatan" class="form-control">
                                    <?php
                                    foreach ($jabatan as $j) {
                                        echo "<option value='$j->id_jabatan'";
                                        echo $record['id_jabatan'] == $j->id_jabatan ? 'selected' : '';
                                        echo">$j->nama_jabatan</option>";
                                    }
                                    ?>
                                </select>
                        </div> 
                        <div class="form-group">
                                <label>Departemen</label>
                                <select name="dept" class="form-control" id="dept">
                                    <?php 
                                    $departemen=$this->db->get_where('tb_departemen', array('parent'=>0,'gid'=>$record['gid']));                                   
                                    foreach ($departemen->result() as $d) {
                                        echo "<option value='$d->id_dept'";
                                        if ($record['parent']==0){
                                            echo $record['id_dept'] == $d->id_dept ? 'selected' : '';
                                        }else{
                                           echo $record['parent'] == $d->id_dept ? 'selected' : ''; 
                                        }                                        
                                        echo">$d->nama</option>";
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Sub. Departemen</label>
                            <select name="subdept" class="form-control" id="subdept">                            
                                <?php
                                $parent=$record['parent'];
                                $deptid=$record['id_dept'];                                
                                if ($parent==0){
                                    $subdept=$this->db->get_where('tb_departemen',array('parent'=>$deptid))->result();
                                    $dept=$this->db->get_where('tb_departemen',array('id_dept'=>$deptid))->row_array();                                    
                                }else{
                                     $subdept=$this->db->get_where('tb_departemen',array('parent'=>$parent))->result();
                                     $dept=$this->db->get_where('tb_departemen',array('id_dept'=>$parent))->row_array(); 
                                }   
                                echo "<option value=".$dept['id_dept'].">".strtoupper($dept['nama'])."</option>";
                                foreach ($subdept as $d) {
                                        echo "<option value='$d->id_dept'";
                                        echo $record['id_dept'] == $d->id_dept ? 'selected' : '';
                                        echo">$d->nama</option>";
                                    }
                                ?>
                            </select>
                            <?php echo form_error('subdept', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Ruang/ Kantor</label>
                            <input type="text" class="form-control" name="kantor" required oninvalid="setCustomValidity('Ruang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="ex: Ruang Main office HRD" value="<?php echo $record['ruang_kantor']; ?>" >
                            <?php echo form_error('kantor', '<div class="text-red">', '</div>'); ?>
                        </div> 
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
                        <a href="<?php echo site_url('pengguna'); ?>" class="btn btn-primary">Kembali</a>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>