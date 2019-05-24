<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cabang extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_cabang');
        chek_session();
    }
    public function index() {
        $data['record'] = $this->m_cabang->semua()->result(); 
        $this->template->display('cabang/view', $data);       
    }       
   
    public function view_data() {
        $criteria = $this->m_cabang->list_cabang();
        $no = 1;
        foreach ($criteria->result_array() as $data) {
            $row[] = array(
                'no' => $no++,
                'id_cabang' => $data['id_cabang'],
                'namacabang' =>$data['namacabang'],
                'wilayah' => $data['wilayah'],
                'edit' => '<center><a href="' . base_url() . 'cabang/edit/' . $data['id_cabang'] .'"><i class="glyphicon glyphicon-edit"></i></a></center>',
                'delete' => '<center><a href="' . base_url() . 'cabang/hapus/' . $data['id_cabang'] .'" class="hapus" ><i class="glyphicon glyphicon-trash"></i></a></center>'
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
                'namacabang' => $this->input->post('namacabang'),
                'wilayah' => $this->input->post('wilayah'),
            );
            $this->m_cabang->simpan($data);
            redirect('cabang');
        } else {          
            $data['wilayah'] = $this->m_cabang->getwilayah()->result();  
            $this->template->display('cabang/tambah');  
        }
    }
    
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array(                            
                    'namacabang' => $this->input->post('namacabang'),
                    'wilayah' => $this->input->post('wilayah'),
                        );
                $kode=$this->input->post('id');
                $this->m_cabang->edit($kode,$data);
                redirect('cabang');                
            }else {
                $id = $this->input->post('id');                                     
                $data['record'] = $this->m_cabang->getkode($id)->row_array();
                $this->template->display('cabang/edit', $data); 
            } 
           }else{ 
                $id = $this->uri->segment(3);
                $data['record'] = $this->m_cabang->getkode($id)->row_array();
                $this->template->display('cabang/edit', $data);
            }
    }
    function hapus($id_cabang) {
        $this->m_cabang->hapus($id_cabang);
        redirect('cabang');
    }

    function _set_rules() {
        $this->form_validation->set_rules('namacabang', 'Nama Cabang', 'required');
        $this->form_validation->set_rules('wilayah', 'Wilayah', 'required');
        
    }

}