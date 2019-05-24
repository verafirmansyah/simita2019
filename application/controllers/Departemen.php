<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Departemen extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_departemen');
        chek_session();
    }
	public function index() {
        $data['record'] = $this->m_departemen->treeview()->result(); 
        $this->template->display('departemen/view', $data);       
    }	 

    function add() {               
        $this->_set_rules();
        if ($this->form_validation->run() == true) {
            $data = array(
                'gid' => $this->input->post('gid'),
                'nama' => $this->input->post('nama'),
                'parent' => $this->input->post('parent')
            );
            $this->m_departemen->simpan($data);
            redirect('departemen');
        } else {
            $data['record']=$this->m_departemen->treeview()->result();
            $this->template->display('departemen/tambah',$data);
        }
    }
	
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array(
                    'gid' => $this->input->post('gid'),
                    'nama' => $this->input->post('nama'),
                    'parent' => $this->input->post('parent')
                );
                $kode=$this->input->post('id');
                $this->m_departemen->edit($kode,$data);
                redirect('departemen');          
            }else {
                $data['group'] = $this->m_departemen->treeview()->result();
                $data['record'] = $this->m_departemen->getkode($id)->row_array();
                $this->template->display('departemen/edit',$data);
            } 
           }else{ 
                $id = $this->uri->segment(3); 
                $data['group'] = $this->m_departemen->treeview()->result();
                $data['record'] = $this->m_departemen->getkode($id)->row_array();
                $this->template->display('departemen/edit', $data);
            }
    }
    function delete($kode) {
        $this->m_departemen->hapus($kode);
		redirect('departemen');
    }

    function _set_rules() {
        //$this->form_validation->set_rules('gid', 'Nama Group', 'required');
        $this->form_validation->set_rules('nama', 'Nama Departeman', 'required');
        $this->form_validation->set_rules('parent', 'Departemen', 'required');
    }

}
