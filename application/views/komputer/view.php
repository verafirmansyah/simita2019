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
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
    <script>
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
        "ajax": "<?php echo base_url('komputer/view_data');?>",
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "kode_komputer" },
                { "mData": "aset_hrd" },
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
</script>
<section class="content">   
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('komputer/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' > <?php echo $this->session->flashdata('result_hapus'); ?></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-komputer" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No Inventaris</th>
                                <th>No.Aset HRD</th>   
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
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
