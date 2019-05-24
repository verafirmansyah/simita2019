<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_barang extends CI_Model { 

    function list_barang() {
        $query = $this->db->query("SELECT tb_barang.kode_barang,tb_kategori.nama_kategori,tb_barang.nama_barang,
            tb_barang.merek_barang,tb_barang.spesifikasi,tb_barang.satuan FROM tb_barang INNER JOIN tb_kategori ON tb_kategori.id_kategori = tb_barang.id_kategori 
            ORDER BY tb_barang.kode_barang DESC");
        return $query;
    }   

    function list_barangid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_barang.kode_barang,tb_kategori.nama_kategori,tb_barang.nama_barang,
            tb_barang.merek_barang,tb_barang.spesifikasi,tb_barang.satuan FROM tb_barang INNER JOIN tb_kategori ON tb_kategori.id_kategori = tb_barang.id_kategori 
            WHERE tb_barang.gid='$gid' ORDER BY tb_barang.kode_barang DESC");
        return $query;
    }

    function getkode($id) {
        $kode = array('kode_barang' => $id);
        return $this->db->get_where('tb_barang', $kode);
    }
   
    function kdotomatis() {
        $jenis = "B0".date('y').".";
        $query = $this->db->query("SELECT max(kode_barang) as maxID FROM tb_barang WHERE kode_barang LIKE '$jenis%'");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 5, 4);
        $noUrut++;
        $newID = $jenis . sprintf("%04s", $noUrut);
        return $newID;
       
    }

    function getKategori() {
        return $this->db->get("tb_kategori");
    }

    function getMerek() {
        return $this->db->get("tb_manufacture");
    }
        
    function simpan($data) {
        $this->db->insert('tb_barang', $data);
        return $this->db->insert_id();
    }

    function simpankat($data) {
        $this->db->insert('tb_kategori', $data);
        return $this->db->insert_id();
    }

    function edit($kode,$data) {        
        $this->db->where('kode_barang', $kode);
        $this->db->update('tb_barang', $data);
    }

    function hapus($kode) {
        $this->db->where('kode_barang', $kode);
        $this->db->delete('tb_barang');
    }
}
