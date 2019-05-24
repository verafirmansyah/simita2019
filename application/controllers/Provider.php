<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Provider extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_provider');
        chek_session();
    }
	public function index() {
        $data['record'] = $this->m_provider->semua()->result(); 
        $this->template->display('provider/view', $data);       
    }		
   
    public function view_data() {
        $criteria = $this->m_provider->listBarang();
        $no = 1;
        foreach ($criteria->result_array() as $data) {
            $row[] = array(
                'no' => $no++,
                'kd_barang' => $data['kd_barang'],
                'jenis' =>$data['kategori'],
                'b_nama' => $data['b_nama'],
                'merek' => $data['merek'],
                'spesifikasi' => $data['spesifikasi'],
                'satuan' => '<center>' . $data['satuan_nama'] . '</center>',
                'edit' => '<center><a href="' . base_url() . 'barang/edit/' . $data['kd_barang'] .'"><i class="glyphicon glyphicon-edit"></i></a></center>',
                'delete' => '<center><a href="' . base_url() . 'barang/hapus/' . $data['kd_barang'] .'" class="hapus" ><i class="glyphicon glyphicon-trash"></i></a></center>'
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
                'nama_provider' => $this->input->post('nama_provider'),
                'telpon_provider' => $this->input->post('telpon_provider'),
                'nama_sales' => $this->input->post('nama_sales'),
                'telpon_sales' => $this->input->post('telpon_sales'),
                'email_provider' => $this->input->post('email_provider'),
            );
            $this->m_provider->simpan($data);
            redirect('provider');
        } else {           
            $this->template->display('provider/tambah');
        }
    }
	
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array(                            
                        'nama_provider' => $this->input->post('nama_provider'),
                        'telpon_provider' => $this->input->post('telpon_provider'),
                        'nama_sales' => $this->input->post('nama_sales'),
                        'telpon_sales' => $this->input->post('telpon_sales'),
                        'email_provider'=> $this->input->post('email_provider'),
                        );
                $kode=$this->input->post('id');
                $this->m_provider->edit($kode,$data);
                redirect('provider');                
            }else {
                $id = $this->input->post('id');                                     
                $data['record'] = $this->m_provider->getkode($id)->row_array();
                $this->template->display('provider/edit', $data); 
            } 
           }else{ 
                $id = $this->uri->segment(3);
                $data['record'] = $this->m_provider->getkode($id)->row_array();
                $this->template->display('provider/edit', $data);
            }
    }
    function delete($id) {
        $this->m_provider->hapus($id);
		redirect('provider');
    }

    function _set_rules() {
        $this->form_validation->set_rules('nama_provider', 'Nama Provider', 'required');
        $this->form_validation->set_rules('telpon_provider', 'Nomor Telpon Provider', 'required');
        $this->form_validation->set_rules('nama_sales', 'Nama Sales', 'required');
        $this->form_validation->set_rules('telpon_sales', 'Nomor Telpon Sales', 'required');
        $this->form_validation->set_rules('email_provider', 'Nomor Telpon Sales', 'required');
        
    }

}
