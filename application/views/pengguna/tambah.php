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
                    echo form_open('pengguna/add');
                ?> 
                  
                    <div class="box-body">
                        <div class="form-group">
                            <label for="example">NIK</label>
                            <input type="text" name="nik" class="form-control" required oninvalid="setCustomValidity('NIK Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Nomor Induk Karyawan " >
                                   <?php echo form_error('nik', '<div class="text-red">', '</div>'); ?>
                        </div>                                            
                        <div class="form-group">
                            <label for="">Nama Pengguna</label>
                            <input type="text" onkeyup="this.value = this.value.toUpperCase()"  class="form-control" name="pengguna" required oninvalid="setCustomValidity('Nama Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="Masukan Nama Pengguna">
                            <?php echo form_error('nama', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Cabang</label>
                            
                                <select name="cabang" class="form-control" id="inputError">
                                    <option value='0'>- Pilih Cabang -</option>
                                    <?php
                                    if (!empty($cabang)) {
                                        foreach ($cabang as $row) {
                                            echo "<option value=".$row->id_cabang.">".$row->namacabang."</option>";                                        
                                        }
                                    }
                                    ?>
                                </select>
                                   
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <!--<div class="input-group">-->
                                <select name="jabatan" class="form-control" id="inputError">
                                    <option value='0'>- Pilih Jabatan -</option>
                                    <?php
                                    if (!empty($jabatan)) {
                                        foreach ($jabatan as $row) {
                                            echo "<option value='".$row->nama_jabatan."'>".$row->nama_jabatan."</option>";                                        
                                        }
                                    }
                                    ?>
                                </select>
                                <!--
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-toggle="tooltip" title="Add Jabatan"><?php echo anchor('pengguna/addjabatan','<i class="fa fa-plus"></i>')?> </button>
                                </div>
                           
                            </div>-->
                            <?php echo form_error('jabatan', '<div class="text-red">', '</div>'); ?>
                        </div>      
                        <div class="form-group">
                            <label>Departemen</label>
                            <select name="dept" class="form-control" id="dept">
                            <option value='0'>- Pilih Departemen -</option>
                                <?php
                                if (!empty($departemen)) {
                                    foreach ($departemen as $row) {
                                        echo "<option value='".$row->id_dept."'>".strtoupper($row->nama)."</option>";                                        
                                    }
                                }
                                ?>
                            </select>                            
                        </div>     
                        <div class="form-group">
                            <label>Sub. Departemen</label>
                            <select name="subdept" class="form-control" id="subdept">
                            <option value=''>- Pilih Sub. Departemen -</option>
                                <?php
                                
                                ?>
                            </select>
                            <?php echo form_error('subdept', '<div class="text-red">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="">Ruang/ Kantor</label>
                            <input type="text" class="form-control" name="kantor" required oninvalid="setCustomValidity('Ruang Harus di Isi !')"
                                   oninput="setCustomValidity('')" placeholder="ex: Ruang Main office HRD">
                            <?php echo form_error('kantor', '<div class="text-red">', '</div>'); ?>
                        </div>          
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>                        
                        <a href="<?php echo site_url('pengguna'); ?>" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
        $(document).ready(function () {
            $("#dept").change(function () {
                var url = "<?php echo site_url('pengguna/add_subdept'); ?>/" + $(this).val();
                $('#subdept').load(url);
                return false;
            })
        });        
</script>    