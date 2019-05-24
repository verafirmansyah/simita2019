<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_user');
        chek_session();
    }
    
    function index() {
        $data['title'] = "Home";
		$gid=$this->session->userdata('gid');
        $data['group'] = $this->db->get_where('tb_group',array('gid'=>$gid))->row_array();
        $data['tiket_open'] = $this->db->get_where('tb_maintenance',array('status'=>'OPEN'))->num_rows();
        $data['tiket_process'] = $this->db->get_where('tb_maintenance',array('status'=>'PROCESS'))->num_rows();
        $data['tiket_close'] = $this->db->get_where('tb_maintenance',array('status'=>'CLOSED'))->num_rows();
        $data['tiket_pending'] = $this->db->get_where('tb_maintenance',array('status'=>'PENDING'))->num_rows();
        $this->template->display('dashboard/index', $data);
    }

    function petugas() {
        $data['title'] = "Data Petugas";
        $data['petugas'] = $this->m_petugas->semua()->result();
        if ($this->uri->segment(3) == "delete_success")
            $data['message'] = "<div class='alert alert-success'>Data berhasil dihapus</div>";
        else if ($this->uri->segment(3) == "add_success")
            $data['message'] = "<div class='alert alert-success'>Data Berhasil disimpan</div>";
        else
            $data['message'] = '';
        $this->template->display('dashboard/petugas', $data);
    }

    function tambahpetugas() {
        $data['title'] = "Tambah Petugas";
        $this->_set_rules();
        if ($this->form_validation->run() == true) {
            $user = $this->input->post('user');
            $cek = $this->m_petugas->cekKode($user);
            if ($cek->num_rows() > 0) {
                $data['message'] = "<div class='alert alert-danger'>Username sudah digunakan</div>";
                $this->template->display('dashboard/tambahpetugas', $data);
            } else {
                $info = array(
                    'user' => $this->input->post('user'),
                    'password' => md5($this->input->post('password'))
                );
                $this->m_petugas->simpan($info);
                redirect('dashboard/petugas/add_success');
            }
        } else {
            $data['message'] = "";
            $this->template->display('dashboard/tambahpetugas', $data);
        }
    }

    function edit($id) {
        $data['title'] = "Update data Petugas";
        $this->_set_rules();
        if ($this->form_validation->run() == true) {
            $id = $this->input->post('id');
            $info = array(
                'user' => $this->input->post('user'),
                'password' => md5($this->input->post('password'))
            );
            $this->m_petugas->update($id, $info);
            $data['petugas'] = $this->m_petugas->cekId($id)->row_array();
            $data['message'] = "<div class='alert alert-success'>Data Berhasil diupdate</div>";
            $this->template->display('dashboard/editpetugas', $data);
        } else {
            $data['message'] = "";
            $data['petugas'] = $this->m_petugas->cekId($id)->row_array();
            $this->template->display('dashboard/editpetugas', $data);
        }
    }

    function hapus() {
        $kode = $this->input->post('kode');
        $this->m_petugas->hapus($kode);
    }

    function _set_rules() {
        $this->form_validation->set_rules('user', 'username', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}
