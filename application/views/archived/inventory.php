<script type="text/javascript" src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.3.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
    <script>
    $(document).ready(function(){  
		$.fn.dataTable.ext.errMode = 'throw'; 	
        $('#tb-laptop').dataTable( {
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 25,
        "oLanguage": {
                    "sSearch": "Search Data :  ",
                    "sZeroRecords": "No records to display",
                    "sEmptyTable": "No data available in table"
                    },
        "dom": 'Bfrtip',
        "select": true,
        "buttons": [
            {
                "extend": 'collection',
                "text": 'Export',
                "buttons": [
                    'copy',
                    'excel',
                    'pdf',
                    'print',
                ]
            }
            ],
        "ajax": "<?php echo base_url('archived/view_laptop');?>",
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "kode_laptop" },
                { "mData": "nama_pengguna" },
                { "mData": "dept" },  
                { "mData": "subdept" },                
                { "mData": "nama_laptop" },                           
                { "width":"20%","mData": "spesifikasi" },                          
                { "mData": "status" },
                { "mData": "view" },
                { "mData": "delete" },
                ]
            } );
    });
    
    $(document).ready(function(){ 
		$.fn.dataTable.ext.errMode = 'throw'; 
        $('#tb-komputer').dataTable( {                  
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 25,
        "oLanguage": {
                    "sSearch": "Search Data :  ",
                    "sZeroRecords": "No records to display",
                    "sEmptyTable": "No data available in table"
                    },
        "dom": 'Bfrtip',
        "select": true,
        "buttons": [
            {
                "extend": 'collection',
                "text": 'Export',
                "buttons": [
                    'copy',
                    'excel',
                    'pdf',
                    'print',
                ]
            }
            ],
        "ajax": "<?php echo base_url('archived/view_komputer');?>",
        "deferLoading": 57,
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "kode_komputer" },
                { "mData": "nama_pengguna" },
                { "mData": "dept" },  
                { "mData": "subdept" },                
                { "mData": "nama_komputer" },                           
                { "width":"20%","mData": "spesifikasi" },                           
                { "mData": "status" },
                { "mData": "edit" },
                { "mData": "delete" },
                ]
            } );
        });
    $(document).ready(function(){ 
		$.fn.dataTable.ext.errMode = 'throw'; 
        $('#tb-monitor').dataTable( {                  
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 25,
        "oLanguage": {
                    "sSearch": "Search Data :  ",
                    "sZeroRecords": "No records to display",
                    "sEmptyTable": "No data available in table"
                    },
        "dom": 'Bfrtip',
        "select": true,
        "buttons": [
            {
                "extend": 'collection',
                "text": 'Export',
                "buttons": [
                    'copy',
                    'excel',
                    'pdf',
                    'print',
                ]
            }
            ],
        "ajax": "<?php echo base_url('archived/view_monitor');?>",
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "kode_monitor" },
                { "mData": "nama_pengguna" },
                { "mData": "dept" },  
                { "mData": "subdept" },                
                { "mData": "jenis_monitor" },                           
                { "width":"20%","mData": "spesifikasi" },                        
                { "mData": "status" },
                { "mData": "edit" },
                { "mData": "delete" },
                ]
            } );
        });
    $(document).ready(function(){ 
		$.fn.dataTable.ext.errMode = 'throw'; 
        $('#tb-printer').dataTable( {                  
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 25,
        "oLanguage": {
                    "sSearch": "Search Data :  ",
                    "sZeroRecords": "No records to display",
                    "sEmptyTable": "No data available in table"
                    },
        "dom": 'Bfrtip',
        "select": true,
        "buttons": [
            {
                "extend": 'collection',
                "text": 'Export',
                "buttons": [
                    'copy',
                    'excel',
                    'pdf',
                    'print',
                ]
            }
            ],
        "ajax": "<?php echo base_url('archived/view_printer');?>",
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "kode_printer" },
                { "mData": "nama_pengguna" },
                { "mData": "dept" },  
                { "mData": "subdept" },                
                { "mData": "jenis_printer" },                           
                { "width":"20%","mData": "spesifikasi" },                        
                { "mData": "status" },
                { "mData": "edit" },
                { "mData": "delete" },
                ]
            } );
        });
    $(document).ready(function(){
		$.fn.dataTable.ext.errMode = 'throw'; 
        $('#tb-device').dataTable( {                  
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 25,
        "oLanguage": {
                    "sSearch": "Search Data :  ",
                    "sZeroRecords": "No records to display",
                    "sEmptyTable": "No data available in table"
                    },
        "dom": 'Bfrtip',
        "select": true,
        "buttons": [
            {
                "extend": 'collection',
                "text": 'Export',
                "buttons": [
                    'copy',
                    'excel',
                    'pdf',
                    'print',
                ]
            }
            ],
        "ajax": "<?php echo base_url('archived/view_device');?>",
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "kode_network" },                             
                { "mData": "jenis_network" },                           
                { "width":"20%","mData": "spesifikasi" }, 
                { "mData": "lokasi" },                        
                { "mData": "status" },
                { "mData": "edit" },
                { "mData": "delete" },
                ]
            } );
        });
