<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_pengguna','m_departemen'));
        // load helper Date
        $this->load->helper('date');
        chek_session();
    }
	public function index() {       
        //$data['record'] = $this->m_pengguna->semua()->result();         
        $this->template->display('pengguna/view');       
    }
    
    function view_data(){        
        if ($this->session->userdata('role')=='Administrator'){
            $ambildata=$this->m_pengguna->semua()->result();
        }else{
            $ambildata=$this->m_pengguna->semuagid()->result();
        } 
        $no=1;
        foreach($ambildata as $r) {  
        $dept=$this->db->get_where('tb_departemen',array('id_dept'=>$r->parent))->row_array();
            if($r->parent==0){
                    $deptnama=$r->nama;
            }else{
                    $deptnama=$dept['nama'];
            } 
            $query[] = array(
                'no'=>$no++,
                'id_pengguna'=>$r->id_pengguna,
                'nik'=>'<center>'.$r->nik.'</center>',
                'nama_pengguna'=>$r->nama_pengguna,
                'dept'=>$deptnama, 
                'subdept'=>$r->nama, 
                'nama_jabatan'=>$r->nama_jabatan, 
                'namacabang'=>$r->namacabang,
                'ruang_kantor'=>$r->ruang_kantor, 
                'edit'=>''.anchor('pengguna/edit/' . $r->id_pengguna, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') .'',
                'delete'=>''.anchor('pengguna/delete/' . $r->id_pengguna, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")).'',                
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }	

    function tampilsubdept(){        
        $id=$_GET['dept'];
        $dept=  $this->db->get_where('tb_departemen',array('id_dept'=>$id))->row_array();
        $data=  $this->db->get_where('tb_departemen',array('parent'=>$id))->result();
        echo "<option value=".$dept['id_dept'].">- ".strtoupper($dept['nama'])." -</option>";
        foreach ($data as $r){
            echo "<option value='$r->id_dept'>".  strtoupper($r->nama)."</option>";
        }
    }
   

    function add() {         
        $this->form_validation->set_message('is_unique', '<b>%s Sudah Terdaftar dalam database</b>');
        $this->form_validation->set_rules('nik', 'NIK Karyawan', 'trim|required|is_unique[tb_pengguna.nik]');     
        //$this->_set_rules();
        if ($this->form_validation->run() == true) {
            $data = array(
                'id_pengguna' => $this->m_pengguna->kdotomatis(),
                'nik' => $this->input->post('nik'),
                'nama_pengguna' => $this->input->post('pengguna'),
                'id_jabatan' => $this->input->post('jabatan'),
                'id_cabang' => $this->input->post('cabang'),
                'id_dept' => $this->input->post('subdept'),
                'createby' => $this->session->userdata('username'),
                'createdate' =>mdate('%Y-%m-%d %H:%i:%s', now()),
                'ruang_kantor' => $this->input->post('kantor')                
            );
            $this->m_pengguna->simpan($data);
            redirect('pengguna');
        } else {  
            $data['jabatan'] = $this->m_pengguna->getjabatan()->result(); 
            $data['cabang'] = $this->m_pengguna->getcabang()->result();
            $data['departemen'] = $this->m_pengguna->getdepartemengid()->result();             
            $this->template->display('pengguna/tambah', $data);
        }
    }

    function addjabatan() { 
        $this->form_validation->set_message('is_unique', '%s Sudah Ada');
        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'trim|required|is_unique[tb_jabatan.nama_jabatan]');
        if ($this->form_validation->run() == true) {
            $data = array(
                'nama_jabatan' => $this->input->post('nama_jabatan')               
            );
            $this->m_pengguna->simpanjab($data);
            redirect('pengguna/add');
        } else {       
            $this->template->display('pengguna/jabatan');
        }
    }
	
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array(                
                'nik' => $this->input->post('nik'),
                'nama_pengguna' => $this->input->post('pengguna'),
                'id_jabatan' => $this->input->post('jabatan'),
                'id_cabang' => $this->input->post('cabang'),
                'id_dept' => $this->input->post('subdept'),
                'ruang_kantor' => $this->input->post('kantor'));
                $kode=$this->input->post('kode');
                $this->m_pengguna->edit($kode,$data);
                redirect('pengguna');                
            }else {
                $id = $this->input->post('kode');
                $data['jabatan'] = $this->m_pengguna->getjabatan()->result(); 
                $data['cabang'] = $this->m_pengguna->getcabang()->result();                                                      
                $data['record'] = $this->m_pengguna->getpengguna($id)->row_array();
            } 
           }else{ 
                $id = $this->uri->segment(3);               
                $data['jabatan'] = $this->m_pengguna->getjabatan()->result();  
                $data['cabang'] = $this->m_pengguna->getcabang()->result();                                        
                $data['record'] = $this->m_pengguna->getpengguna($id)->row_array();
                $this->template->display('pengguna/edit', $data);
            }
    }
    function delete($kode) {
        $this->m_pengguna->hapus($kode);
		redirect('pengguna');
    }

    function _set_rules() {
        $this->form_validation->set_rules('pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('cabang', 'cabang', 'required');
        $this->form_validation->set_rules('subdept', 'Sub. Departemen', 'required');
       
    }

}
