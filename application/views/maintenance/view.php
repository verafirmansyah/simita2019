<section class="content-header">
    <h1>
        Maintenance
        <small>Data Maintenance Inventory</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Transaksi</a></li>
        <li class="active">Maintenance</li>
    </ol>
</section>
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
    <script>
    $(document).ready(function(){ 
		$.fn.dataTable.ext.errMode = 'throw'; 
        $('#tb-maintenance').dataTable( {                  
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
        "ajax": "<?php echo base_url('maintenance/view_data');?>",
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "no_permohonan" },
                { "mData": "no_inventaris"},
                { "mData": "aset_hrd"},
                { "mData": "nama_kategori" },
                { "mData": "tgl_permohonan" },                           
                { "mData": "jenis_permohonan" }, 
                { "mData": "catatan_pemohon"},
                { "mData": "status" },
                { "mData": "view" },
                { "mData": "cetak" },
                ]
            } );
        });
</script>
<section class="content">   
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('maintenance/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' > <?php echo $this->session->flashdata('result_hapus'); ?></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-maintenance" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No Permohonan</th>
                                <th>No. Inventaris</th>
                                <th>Aset HRD</th>
                                <th>Jenis Inventaris</th> 
                                <th>Tgl. Permohonan</th>
                                <th>Maintenance Type</th>                                   
                                <th>Catatan Permohonan</th>                           
                                <th>Status</th>   
                                <th>View</th> 
                                <th>Print</th>                             
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