</script>
<section class="content-header">
    <h1>
        Archived Inventory
        <small>Semua Inventaris</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">All</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">   
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">LAPTOP</a></li>
                        <li><a href="#tab_2" data-toggle="tab">KOMPUTER</a></li>
                        <li><a href="#tab_3" data-toggle="tab">MONITOR</a></li>                    
                        <li><a href="#tab_4" data-toggle="tab">PRINTER</a></li>
                        <li><a href="#tab_5" data-toggle="tab">DEVICE SUPORT</a></li>
                        <li class="pull-right"><a href="javascript:history.back()" ><i class="fa fa-remove"></i></a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                        <div class="col-md-12"> 
                          <div class="box-body table-responsive">                       
                            <table id="tb-laptop" class="table table-bordered table-striped" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>No.</th>
                                      <th>No Inventaris</th>
                                      <th>Nama Pengguna</th>
                                      <th>Departemen</th>
                                      <th>Sub.Dept</th>                                           
                                      <th>Nama Laptop</th>
                                      <th>Spesifikasi</th>                                 
                                      <th>Status</th>                           
                                      <th>Detail</th>   
                                      <th>Delete</th>                                 
                                  </tr>
                              </thead>
                              <body>

                              </body>
                            </table> 
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="tab_2">
                        <div class="col-md-12">
                          <div class="box-body table-responsive">
                            <table id="tb-komputer" class="table table-bordered table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No Inventaris</th>
                                        <th>Nama Pengguna</th>
                                        <th>Departemen</th>
                                        <th>Sub.Dept</th>                                           
                                        <th>Manufacture</th>
                                        <th>Spesifikasi</th>                              
                                        <th>Status</th>                           
                                        <th>Detail</th>   
                                        <th>Delete</th>                                 
                                    </tr>
                                </thead>
                                <body>

                                </body>
                            </table> 
                        </div><!-- /.box-body -->
                        </div>
                      </div>
                      <div class="tab-pane" id="tab_3">
                        <div class="col-md-12 "> 
                          <div class="box-body table-responsive">
                            <table id="tb-monitor" class="table table-bordered table-striped" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>No.</th>
                                      <th>No Inventaris</th>
                                      <th>Nama Pengguna</th>
                                      <th>Departemen</th>
                                      <th>Sub.Dept</th>                                            
                                      <th>Jenis Monitor</th>
                                      <th>Spesifikasi</th>                               
                                      <th>Status</th>                           
                                      <th>Detail</th>   
                                      <th>Delete</th>                                 
                                  </tr>
                              </thead>
                              <body>

                              </body>
                          </table> 
                        </div><!-- /.box-body -->
                        </div>
                      </div>
                      <div class="tab-pane" id="tab_4">
                        <div class="col-md-12 ">  
                          <div class="box-body table-responsive">
                            <table id="tb-printer" class="table table-bordered table-striped" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>No.</th>
                                      <th>No Inventaris</th>
                                      <th>Nama Pengguna</th>
                                      <th>Departemen</th>
                                      <th>Sub.Dept</th>                                             
                                      <th>Jenis printer</th>
                                      <th>Spesifikasi</th>                               
                                      <th>Status</th>                           
                                      <th>Detail</th>   
                                      <th>Delete</th>                                 
                                  </tr>
                              </thead>
                              <body>

                              </body>
                            </table> 
                          </div><!-- /.box-body -->
                        </div>
                      </div>
                      <div class="tab-pane" id="tab_5">
                        <div class="col-md-12 ">  
                          <div class="box-body table-responsive">
                            <table id="tb-device" class="table table-bordered table-striped" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th>No.</th>
                                      <th>No Inventaris</th>                                     
                                      <th>Device Type</th>
                                      <th>Spesifikasi</th> 
                                      <th>Lokasi Penggunaan</th>                              
                                      <th>Status</th>                           
                                      <th>Edit</th>   
                                      <th>Delete</th>                                 
                                  </tr>
                              </thead>
                              <body>

                              </body>
                            </table> 
                          </div><!-- /.box-body -->
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>