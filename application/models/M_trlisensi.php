<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_stok extends CI_Model {    

    function list_barang($id) {
        $query = $this->db->query("SELECT tb_barang.kode_barang,tb_kategori.nama_kategori,tb_barang.nama_barang,
            tb_barang.merek_barang,tb_barang.spesifikasi,tb_barang.satuan FROM tb_barang INNER JOIN tb_kategori ON tb_kategori.id_kategori = tb_barang.id_kategori 
            WHERE tb_barang.kode_barang='$id' ");
        return $query;
    }   

    function detail($id){
        $gid=$this->session->userdata('gid');
        $this->db->order_by('id_trans_detail','ASC');
        return $this->db->get_where('tb_trans_detail',array('kode_barang'=>$id,'gid'=>$gid));

    }
    function list_lisensi() {
        $query = $this->db->query("SELECT tb_barang.kode_barang,tb_kategori.nama_kategori,tb_barang.nama_barang,
            tb_barang.merek_barang,tb_barang.spesifikasi,tb_barang.satuan FROM tb_barang INNER JOIN tb_kategori ON tb_kategori.id_kategori = tb_barang.id_kategori 
            ORDER BY tb_barang.kode_barang DESC");
        return $query;
    }   

    function list_lisensiid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_barang.kode_barang,tb_kategori.nama_kategori,tb_barang.nama_barang,
            tb_barang.merek_barang,tb_barang.spesifikasi,tb_barang.satuan FROM tb_barang INNER JOIN tb_kategori ON tb_kategori.id_kategori = tb_barang.id_kategori 
            WHERE tb_barang.gid='$gid' ORDER BY tb_barang.kode_barang DESC");
        return $query;
    }
}

//    function detail($id) {
//        $query = $this->db->query("SELECT tb_trans_detail.tgl_transaksi,tb_cabang.namacabang,tb_trans_detail.kode_transaksi,tb_trans_detail.catatan,
//        tb_trans_detail.qty_masuk,tb_trans_detail.qty_keluar FROM tb_trans_detail 
//        INNER JOIN tb_trans_detail.id_cabang ON tb_cabang.id_cabang
//        WHERE tb_trans_detail.kode_barang='$id' ");
//        return $query;
//    }