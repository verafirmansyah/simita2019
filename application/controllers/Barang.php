<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Barang extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_barang');
        chek_session();
    }
	public function index() {
        //$data['record'] = $this->m_barang->listBarang()->result(); 
        $this->template->display('barang/databarang');       
    }		
   
    public function view_data() {
       if ($this->session->userdata('role')=='Administrator'){
            $ambildata=$this->m_barang->list_barang()->result();
        }else{
            $ambildata=$this->m_barang->list_barangid()->result();
        }  
        $no=1;
        foreach($ambildata as $r) { 
            $query[] = array(
                'no'=>$no++,
                'kode_barang'=>$r->kode_barang,
                'nama_kategori'=>$r->nama_kategori,                
                'nama_barang'=>$r->nama_barang,  
                'merek_barang'=>$r->merek_barang, 
                'spesifikasi'=>$r->spesifikasi, 
                'satuan'=>'<center>'.$r->satuan.'</center>',          
                'edit'=>anchor('barang/edit/' . $r->kode_barang, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>'),
                'delete'=>anchor('barang/delete/' . $r->kode_barang, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")),     
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }

    function add() {              
        $this->_set_rules();
        if ($this->form_validation->run() == true) {
            $data = array(
                'kode_barang' => $this->m_barang->kdotomatis(),
                'id_kategori' => $this->input->post('kategori'),
                'nama_barang' => $this->input->post('nama'),
                'merek_barang' => $this->input->post('merek'),
                'spesifikasi' => $this->input->post('spek'),
                'satuan' => $this->input->post('satuan'),
                'gid' => $this->session->userdata('gid')
            );
            $this->m_barang->simpan($data);
            redirect('barang');
        } else {  
            $data['katBarang'] = $this->m_barang->getKategori()->result();   
            $data['merek'] = $this->m_barang->getMerek()->result();          
            $this->template->display('barang/tambah', $data);
        }
    }
	
    function addkategori() { 
        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required|is_unique[tb_kategori.nama_kategori]');
        if ($this->form_validation->run() == true) {
            $data = array(
                'nama_kategori' => $this->input->post('nama_kategori')               
            );
            $this->m_barang->simpankat($data);
            redirect('barang/add');
        } else {       
            $this->template->display('barang/kategori');
        }
    }
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array(                            
                        'id_kategori' => $this->input->post('kategori'),
                        'nama_barang' => $this->input->post('nama'),
                        'merek_barang' => $this->input->post('merek'),
                        'spesifikasi' => $this->input->post('spek'),
                        'satuan' => $this->input->post('satuan'));
                $kode=$this->input->post('kode');
                $this->m_barang->edit($kode,$data);
                redirect('barang');                
            }else {
                $id = $this->input->post('kode');
                $data['katbarang'] = $this->m_barang->getKategori()->result();                            
                $data['record'] = $this->m_barang->getkode($id)->row_array();
                $this->template->display('barang/edit', $data); 
            } 
           }else{ 
                $id = $this->uri->segment(3);               
                $data['katbarang'] = $this->m_barang->getKategori()->result();                            
                $data['record'] = $this->m_barang->getkode($id)->row_array();
                $this->template->display('barang/edit', $data);
            }
    }
    function delete($kode_barang) {
        $this->m_barang->hapus($kode_barang);
		redirect('barang');
    }

    function _set_rules() {
        $this->form_validation->set_rules('nama', 'Nama barang', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('merek', 'Merek', 'required');
        $this->form_validation->set_rules('spek', 'Spesifikasi', 'required');
        $this->form_validation->set_rules('satuan', 'Satuan', 'required');        
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissable'>", "</div>");
    }

}
