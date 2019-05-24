<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_keluar extends CI_Model {    

    function list_keluar() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_trans_keluar.id_transaksi,tb_trans_keluar.kode_transaksi,tb_trans_keluar.tgl_transaksi,tb_trans_keluar.id_pengguna,tb_trans_detail.kode_barang,tb_trans_detail.harga,
            tb_trans_detail.qty_keluar,tb_trans_detail.catatan,tb_trans_detail.status,tb_barang.nama_barang,tb_barang.merek_barang,tb_barang.spesifikasi,tb_trans_detail.gid,tb_pengguna.nama_pengguna,tb_cabang.namacabang,tb_departemen.nama
            FROM tb_trans_detail INNER JOIN tb_barang ON tb_barang.kode_barang = tb_trans_detail.kode_barang INNER JOIN tb_trans_keluar ON tb_trans_detail.kode_transaksi = tb_trans_keluar.kode_transaksi INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_trans_keluar.id_pengguna  INNER JOIN tb_cabang.id_cabang = tb_trans_keluar.id_cabang
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept ORDER BY tb_trans_detail.id_trans_detail DESC");
        return $query;
    }

    function list_keluargid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_trans_keluar.id_transaksi,tb_trans_keluar.kode_transaksi,tb_trans_keluar.tgl_transaksi,tb_trans_keluar.id_pengguna,tb_trans_detail.kode_barang,tb_trans_detail.harga,
            tb_trans_detail.qty_keluar,tb_trans_detail.catatan,tb_trans_detail.status,tb_barang.nama_barang,tb_barang.merek_barang,tb_barang.spesifikasi,tb_trans_detail.gid,tb_pengguna.nama_pengguna,tb_departemen.nama,tb_trans_keluar.namacabang 
            FROM tb_trans_detail INNER JOIN tb_barang ON tb_barang.kode_barang = tb_trans_detail.kode_barang INNER JOIN tb_trans_keluar ON tb_trans_detail.kode_transaksi = tb_trans_keluar.kode_transaksi INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_trans_keluar.id_pengguna INNER JOIN tb_cabang.id_cabang = tb_trans_keluar.id_cabang
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_trans_keluar.gid ='$gid' ORDER BY tb_trans_detail.id_trans_detail DESC ");
        return $query;
    }

    function cetak($id) {        
        $query = $this->db->query("SELECT tb_trans_detail.kode_transaksi,tb_trans_detail.tgl_transaksi,tb_trans_detail.kode_barang,tb_trans_detail.harga,tb_trans_detail.qty_keluar
            tb_trans_detail.catatan,tb_barang.nama_barang,tb_barang.merek_barang,tb_barang.spesifikasi,tb_trans_detail.gid 
            FROM tb_trans_detail INNER JOIN tb_barang ON tb_barang.kode_barang = tb_trans_detail.kode_barang WHERE tb_trans_detail.kode_transaksi = '$id'");
        return $query;
    }

    function get_transaksi($id){
        $query = $this->db->query("SELECT tb_trans_keluar.kode_transaksi,tb_trans_keluar.tgl_transaksi,tb_trans_keluar.id_pengguna,tb_pengguna.nama_pengguna,tb_pengguna.id_dept,
            tb_departemen.nama,tb_cabang.namacabang,tb_trans_keluar.id_cabang FROM tb_trans_keluar INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_trans_keluar.id_pengguna INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_trans_keluar.id_cabang
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_trans_keluar.kode_transaksi = '$id'");
        return $query;
    }

    function getpenggunagid() {
        $gid=$this->session->userdata('gid');
        $query=$this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.gid
            FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept 
            WHERE tb_departemen.gid ='$gid' ORDER BY tb_pengguna.nama_pengguna ASC");
        return $query;
    }

    function getcabang() {
        $this->db->order_by('id_cabang', 'ASC');
        return $this->db->get('tb_cabang');
    }

    function getbarang() {
        $this->db->order_by('nama_barang','ASC');
        return $this->db->get('tb_barang');
    }

    function getsupplier() {
        $this->db->order_by('nama_supplier','ASC');
        return $this->db->get('tb_supplier');
    }

    function getkategori() {
        $this->db->order_by('nama_kategori','ASC');
        return $this->db->get('tb_kategori');
    }

    function getkode($id) {
        $kode = array('kode_barang' => $id);
        return $this->db->get_where('tb_barang', $kode);
    }
   
    function simpan_keluar_temp($data) {
        $gid=$this->session->userdata('gid');
        $barang =   $_GET['barang'];
        $qty    =   $_GET['qty'];
        $catatan =  $_GET['catatan'];
        $this->db->order_by('id_trans_detail','DESC');
        $this->db->limit(1);
        $harga=  $this->db->get_where('tb_trans_detail',array('kode_barang'=>$barang,'gid'=>$gid))->row_array();
        $data   =   array(
                    'kode_transaksi'=>0,
                    'tgl_transaksi'=>tanggal(),
                    'kode_barang'=>$barang,
                    'harga'=>$harga['harga'],
                    'qty_keluar'=>$qty,                    
                    'catatan'=>$catatan,
                    'gid'=>$gid);
        // status 1 sudah diproses, 2 belum diproses
        $this->db->insert('tb_trans_detail',$data);
    }

    function tampil_temp(){
        $gid=$this->session->userdata('gid');
        $query=$this->db->query("SELECT tb_trans_detail.id_trans_detail,tb_trans_detail.kode_transaksi,tb_trans_detail.kode_barang,tb_barang.nama_barang,tb_barang.spesifikasi,tb_trans_detail.harga,tb_trans_detail.qty_keluar,
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
        $jenis = "BK-".$kode."-".date('m').".";
        $query = $this->db->query("SELECT max(kode_transaksi) as maxID FROM tb_trans_keluar WHERE kode_transaksi LIKE '$jenis%'");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 10, 3);
        $noUrut++;
        $newID = $jenis . sprintf("%03s", $noUrut);
        return $newID;       
    }
    
    function update_status($kode){
        //$sid = session_id();
        $this->db->query("UPDATE tb_trans_detail SET kode_transaksi='$kode',status='1' WHERE status='0' ");
    }
    function simpan($data) {
        $this->db->insert('tb_trans_keluar', $data);
        return $this->db->insert_id();
    }

    function hapus($kode) {
        $this->db->where('kode_barang', $kode);
        $this->db->delete('tb_barang');
    }
}
