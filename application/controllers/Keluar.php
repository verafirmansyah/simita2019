<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keluar extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_keluar'));
        chek_session();
    }
	
    function index() {        
        $this->template->display('transaksi/keluar/view');       
    }		
   
    function view_data_keluar(){        
        //$criteria = $this->db->query("SELECT * FROM tb_kecamatan ORDER BY kota_id ASC");
        if ($this->session->userdata('role')=='Administrator'){
            $ambildata=$this->m_keluar->list_keluar()->result();
        }else{
            $ambildata=$this->m_keluar->list_keluargid()->result();
        }  
        $no=1;
        foreach($ambildata as $r) { 
            $query[] = array(
                'no'=>$no++,
                'kode_transaksi'=>$r->kode_transaksi,
                'tgl_transaksi'=>tgl_indo($r->tgl_transaksi),                
                'nama_barang'=>$r->nama_barang,  
                'spesifikasi'=>$r->spesifikasi, 
                'qty'=>'<center>'.$r->qty_keluar.'</center>',         
                'catatan'=>$r->catatan, 
                'nama_pengguna'=>$r->nama_pengguna,
                'nama'=>$r->nama,   
                'cabang'=>$r->id_cabang,            
                'cetak'=>'<a href="'.base_url('keluar/cetak/'.$r->kode_transaksi).'" target="_blank" ><i class="btn btn-info btn-sm fa fa-print" data-toggle="tooltip" title="Print"></i>',
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }  

    function tampilbarang(){        
        $id=$_GET['kategori'];
        $gid=$this->session->userdata('gid');
        $barang=  $this->db->get_where('tb_barang',array('id_kategori'=>$id,'gid'=>$gid))->result();
        echo "<option value=''>- Select -</option>";        
        foreach ($barang as $r){
            echo "<option value='$r->kode_barang'>".  strtoupper($r->nama_barang)."</option>";
        }
    } 

    function keluar_ajax(){
        $barang =   $_GET['barang'];
        $qty    =   $_GET['qty'];
        if (chek_stok($barang)>=$qty){
            $this->m_keluar->simpan_keluar_temp();           
        }else{
             $this->session->set_flashdata('qty', '<br>Qty Melebihi Stok');
            redirect('keluar/add');
        }
        
    }

    function load_temp(){
        echo "<table class='table table-bordered table-striped'>
        <tr>
            <th>Cabang</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Spesifikasi</th>
            <th>Qty</th>
            <th>Catatan</th>
            <th>Delete</th>
        </tr>";
        $data=  $this->m_keluar->tampil_temp()->result();
        foreach ($data as $d){
            echo "<tr id='dataku$d->id_trans_detail'>
                <td>$d->id_cabang</td>
                <td>$d->kode_barang</td>
                <td>$d->nama_barang</td>   
                <td>$d->spesifikasi</td>               
                <td>$d->qty_keluar</td>
                <td>$d->catatan</td>
                <td><button onclick='hapus($d->id_trans_detail)'>Hapus</button></td>
                </tr>";
        }
    echo"</table>";
    }

    function hapus_temp() {
        $id=$_GET['id'];
        $this->m_keluar->hapus_temp($id);
    }

    function cetak($id) {
        $data['keluar']=$this->m_keluar->get_transaksi($id)->row_array();        
        $data['record']=$this->m_keluar->cetak($id)->result();     
        $this->load->view('transaksi/keluar/cetak',$data); 
    }

    function tampilspek(){        
        $id=$_GET['namabarang'];
        $barang=  $this->db->get_where('tb_barang',array('kode_barang'=>$id))->row_array();        
        echo $barang['spesifikasi'];
    } 
    function tampilqty(){        
        $id=$_GET['namabarang'];
        $barang=  $this->db->get_where('tb_transdetail',array('kode_barang'=>$id))->row_array();        
        echo $barang['qtymasuk'];
    }

    function add() {  
        $this->form_validation->set_rules('penerima', 'Penerima', 'required');            
        if ($this->form_validation->run() == true) {
            $gid=$this->session->userdata('gid');           
            $kode =$this->m_keluar->kdotomatis();
            $data = array(
                    'kode_transaksi'=>$kode,                     
                    'tgl_transaksi'=>  tanggal(),
                    'id_pengguna'=>$this->input->post('penerima'),
                    'id_cabang'=>$this->input->post('cabang'),
                    'createddate'=>tgl_lengkap,
                    'form_permintaan' => $upload['file']['file_name'],
                    'gid'=>$gid
                );
            $this->m_keluar->simpan($data);
            $this->m_keluar->update_status($kode);
            $this->m_keluar->upload();
            redirect('keluar');
        } else {
            $data['kode']=$this->m_keluar->kdotomatis();
            $data['kategori'] = $this->m_keluar->getkategori()->result();   
            $data['barang'] = $this->m_keluar->getbarang()->result();  
            $data['pengguna'] = $this->m_keluar->getpenggunagid()->result();   
            $data['cabang'] = $this->m_keluar->getcabang()->result();       
            $this->template->display('transaksi/keluar/tambah',$data);
        }
    }	 

    function _set_rules() {
        //$this->form_validation->set_rules('kategori', 'Kategori Barang', 'required');   
        //$this->form_validation->set_rules('namabarang', 'Nama Barang', 'required');
        //$this->form_validation->set_rules('qty', 'QTY', 'required');        
        //$this->form_validation->set_rules('harga', 'Harga', 'required');  
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        
    }
}
