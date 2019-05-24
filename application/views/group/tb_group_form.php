
<section class='content-header'>
	<h1>
		TB_GROUP
		<small>Daftar Tb_group</small>
	</h1>
	<ol class='breadcrumb'>
		<li><a href='#'><i class='fa fa-suitcase'></i>Seting</a></li>
		<li class='active'>Daftar Tb_group</li>
	</ol>
</section>        
<section class='content'>
    <div class='row'>
        <!-- left column -->
        <div class='col-md-12'>
            <!-- general form elements -->
            <div class='box box-primary'>
                <div class='box-header'>
                <div class='col-md-5'>
        <form action="<?php echo $action; ?>" method="post"><div class='box-body'>
	    <div class='form-group'>Nama Group <?php echo form_error('nama_group') ?>
            <input type="text" class="form-control" name="nama_group" id="nama_group" placeholder="Nama Group" value="<?php echo $nama_group; ?>" />
        </div>
	    <div class='form-group'>Nama Alias <?php echo form_error('nama_alias') ?>
            <input type="text" class="form-control" name="nama_alias" id="nama_alias" placeholder="Nama Alias" value="<?php echo $nama_alias; ?>" />
        </div>
	    <div class='form-group'>Alamat <?php echo form_error('alamat') ?>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
	    <div class='form-group'>Logo <?php echo form_error('logo') ?>
            <input type="text" class="form-control" name="logo" id="logo" placeholder="Logo" value="<?php echo $logo; ?>" />
        </div>
	    <div class='form-group'>Logo Dashboard <?php echo form_error('logo_dashboard') ?>
            <input type="text" class="form-control" name="logo_dashboard" id="logo_dashboard" placeholder="Logo Dashboard" value="<?php echo $logo_dashboard; ?>" />
        </div></div><div class='box-footer'>
	    <input type="hidden" name="gid" value="<?php echo $gid; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('group') ?>" class="btn btn-default">Cancel</a>
	 </div>
            </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
</section><!-- /.content -->