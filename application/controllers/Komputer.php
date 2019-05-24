<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Komputer extends CI_Controller {

    function __construct() {
        parent::__construct();
         // load helper Date
         $this->load->helper('date');
        $this->load->model(array('m_komputer','m_laptop','m_masuk','m_maintenance'));
        chek_session();
    }
	public function index() {             
        $this->template->display('komputer/view');       
    }		
   
    function view_data(){        
        //$criteria = $this->db->query("SELECT * FROM tb_kecamatan ORDER BY kota_id ASC");
        if ($this->session->userdata('role')=='Administrator'){
            $ambildata=$this->m_komputer->semua()->result();
        }else{
            $ambildata=$this->m_komputer->semuagid()->result();
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
            } else{
				$status="<span class='label label-warning'>" .$r->status."</span>";
			}   
            $query[] = array(
                'no'=>$no++,
                'kode_komputer'=>$r->kode_komputer,
                'aset_hrd'=>$r->aset_hrd,
                'nama_pengguna'=>$r->nama_pengguna, 
                'dept'=>$deptnama, 
                'subdept'=>$r->nama,         
                'tgl_inv'=>tgl_indo($r->tgl_inv),
                'tgl_garansi'=>tgl_indo($r->tgl_garansi),
                'nama_komputer'=>$r->nama_komputer, 
                'spesifikasi'=>$r->spesifikasi, 
                'sn'=>$r->serial_number, 
                'ip'=>$r->network, 
                'status'=>$status, 
                'edit'=>anchor('komputer/detail/' . $r->kode_komputer, '<i class="btn btn-info btn-sm fa fa-eye" data-toggle="tooltip" title="View Detail"></i>'),
                'delete'=>''.anchor('komputer/delete/' . $r->id_komputer, '<i class="btn-sm btn-danger glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")).'',                
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }   

    function add() {              
        $this->_set_rules();         
        if ($this->form_validation->run() == true) {
            $gid=$this->session->userdata('gid');           
            $data = array(
                'kode_komputer' => $this->m_komputer->kdotomatis(),
                'aset_hrd' => $this->input->post('aset_hrd'),
                'id_pengguna' => $this->input->post('pengguna'),
                'nama_komputer' => $this->input->post('merek'),
                'tipe' => $this->input->post('tipe'),
                'kode_lisensi' => $this->input->post('kode_lisensi'),
                'spesifikasi' => $this->input->post('spek'),
                'serial_number' => $this->input->post('sn'),
                'network' => $this->input->post('ip'),
                'harga_beli' => $this->input->post('harga'),
                'tgl_inv' =>$this->input->post('tgl_inv'),
                'tgl_garansi' =>$this->input->post('tgl_garansi'),
                'createby'=>$this->session->userdata('username'),
                'createdate' =>mdate('%Y-%m-%d %H:%i:%s', now()),
                'gid' => $gid
            );
            $data2=array(
                'no_inventaris' => $this->m_komputer->kdotomatis(),
				'id_pengguna_awal' => $this->input->post('pengguna'),
                'id_pengguna' => $this->input->post('pengguna'),
                'tgl_update'=>date('Y-m-d H:i:s'),
                'admin'=>$this->session->userdata('nama'),
                'note'=>'Inventory Baru',
                );
            $this->m_laptop->simpan_history($data2);
            $this->m_komputer->simpan($data);
            redirect('komputer');
        } else {              
            $data['pengguna'] = $this->m_komputer->getpenggunagid()->result();  
            $data['lisensi'] = $this->m_komputer->getlisensi()->result();  
            $data['merek'] = $this->m_komputer->getmerk()->result();   
            $data['tipe'] = $this->m_komputer->gettipe()->result();         
            $this->template->display('komputer/tambah',$data);
        }
    }	
    
    function update() { 
        $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array( 
                        'id_pengguna' => $this->input->post('pengguna'),
                        'nama_komputer' => $this->input->post('merek'),
                        'spesifikasi' => $this->input->post('spek'),
                        'serial_number' => $this->input->post('sn'),
                        'network' => $this->input->post('ip'),
                        'tgl_inv' =>$this->input->post('tgl_inv'),
                        'tgl_garansi' =>$this->input->post('tgl_garansi'),
                        'harga_beli' => $this->input->post('harga'),
                        'status' => $this->input->post('status'),
                        'updatedate' =>mdate('%Y-%m-%d %H:%i:%s', now()),
                        'updateby'=>$this->session->userdata('username'),
						'note' => $this->input->post('note')
                    );
                $kode=$this->input->post('kode');
                $this->m_komputer->update($kode,$data);
                redirect('komputer/detail/'.$kode);                
            }else {
                $id = $this->input->post('kode');                                       
                $data['recordall'] = $this->m_komputer->get_inv($id)->row_array();
                $data['record'] = $this->m_komputer->getkode($id)->row_array();
                $data['service']=$this->m_laptop->get_service($id)->result();
                $data['history']=$this->m_laptop->get_history($id)->result();
                $this->template->display('komputer/detail', $data); 
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
			$this->m_komputer->update($kode,$data2);
            redirect('komputer/detail/'.$kode);
        } else { 
            $data['record'] = $this->m_komputer->get_mutasi($id)->row_array(); 
            $this->template->display('komputer/edithistory',$data);
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
                'nama_kategori' => 'Komputer',
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
            $this->m_maintenance->simpan_detail($detail);
            $this->m_maintenance->simpan($data);
            redirect('komputer/detail/'.$kode); 
        } else {
            $data['record'] = $this->m_komputer->getkode($id)->row_array();
            $data['supplier'] = $this->m_masuk->getsupplier()->result();             
            $this->template->display('komputer/addnew',$data);
        }
    }

    function detail() { 
        $id = $this->uri->segment(3);                                           
        $data['recordall'] = $this->m_komputer->get_inv($id)->row_array();
        $data['record'] = $this->m_komputer->getkode($id)->row_array();
        $data['service']=$this->m_laptop->get_service($id)->result();
        $data['history']=$this->m_laptop->get_history($id)->result();
        $this->template->display('komputer/detail', $data);            
    }
	
	function print_maintenance() { 
        $id = $this->uri->segment(3);                                           
        $data['recordall'] = $this->m_komputer->get_inv($id)->row_array();
        $data['service']=$this->m_laptop->get_service($id)->result();
        $this->load->view('komputer/print_maintenance', $data);            
    }

   function print_history() { 
        $id = $this->uri->segment(3); 
		$data['record'] = $this->m_komputer->get_mutasi($id)->row_array(); 
        $this->load->view('komputer/print_history',$data);           
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
            $this->m_komputer->update($kode,$data2);          
            redirect('komputer/detail/'.$kode);
        } else { 
            $id = $this->uri->segment(3);              
            $data['recordall'] = $this->m_komputer->get_inv($id)->row_array(); 
            $data['pengguna'] = $this->m_laptop->getpenggunagid()->result();           
            $this->template->display('komputer/history',$data);
        }
    }   

    function delete($kode) {
        if ($this->session->userdata('role')=='Administrator'){
            $this->m_komputer->hapus($kode); 
            redirect('komputer'); 
        }else{
            $this->session->set_flashdata('result_hapus', '<br><p class="text-red">Maaf Anda tidak di ijinkan menghapus data ini !</p>');
            redirect('komputer');
        }       
		
    }

    function _set_rules() {
        $this->form_validation->set_rules('pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('aset_hrd', 'Nomor Aset HRD', 'required');
        $this->form_validation->set_rules('merek', 'Merek/Brand', 'required');
        $this->form_validation->set_rules('spek', 'Spesifikasi', 'required');
        $this->form_validation->set_rules('sn', 'Serial Number', 'required');   
        $this->form_validation->set_rules('ip', 'IP Address', 'required|valid_ip');       
        $this->form_validation->set_rules('tgl_inv', 'Tgl. Inventaris', 'required'); 
        $this->form_validation->set_rules('tgl_garansi', 'Tgl. Garansi', 'required');
        $this->form_validation->set_rules('harga', 'Harga Beli', 'required');  
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissable'>", "</div>");
    }

}
