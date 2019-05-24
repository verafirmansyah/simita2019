<!doctype html>
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
        <div class='col-md-12'>
            <div class='box box-primary'>  
                <div class='box-header with-border'>                
                  <div class="col-md-4">
                    <?php echo anchor(site_url('group/create'),'Create', 'class="btn btn-primary"'); ?>
                  </div>
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message">
                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                    </div>
                </div>
                <div class="col-md-1 text-right">
                </div>
                <div class="col-md-3 text-right">
                    <form action="<?php echo site_url('group/index'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                                <?php 
                                    if ($q <> '')
                                    {
                                        ?>
                                        <a href="<?php echo site_url('group'); ?>" class="btn btn-default">Reset</a>
                                        <?php
                                    }
                                ?>
                              <button class="btn btn-primary" type="submit">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">                         
            <tr>
                <th>No</th>
		<th>Nama Group</th>
		<th>Nama Alias</th>
		<th>Alamat</th>
		<th>Logo</th>
		<th>Logo Dashboard</th>
		<th>Action</th>
            </tr><?php
            foreach ($group_data as $group)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $group->nama_group ?></td>
			<td><?php echo $group->nama_alias ?></td>
			<td><?php echo $group->alamat ?></td>
			<td><?php echo $group->logo ?></td>
			<td><?php echo $group->logo_dashboard ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('group/read/'.$group->gid),'Read'); 
				echo ' | '; 
				echo anchor(site_url('group/update/'.$group->gid),'Update'); 
				echo ' | '; 
				echo anchor(site_url('group/delete/'.$group->gid),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
            <br>            
            <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
		</div>
		</div>
            
</section><!-- /.content -->