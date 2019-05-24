<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Internet extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_internet');
        chek_session();
    }
	public function index() {
        $data['record'] = $this->m_internet->semua()->result(); 
        $this->template->display('internet/view', $data);       
    }		
   
    public function view_data() {
        $ambildata = $this->m_provider->listBarang();
        $no = 1;
        foreach ($ambildata->result_array() as $data) {
            $row[] = array(
                'no' => $no++,
                'kd_barang' => $data['kd_barang'],
                'jenis' =>$data['kategori'],
                'b_nama' => $data['b_nama'],
                'merek' => $data['merek'],
                'spesifikasi' => $data['spesifikasi'],
                'satuan' => '<center>' . $data['satuan_nama'] . '</center>',
                'edit' => '<center><a href="' . base_url() . 'barang/edit/' . $data['kd_barang'] .'"><i class="glyphicon glyphicon-edit"></i></a></center>',
                'delete' => '<center><a href="' . base_url() . 'barang/hapus/' . $data['kd_barang'] .'" class="hapus" ><i class="glyphicon glyphicon-trash"></i></a></center>'
            );
        }
        //$result=array_merge($result,array('rows'=>$row));
        $result = array('aaData' => $row);
        echo json_encode($result);
    }

    function getall($id) {        
        $query = $this->db->query("SELECT tb_inv_laptop.id_laptop,tb_inv_laptop.kode_laptop,tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_laptop.nama_laptop,tb_inv_laptop.spesifikasi,tb_inv_laptop.serial_number,
            tb_inv_laptop.id_lisence,tb_inv_laptop.network,tb_inv_laptop.aset_hrd,tb_inv_laptop.tgl_inv,tb_inv_laptop.tgl_garansi,tb_inv_laptop.harga_beli,tb_inv_laptop.status,tb_inv_laptop.note,tb_inv_laptop.gid,tb_cabang.namacabang
            FROM tb_inv_laptop INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_laptop.id_pengguna 
            INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_pengguna.id_cabang
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_laptop.kode_laptop ='$id'");
        return $query;
    }

    function add() {                
        $this->_set_rules();
        if ($this->form_validation->run() == true) {
            $gid=$this->session->userdata('gid');  
            $data = array(
                'kode_internet' => $this->m_internet->kdotomatis(),
                'nama_provider' => $this->input->post('nama_provider'),
                'nama_cabang' => $this->input->post('nama_cabang'),
                'tipe_koneksi' => $this->input->post('jenis'),
                'nomor_pelanggan' => $this->input->post('nomor_pelanggan'),
                'ip_public' => $this->input->post('ip_public'),
                'spesifikasi' => $this->input->post('spesifikasi'),
                'tanggal_kontrak' => $this->input->post('tanggal_kontrak'),
                'masa_kontrak' => $this->input->post('masa_kontrak'),
                'biaya' => $this->input->post('biaya'),
                'status' => $this->input->post('status'),
                'gid' => $gid
            );
            $this->m_internet->simpan($data);
            redirect('internet');
        } else {           
        	$data['provider'] = $this->m_internet->getprovider()->result(); 
            $data['cabang'] = $this->m_internet->getcabang()->result();
            $this->template->display('internet/tambah',$data);
        }
    }
	
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array(                            
                    'nama_provider' => $this->input->post('nama_provider'),
                    'nama_cabang' => $this->input->post('nama_cabang'),
                    'tipe_koneksi' => $this->input->post('jenis'),
                    'nomor_pelanggan' => $this->input->post('nomor_pelanggan'),
                    'ip_public' => $this->input->post('ip_public'),
                    'spesifikasi' => $this->input->post('spesifikasi'),
                    'tanggal_kontrak' => $this->input->post('tanggal_kontrak'),
                    'masa_kontrak' => $this->input->post('masa_kontrak'),
                    'biaya' => $this->input->post('biaya'),
                    'status' => $this->input->post('status'),
                    //'gid' => $gid
                        );
                $kode=$this->input->post('id');
                $this->m_internet->edit($kode,$data);
                redirect('internet');                
            }else {
                $id = $this->input->post('id');      
                $data['provider'] = $this->m_internet->getprovider()->result();                                
                $data['record'] = $this->m_internet->getkode($id)->row_array();
                $this->template->display('internet/edit', $data); 
            } 
           }else{ 
                $id = $this->uri->segment(3);
                $data['record'] = $this->m_internet->getkode($id)->row_array();
                $this->template->display('internet/edit', $data);
            }
    }
    function delete($id) {
        if ($this->session->userdata('role')=='Administrator'){
            $this->m_internet->hapus($id); 
            redirect('internet'); 
        }else{
            $this->session->set_flashdata('result_hapus', '<br><p class="text-red">Anda tidak memiliki akses untuk menghapus data !</p>');
            redirect('internet');
        }       
    }
        
    function _set_rules() {
        $this->form_validation->set_rules('nama_provider', 'Nama Provider', 'required');
        $this->form_validation->set_rules('nama_cabang', 'Nama Cabang', 'required');
        $this->form_validation->set_rules('jenis', 'Tipe Koneksi', 'required');
        $this->form_validation->set_rules('nomor_pelanggan', 'Nomor Pelanggan', 'required');
        $this->form_validation->set_rules('ip_public', 'IP Public', 'required');
        $this->form_validation->set_rules('spesifikasi', 'spesifikasi', 'required');
        $this->form_validation->set_rules('tanggal_kontrak', 'Tanggal Kontrak', 'required');
        $this->form_validation->set_rules('masa_kontrak', 'Masa Kontrak', 'required');
        $this->form_validation->set_rules('biaya', 'Biaya', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        
    }

    function detail() { 
        $id = $this->uri->segment(3);                                           
        $data['recordall'] = $this->m_internet->getall($id)->row_array();
        $this->template->display('internet/detail', $data);            
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
                 ->setTitle("Data Koneksi Internet")
                 ->setSubject("Koneksi Internet")
                 ->setDescription("Laporan Data Koneksi Internet")
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
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN DATA INVENTORY INTERNET CABANG"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "Cabang"); // Set kolom B3 
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Provider"); // Set kolom C3 
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Tipe Koneksi"); // Set kolom C3 
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "No.Pelanggan"); // Set kolom D3 
    $excel->setActiveSheetIndex(0)->setCellValue('F3', "IP Public"); // Set kolom E3 
    $excel->setActiveSheetIndex(0)->setCellValue('G3', "Tgl. Kontrak");
    $excel->setActiveSheetIndex(0)->setCellValue('H3', "Tgl. Habis Kontrak");
    $excel->setActiveSheetIndex(0)->setCellValue('I3', "Status");
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
    $internet = $this->m_internet->semua()->result();
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($internet as $data){ // Lakukan looping pada variabel
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_cabang);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama_provider);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->tipe_koneksi);
      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nomor_pelanggan);
      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->ip_public);
      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->tanggal_kontrak);
      $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->masa_kontrak);
      $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->status);
      
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
    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
    $excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Koneksi Internet");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Laporan Koneksi Internet.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }

}
