<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Web extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_web','m_maintenance'));
    }

    function index(){
        //$this->db->limit(4,0);
        $data['group']=$this->db->get('tb_group',4,0)->result();
        $data['group2']=$this->db->get('tb_group',4,4)->result();
        $this->load->view('web/index',$data);
    }
    
    function ticket($id) {
        $sess_data['group_id'] = $id;
        $this->session->set_userdata($sess_data);
        if(!empty($this->session->userdata('group_id'))){
            // view ticket open
            $config['base_url'] = base_url().'web/ticket/'.$id.'/';
            $config['total_rows'] = $this->m_web->ticket_num_rows($id);
            $config['per_page'] = $per_page=5;
             //config for bootstrap pagination class integration
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            //inisialisasi config
            $this->pagination->initialize($config);
            //buat pagination
            $data['paging'] = $this->pagination->create_links();
            $page= ($this->uri->segment(4))? $this->uri->segment(4):0;
            $data['group'] =$this->db->get_where('tb_group',array('gid'=>$id))->result();
            $data['type'] =$this->db->get('tb_kategori')->result(); 
            $data['inventory'] =$this->db->get('tb_inv_komputer')->result();
            $data['ticket']=$this->m_web->list_ticket($per_page,$page); 
            $data['ticketclose']=$this->m_web->list_ticket_close($id); 
            $data['ticketprogress']=$this->m_web->list_ticket_progress($id);
            //tamplikan data        
            $this->load->view('web/ticket',$data);
        }else{
            redirect('web');
        }

    }

    function openticket($kode){
    	$data['detail']= $this->m_web->view_detail($kode);
    	$this->load->view('web/ticketopen',$data);
    }

    function addcomment(){
    	$this->form_validation->set_rules('catatan', 'Comment', 'required');       
        if ($this->form_validation->run() == true) { 
        	$kode=$this->input->post('kode');
            $detail=array(
            	'no_permohonan' => $kode,
                'tgl_proses' =>date('Y-m-d H:i:s'),  
                'catatan' => $this->input->post('catatan'),
                'user' => "Guest",
             );
            $this->m_web->simpan_detail($detail);
            redirect('web/openticket/'.$kode);
        } else {  
            redirect('web/index');
        }
    }
	
	function addticket() {              
        $this->_set_rules();        
        if ($this->form_validation->run() == true) {    
            $id=$this->input->post('group');       
            $data = array(
                'no_permohonan' => $this->m_maintenance->kdotomatis($id),
                'tgl_permohonan' =>date('Y-m-d H:i:s'),              
                'nama_kategori' => $this->input->post('kategori'),
                'nama_pemohon' => $this->input->post('pemohon'),
                'no_inventaris' => $this->input->post('inventaris'),
                'catatan_pemohon' => $this->input->post('catatan'),
                'biaya' =>('0'),
                'createddate' =>date('Y-m-d H:i:s'),
                'gid' => $this->input->post('group')
            );
            $detail=array(
            	'no_permohonan' => $this->m_maintenance->kdotomatis($id),
                'tgl_proses' =>date('Y-m-d H:i:s'),  
                'catatan' => $this->input->post('catatan'),
                'user' => $this->input->post('pemohon'),
             );            
            $this->m_web->simpan($data);
            $this->m_web->simpan_detail($detail);
            redirect('web/ticket/'.$id);
        } else {  
            redirect('web');
        }
    }

    function kategori(){
    	$inv=  $this->db->get('tb_kategori')->result();
            echo "<option value='' selected='selected'>- Select Kategori -</option>";        
            foreach ($inv as $r){
                echo "<option value='$r->nama_kategori'>".  strtoupper($r->nama_kategori)."</option>";
            } 
    }

    function tampil_inv(){        
        $id=$_GET['kategori'];
        $gid=$_GET['group'];
        if ($id=='Laptop'){
            $inv=  $this->db->query("SELECT tb_inv_laptop.id_laptop,tb_inv_laptop.kode_laptop,tb_inv_laptop.id_pengguna,tb_inv_laptop.gid,tb_pengguna.nama_pengguna,tb_inv_laptop.aset_hrd FROM tb_inv_laptop, tb_pengguna WHERE tb_pengguna.id_pengguna = tb_inv_laptop.id_pengguna  AND tb_inv_laptop.gid=$gid")->result();
            echo "<option value='' selected='selected'>- Select No. Inventory -</option>";        
            foreach ($inv as $r){
                echo "<option value='$r->kode_laptop'>".strtoupper($r->aset_hrd),' - '.strtoupper($r->kode_laptop),' - '.strtoupper($r->nama_pengguna)."</option>";
            } 
        }else if($id=='Komputer'){
            $inv=  $this->db->query("SELECT tb_inv_komputer.id_komputer,tb_inv_komputer.kode_komputer,tb_inv_komputer.gid,tb_inv_komputer.id_pengguna,tb_pengguna.nama_pengguna,tb_inv_komputer.aset_hrd FROM tb_pengguna INNER JOIN tb_inv_komputer ON tb_pengguna.id_pengguna = tb_inv_komputer.id_pengguna WHERE tb_inv_komputer.gid=$gid")->result();
            echo "<option value='' selected='selected'>- Select No. Inventory -</option>";         
            foreach ($inv as $r){
                echo "<option value='$r->kode_komputer'>".strtoupper($r->aset_hrd),' - '.strtoupper($r->kode_komputer),' - '.strtoupper($r->nama_pengguna)."</option>";
            } 
        }else if($id=='Printer'){
            $inv=  $this->db->query("SELECT tb_inv_printer.id_printer, tb_inv_printer.kode_printer,tb_inv_printer.id_pengguna,tb_inv_printer.gid,tb_pengguna.nama_pengguna,tb_inv_printer.aset_hrd FROM tb_pengguna INNER JOIN tb_inv_printer ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna WHERE tb_inv_printer.gid=$gid")->result();
            echo "<option value='' selected='selected'>- Select No. Inventory -</option>";        
            foreach ($inv as $r){
                echo "<option value='$r->kode_printer'>".strtoupper($r->aset_hrd),' - '.strtoupper($r->kode_printer),' - '.strtoupper($r->nama_pengguna)."</option>";
            } 
        }else if($id=='Monitor'){
            $inv=  $this->db->query("SELECT tb_inv_monitor.id_monitor,tb_inv_monitor.kode_monitor,tb_inv_monitor.id_pengguna,tb_inv_monitor.gid,tb_pengguna.nama_pengguna,tb_inv_monitor.aset_hrd FROM tb_pengguna INNER JOIN tb_inv_monitor ON tb_pengguna.id_pengguna = tb_inv_monitor.id_pengguna WHERE tb_inv_monitor.gid=$gid")->result();
            echo "<option value='' selected='selected'>- Select No. Inventory -</option>";        
            foreach ($inv as $r){
                echo "<option value='$r->kode_monitor'>".strtoupper($r->aset_hrd),' - '.  strtoupper($r->kode_monitor),' - '.strtoupper($r->nama_pengguna)."</option>";
            } 
        }else{
            $inv=  $this->db->get_where('tb_inv_network',array('gid'=>$gid))->result();
            echo "<option value='' selected='selected'>- Select No. Inventory -</option>";        
            foreach ($inv as $r){
                echo "<option value='$r->kode_network'>".strtoupper($r->aset_hrd),' - '.  strtoupper($r->kode_network),' - '.strtoupper($r->spesifikasi)."</option>";
            } 
        }        
    } 
    
    function _set_rules() {
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('inventaris', 'No Inventaris', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required'); 
        $this->form_validation->set_rules('pemohon', 'Nama Pemohon', 'required');  
        $this->form_validation->set_rules('group', 'Group', 'required');         
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissable'>", "</div>");
    }

}
