<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Monitor extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_monitor','m_laptop','m_masuk','m_maintenance'));
        chek_session();
    }
	public function index() {
        //$data['record'] = $this->m_barang->listBarang()->result(); 
        $this->template->display('monitor/view');       
    }		
   
    function view_data(){        
        //$criteria = $this->db->query("SELECT * FROM tb_kecamatan ORDER BY kota_id ASC");
        if ($this->session->userdata('role')=='Administrator'){
            $ambildata=$this->m_monitor->semua()->result();
        }else{
            $ambildata=$this->m_monitor->semuagid()->result();
        }  
        $no=1;
        foreach($ambildata as $r) {  
        $dept=$this->db->get_where('tb_departemen',array('id_dept'=>$r->parent))->row_array();
            if($r->parent==0){
                    $deptnama=$r->nama;
            }else{
                    $deptnama=$dept['nama'];
            }
            if ($r->status =="DIGUNAKAN"){
                $status="<span class='label label-success'>" . $r->status. "</span>";
            }elseif($r->status =="SIAP DIGUNAKAN") {
                $status="<span class='label label-info'>" .$r->status."</span>";
            }elseif($r->status =="DIPERBAIKI") {
                $status="<span class='label label-warning'>" .$r->status."</span>";
            }else{
				$status="<span class='label label-warning'>" .$r->status."</span>";
			}      
            $query[] = array(
                'no'=>$no++,
                'kode_monitor'=>$r->kode_monitor,
                'nama_pengguna'=>$r->nama_pengguna, 
                'dept'=>$deptnama, 
                'subdept'=>$r->nama,         
                'tgl_inv'=>tgl_indo($r->tgl_inv),
                'jenis_monitor'=>$r->jenis_monitor, 
                'spesifikasi'=>$r->spesifikasi,                  
                'status'=>$status, 
                'edit'=>anchor('monitor/detail/' . $r->kode_monitor, '<i class="btn btn-info btn-sm fa fa-eye" data-toggle="tooltip" title="View Detail"></i>'),
                'delete'=>''.anchor('monitor/delete/' . $r->id_monitor, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")).'',                
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }   

    function add() {              
        $this->_set_rules(); 
        //$this->form_validation->set_message('is_unique', '%s Sudah Ada');
        //$this->form_validation->set_rules('no_inv', 'No. Inventaris', 'trim|required|is_unique[tb_inv_monitor.kode_monitor]');       
        if ($this->form_validation->run() == true) {
            $gid=$this->session->userdata('gid');           
            $data = array(
                'kode_monitor' => $this->m_monitor->kdotomatis(),
                'id_pengguna' => $this->input->post('pengguna'),
                'jenis_monitor' => $this->input->post('jenis'),
                'spesifikasi' => $this->input->post('spek'),               
                'tgl_inv' =>$this->input->post('tgl_inv'),
                'harga_beli' =>$this->input->post('harga'),
                'gid' => $gid
            );
            $data2=array(
                'no_inventaris' => $this->m_monitor->kdotomatis(),
				'id_pengguna_awal' => $this->input->post('pengguna'),
                'id_pengguna' => $this->input->post('pengguna'),
                'tgl_update'=>date('Y-m-d H:i:s'),
                'admin'=>$this->session->userdata('nama'),
                'note'=>'Inventory Baru',
                );
            $this->m_laptop->simpan_history($data2);
            $this->m_monitor->simpan($data);
            redirect('monitor');
        } else {  
            $data['pengguna'] = $this->m_monitor->getpengguna()->result();           
            $this->template->display('monitor/tambah',$data);
        }
    }	
    
    function update() {  
        $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array( 
                        'id_pengguna' => $this->input->post('pengguna'),
                        'jenis_monitor' => $this->input->post('jenis'),
                        'spesifikasi' => $this->input->post('spek'),
                        'tgl_inv' =>$this->input->post('tgl_inv'),
                        'harga_beli' =>$this->input->post('harga'),
                        'status' =>$this->input->post('status'),
						'note' => $this->input->post('note')
                    );
                $kode=$this->input->post('kode');
                $this->m_monitor->update($kode,$data);
                redirect('monitor/detail/'.$kode);                
            }else {
                $id = $this->uri->segment(3);                                           
                $data['recordall'] = $this->m_monitor->get_inv($id)->row_array();
                $data['record'] = $this->m_monitor->getkode($id)->row_array();
                $data['service']=$this->m_laptop->get_service($id)->result();
                $data['history']=$this->m_laptop->get_history($id)->result();
                $this->template->display('monitor/detail', $data); 
        }            
    }

    function history() {              
        $this->form_validation->set_rules('pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('tgl_update', 'Tgl Update', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan/ Keterangan', 'required'); 
        if ($this->form_validation->run() == true) {                  
            $data = array(
                'tgl_update' => $this->input->post('tgl_update'),
                'no_inventaris' => $this->input->post('no_inv'),
                'status' => $this->input->post('status'),
                'admin' => $this->session->userdata('nama'),
                'id_pengguna_awal' => $this->input->post('pengguna_awal'),
                'id_pengguna' => $this->input->post('pengguna'),
                'note' => $this->input->post('catatan')                
            ); 
			if ($this->input->post('status')== "Dipinjamkan"){
				$data2=array('id_pengguna' => $this->input->post('pengguna'),'status'=>"DIPINJAMKAN");
				}else if($this->input->post('status')== "Kembali"){
					$data2=array('id_pengguna' => $this->input->post('pengguna'),'status'=>"DIGUNAKAN");
				}else{
					$data2=array('id_pengguna' => $this->input->post('pengguna'),'status'=>"DIGUNAKAN");
				}	
            $kode=$this->input->post('no_inv');         
            $this->m_laptop->history($data);
            //$data2=array('id_pengguna'=>$this->input->post('pengguna'));
            $this->m_monitor->update($kode,$data2);            
            redirect('monitor/detail/'.$kode);
        } else { 
            $id = $this->uri->segment(3);              
            $data['recordall'] = $this->m_monitor->get_inv($id)->row_array(); 
            $data['pengguna'] = $this->m_laptop->getpenggunagid()->result();           
            $this->template->display('monitor/history',$data);
        }
    }

    function edithistory($id) {              
        $this->form_validation->set_rules('pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('tgl_update', 'Tgl Update', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan/ Keterangan', 'required'); 
        if ($this->form_validation->run() == true) {                  
            $data = array(
                'tgl_update' => $this->input->post('tgl_update'),
                'status' => $this->input->post('status'),
                'id_pengguna' => $this->input->post('pengguna'),
                'note' => $this->input->post('catatan')                
            );
			if ($this->input->post('status')== "Dipinjamkan"){
				$data2=array('id_pengguna' => $this->input->post('pengguna'),'status'=>"DIPINJAMKAN");
				}else if($this->input->post('status')== "Kembali"){
					$data2=array('id_pengguna' => $this->input->post('pengguna'),'status'=>"DIGUNAKAN");
				}else{
					$data2=array('id_pengguna' => $this->input->post('pengguna'),'status'=>"DIGUNAKAN");
				}	
            $id=$this->input->post('id');          
            $kode=$this->input->post('no_inv'); 
            $this->m_laptop->update_mutasi($id,$data);
			$this->m_monitor->update($kode,$data2);
            redirect('monitor/detail/'.$kode);
        } else { 
            $data['record'] = $this->m_monitor->get_mutasi($id)->row_array(); 
            $this->template->display('monitor/edithistory',$data);
        }
    }       

    function maintadd($id) {
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');
        $this->form_validation->set_rules('tgl_permohonan', 'Tgl. Permohonan', 'required');
        $this->form_validation->set_rules('type', 'Maintenance Type', 'required');       
        if ($this->form_validation->run() == true) {
            $supplier=$this->input->post('supplier');
            $id=$this->session->userdata('gid');
            $data = array(
                'no_permohonan' => $this->m_maintenance->kdotomatis($id),
                'tgl_permohonan' => $this->input->post('tgl_permohonan'),
                'tgl_selesai' => $this->input->post('tgl_selesai'),
                'jenis_permohonan' => $this->input->post('type'),                
                'nama_kategori' => 'Monitor',
                'no_inventaris' => $this->input->post('inventaris'), 
                'catatan_pemohon' => $this->input->post('catatan'),
                'catatan_perbaikan' => $this->input->post('catatan_perbaikan'),
                'nama_supplier' => $supplier,
                'biaya' => $this->input->post('biaya'),
                'gid' => $this->session->userdata('gid')
            );
            $detail=array(
                'no_permohonan' => $this->m_maintenance->kdotomatis($id),
                'tgl_proses' =>date('Y-m-d H:i:s'),  
                'catatan' => $this->input->post('catatan'),
                'user' => "User",
             );
            $kode=$this->input->post('inventaris');
            $this->m_maintenance->simpan($data);
            $this->m_maintenance->simpan_detail($detail);
            redirect('monitor/detail/'.$kode); 
        } else {
            $data['record'] = $this->m_monitor->getkode($id)->row_array();
            $data['supplier'] = $this->m_masuk->getsupplier()->result();             
            $this->template->display('monitor/addnew',$data);
        }
    }  

    function detail() { 
        $id = $this->uri->segment(3);                                           
        $data['recordall'] = $this->m_monitor->get_inv($id)->row_array();
        $data['record'] = $this->m_monitor->getkode($id)->row_array();
        $data['service']=$this->m_laptop->get_service($id)->result();
        $data['history']=$this->m_laptop->get_history($id)->result();
        $this->template->display('monitor/detail', $data);            
    }

    function delete($kode) {
        if ($this->session->userdata('role')=='Administrator'){
            $this->m_monitor->hapus($kode);
            redirect('monitor');
        }else{
            $this->session->set_flashdata('result_hapus', '<br><p class="text-red">Maaf Anda tidak di ijinkan menghapus data ini !</p>');
            redirect('monitor');
        }    
    }

    function _set_rules() {
        $this->form_validation->set_rules('pengguna', 'Nama Pengguna', 'required');   
        $this->form_validation->set_rules('spek', 'Spesifikasi', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis Monitor', 'required');        
        $this->form_validation->set_rules('tgl_inv', 'Tgl. Inventaris', 'required');  
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissable'>", "</div>");
    }

}
