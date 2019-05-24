<section class="content-header">
    <h1>
        Data Laptop 
        <small>Inventaris Laptop</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Inventaris</a></li>
        <li class="active">laptop</li>
    </ol>
</section>
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" >
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script>   
    $('#notifications').slideDown('slow').delay(3000).slideUp('slow');
</script>
<style>
#notifications {
    cursor: pointer;
    position: fixed;
    right: 0px;
    z-index: 9999;
    bottom: 0px;
    margin-bottom: 22px;
    margin-right: 15px;
    min-width: 300px; 
    max-width: 800px;  
    }
</style>
<script>
    $(document).ready(function(){     
		$.fn.dataTable.ext.errMode = 'throw'; 	
        $('#tb-laptop').dataTable( {
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 25,
        "oLanguage": {
                    "sSearch": "Pencarian :  ",
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
        "ajax": "<?php echo base_url('laptop/view_data');?>",
        "columns": [
                { "mData": "no" },
                { "width":"15%","mData": "kode_laptop" },
                { "width":"15%","mData": "aset_hrd" },
                { "mData": "nama_pengguna" },
                { "mData": "dept" },  
                { "mData": "subdept" },                
                { "mData": "nama_laptop" },                           
                { "mData": "ip" },                           
                { "mData": "status" },
                { "mData": "view"},
                { "mData": "delete" },
                ]
            } );
    });
</script>
<div id="notifications"><?php echo $this->session->flashdata('result_hapus'); ?></div> 
<section class="content">   
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('laptop/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <a href="<?php echo base_url('laptop/export_excel'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-save-file"></i> Export to Excel</a></h3>
                            <!--<label calss='control-label' ><?php echo $this->session->flashdata('result_hapus'); ?></label> -->
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-laptop" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No.Inventaris IT</th>
                                <th>No.Inventaris HRD</th>
                                <th>Pengguna</th>
                                <th>Departemen</th>
                                <th>Sub.Dept</th>                                                               
                                <th>Merk</th>
                                <th>IP Address</th>                                 
                                <th>Status</th>                           
                                <th>Detail</th>   
                                <th>Hapus</th>                                 
                            </tr>
                        </thead>
                        <body>

                        </body>
                    </Table> 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
