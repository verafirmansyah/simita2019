<section class="content-header">
    <h1>
        Data Komputer PC 
        <small>Inventaris Komputer PC</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">KomputerPC</li>
    </ol>
</section>
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
    <script>
    $(document).ready(function(){                    
        $('#tb-komputer').dataTable( {                  
        "Processing": true, 
        "ServerSide": true,
        "ajax": "<?php echo base_url('komputer/view_data');?>",
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "kode_komputer" },
                { "mData": "nama_pengguna" },
                { "mData": "dept" },  
                { "mData": "subdept" },                
                { "mData": "nama_komputer" },                           
                { "width":"20%","mData": "spesifikasi" },
                { "mData": "ip" },                           
                { "mData": "status" },
                { "mData": "edit" },
                { "mData": "delete" },
                ]
            } );
        });
</script>
<section class="content">   
    <div class="row">
	 <div class="col-md-12">
        <div class="box box-primary">
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">                  
                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">UNIT KOMPUTER <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <?php                    
                    foreach ($menu as $m) {                        
                        echo '<li class=""><a data-toggle="tab" tabindex="-1" href="#'.$m->gid.'">'.$m->nama_group.'</a></li>';
                       }                    
                    ?>  
                    </ul> 
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
        <div class="tab-content">
            <div id="1" class="tab-pane fade in active">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('komputer/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' ></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-komputer" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No Inventaris</th>
                                <th>Nama Pengguna</th>
                                <th>Departemen</th>
                                <th>Sub.Dept</th>                                                               
                                <th>Brand/ Mainbord PC</th>
                                <th>Spesifikasi</th>
                                <th>IP Address</th>                                 
                                <th>Status</th>                           
                                <th>Edit</th>   
                                <th>Delete</th>                                 
                            </tr>
                        </thead>
                        <body>

                        </body>
                    </Table> 
                </div><!-- /.box-body -->
                </div>
                  <div id="2" class="tab-pane fade">
                    <p>@mdo Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                </div>
            </div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->
	</div>
	</div>
</div>
</section>