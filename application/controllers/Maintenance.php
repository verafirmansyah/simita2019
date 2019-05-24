<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Maintenance extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_maintenance','m_supplier','m_barang','m_komputer','m_masuk','m_laptop','m_monitor','m_printer','m_network'));
        chek_session();
    }
	public function index() {
        //$data['record'] = $this->m_barang->listBarang()->result(); 
        $this->template->display('maintenance/view');     
    }		
   
    public function view_data() {  
        if ($this->session->userdata('role')=='Administrator'){     
        $ambildata=$this->m_maintenance->listid()->result();    
        }else{      
            redirect('dashboard');
        }     
        $no=1;
        foreach($ambildata as $r) { 
            if ($r->status =="OPEN"){
                $status="<span class='label label-danger'>" . $r->status. "</span>";
            }elseif($r->status =="CLOSED") {
                $status="<span class='label label-success'>" .$r->status."</span>";
            }elseif($r->status =="PROCESS") {
                $status="<span class='label label-info'>" .$r->status."</span>";
            }else{
                 $status="<span class='label label-warning'>" .$r->status."</span>";
            }  
            $query[] = array(
                'no'=>$no++,
                'no_permohonan'=>$r->no_permohonan,
                'tgl_permohonan'=>tgl_lengkap($r->tgl_permohonan),                
                'tgl_selesai'=>$r->tgl_selesai,  
                'jenis_permohonan'=>$r->jenis_permohonan, 
                'aset_hrd'=>$r->aset_hrd,
                'nama_kategori'=>$r->nama_kategori, 
                'no_inventaris'=>$r->no_inventaris,
                'catatan_pemohon'=>$r->catatan_pemohon,
                'status'=>'<center>'.$status.'</center>',          
                'view'=>anchor('maintenance/detail/' . $r->no_permohonan, '<i class="btn btn-info btn-sm fa fa-eye" data-toggle="tooltip" title="View Detail"></i>'),
                'cetak'=>'<a href="'.base_url('maintenance/cetak/'.$r->no_permohonan).'" target="_blank" ><i class="btn btn-info btn-sm fa fa-print" data-toggle="tooltip" title="Print"></i>',
                
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }

    function tampil_inv(){        
        $id=$_GET['kategori'];
        $gid=$this->session->userdata('gid');
        if ($id=='Laptop'){
            $inv=  $this->db->get_where('tb_inv_laptop',array('gid'=>$gid))->result();
            echo "<option value='' selected='selected'>- Select No. Inventory -</option>";        
            foreach ($inv as $r){
                $pengguna=$this->db->get_where('tb_pengguna',array('id_pengguna'=>$r->id_pengguna))->row_array();
                echo "<option value='$r->kode_laptop'>". strtoupper($pengguna['nama_pengguna']),' - ('.strtoupper($r->kode_laptop),')'."</option>";
            } 
        }else if($id=='Komputer'){
            $inv=  $this->db->get_where('tb_inv_komputer',array('gid'=>$gid))->result();
            echo "<option value='' selected='selected'>- Select No. Inventory -</option>";         
            foreach ($inv as $r){
                $pengguna=$this->db->get_where('tb_pengguna',array('id_pengguna'=>$r->id_pengguna))->row_array();
                echo "<option value='$r->kode_komputer'>". strtoupper($pengguna['nama_pengguna']),' - ('.strtoupper($r->kode_komputer),')'."</option>";
            } 
        }else if($id=='Printer'){
            $inv=  $this->db->get_where('tb_inv_printer',array('gid'=>$gid))->result();
            echo "<option value='' selected='selected'>- Select No. Inventory -</option>";        
            foreach ($inv as $r){
                $pengguna=$this->db->get_where('tb_pengguna',array('id_pengguna'=>$r->id_pengguna))->row_array();
                echo "<option value='$r->kode_printer'>". strtoupper($pengguna['nama_pengguna']),' - ('.strtoupper($r->kode_printer),') '."</option>";
            } 
        }else if($id=='Monitor'){
            $inv=  $this->db->get_where('tb_inv_monitor',array('gid'=>$gid))->result();
            echo "<option value='' selected='selected'>- Select No. Inventory -</option>";        
            foreach ($inv as $r){
                $pengguna=$this->db->get_where('tb_pengguna',array('id_pengguna'=>$r->id_pengguna))->row_array();
                echo "<option value='$r->kode_monitor'>". strtoupper($pengguna['nama_pengguna']),' - ('.strtoupper($r->kode_monitor),') '."</option>";
            } 
        }else{
            $inv=  $this->db->get_where('tb_inv_network',array('gid'=>$gid))->result();
            echo "<option value='' selected='selected'>- Select No. Inventory -</option>";        
            foreach ($inv as $r){
                $pengguna=$this->db->get_where('tb_pengguna',array('id_pengguna'=>$r->id_pengguna))->row_array();
                echo "<option value='$r->kode_network'>". strtoupper($pengguna['nama_pengguna']),' - ('.strtoupper($r->kode_network),') '."</option>";
            } 
        }
        
    } 

    function cetak($id) {
        $maintenance = $this->m_maintenance->getall($id)->row_array();
        if($maintenance['nama_kategori']=='Laptop'){
            $inv=$this->m_laptop->get_inv($maintenance['no_inventaris'])->row_array();
            $inv=$this->m_laptop->get_inv($maintenance['aset_hrd'])->row_array();
        }elseif ($maintenance['nama_kategori']=='Komputer') {
            $inv=$this->m_komputer->get_inv($maintenance['no_inventaris'])->row_array();
        }elseif ($maintenance['nama_kategori']=='Monitor') {
            $inv=$this->m_monitor->get_inv($maintenance['no_inventaris'])->row_array();
        }elseif ($maintenance['nama_kategori']=='Printer') {
            $inv=$this->m_printer->get_inv($maintenance['no_inventaris'])->row_array();
        }elseif ($maintenance['nama_kategori']=='Network') {
            $inv=$this->m_network->get_inv($maintenance['no_inventaris'])->row_array();
        }
        $data['inv']=$inv;
        $data['recordall'] = $this->m_maintenance->getall($id)->row_array();
        $data['record'] = $this->m_supplier->semua()->result();     
        $this->load->view('maintenance/cetak',$data); 
    }
    
    function add() {              
        $this->_set_rules();        
        if ($this->form_validation->run() == true) {
            $supplier=$this->input->post('supplier');
            $id=$this->session->userdata('gid');
            $data = array(
                'no_permohonan' => $this->m_maintenance->kdotomatis($id),
                'tgl_permohonan' => $this->input->post('tgl_permohonan'),
                'tgl_selesai' => $this->input->post('tgl_selesai'),
                'jenis_permohonan' => $this->input->post('type'),                
                'nama_kategori' => $this->input->post('kategori'),
                'no_inventaris' => $this->input->post('inventaris'),
                'aset_hrd' => $this->input->post('aset_hrd'),
                'catatan_pemohon' => $this->input->post('catatan'),
                'catatan_perbaikan' => $this->input->post('catatan_perbaikan'),
                'nama_supplier' => $supplier,
                'status' => 'PROCESS',
                'biaya' => $this->input->post('biaya'),
                'gid' => $this->session->userdata('gid')
            );
            $detail=array(
                'no_permohonan' => $this->m_maintenance->kdotomatis($id),
                'tgl_proses' =>$this->input->post('tgl_permohonan'),  
                'catatan' => $this->input->post('catatan'),
                'user' => "User",
             );
            $no_inv=$this->input->post('inventaris');
            $kategori=$this->input->post('kategori');
            $this->m_maintenance->update_inv($kategori,$no_inv);
            $this->m_maintenance->simpan($data);
            $this->m_maintenance->simpan_detail($detail);
            redirect('maintenance');
        } else {  
            $data['kategori'] = $this->m_barang->getKategori()->result(); 
            $data['supplier'] = $this->m_masuk->getsupplier()->result();             
            $this->template->display('maintenance/tambah',$data);
        }
    }
	
	function chat_simpan(){
    	$this->form_validation->set_rules('catatan', 'Comment', 'required');       
        if ($this->form_validation->run() == true) { 
        	$kode=$this->input->post('kode');
            $detail=array(
            	'no_permohonan' => $kode,
                'tgl_proses' =>date('Y-m-d H:i:s'),  
                'catatan' => $this->input->post('catatan'),
                'user' => "Admin",
             );
            $this->m_maintenance->simpan_detail($detail);
            redirect('maintenance/detail/'.$kode);
        } else {  
            redirect('maintenance');
        }
    }

	function detail() { 
        $id = $this->uri->segment(3); 
        $maintenance = $this->m_maintenance->getall($id)->row_array();
        if($maintenance['nama_kategori']=='Laptop'){
            $inv=$this->m_laptop->get_inv($maintenance['no_inventaris'])->row_array();
        }elseif ($maintenance['nama_kategori']=='Komputer') {
            $inv=$this->m_komputer->get_inv($maintenance['no_inventaris'])->row_array();
        }elseif ($maintenance['nama_kategori']=='Monitor') {
            $inv=$this->m_monitor->get_inv($maintenance['no_inventaris'])->row_array();
        }elseif ($maintenance['nama_kategori']=='Printer') {
            $inv=$this->m_printer->get_inv($maintenance['no_inventaris'])->row_array();
        }elseif ($maintenance['nama_kategori']=='Network') {
            $inv=$this->m_network->get_inv($maintenance['no_inventaris'])->row_array();
        }elseif ($maintenance['tgl_garansi']=='Garansi') {
            $inv=$this->m_laptop->get_inv($maintenance['tgl_garansi'])->row_array();
        }
        $data['inv']=$inv;                                         
        $data['recordall'] = $this->m_maintenance->getall($id)->row_array();
        $data['record'] = $this->m_supplier->semua()->result();
		$data['detail'] = $this->m_maintenance->detail($id);
        $this->template->display('maintenance/detail', $data);            
    }

    function update() {  
        $data = array(                
                'tgl_selesai' => $this->input->post('tgl_selesai'),
                'tgl_estimasi'=>tgl_indo($r->tgl_estimasi),
                'jenis_permohonan' => $this->input->post('type'), 
                'catatan_pemohon' => $this->input->post('catatan'),
                'catatan_perbaikan' => $this->input->post('catatan_perbaikan'),
                'nama_supplier' => $this->input->post('supplier'),
                'biaya' => $this->input->post('biaya'),
                'status' => $this->input->post('status')
        );
        $kategori=$this->input->post('kategori');
        $no_inv=$this->input->post('no_inv');
        $kode=$this->input->post('no_permohonan');
        $status=$this->input->post('status');
        $this->m_maintenance->update($kode,$data);
        if($status=='CLOSED'){
            $this->m_maintenance->update_status($kategori,$no_inv);
        }
        // Tambahan untuk memunculkan notifikasi
        $this->session->set_flashdata('msg', 
                '<div class="alert alert-success">
                    <h4>Sukses </h4>
                    <p>Data Maintenance Berhasil disimpan</p>
                </div>');
        // Akhir Notifikasi
        redirect('maintenance/detail/'.$kode);   
    }
    
    function _set_rules() {
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('inventaris', 'No Inventaris', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');
        $this->form_validation->set_rules('tgl_permohonan', 'Tgl. Permohonan', 'required');
        $this->form_validation->set_rules('type', 'Maintenance Type', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissable'>", "</div>");
    }

}
