<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Manufacture extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_manufacture');
        chek_session();
    }
    public function index() {
        $data['record'] = $this->m_manufacture->semua()->result(); 
        $this->template->display('manufacture/view', $data);       
    }       
   
    public function view_data() {
        $criteria = $this->m_manufacture->list_manufacture();
        $no = 1;
        foreach ($criteria->result_array() as $data) {
            $row[] = array(
                'no' => $no++,
                'id_manufacture' => $data['id_manufacture'],
                'jenis' => $data['jenis'],
                'nama_manufacture' =>$data['nama_manufacture'],
                'edit' => '<center><a href="' . base_url() . 'manufacture/edit/' . $data['id_manufacture'] .'"><i class="glyphicon glyphicon-edit"></i></a></center>',
                'delete' => '<center><a href="' . base_url() . 'manufacture/hapus/' . $data['id_manufacture'] .'" class="hapus" ><i class="glyphicon glyphicon-trash"></i></a></center>'
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
                'nama_manufacture' => $this->input->post('nama_manufacture'),
                'jenis' => $this->input->post('jenis'),
            );
            $this->m_manufacture->simpan($data);
            redirect('manufacture');
        } else {         
            $this->template->display('manufacture/tambah');
            
        }
    }
    
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array(                            
                    'nama_manufacture' => $this->input->post('nama_manufacture'),
                    'jenis' => $this->input->post('jenis'),
                        );
                $kode=$this->input->post('id');
                $this->m_manufacture>edit($kode,$data);
                redirect('manufacture');                
            }else {
                $id = $this->input->post('id');                                     
                $data['record'] = $this->m_manufacture->getkode($id)->row_array();
                $this->template->display('manufacture/edit', $data); 
            } 
           }else{ 
                $id = $this->uri->segment(3);
                $data['record'] = $this->m_manufacture->getkode($id)->row_array();
                $this->template->display('manufacture/edit', $data);
            }
    }
    function hapus($id_manufacture) {
        $this->m_manufacture->hapus($id_manufacture);
        redirect('manufacture');
    }

    function _set_rules() {
        $this->form_validation->set_rules('nama_manufacture', 'Nama Cabang', 'required');

        
    }

}