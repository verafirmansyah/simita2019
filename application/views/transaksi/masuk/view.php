<section class="content-header">
    <h1>
        Detail Transaksi Barang Masuk
        <small>Transaksi Barang Masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Transaksi</a></li>
        <li class="active">Barang Masuk</li>
    </ol>
</section>
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>

    <script>
    $(document).ready(function(){ 
		$.fn.dataTable.ext.errMode = 'throw'; 
        $('#tb-masuk').dataTable( {                  
        "Processing": true, 
        "ServerSide": true,
        "iDisplayLength": 50,
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
        "ajax": "<?php echo base_url('masuk/view_data_masuk');?>",
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "kode_transaksi" },
                { "mData": "tgl_transaksi" },                           
                { "mData": "no_po" },
                { "mData": "merek_barang" },                            
                { "className": "dt-body-left","width":"20%","mData": "spesifikasi" },
                { "mData": "qty" },                           
                { "className": "dt-center","mData": "harga" },                                     
                { "mData": "catatan" },
                ]
            } );
        });
</script>
<section class="content">   
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class='box-header with-border'>
                    <h3 class='box-title'><a href="<?php echo base_url('masuk/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' > <?php echo $this->session->flashdata('result_hapus'); ?></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-masuk" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No Transaksi</th>
                                <th>Tgl. Transaksi</th>
                                <th>No. PO</th>
                                <th>Manufacture</th>                                                               
                                <th>Spesifikasi</th>
                                <th>QTY</th>
                                <th>Harga</th>                                 
                                <th>Keterangan</th>                                                         
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
