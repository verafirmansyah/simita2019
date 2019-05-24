<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tb_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tb_user_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $tb_user = $this->Tb_user_model->get_all();

        $data = array(
            'tb_user_data' => $tb_user
        );

        $this->load->view('tb_user_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tb_user_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_user' => $row->id_user,
		'nama_user' => $row->nama_user,
		'username' => $row->username,
		'password' => $row->password,
		'role' => $row->role,
		'last_login' => $row->last_login,
		'gid' => $row->gid,
	    );
            $this->load->view('tb_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tb_user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tb_user/create_action'),
	    'id_user' => set_value('id_user'),
	    'nama_user' => set_value('nama_user'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'role' => set_value('role'),
	    'last_login' => set_value('last_login'),
	    'gid' => set_value('gid'),
	);
        $this->load->view('tb_user_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_user' => $this->input->post('nama_user',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'role' => $this->input->post('role',TRUE),
		'last_login' => $this->input->post('last_login',TRUE),
		'gid' => $this->input->post('gid',TRUE),
	    );

            $this->Tb_user_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tb_user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tb_user_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tb_user/update_action'),
		'id_user' => set_value('id_user', $row->id_user),
		'nama_user' => set_value('nama_user', $row->nama_user),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'role' => set_value('role', $row->role),
		'last_login' => set_value('last_login', $row->last_login),
		'gid' => set_value('gid', $row->gid),
	    );
            $this->load->view('tb_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tb_user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_user', TRUE));
        } else {
            $data = array(
		'nama_user' => $this->input->post('nama_user',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'role' => $this->input->post('role',TRUE),
		'last_login' => $this->input->post('last_login',TRUE),
		'gid' => $this->input->post('gid',TRUE),
	    );

            $this->Tb_user_model->update($this->input->post('id_user', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tb_user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tb_user_model->get_by_id($id);

        if ($row) {
            $this->Tb_user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tb_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tb_user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_user', 'nama user', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('role', 'role', 'trim|required');
	$this->form_validation->set_rules('last_login', 'last login', 'trim|required');
	$this->form_validation->set_rules('gid', 'gid', 'trim|required');

	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_user.xls";
        $judul = "tb_user";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama User");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Role");
	xlsWriteLabel($tablehead, $kolomhead++, "Last Login");
	xlsWriteLabel($tablehead, $kolomhead++, "Gid");

	foreach ($this->Tb_user_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_user);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->role);
	    xlsWriteLabel($tablebody, $kolombody++, $data->last_login);
	    xlsWriteNumber($tablebody, $kolombody++, $data->gid);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Tb_user.php */
/* Location: ./application/controllers/Tb_user.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-05-11 13:45:11 */
/* http://harviacode.com */