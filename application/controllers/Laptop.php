<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laptop extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_laptop','m_masuk','m_barang','m_maintenance'));
        // load helper Date
        $this->load->helper('date');
        chek_session();
    }
	public function index() {
        //$data['record'] = $this->m_barang->listBarang()->result(); 
        $this->template->display('laptop/view');       
    }		
   
    function view_data(){        
        if ($this->session->userdata('role')=='Administrator'){
            $ambildata=$this->m_laptop->semua()->result();
        }else{
            $ambildata=$this->m_laptop->semuagid()->result();
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
                'kode_laptop'=>$r->kode_laptop,
                'nama_pengguna'=>$r->nama_pengguna, 
                'dept'=>$deptnama, 
                'subdept'=>$r->nama,         
                'tgl_inv'=>tgl_indo($r->tgl_inv),
                'nama_laptop'=>$r->nama_laptop, 
                'spesifikasi'=>$r->spesifikasi, 
                'sn'=>$r->serial_number, 
                'ip'=>$r->network, 
                'aset_hrd'=>$r->aset_hrd,
                'status'=>$status, 
                'view'=>anchor('laptop/detail/' . $r->kode_laptop, '<i class="btn btn-info btn-sm fa fa-eye" data-toggle="tooltip" title="View Detail"></i>'),
                'delete'=>anchor('laptop/delete/' . $r->id_laptop, '<i class="btn-sm btn-danger glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")),
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }   

    function add() {              
        $this->_set_rules(); 
        //$this->form_validation->set_message('is_unique', '%s Sudah Ada');
        //$this->form_validation->set_rules('no_inv', 'No. Inventaris', 'trim|required|is_unique[tb_inv_laptop.kode_laptop]');       
        if ($this->form_validation->run() == true) {
            $gid=$this->session->userdata('gid');           
            $data = array(
                'kode_laptop' => $this->m_laptop->kdotomatis(),
                'id_pengguna' => $this->input->post('pengguna'),
                'nama_laptop' => $this->input->post('merek'),
                'tipe_laptop' => $this->input->post('tipe_laptop'),
                'spesifikasi' => $this->input->post('spek'),
                'serial_number' => $this->input->post('sn'),
                'kode_lisensi' => $this->input->post('kode_lisensi'),
                'network' => $this->input->post('ip'),
                'aset_hrd' => $this->input->post('aset_hrd'),
                'tgl_inv' =>$this->input->post('tgl_inv'),
                'tgl_garansi' =>$this->input->post('tgl_garansi'),
                'harga_beli' =>$this->input->post('harga'),
                'createdate' =>mdate('%Y-%m-%d %H:%i:%s', now()),
                'createby'=>$this->session->userdata('username'),
                'gid' => $gid
            );
            $data2=array(
                'no_inventaris' => $this->m_laptop->kdotomatis(),
				'id_pengguna_awal' => $this->input->post('pengguna'),
                'id_pengguna' => $this->input->post('pengguna'),
                'tgl_update'=>date('Y-m-d H:i:s'),
                'admin'=>$this->session->userdata('nama'),
                'note'=>'Inventory Baru',
                );
            $this->m_laptop->simpan($data);
            $this->m_laptop->simpan_history($data2);
            redirect('laptop');
        } else {              
            $data['pengguna'] = $this->m_laptop->getpenggunagid()->result();        
            $data['lisensi'] = $this->m_laptop->getlisensi()->result();   
            $data['merek'] = $this->m_laptop->getmerk()->result();
            $data['tipe_laptop'] = $this->m_laptop->gettipe()->result();
            $this->template->display('laptop/tambah',$data);
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
                'createdate' =>mdate('%Y-%m-%d %H:%i:%s', now()),
                'createby'=>$this->session->userdata('username'),
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
            $this->m_laptop->update($kode,$data2);          
            redirect('laptop/detail/'.$kode);
        } else { 
            $id = $this->uri->segment(3);              
            $data['recordall'] = $this->m_laptop->getall($id)->row_array(); 
            $data['pengguna'] = $this->m_laptop->getpenggunagid()->result();           
            $this->template->display('laptop/history',$data);
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
                'lastupdate' =>mdate('%Y-%m-%d %H:%i:%s', now()),
                'updateby'=>$this->session->userdata('username'),
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
			$this->m_laptop->update($kode,$data2);
            redirect('laptop/detail/'.$kode);
        } else { 
            $data['record'] = $this->m_laptop->get_mutasi($id)->row_array(); 
            $this->template->display('laptop/edithistory',$data);
        }
    }      

    //function edit() {       
       // if (isset($_POST['submit'])) {
        	
           // $this->_set_rules();
           // if ($this->form_validation->run() == true) {
               // $data = array( 
                 //       'id_pengguna' => $this->input->post('pengguna'),
                   //     'nama_laptop' => $this->input->post('merek'),
                     //   'spesifikasi' => $this->input->post('spek'),
                       // 'serial_number' => $this->input->post('sn'),
                        //'network' => $this->input->post('ip'),
                        //'tgl_inv' =>$this->input->post('tgl_inv')
            //        );
            //    $kode=$this->input->post('kode');
            //    $this->m_laptop->edit($kode,$data);
            //    redirect('laptop');                
            //}else {
            //    $id = $this->input->post('kode');                                          
            //    $data['record'] = $this->m_laptop->getkode($id)->row_array();
            //    $this->template->display('laptop/edit', $data);
        //  } 
        //  }else{ 
            //    $id = $this->uri->segment(3);                                                                         
            //    $data['record'] = $this->m_laptop->getkode($id)->row_array();
            //    $this->template->display('laptop/edit', $data);
        //  }
    //}

    function detail() { 
        $id = $this->uri->segment(3);                                           
        $data['recordall'] = $this->m_laptop->getall($id)->row_array();
        $data['record'] = $this->m_laptop->getkode($id)->row_array();
        $data['service']=$this->m_laptop->get_service($id)->result();
        $data['history']=$this->m_laptop->get_history($id)->result();
        $this->template->display('laptop/detail', $data);            
    }
	
	function print_maintenance() { 
        $id = $this->uri->segment(3);                                           
        $data['recordall'] = $this->m_laptop->getall($id)->row_array();
        $data['service']=$this->m_laptop->get_service($id)->result();
        $this->load->view('laptop/print_maintenance', $data);            
    }

   function print_history() { 
        $id = $this->uri->segment(3); 
		$data['record'] = $this->m_laptop->get_mutasi($id)->row_array(); 
        $this->load->view('laptop/print_history',$data);           
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
                'nama_kategori' => 'Laptop',
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
            redirect('laptop/detail/'.$kode); 
        } else {
            $data['record'] = $this->m_laptop->getkode($id)->row_array();
            $data['supplier'] = $this->m_masuk->getsupplier()->result();             
            $this->template->display('laptop/addnew',$data);
        }
    }

    function update(){
        $this->_set_rules();
        if ($this->form_validation->run() == true) {
            $data = array( 
                        'id_pengguna' => $this->input->post('pengguna'),
                        'nama_laptop' => $this->input->post('merek'),
                        'spesifikasi' => $this->input->post('spek'),
                        'serial_number' => $this->input->post('sn'),
                        'harga_beli' =>$this->input->post('harga'),
                        'network' => $this->input->post('ip'),
                        'tgl_inv' =>$this->input->post('tgl_inv'),
                        'tgl_garansi' =>$this->input->post('tgl_garansi'),
                        'status' => $this->input->post('status'),
                        'updateby' => $this->session->userdata('username'),
                        'updatedate' =>mdate('%Y-%m-%d %H:%i:%s', now()),
                        'note' => $this->input->post('note')
                    );
                
            $kode=$this->input->post('kode');
            $this->m_laptop->update($kode,$data);
            redirect('laptop/detail/'.$kode);                
        }else {
            $id = $this->input->post('kode');                                          
            $data['recordall'] = $this->m_laptop->getall($id)->row_array();
            $data['record'] = $this->m_laptop->getkode($id)->row_array();
            $data['service']=$this->m_laptop->get_service($id)->result();
            $data['history']=$this->m_laptop->get_history($id)->result();
            $this->template->display('laptop/detail', $data);
        } 
    }

    function delete($kode) {
        if ($this->session->userdata('role')=='Administrator'){
            $this->m_laptop->hapus($kode); 
            redirect('laptop'); 
        }else{
            $this->session->set_flashdata('result_hapus', '<br><div class="alert alert-danger">Anda tidak memiliki akses untuk menghapus data !</div>');
            redirect('laptop');
        }       
    }
    function _set_rules() {
        $this->form_validation->set_rules('pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('merek', 'Merek/Brand', 'required');
        $this->form_validation->set_rules('spek', 'Spesifikasi', 'required');
        $this->form_validation->set_rules('sn', 'Serial Number', 'required'); 
        $this->form_validation->set_rules('harga', 'Harga Beli', 'required|numeric');     
        $this->form_validation->set_rules('ip', 'IP Address', 'required|valid_ip');       
        $this->form_validation->set_rules('tgl_inv', 'Tgl. Inventaris', 'required');  
        $this->form_validation->set_rules('tgl_garansi', 'Tgl. Garansi', 'required'); 
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissable'>", "</div>");
    }
    // Fungsi untuk export ke excel (23 Januari 2018)
    public function export_excel(){
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    // Panggil class PHPExcel nya
    $excel = new PHPExcel();
    // Settingan awal fil excel
    $excel->getProperties()->setCreator('SIMITA')
                 ->setLastModifiedBy('SIMITA')
                 ->setTitle("Laporan Inventaris Laptop")
                 ->setSubject("")
                 ->setDescription("Laporan Data Inventaris Laptop dari SIMITA")
                 ->setKeywords("Laporan");
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN DATA INVENTORY LAPTOP"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A1:L1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "No.Inventaris IT"); // Set kolom B3 
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "No.Inventaris HRD"); // Set kolom C3 
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Pengguna"); // Set kolom D3 
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "Cabang"); // Set kolom E3 
    $excel->setActiveSheetIndex(0)->setCellValue('F3', "Brand");
    $excel->setActiveSheetIndex(0)->setCellValue('G3', "Spesifikasi");
    $excel->setActiveSheetIndex(0)->setCellValue('H3', "SN");
    $excel->setActiveSheetIndex(0)->setCellValue('I3', "Tgl.Inventaris");
    $excel->setActiveSheetIndex(0)->setCellValue('J3', "Tgl.Akhir Garansi");
    $excel->setActiveSheetIndex(0)->setCellValue('K3', "Status");
    $excel->setActiveSheetIndex(0)->setCellValue('L3', "Catatan");
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
    $laptop = $this->m_laptop->semuadata()->result();
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($laptop as $data){ // Lakukan looping pada variabel
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->kode_laptop);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->aset_hrd);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nama_pengguna);
      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->namacabang);
      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->nama_laptop);
      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->spesifikasi);
      $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->serial_number);
      $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->tgl_inv);
      $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->tgl_garansi);
      $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->status);
      $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->note);
      
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
      
      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Inventaris Laptop");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Laporan Inventaris Laptop.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }

}
