<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_printer extends CI_Model {    

    function semua() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_cabang.namacabang,tb_inv_printer.merk,tb_inv_printer.id_printer,tb_inv_printer.kode_printer,tb_pengguna.nama_pengguna,tb_inv_printer.jenis_printer,
            tb_inv_printer.spesifikasi,tb_inv_printer.tgl_inv,tb_inv_printer.status,tb_inv_printer.isSewa,tb_inv_printer.note,tb_inv_printer.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_dept,tb_inv_printer.aset_hrd
            FROM tb_inv_printer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna
            INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_pengguna.id_cabang
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_printer.status='DIGUNAKAN' OR tb_inv_printer.status ='SIAP DIGUNAKAN' OR tb_inv_printer.status='DIPERBAIKI' ORDER BY tb_inv_printer.id_printer DESC");
        return $query;
    }

    function semuagid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_cabang.namacabang,tb_inv_printer.merk,tb_inv_printer.isSewa,tb_inv_printer.id_printer,tb_inv_printer.kode_printer,tb_pengguna.nama_pengguna,tb_inv_printer.jenis_printer,
            tb_inv_printer.spesifikasi,tb_inv_printer.tgl_inv,tb_inv_printer.status,tb_inv_printer.note,tb_inv_printer.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_dept,tb_inv_printer.aset_hrd
            FROM tb_inv_printer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna 
            INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_pengguna.id_cabang
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_departemen.gid ='$gid' AND tb_inv_printer.status='DIGUNAKAN' OR tb_departemen.gid ='$gid' AND tb_inv_printer.status ='SIAP DIGUNAKAN' OR tb_departemen.gid ='$gid' AND tb_inv_printer.status='DIPERBAIKI' OR tb_departemen.gid ='$gid' AND tb_inv_printer.status='DIPINJAMKAN' ORDER BY tb_inv_printer.id_printer DESC");
        return $query;
    }

    function semua_arsip() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_printer.id_printer,tb_inv_printer.isSewa,tb_inv_printer.kode_printer,tb_pengguna.nama_pengguna,tb_inv_printer.jenis_printer,
            tb_inv_printer.spesifikasi,tb_inv_printer.tgl_inv,tb_inv_printer.status,tb_inv_printer.note,tb_inv_printer.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_dept
            FROM tb_inv_printer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_printer.status='ARSIP/DISIMPAN' OR tb_inv_printer.status ='RUSAK/NOT FIXABLE' OR tb_inv_printer.status='HILANG/DICURI' ORDER BY tb_inv_printer.id_printer DESC");
        return $query;
    }

    function semuagid_arsip() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_printer.id_printer,tb_inv_printer.kode_printer,tb_pengguna.nama_pengguna,tb_inv_printer.jenis_printer,
            tb_inv_printer.spesifikasi,tb_inv_printer.tgl_inv,tb_inv_printer.status,tb_inv_printer.note,tb_inv_printer.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_dept
            FROM tb_inv_printer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_departemen.gid ='$gid' AND tb_inv_printer.status='ARSIP/DISIMPAN' OR tb_departemen.gid ='$gid' AND tb_inv_printer.status ='RUSAK/NOT FIXABLE' OR tb_departemen.gid ='$gid' AND tb_inv_printer.status='HILANG/DICURI' ORDER BY tb_inv_printer.id_printer DESC");
        return $query;
    }

    function get_inv($id) {
        $query = $this->db->query("SELECT tb_cabang.namacabang,tb_inv_printer.aset_hrd,tb_inv_printer.merk,tb_inv_printer.isSewa, tb_inv_printer.id_printer,tb_inv_printer.kode_printer,tb_inv_printer.id_pengguna,tb_inv_printer.harga_beli,tb_pengguna.nama_pengguna,tb_inv_printer.jenis_printer,
            tb_inv_printer.spesifikasi,tb_inv_printer.tgl_inv,tb_inv_printer.status,tb_inv_printer.note,tb_inv_printer.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_dept
            FROM tb_inv_printer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna 
            INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_pengguna.id_cabang
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_printer.kode_printer ='$id' ");
        return $query;
    }

    function get_mutasi($id){
        $query=$this->db->query("SELECT tb_inv_history.id_history,tb_inv_printer.aset_hrd,tb_inv_history.no_inventaris,tb_inv_history.tgl_update,tb_inv_history.status,tb_inv_history.admin,tb_inv_history.id_pengguna_awal,tb_inv_history.id_pengguna,tb_inv_history.lokasi,tb_inv_history.note,tb_inv_printer.jenis_printer,tb_inv_printer.spesifikasi FROM tb_inv_history INNER JOIN tb_inv_printer ON tb_inv_printer.kode_printer = tb_inv_history.no_inventaris WHERE tb_inv_history.id_history ='$id'");
        return $query;
    }

    function getkode($id) {
        $kode = array('kode_printer' => $id);
        return $this->db->get_where('tb_inv_printer', $kode);
    }
   
    function kdotomatis() {
    	$group=$this->db->get_where('tb_group',array('gid'=>$this->session->userdata('gid')))->row_array();
    	$kode=$group['nama_alias'];
        $jenis = "PRI-".$kode."-".date('y');
        $query = $this->db->query("SELECT max(kode_printer) as maxID FROM tb_inv_printer WHERE kode_printer LIKE '$jenis%'");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 10, 3);
        $noUrut++;
        $newID = $jenis . sprintf("%03s", $noUrut);
        return $newID;       
    }

    function getpengguna() {
        $gid=$this->session->userdata('gid');
        $query=$this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna 
            FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept INNER JOIN tb_group ON tb_group.gid = tb_departemen.gid 
            WHERE tb_departemen.gid ='$gid' ORDER BY tb_pengguna.nama_pengguna ASC");
        return $query;
    }
        
    function simpan($data) {
        $this->db->insert('tb_inv_printer', $data);
        return $this->db->insert_id();
    }

    function update($kode,$data) {        
        $this->db->where('kode_printer', $kode);
        $this->db->update('tb_inv_printer', $data);
    }

    function hapus($kode) {
        $this->db->where('id_printer', $kode);
        $this->db->delete('tb_inv_printer');
    }
    function getmerk(){
        $query=$this->db->query("SELECT * 
        	FROM tb_manufacture
        	WHERE jenis ='MERK-PRINTER' ");
        return $query;
    }
    function getsupplier(){
        $query=$this->db->query("SELECT * 
        	FROM tb_supplier
        	WHERE isactive ='True' ");
        return $query;
    }
}
