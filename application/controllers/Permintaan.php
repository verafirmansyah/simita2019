<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permintaan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_permintaan'));
        chek_session();
    }
	
    function index() {        
        $this->template->display('transaksi/permintaan/view');       
    }		
   
    function view_data_permintaan(){        
        //$criteria = $this->db->query("SELECT * FROM tb_kecamatan ORDER BY kota_id ASC");
        $ambildata=$this->m_permintaan->list_permintaangid()->result();          
        $no=1;
        foreach($ambildata as $r) { 
            $query[] = array(
                'no'=>$no++,
                'kode_transaksi'=>$r->kode_transaksi,                
                'merek_barang'=>$r->merek_barang,  
                'spesifikasi'=>$r->spesifikasi, 
                'qty'=>'<center>'.$r->qty_masuk.'</center>',         
                'harga'=>rupiah($r->harga),
                'catatan'=>$r->catatan, 
                'no_po'=>$r->no_po,                  
                'tgl_transaksi'=>tgl_indo($r->tgl_transaksi),
                'nama_supplier'=>$r->nama_supplier,  
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

    function tampilbrand(){        
        $id=$_GET['kategori'];
        $gid=$this->session->userdata('gid');
        $brand=  $this->db->get_where('tb_barang',array('id_kategori'=>$id,'gid'=>$gid))->result(); 
        echo "<option value=''>- PILIH BRAND -</option>";       
        foreach ($brand as $r){
            echo "<option value='$r->merek_barang'>".  strtoupper($r->merek_barang)."</option>";
        }
    }

    function masuk_ajax(){
        $this->m_permintaan->simpan_masuk_temp();
    }

    function load_temp(){
        echo "<table class='table table-bordered table-striped'>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Harga Beli</th>
            <th>Catatan</th>
            <th>Delete</th>
        </tr>";
        $data=  $this->m_permintaan->tampil_temp()->result();
        foreach ($data as $d){
            $harga=rupiah($d->harga);
            echo "<tr id='dataku$d->id_trans_detail'>
                <td>$d->kode_barang</td>
                <td>$d->nama_barang</td>                
                <td>$d->qty_masuk</td>
                <td>$harga</td>
                <td>$d->catatan</td>
                <td><button onClick='hapus($d->id_trans_detail)'>Hapus</button></td>
                </tr>";
        }
    echo"</table>";
    }

    function hapus_temp() {
        $id=$_GET['id'];
        $this->m_permintaan->hapus_temp($id);
    }

    function tampilspek(){        
        $id=$_GET['namabarang'];
        $barang=  $this->db->get_where('tb_barang',array('kode_barang'=>$id))->row_array();        
        echo $barang['spesifikasi'];
    } 
    
    function add() {  
        $this->form_validation->set_rules('cabang', 'Cabang', 'required');            
        if ($this->form_validation->run() == true) {
            $gid=$this->session->userdata('gid');           
            $kode =$this->m_permintaan->kdotomatis();
            $data = array(
                    'kode_permintaan'=>$kode,                     
                    'tgl_permintaan'=>  tanggal(),
                    'nama_cabang'=>$this->input->post('namacabang'),
                    'gid'=>$gid
                );
            $this->m_permintaan->simpan($data);
            $this->m_permintaan->update_status($kode);
            redirect('permintaan');
        } else {
            $data['kode']=$this->m_permintaan->kdotomatis();
            $data['kategori'] = $this->m_permintaan->getkategori()->result(); 
            $data['brand'] = $this->m_permintaan->getbrand()->result();  
            $data['barang'] = $this->m_permintaan->getbarang()->result();  
            $data['cabang'] = $this->m_permintaan->getcabang()->result();          
            $this->template->display('transaksi/permintaan/tambah',$data);
        }
    }	
    
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array( 
                        'id_pengguna' => $this->input->post('pengguna'),
                        'jenis_transaksi' => $this->input->post('merek'),
                        'spesifikasi' => $this->input->post('spek'),
                        'tgl_inv' =>$this->input->post('tgl_inv')
                    );
                $kode=$this->input->post('kode');
                $this->m_permintaan->edit($kode,$data);
                redirect('transaksi');                
            }else {
                $id = $this->input->post('kode');
                //$data['pengguna'] = $this->m_permintaan->getpengguna()->result();                            
                $data['record'] = $this->m_permintaan->getkode($id)->row_array();
                $this->template->display('transaksi/edit', $data);
            } 
           }else{ 
                $id = $this->uri->segment(3);               
                //$data['pengguna'] = $this->m_permintaan->getpengguna()->result();                            
                $data['record'] = $this->m_permintaan->getkode($id)->row_array();
                $this->template->display('transaksi/edit', $data);
            }
    }
    function delete($kode) {
        $this->m_permintaan->hapus($kode);
		redirect('transaksi');
    }

    function _set_rules() {
        //$this->form_validation->set_rules('kategori', 'Kategori Barang', 'required');   
        //$this->form_validation->set_rules('namabarang', 'Nama Barang', 'required');
        //$this->form_validation->set_rules('qty', 'QTY', 'required');        
        //$this->form_validation->set_rules('harga', 'Harga', 'required');  
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        
    }
}