<section class="content-header">
    <h1>
        Data Monitor 
        <small>Inventaris Monitor</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">Monitor</li>
    </ol>
</section>
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
    <script>
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
        "ajax": "<?php echo base_url('monitor/view_data');?>",
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
</script>
<section class="content">   
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('monitor/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' > <?php echo $this->session->flashdata('result_hapus'); ?></label>
                </div>
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
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
