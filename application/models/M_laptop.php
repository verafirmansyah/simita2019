<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_laptop extends CI_Model {    

    function semua() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_laptop.id_laptop,tb_inv_laptop.kode_laptop,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_laptop.nama_laptop,tb_inv_laptop.spesifikasi,tb_inv_laptop.serial_number,
            tb_inv_laptop.kode_lisensi,tb_inv_laptop.network,tb_inv_laptop.aset_hrd,tb_inv_laptop.tgl_inv,tb_inv_laptop.tgl_garansi,tb_inv_laptop.status,tb_inv_laptop.note,tb_inv_laptop.gid
            FROM tb_inv_laptop INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_laptop.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_laptop.status='DIGUNAKAN' OR tb_inv_laptop.status ='SIAP DIGUNAKAN' OR tb_inv_laptop.status='DIPERBAIKI' ORDER BY tb_inv_laptop.id_laptop DESC ");
        return $query;
    }

    function semuagid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_laptop.id_laptop,tb_inv_laptop.kode_laptop,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_laptop.nama_laptop,tb_inv_laptop.spesifikasi,tb_inv_laptop.serial_number,
            tb_inv_laptop.kode_lisensi,tb_inv_laptop.network,tb_inv_laptop.aset_hrd,tb_inv_laptop.tgl_inv,tb_inv_laptop.tgl_garansi,tb_inv_laptop.status,tb_inv_laptop.note,tb_inv_laptop.gid
            FROM tb_inv_laptop INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_laptop.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_laptop.gid ='$gid' AND tb_inv_laptop.status='DIGUNAKAN' OR tb_inv_laptop.gid ='$gid' AND tb_inv_laptop.status ='SIAP DIGUNAKAN' OR tb_inv_laptop.gid ='$gid' AND tb_inv_laptop.status='DIPERBAIKI' OR tb_inv_laptop.gid ='$gid' AND tb_inv_laptop.status='DIPINJAMKAN' ORDER BY tb_inv_laptop.id_laptop DESC ");
        return $query;
    }

    function semua_arsip() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_laptop.id_laptop,tb_inv_laptop.kode_laptop,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_laptop.nama_laptop,tb_inv_laptop.spesifikasi,tb_inv_laptop.serial_number,
            tb_inv_laptop.kode_lisensi,tb_inv_laptop.network,tb_inv_laptop.aset_hrd,tb_inv_laptop.tgl_inv,tb_inv_laptop.tgl_garansi,tb_inv_laptop.status,tb_inv_laptop.note,tb_inv_laptop.gid
            FROM tb_inv_laptop INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_laptop.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_laptop.status='ARSIP/DISIMPAN' OR tb_inv_laptop.status ='RUSAK/NOT FIXABLE' OR tb_inv_laptop.status='HILANG/DICURI' ORDER BY tb_inv_laptop.id_laptop DESC ");
        return $query;
    }

    function semuagid_arsip() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_laptop.id_laptop,tb_inv_laptop.kode_laptop,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_laptop.nama_laptop,tb_inv_laptop.spesifikasi,tb_inv_laptop.serial_number,
            tb_inv_laptop.kode_lisensi,tb_inv_laptop.network,tb_inv_laptop.aset_hrd,tb_inv_laptop.tgl_inv,tb_inv_laptop.tgl_garansi,tb_inv_laptop.status,tb_inv_laptop.note,tb_inv_laptop.gid
            FROM tb_inv_laptop INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_laptop.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_laptop.gid ='$gid' AND tb_inv_laptop.status='ARSIP/DISIMPAN' OR tb_inv_laptop.gid ='$gid' AND tb_inv_laptop.status ='RUSAK/NOT FIXABLE' OR tb_inv_laptop.gid ='$gid' AND tb_inv_laptop.status='HILANG/DICURI' ORDER BY tb_inv_laptop.id_laptop DESC ");
        return $query;
    }    

    function getall($id) {        
        $query = $this->db->query("SELECT tb_inv_laptop.id_laptop,tb_inv_laptop.kode_laptop,tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_laptop.nama_laptop,tb_inv_laptop.spesifikasi,tb_inv_laptop.serial_number,
            tb_inv_laptop.kode_lisensi,tb_inv_laptop.network,tb_inv_laptop.aset_hrd,tb_inv_laptop.tgl_inv,tb_inv_laptop.tgl_garansi,tb_cabang.namacabang,tb_inv_laptop.harga_beli,tb_inv_laptop.status,tb_inv_laptop.note,tb_inv_laptop.gid,tb_cabang.namacabang,
            tb_lisensi.key_lisensi,tb_lisensi.tgl_habis,tb_lisensi.id_lisensi
            FROM tb_inv_laptop INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_laptop.id_pengguna 
            INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_pengguna.id_cabang
            INNER JOIN tb_lisensi ON tb_lisensi.kode_lisensi = tb_inv_laptop.kode_lisensi
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_laptop.kode_laptop ='$id'");
        return $query;
    }

    function semuadata() {        
        $query = $this->db->query("SELECT tb_inv_laptop.id_laptop,tb_inv_laptop.kode_laptop,tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_laptop.nama_laptop,tb_inv_laptop.spesifikasi,tb_inv_laptop.serial_number,
            tb_inv_laptop.kode_lisensi,tb_inv_laptop.network,tb_inv_laptop.aset_hrd,tb_inv_laptop.tgl_inv,tb_inv_laptop.tgl_garansi,tb_inv_laptop.harga_beli,tb_inv_laptop.status,tb_inv_laptop.note,tb_inv_laptop.gid,tb_cabang.namacabang
            FROM tb_inv_laptop INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_laptop.id_pengguna 
            INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_pengguna.id_cabang
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept");
        return $query;
    }

    function get_inv($id) {        
        $query = $this->db->query("SELECT tb_inv_laptop.id_laptop,tb_inv_laptop.kode_laptop,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_laptop.nama_laptop,tb_inv_laptop.spesifikasi,tb_inv_laptop.serial_number,
            tb_inv_laptop.kode_lisensi,tb_inv_laptop.network,tb_inv_laptop.aset_hrd,tb_inv_laptop.tgl_inv,tb_inv_laptop.tgl_garansi,tb_inv_laptop.harga_beli,tb_inv_laptop.status,tb_inv_laptop.note,tb_inv_laptop.gid
            FROM tb_inv_laptop INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_laptop.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_laptop.kode_laptop ='$id'");
        return $query;
    }

    function getkode($id) {
        $kode = array('kode_laptop' => $id);
        return $this->db->get_where('tb_inv_laptop', $kode);
    }

    function getlisensi(){
        $this->db->order_by('id_lisensi','ASC');
        return $this->db->get('tb_lisensi');
    }

    function get_service($id){
        $kode = array('no_inventaris' => $id);
        return $this->db->get_where('tb_maintenance', $kode);
    }

    function get_history($id){
        $query=$this->db->query("SELECT tb_inv_history.no_inventaris,tb_inv_history.id_history,tb_inv_history.tgl_update,tb_inv_history.status,tb_inv_history.admin,tb_inv_history.id_pengguna,tb_inv_history.note,tb_pengguna.nama_pengguna 
            FROM tb_inv_history INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_history.id_pengguna WHERE tb_inv_history.no_inventaris = '$id'");
        return $query;
    }
	
	function get_history_limit($id){
        $query=$this->db->query("SELECT tb_inv_history.id_history,tb_inv_history.no_inventaris,tb_inv_history.id_pengguna, tb_inv_history.tgl_update FROM tb_inv_history WHERE tb_inv_history.no_inventaris = '$id' ORDER BY tb_inv_history.id_history DESC LIMIT 1,1");
        return $query;
    }

    function get_mutasi($id){
        $query=$this->db->query("SELECT tb_inv_history.id_history,tb_inv_history.no_inventaris,tb_inv_history.tgl_update,tb_inv_history.status,tb_inv_history.admin,tb_inv_history.id_pengguna_awal,tb_inv_history.id_pengguna,tb_inv_history.lokasi,tb_inv_history.note,tb_inv_laptop.nama_laptop,tb_inv_laptop.spesifikasi,tb_inv_laptop.aset_hrd FROM tb_inv_history INNER JOIN tb_inv_laptop ON tb_inv_laptop.kode_laptop = tb_inv_history.no_inventaris WHERE tb_inv_history.id_history ='$id'");
        return $query;
    }
   
    function kdotomatis() {
    	$group=$this->db->get_where('tb_group',array('gid'=>$this->session->userdata('gid')))->row_array();
    	$kode=$group['nama_alias'];
        $jenis = "LAP-".$kode."-".date('y');
        $query = $this->db->query("SELECT max(kode_laptop) as maxID FROM tb_inv_laptop WHERE kode_laptop LIKE '$jenis%'");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 10, 3);
        $noUrut++;
        $newID = $jenis . sprintf("%03s", $noUrut);
        return $newID;       
    }

    function getpengguna() {        
        $query=$this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.gid 
        	FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept 
        	ORDER BY tb_pengguna.nama_pengguna ASC");
        return $query;
    }


    function getpenggunagid() {
        $gid=$this->session->userdata('gid');
        $query=$this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.gid 
        	FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept 
        	WHERE tb_departemen.gid ='$gid' ORDER BY tb_pengguna.nama_pengguna ASC");
        return $query;
    }
        
    function simpan($data) {
        $this->db->insert('tb_inv_laptop', $data);
        return $this->db->insert_id();
    }

    function simpan_history($data2) {
        $this->db->insert('tb_inv_history', $data2);
        return $this->db->insert_id();
    }

    function history($data) {
        $this->db->insert('tb_inv_history', $data);
        return $this->db->insert_id();
    }

    function simpankat($data) {
        $this->db->insert('tb_kategori', $data);
        return $this->db->insert_id();
    }
    
    function update($kode,$data) {        
        $this->db->where('kode_laptop', $kode);
        $this->db->update('tb_inv_laptop', $data);
    }

    function update_mutasi($id,$data) {        
        $this->db->where('id_history', $id);
        $this->db->update('tb_inv_history', $data);
    }

    function hapus($kode) {
        $this->db->where('id_laptop', $kode);
        $this->db->delete('tb_inv_laptop');
    }
    function getmerk(){
        $query=$this->db->query("SELECT * 
        	FROM tb_manufacture
        	WHERE jenis ='MERK-LAPTOP' ");
        return $query;
    }
    function gettipe(){
        $query=$this->db->query("SELECT * 
        	FROM tb_manufacture
        	WHERE jenis ='MODEL-LAPTOP' ");
        return $query;
    }
}
