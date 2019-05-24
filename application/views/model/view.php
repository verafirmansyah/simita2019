<section class="content-header">
    <h1>
        Data Master
        <small>Master Tipe</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Master Tipe</li>
    </ol>
</section>
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
    <script>
    $(document).ready(function(){ 
        $.fn.dataTable.ext.errMode = 'throw'; 
        $('#tb-model').dataTable( {                  
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 10,
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
        "ajax": "<?php echo base_url('model/view_data');?>",
        "columns": [
                { "mData": "no" },                             
                { "mData": "nama_manufacture" },  
                { "mData": "tipe"},
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
                    <h3 class='box-title'><a href="<?php echo base_url('model/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data Tipe</a></h3>
                    <h3 class='box-title'><a href="<?php echo base_url('manufacture/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data Manufacture</a></h3>
                            <label calss='control-label' > <?php echo $this->session->flashdata('result_hapus'); ?></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-model" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Manufacture (Merk)</th> 
                                <th>Tipe</th>                            
                                <th>Edit</th>   
                                <th>Delete</th>                                 
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
