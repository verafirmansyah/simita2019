<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_supplier');
        chek_session();
    }
	public function index() {
        $data['record'] = $this->m_supplier->semua()->result(); 
        $this->template->display('supplier/view', $data);       
    }		
   
    public function view_data() {
        $criteria = $this->m_supplier->listBarang();
        $no = 1;
        foreach ($criteria->result_array() as $data) {
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

    function add() {                
        $this->_set_rules();
        if ($this->form_validation->run() == true) {
            $data = array(
                'nama_supplier' => $this->input->post('nama'),
                'nomor_npwp' => $this->input->post('nomor_npwp'),
                'nomor_ktp' => $this->input->post('nomor_ktp'),
                'alamat_supplier' => $this->input->post('alamat'),
                'nama_pic' => $this->input->post('nama_pic'),
                'telepon' => $this->input->post('telepon'),
                'isactive' => $this->input->post('isactive')
            );
            $this->m_supplier->simpan($data);
            redirect('supplier');
        } else {            
            $this->template->display('supplier/tambah');
        }
    }
	
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array(                            
                        'nama_supplier' => $this->input->post('nama'),
                        'nomor_npwp' => $this->input->post('nomor_npwp'),
                        'nomor_ktp' => $this->input->post('nomor_ktp'),
                        'alamat_supplier' => $this->input->post('alamat'),
                        'nama_pic' => $this->input->post('nama_pic'),
                        'telepon' => $this->input->post('telepon'),
                        'isactive' => $this->input->post('isactive'));
                $kode=$this->input->post('id');
                $this->m_supplier->edit($kode,$data);
                redirect('supplier');                
            }else {
                $id = $this->input->post('id');                                     
                $data['record'] = $this->m_supplier->getkode($id)->row_array();
                $this->template->display('supplier/edit', $data); 
            } 
           }else{ 
                $id = $this->uri->segment(3);
                $data['record'] = $this->m_supplier->getkode($id)->row_array();
                $this->template->display('supplier/edit', $data);
            }
    }
    function delete($id) {
        $this->m_supplier->hapus($id);
		redirect('supplier');
    }

    function _set_rules() {
        $this->form_validation->set_rules('nama', 'Nama Supplier', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('nama_pic', 'Nama PIC','required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');
        $this->form_validation->set_rules('isactive', 'Status', 'required');
        
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
                 ->setTitle("Data Supplier")
                 ->setSubject("Supplier")
                 ->setDescription("Laporan Data Master Supplier")
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
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN DATA MASTER SUPPLIER"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "Nama Supplier"); // Set kolom B3 
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "NPWP"); // Set kolom C3 
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "KTP (Jika Ada)"); // Set kolom C3 
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "Alamat Lengkap"); // Set kolom D3 
    $excel->setActiveSheetIndex(0)->setCellValue('F3', "Nama Sales"); // Set kolom E3 
    $excel->setActiveSheetIndex(0)->setCellValue('G3', "Telpon Sales");
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
    $supplier = $this->m_supplier->semua()->result();
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($supplier as $data){ // Lakukan looping pada variabel
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_supplier);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nomor_npwp);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nomor_ktp);
      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->alamat_supplier);
      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->nama_pic);
      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->telepon);
      
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
      
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
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Master Supplier");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Laporan Master Supplier.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }

}