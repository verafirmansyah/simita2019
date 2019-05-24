<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_masuk extends CI_Model {    

    function list_masuk() {     
        $query = $this->db->query("SELECT tb_trans_masuk.id_transaksi,tb_trans_masuk.kode_transaksi,tb_trans_detail.kode_barang,tb_trans_detail.harga,tb_trans_detail.qty_masuk,tb_trans_detail.catatan,tb_trans_detail.status,
        tb_trans_masuk.no_po,tb_trans_masuk.tgl_transaksi,tb_trans_masuk.id_supplier,tb_trans_masuk.gid,tb_barang.nama_barang,tb_barang.merek_barang,tb_barang.spesifikasi,tb_supplier.nama_supplier,
        tb_trans_detail.id_trans_detail FROM tb_trans_detail INNER JOIN tb_trans_masuk ON tb_trans_detail.kode_transaksi = tb_trans_masuk.kode_transaksi 
        INNER JOIN tb_barang ON tb_barang.kode_barang = tb_trans_detail.kode_barang INNER JOIN tb_supplier ON tb_supplier.id_supplier = tb_trans_masuk.id_supplier 
        WHERE tb_trans_detail.status ='1' ORDER BY tb_trans_detail.id_trans_detail DESC ");
        return $query;
    }

    function list_masukgid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_trans_masuk.id_transaksi,tb_trans_masuk.kode_transaksi,tb_trans_detail.kode_barang,tb_trans_detail.harga,tb_trans_detail.qty_masuk,tb_trans_detail.catatan,tb_trans_detail.status,
        tb_trans_masuk.no_po,tb_trans_masuk.tgl_transaksi,tb_trans_masuk.id_supplier,tb_trans_masuk.gid,tb_barang.nama_barang,tb_barang.merek_barang,tb_barang.spesifikasi,tb_supplier.nama_supplier,
        tb_trans_detail.id_trans_detail FROM tb_trans_detail INNER JOIN tb_trans_masuk ON tb_trans_detail.kode_transaksi = tb_trans_masuk.kode_transaksi 
        INNER JOIN tb_barang ON tb_barang.kode_barang = tb_trans_detail.kode_barang INNER JOIN tb_supplier ON tb_supplier.id_supplier = tb_trans_masuk.id_supplier 
        WHERE tb_trans_detail.gid ='$gid' AND tb_trans_detail.status ='1' ORDER BY tb_trans_detail.id_trans_detail DESC ");
        return $query;
    }

    function getbarang() {
        $this->db->order_by('nama_barang','ASC');
        return $this->db->get('tb_barang');
    }

    function getsupplier() {
        $this->db->where('isactive','True');
        $this->db->order_by('nama_supplier','ASC');
        return $this->db->get('tb_supplier');
    }

    function getkategori() {
        $this->db->order_by('nama_kategori','ASC');
        return $this->db->get('tb_kategori');
    }

    function getbrand(){
        $this->db->order_by('merek_barang', 'ASC');
        return $this->db->get('tb_barang');
    }

    function getkode($id) {
        $kode = array('kode_barang' => $id);
        return $this->db->get_where('tb_barang', $kode);
    }
   
    function simpan_masuk_temp($data) {
        $barang =   $_GET['barang'];
        $qty    =   $_GET['qty'];
        $harga  =   $_GET['harga'];
        $catatan =  $_GET['catatan'];
        //$id_barang=  $this->db->get_where('tb_barang',array('kode_barang'=>$barang))->row_array();
        $gid=$this->session->userdata('gid');
        $data   =   array(
                    'kode_transaksi'=>0,
                    'tgl_transaksi'=>tanggal(),
                    'kode_barang'=>$barang,
                    'harga'=>$harga,
                    'qty_masuk'=>$qty,                    
                    'catatan'=>$catatan,
                    'gid'=>$gid);
        // status 1 sudah diproses, 2 belum diproses
        $this->db->insert('tb_trans_detail',$data);
    }

    function tampil_temp(){   
        $gid=$this->session->userdata('gid');     
        $query=$this->db->query("SELECT tb_trans_detail.id_trans_detail,tb_trans_detail.kode_transaksi,tb_trans_detail.kode_barang,tb_barang.nama_barang,tb_trans_detail.harga,tb_trans_detail.qty_masuk,
            tb_trans_detail.catatan,tb_trans_detail.status,tb_trans_detail.gid FROM tb_trans_detail INNER JOIN tb_barang ON tb_barang.kode_barang = tb_trans_detail.kode_barang 
            WHERE tb_trans_detail.status= '0' AND tb_trans_detail.gid = '$gid'");
        return $query;
    }

    function hapus_temp($id){
        $this->db->where('id_trans_detail',$id);
        $this->db->delete('tb_trans_detail');
    }

    function kdotomatis() {
        $group=$this->db->get_where('tb_group',array('gid'=>$this->session->userdata('gid')))->row_array();
        $kode=$group['nama_alias'];
        $jenis = "BM-".$kode."-".date('m').".";
        $query = $this->db->query("SELECT max(kode_transaksi) as maxID FROM tb_trans_masuk WHERE kode_transaksi LIKE '$jenis%'");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 10, 3);
        $noUrut++;
        $newID = $jenis . sprintf("%03s", $noUrut);
        return $newID;       
    }
    
    function update_status($kode){
       // $sid = session_id();
        $this->db->query("UPDATE tb_trans_detail SET kode_transaksi='$kode',kode_transaksi='$kode',status='1' WHERE status='0' ");
    }
    function simpan($data) {
        $this->db->insert('tb_trans_masuk', $data);
        return $this->db->insert_id();
    }

    function hapus($kode) {
        $this->db->where('kode_barang', $kode);
        $this->db->delete('tb_barang');
    }
}
