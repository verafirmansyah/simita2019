<section class="content-header">
    <h1>
        Data Barang
        <small>Master Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-suitcase"></i>Master</a></li>
        <li class="active">Barang</li>
    </ol>
</section>
<script src="<?php echo base_url('assets/js/plugins/datatables/jquery-1.11.3.min.js'); ?>"></script>
    <script>
    $(document).ready(function(){  
		$.fn.dataTable.ext.errMode = 'throw'; 
        $('#tb-barang').dataTable( {                  
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
        "ajax": "<?php echo base_url('barang/view_data');?>",
        "columns": [
                { "mData": "no" },
                { "width":"12%","mData": "kode_barang" },
                { "mData": "nama_kategori" },                           
                { "mData": "merek_barang" },
                { "mData": "nama_barang" },                            
                { "className": "dt-body-left","width":"20%","mData": "spesifikasi" },
                { "mData": "satuan" },                           
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
                    <h3 class='box-title'><a href="<?php echo base_url('barang/add'); ?>" class="btn btn-primary btn-small">
                            <i class="glyphicon glyphicon-plus"></i> Tambah Data</a></h3>
                            <label calss='control-label' ></label>
                </div>
                <div class="box-body table-responsive">
                    <table id="tb-barang" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Barang</th>
                                <th>Kategori</th>
                                <th>Merek</th>
                                <th>Nama</th>
                                <th>Spesifikasi</th>
                                <th>Satuan</th>                               
                                <th>Edit</th>   
                                <th>Delete</th>                                 
                            </tr>
                        </thead>
                       
                    </Table> 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
