
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
            <div class='col-xs-12'>
              <div class='box box-primary'>
                <div class='box-header'>
                <h3 class='box-title'> Detail Tb_group Read</h3>
        <table class="table table-bordered">
	    <tr><td>Nama Group</td><td><?php echo $nama_group; ?></td></tr>
	    <tr><td>Nama Alias</td><td><?php echo $nama_alias; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Logo</td><td><?php echo $logo; ?></td></tr>
	    <tr><td>Logo Dashboard</td><td><?php echo $logo_dashboard; ?></td></tr>
	</table>
        <div class='box-footer'>
        <a href="<?php echo site_url('group') ?>" class="btn btn-primary">Back</a>
        </div>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->