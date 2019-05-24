<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_transaksi'));
        chek_session();
    }
	public function masuk() {        
        $this->template->display('transaksi/masuk/view');       
    }		
   
    function view_data_masuk(){        
        //$criteria = $this->db->query("SELECT * FROM tb_kecamatan ORDER BY kota_id ASC");
        if ($this->session->userdata('role')=='Administrator'){
            $ambildata=$this->m_transaksi->list_masuk()->result();
        }else{
            $ambildata=$this->m_transaksi->list_masukgid()->result();
        }  
        $no=1;
        foreach($ambildata as $r) { 
            $query[] = array(
                'no'=>$no++,
                'kode_transaksi'=>$r->kode_transaksi,                
                'merek_barang'=>$r->merek_barang,  
                'spesifikasi'=>$r->spesifikasi, 
                'qty'=>'<center>'.$r->qty.'</center>',         
                'harga'=>rupiah($r->harga),
                'catatan'=>$r->catatan, 
                'no_po'=>$r->no_po,                  
                'tgl_transaksi'=>tgl_indo($r->tgl_transaksi),
                'nama_supplier'=>$r->nama_supplier,  
                'edit'=>''.anchor('transaksi/edit/' . $r->id_transaksi, '<i class="btn btn-info btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') .'',
                'delete'=>''.anchor('transaksi/delete/' . $r->id_transaksi, '<i class="btn-sm btn-info glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></i>', array('onclick' => "return confirm('Data Akan di Hapus?')")).'',                
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }  

    function tampilbarang(){        
        $id=$_GET['kategori'];
        $barang=  $this->db->get_where('tb_barang',array('id_kategori'=>$id))->result();        
        foreach ($barang as $r){
            echo "<option value='$r->kode_barang'>".  strtoupper($r->nama_barang)."</option>";
        }
    } 

    function masuk_ajax(){
        $this->m_transaksi->simpan_masuk_temp();
    }

    function load_temp(){
        echo "<table class='table table-bordered table-striped'>
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Spesifikasi</th>
            <th>Qty</th>
            <th>Harga Beli</th>
            <th>Catatan</th>
            <th>Delete</th>
        </tr>";
        $data=  $this->m_transaksi->tampil_temp()->result();
        foreach ($data as $d){
            echo "<tr id='dataku$d->id_masukdetail'>
                <td>$d->kode_barang</td>
                <td>$d->nama_barang</td>
                <td>$d->spesifikasi</td>
                <td>$d->qty</td>
                <td>$d->harga</td>
                <td>$d->catatan</td>
                <td><button onclick='hapustemp(99)' >Hapus</button></td>
                </tr>";
        }
    echo"</table>";
    }

    function hapus_temp() {
        $id=$_GET['id'];
        $this->m_transaksi->hapus_temp($id);
    }

    function tampilspek(){        
        $id=$_GET['namabarang'];
        $barang=  $this->db->get_where('tb_barang',array('kode_barang'=>$id))->row_array();        
        echo $barang['spesifikasi'];
    } 
    function masukadd() {              
        $this->_set_rules(); 
        //$this->form_validation->set_message('is_unique', '%s Sudah Ada');
        //$this->form_validation->set_rules('no_inv', 'No. Inventaris', 'trim|required|is_unique[tb_inv_transaksi.kode_transaksi]');       
        if ($this->form_validation->run() == true) {
            $gid=$this->session->userdata('gid');           
            $data = array(
                'kode_transaksi' => $this->m_transaksi->kdotomatis(),
                'id_pengguna' => $this->input->post('pengguna'),
                'jenis_transaksi' => $this->input->post('jenis'),
                'spesifikasi' => $this->input->post('spek'),               
                'tgl_inv' =>$this->input->post('tgl_inv'),
                'gid' => $gid
            );
            $this->m_transaksi->simpan($data);
            redirect('transaksi');
        } else {
            $data['kategori'] = $this->m_transaksi->getkategori()->result();   
            $data['barang'] = $this->m_transaksi->getbarang()->result();  
            $data['supplier'] = $this->m_transaksi->getsupplier()->result();          
            $this->template->display('transaksi/masuk/tambah',$data);
        }
    }	
    
    function edit() {       
        if (isset($_POST['submit'])) {
            $this->_set_rules();
            if ($this->form_validation->run() == true) {
                $data = array( 
                        'id_pengguna' => $this->input->post('pengguna'),
                        'jenis_transaksi' => $this->input->post('merek'),
                        'spesifikasi' => $this->input->post('spek'),
                        'tgl_inv' =>$this->input->post('tgl_inv')
                    );
                $kode=$this->input->post('kode');
                $this->m_transaksi->edit($kode,$data);
                redirect('transaksi');                
            }else {
                $id = $this->input->post('kode');
                //$data['pengguna'] = $this->m_transaksi->getpengguna()->result();                            
                $data['record'] = $this->m_transaksi->getkode($id)->row_array();
                $this->template->display('transaksi/edit', $data);
            } 
           }else{ 
                $id = $this->uri->segment(3);               
                //$data['pengguna'] = $this->m_transaksi->getpengguna()->result();                            
                $data['record'] = $this->m_transaksi->getkode($id)->row_array();
                $this->template->display('transaksi/edit', $data);
            }
    }
    function delete($kode) {
        $this->m_transaksi->hapus($kode);
		redirect('transaksi');
    }

    function _set_rules() {
        $this->form_validation->set_rules('pengguna', 'Nama Pengguna', 'required');   
        $this->form_validation->set_rules('spek', 'Spesifikasi', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis transaksi', 'required');        
        $this->form_validation->set_rules('tgl_inv', 'Tgl. Inventaris', 'required');  
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissable'>", "</div>");
    }

}
