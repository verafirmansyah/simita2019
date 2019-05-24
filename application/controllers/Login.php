<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function index() {
        $this->load->view('user/login');
 
    }

    function auth() {  
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $keylogin = $this->config->item('key_login');
            $hasil    = $this->db->get_where('tb_user',array('username'=>$username,'password'=>sha1($password.$keylogin)));
            if ($hasil->num_rows()> 0) {
                $row= $hasil->row_array();
                $group=$this->db->get_where('tb_group',array('gid'=>$row['gid']))->row_array();
                $data = array('nama' =>$row['nama_user'] ,
                                'username'=>$username ,
                                'gid'=>$row['gid'],
                                'role'=>$row['role'],
                                'last_login'=>$row['last_login'],
                                'group'=>$group['nama_group'],
                                'status_login'=>'login_diterima',
                        );
                $this->session->set_userdata($data);
                $this->db->where('username',$username);
                $this->db->update('tb_user',array('last_login'=>date('Y-m-d H:i:s')));
                
                redirect('dashboard');   
            }else{
                $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
                redirect('login');
            }                
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('web');
    }
}
