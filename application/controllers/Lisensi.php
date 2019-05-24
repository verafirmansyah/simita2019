<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lisensi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_lisensi');
        // load helper Date
        $this->load->helper('date');
        chek_session();
    }
	public function index() {
        $data['record'] = $this->m_lisensi->semua()->result(); 
        $this->template->display('lisensi/view', $data);       
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
                'kode_lisensi' => $this->m_lisensi->kdotomatis(),
                'id_supplier' => $this->input->post('id_supplier'),
                'jenis_lisensi' => $this->input->post('jenis_lisensi'),
                'id_cabang' => $this->input->post('id_cabang'),
                'key_lisensi' => $this->input->post('key_lisensi'),
                'tgl_pembelian' => $this->input->post('tgl_pembelian'),
                'tgl_habis' => $this->input->post('tgl_habis'),
                'jumlah_lisensi' => $this->input->post('jumlah_lisensi'),
                'keterangan' => $this->input->post('keterangan'),
                'createby' => $this->session->userdata('username'),
                'createdate' =>mdate('%Y-%m-%d %H:%i:%s', now()),
                'gid'=> $gid
            );
            $this->m_lisensi->simpan($data);
            redirect('lisensi');
        } else {           
        	$data['supplier'] = $this->m_lisensi->getsupplier()->result(); 
            $data['cabang'] = $this->m_lisensi->getcabang()->result();
            $this->template->display('lisensi/tambah',$data);
        }
    }
	
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array(                            
                    'kode_lisensi' => $this->m_lisensi->kdotomatis(),
                    'nama_supplier' => $this->input->post('nama_supplier'),
                    'jenis_lisensi' => $this->input->post('jenis_lisensi'),
                    'cabang' => $this->input->post('cabang'),
                    'key_lisensi' => $this->input->post('key_lisensi'),
                    'tgl_pembelian' => $this->input->post('tgl_pembelian'),
                    'tgl_habis' => $this->input->post('tgl_habis'),
                    'jumlah_lisensi' => $this->input->post('jumlah_lisensi'),
                    'keterangan' => $this->input->post('keterangan'),
                    'updateby' => $this->session->userdata('username'),
                    'updatedate' =>mdate('%Y-%m-%d %H:%i:%s', now())
                    //'gid' => $gid
                        );
                $kode=$this->input->post('id');
                $this->m_lisensi->edit($kode,$data);
                // Tambahan untuk memunculkan notifikasi
                    $this->session->set_flashdata('msg', 
                    '<div class="alert alert-success">
                    <h4>Sukses Save Data </h4>
                    <p>Data Lisensi Berhasil disimpan</p>
                    </div>');
                // Akhir Notifikasi
                redirect('lisensi');                
            }else {
                $id = $this->input->post('id');      
                $data['supplier'] = $this->m_lisensi->getsupplier()->result(); 
                $data['cabang'] = $this->m_lisensi->getcabang()->result();
                $this->template->display('lisensi/edit', $data); 
            } 
           }else{ 
                $id = $this->uri->segment(3);
                $data['record'] = $this->m_lisensi->getkode($id)->row_array();
                $this->template->display('lisensi/edit', $data);
            }
    }
    function delete($id) {
        if ($this->session->userdata('role')=='Administrator'){
            $this->m_lisensi->hapus($id); 
            redirect('lisensi'); 
        }else{
            $this->session->set_flashdata('result_hapus', '<br><p class="text-red">Anda tidak memiliki akses untuk menghapus data !</p>');
            redirect('lisensi');
        }       
    }
        
    function _set_rules() {
        $this->form_validation->set_rules('id_supplier', 'Nama Supplier', 'required');
        $this->form_validation->set_rules('jenis_lisensi', 'Jenis Lisensi', 'required');
        $this->form_validation->set_rules('id_cabang', 'Cabang', 'required');
        $this->form_validation->set_rules('key_lisensi', 'Jenis Lisensi', 'required');
        $this->form_validation->set_rules('tgl_pembelian', 'Tanggal Pembelian', 'required');
        $this->form_validation->set_rules('tgl_habis', 'Tanggal Masa Berlaku', 'required');
        $this->form_validation->set_rules('jumlah_lisensi', 'Jumlah Lisensi', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        
    }

    function detail() { 
        $id = $this->uri->segment(3);                                           
        $data['recordall'] = $this->m_lisensi->getall($id)->row_array();
        $this->template->display('lisensi/detail', $data);            
    }

    function view_inventaris() { 
        $id = $this->uri->segment(3);                                           
        $data['recordall'] = $this->m_lisensi->view_inventaris($id)->row_array();
        $this->template->display('lisensi/view_inventaris', $data);            
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
                 ->setTitle("Data Lisensi Software")
                 ->setSubject("Lisensi Software")
                 ->setDescription("Laporan Data Lisensi Software")
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
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN DATA Lisensi Software"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "Cabang"); // Set kolom B3 
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Jenis Lisensi"); // Set kolom C3 
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Jumlah Lisensi"); // Set kolom C3 
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "Tanggal PO"); // Set kolom D3 
    $excel->setActiveSheetIndex(0)->setCellValue('F3', "Berlaku Hingga"); // Set kolom E3 
    $excel->setActiveSheetIndex(0)->setCellValue('G3', "Nama Vendor");
    $excel->setActiveSheetIndex(0)->setCellValue('H3', "Key Lisensi");
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
    $lisensi = $this->m_lisensi->semua()->result();
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($lisensi as $data){ // Lakukan looping pada variabel
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->namacabang);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->jenis_lisensi);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->jumlah_lisensi);
      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->tgl_pembelian);
      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->tgl_habis);
      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->nama_vendor);
      $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->key_lisensi);
      
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
    $excel->getActiveSheet(0)->setTitle("Laporan Data Koneksi lisensi");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Laporan Koneksi lisensi.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }

}
