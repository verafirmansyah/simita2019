<section class="content-header">
    <h1>
        Laporan Stok Barang
        <small> Stok Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Transaksi</a></li>
        <li class="active">Stok Barang</li>
    </ol>
</section>
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
    <script>
    $(document).ready(function(){ 
		$.fn.dataTable.ext.errMode = 'throw'; 
        $('#tb-stok').dataTable( {                  
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
        "ajax": "<?php echo base_url('stok/view_data_stok');?>",
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "kode_barang" },
                { "mData": "nama_kategori" },                           
                { "mData": "merek_barang" },
                { "mData": "nama_barang" },                            
                { "className": "dt-body-left","width":"20%","mData": "spesifikasi" },                                           
                { "className": "dt-center","mData": "stok" }, 
                { "mData": "satuan" },
                { "mData": "view" },  
                ]
            } );
        });
</script>
<section class="content">   
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">                
                <div class="box-body table-responsive">
                    <table id="tb-stok" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Barang</th>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Merek</th>
                                <th>Spesifikasi</th>                                                               
                                <th>Stok</th>
                                <th>Satuan</th> 
                                <th>View</th>                                                                                          
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
