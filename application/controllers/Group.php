<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Group extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_group');
        $this->load->library('form_validation');
        chek_session();
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'group/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'group/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'group/index.html';
            $config['first_url'] = base_url() . 'group/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_group->total_rows($q);
        $group = $this->M_group->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'group_data' => $group,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->display('group/tb_group_list', $data);
    }

    public function read($id) 
    {
        $row = $this->M_group->get_by_id($id);
        if ($row) {
            $data = array(
		'gid' => $row->gid,
		'nama_group' => $row->nama_group,
		'nama_alias' => $row->nama_alias,
		'alamat' => $row->alamat,
		'logo' => $row->logo,
		'logo_dashboard' => $row->logo_dashboard,
	    );
            $this->template->display('group/tb_group_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('group'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('group/create_action'),
	    'gid' => set_value('gid'),
	    'nama_group' => set_value('nama_group'),
	    'nama_alias' => set_value('nama_alias'),
	    'alamat' => set_value('alamat'),
	    'logo' => set_value('logo'),
	    'logo_dashboard' => set_value('logo_dashboard'),
	);
        $this->template->display('group/tb_group_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_group' => $this->input->post('nama_group',TRUE),
		'nama_alias' => $this->input->post('nama_alias',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'logo' => $this->input->post('logo',TRUE),
		'logo_dashboard' => $this->input->post('logo_dashboard',TRUE),
	    );

            $this->M_group->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('group'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_group->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('group/update_action'),
		'gid' => set_value('gid', $row->gid),
		'nama_group' => set_value('nama_group', $row->nama_group),
		'nama_alias' => set_value('nama_alias', $row->nama_alias),
		'alamat' => set_value('alamat', $row->alamat),
		'logo' => set_value('logo', $row->logo),
		'logo_dashboard' => set_value('logo_dashboard', $row->logo_dashboard),
	    );
            $this->template->display('group/tb_group_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('group'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('gid', TRUE));
        } else {
            $data = array(
		'nama_group' => $this->input->post('nama_group',TRUE),
		'nama_alias' => $this->input->post('nama_alias',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'logo' => $this->input->post('logo',TRUE),
		'logo_dashboard' => $this->input->post('logo_dashboard',TRUE),
	    );

            $this->M_group->update($this->input->post('gid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('group'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_group->get_by_id($id);

        if ($row) {
            $this->M_group->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('group'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('group'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_group', 'nama group', 'trim|required');
	$this->form_validation->set_rules('nama_alias', 'nama alias', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('logo', 'logo', 'trim|required');
	$this->form_validation->set_rules('logo_dashboard', 'logo dashboard', 'trim|required');

	$this->form_validation->set_rules('gid', 'gid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Group.php */
/* Location: ./application/controllers/Group.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-20 11:05:56 */
/* http://harviacode.com */