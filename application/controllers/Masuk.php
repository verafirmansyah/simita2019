<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Masuk extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_masuk'));
        // load helper Date
        $this->load->helper('date');
        chek_session();
    }
	
    function index() {        
        $this->template->display('transaksi/masuk/view');       
    }		
   
    function view_data_masuk(){        
        //$criteria = $this->db->query("SELECT * FROM tb_kecamatan ORDER BY kota_id ASC");
        $ambildata=$this->m_masuk->list_masukgid()->result();          
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
        $this->m_masuk->simpan_masuk_temp();
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
        $data=  $this->m_masuk->tampil_temp()->result();
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
        $this->m_masuk->hapus_temp($id);
    }

    function tampilspek(){        
        $id=$_GET['namabarang'];
        $barang=  $this->db->get_where('tb_barang',array('kode_barang'=>$id))->row_array();        
        echo $barang['spesifikasi'];
    } 
    
    function add() {  
        $this->form_validation->set_rules('supplier', 'Supplier', 'required');      
        if ($this->form_validation->run() == true) {
            $gid=$this->session->userdata('gid');           
            $kode =$this->m_masuk->kdotomatis();
            $data = array(
                    'kode_transaksi'=>$kode,
                    'no_po'=>$this->input->post('no_po'), 
                    'tgl_po'=>$this->input->post('tgl_po'),                      
                    'tgl_transaksi'=>  tanggal(),
                    'id_supplier'=>$this->input->post('supplier'),
                    'createby' => $this->session->userdata('username'),
                    'createdate' =>mdate('%Y-%m-%d %H:%i:%s', now()),
                    'gid'=>$gid
                );
            $this->m_masuk->simpan($data);
            $this->m_masuk->update_status($kode);
            redirect('masuk');
        } else {
            $data['kode']=$this->m_masuk->kdotomatis();
            $data['kategori'] = $this->m_masuk->getkategori()->result(); 
            $data['brand'] = $this->m_masuk->getbrand()->result();  
            $data['barang'] = $this->m_masuk->getbarang()->result();  
            $data['supplier'] = $this->m_masuk->getsupplier()->result();          
            $this->template->display('transaksi/masuk/tambah',$data);
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
                $this->m_masuk->edit($kode,$data);
                redirect('transaksi');                
            }else {
                $id = $this->input->post('kode');
                //$data['pengguna'] = $this->m_masuk->getpengguna()->result();                            
                $data['record'] = $this->m_masuk->getkode($id)->row_array();
                $this->template->display('transaksi/edit', $data);
            } 
           }else{ 
                $id = $this->uri->segment(3);               
                //$data['pengguna'] = $this->m_masuk->getpengguna()->result();                            
                $data['record'] = $this->m_masuk->getkode($id)->row_array();
                $this->template->display('transaksi/edit', $data);
            }
    }
    function delete($kode) {
        $this->m_masuk->hapus($kode);
		redirect('transaksi');
    }

    function _set_rules() {
        //$this->form_validation->set_rules('kategori', 'Kategori Barang', 'required');   
        //$this->form_validation->set_rules('namabarang', 'Nama Barang', 'required');
        //$this->form_validation->set_rules('qty', 'QTY', 'required');        
        //$this->form_validation->set_rules('harga', 'Harga', 'required');  
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        
    }
    function do_upload(){
        
         
        
        if($this->upload->do_upload("file")){
            $data = array('upload_data' => $this->upload->data());
 
           
             
            $result= $this->m_masuk->simpan($judul,$image);
            echo json_decode($result);
        }
 
     }
}