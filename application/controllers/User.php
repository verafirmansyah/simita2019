<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model(array('m_user'));   
        chek_administrator();
    }
    
    function index() {       
        $data['record']=  $this->db->get('tb_user')->result();
        $this->template->display('user/view',$data);
    }
    
    function add() {
        if(isset($_POST['submit'])) {
            $this->form_validation->set_message('is_unique', '%s Sudah Ada');
            $this->form_validation->set_rules('u_name', 'Username', 'trim|required|is_unique[tb_user.username]');
            $this->form_validation->set_rules('passwd', 'Password', 'required');
            $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
            $this->form_validation->set_rules('level', 'Level Pengguna', 'required'); 
            $this->form_validation->set_rules('group', 'User Group', 'required');  
            if ($this->form_validation->run() == true) {
                $paswd = $this->input->post('passwd');
                $data   =   array(  'username'      =>  $_POST['u_name'],
                                    'nama_user'     =>  $_POST['nama'],
                                    'password'      =>  SHA1($paswd . $this->config->item('key_login')),
                                    'gid'           =>  $_POST['group'],
                                    'last_login'    =>  date('Y-m-d h:i:s'),
                                    'role'          =>  $_POST['level']);
                $this->db->insert('tb_user',$data);
                redirect('user');
            } else{
                $data['record']=$this->db->get_where('tb_group')->result();            
                $this->template->display('user/tambah',$data);
            }
            
        }else {
            $data['record']=$this->db->get_where('tb_group')->result();            
            $this->template->display('user/tambah',$data);
        }
    }
    
    function edit()   {
        if(isset($_POST['submit'])) {            
            $this->form_validation->set_rules('passwd', 'Password', 'required');
            $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
            $this->form_validation->set_rules('level', 'Level Pengguna', 'required'); 
            $this->form_validation->set_rules('group', 'User Group', 'required');
            $id= $_POST['id'];  
            if ($this->form_validation->run() == true) {
                $paswd = $this->input->post('passwd');
                $data   =   array(  'nama_user'     =>  $_POST['nama'],
                                    'password'      =>  SHA1($paswd . $this->config->item('key_login')),
                                    'gid'           =>  $_POST['group'],
                                    'role'          =>  $_POST['level']);
                $this->db->where('id_user',$id);
                $this->db->update('tb_user',$data);
                redirect('user');
            } else{                
                $data['record']=  $this->db->get_where('tb_user',array('id_user'=> $id))->row_array();
                $data['group']=  $this->db->get('tb_group')->result();
                $data['katmenu']=$this->db->get_where('tb_menu', array('parent' =>0))->result(); 
                $this->template->display('user/edit',$data);
            }
        }
        else {
            $id= $this->uri->segment(3);
            $data['record']=  $this->db->get_where('tb_user',array('id_user'=> $id))->row_array();
            $data['group']=  $this->db->get('tb_group')->result();
            $data['katmenu']=$this->db->get_where('tb_menu', array('parent' =>0))->result(); 
            $this->template->display('user/edit',$data);
        }
    }

    function delete($id){
        $this->db->where('id_user',$id);
        $this->db->delete('tb_user');
        redirect('user');
    }
}