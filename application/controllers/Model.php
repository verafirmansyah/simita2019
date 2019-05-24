<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_model');
        chek_session();
    }
    public function index() {
        $data['record'] = $this->m_model->semua()->result(); 
        $this->template->display('model/view', $data);       
    }       
   
    public function view_data() {
        $criteria = $this->m_model->list_model();
        $no = 1;
        foreach ($criteria->result_array() as $data) {
            $row[] = array(
                'no' => $no++,
                'nama_manufacture' => $data['nama_manufacture'],
                'tipe' =>$data['tipe'],
                'edit' => '<center><a href="' . base_url() . 'model/edit/' . $data['id_tipe'] .'"><i class="glyphicon glyphicon-edit"></i></a></center>',
                'delete' => '<center><a href="' . base_url() . 'model/hapus/' . $data['id_tipe'] .'" class="hapus" ><i class="glyphicon glyphicon-trash"></i></a></center>'
            );
        }
        //$result=array_merge($result,array('rows'=>$row));
        $result = array('aaData' => $row);
        echo json_encode($result);
    }

    function add() {                
        $this->_set_rules();
        if ($this->form_validation->run() == true) {
            $data = array(
                'id_manufacture' => $this->input->post('id_manufacture'),
                'nama_tipe' => $this->input->post('nama_tipe')
            );
            $this->m_model->simpan($data);
            redirect('model');
        } else {    
            $data['manufacture'] = $this->m_model->getmanufacture()->result();        
            $this->template->display('model/tambah');
        }
    }
    
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array(                            
                    'id_manufacture' => $this->input->post('id_manufacture'),
                    'nama_tipe' => $this->input->post('nama_tipe')
                        );
                $kode=$this->input->post('id');
                $this->m_model>edit($kode,$data);
                redirect('model');                
            }else {
                $id = $this->input->post('id');                                     
                $data['record'] = $this->m_model->getkode($id)->row_array();
                $this->template->display('model/edit', $data); 
            } 
           }else{ 
                $id = $this->uri->segment(3);
                $data['record'] = $this->m_model->getkode($id)->row_array();
                $this->template->display('model/edit', $data);
            }
    }
    function hapus($id_tipe) {
        $this->m_model->hapus($id_tipe);
        redirect('model');
    }

    function _set_rules() {
        $this->form_validation->set_rules('id_manufacture', 'Manufacture', 'required');

        
    }

}