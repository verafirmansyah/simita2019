<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_komputer extends CI_Model {    

    function semua() {        
        $query = $this->db->query("SELECT tb_inv_komputer.id_komputer,tb_inv_komputer.kode_komputer,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_komputer.nama_komputer,tb_inv_komputer.spesifikasi,tb_inv_komputer.serial_number,tb_inv_komputer.kode_lisensi,
            tb_inv_komputer.network,tb_inv_komputer.tgl_inv,tb_inv_komputer.tgl_garansi,tb_inv_komputer.status,tb_inv_komputer.note,tb_inv_komputer.gid,tb_inv_komputer.aset_hrd,tb_cabang.namacabang
            FROM tb_inv_komputer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_komputer.id_pengguna 
            INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_pengguna.id_cabang
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_komputer.status='DIGUNAKAN' OR tb_inv_komputer.status ='SIAP DIGUNAKAN' OR tb_inv_komputer.status='DIPERBAIKI' ORDER BY tb_inv_komputer.id_komputer DESC");
        return $query;
    }

    function semuagid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_komputer.id_komputer,tb_inv_komputer.kode_komputer,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_komputer.nama_komputer,tb_inv_komputer.spesifikasi,tb_inv_komputer.serial_number,tb_inv_komputer.kode_lisensi,
            tb_inv_komputer.network,tb_inv_komputer.tgl_inv,tb_inv_komputer.tgl_garansi,tb_inv_komputer.status,tb_inv_komputer.note,tb_inv_komputer.gid,tb_inv_komputer.aset_hrd 
            FROM tb_inv_komputer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_komputer.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_komputer.gid ='$gid' AND tb_inv_komputer.status='DIGUNAKAN' OR tb_inv_komputer.gid ='$gid' AND tb_inv_komputer.status ='SIAP DIGUNAKAN' OR tb_inv_komputer.gid ='$gid' AND tb_inv_komputer.status='DIPERBAIKI' OR tb_inv_komputer.gid ='$gid' AND tb_inv_komputer.status='DIPINJAMKAN' ORDER BY tb_inv_komputer.id_komputer DESC");
        return $query;
    }

    function semua_arsip() {        
        $query = $this->db->query("SELECT tb_inv_komputer.id_komputer,tb_inv_komputer.kode_komputer,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_komputer.nama_komputer,tb_inv_komputer.spesifikasi,tb_inv_komputer.serial_number,tb_inv_komputer.kode_lisensi,
            tb_inv_komputer.network,tb_inv_komputer.tgl_inv,tb_inv_komputer.tgl_inv,tb_inv_komputer.status,tb_inv_komputer.note,tb_inv_komputer.gid 
            FROM tb_inv_komputer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_komputer.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_komputer.status='ARSIP/DISIMPAN' OR tb_inv_komputer.status ='RUSAK/NOT FIXABLE' OR tb_inv_komputer.status='HILANG/DICURI' ORDER BY tb_inv_komputer.id_komputer DESC");
        return $query;
    }

    function semuagid_arsip() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_komputer.id_komputer,tb_inv_komputer.kode_komputer,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.nama,tb_departemen.parent,tb_inv_komputer.nama_komputer,tb_inv_komputer.spesifikasi,tb_inv_komputer.serial_number,tb_inv_komputer.kode_lisensi,
            tb_inv_komputer.network,tb_inv_komputer.tgl_inv,tb_inv_komputer.tgl_garansi,tb_inv_komputer.status,tb_inv_komputer.note,tb_inv_komputer.gid 
            FROM tb_inv_komputer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_komputer.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_komputer.gid ='$gid' AND tb_inv_komputer.status='ARSIP/DISIMPAN' OR tb_inv_komputer.gid ='$gid' AND tb_inv_komputer.status ='RUSAK/NOT FIXABLE' OR tb_inv_komputer.gid ='$gid' AND tb_inv_komputer.status='HILANG/DICURI' ORDER BY tb_inv_komputer.id_komputer DESC");
        return $query;
    }
    function get_inv($id) {        
        $query = $this->db->query("SELECT tb_inv_komputer.id_komputer,tb_inv_komputer.tipe,tb_inv_komputer.kode_komputer,tb_inv_komputer.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.id_dept,tb_departemen.nama,tb_departemen.parent,tb_inv_komputer.nama_komputer,tb_inv_komputer.spesifikasi,tb_inv_komputer.serial_number,tb_inv_komputer.kode_lisensi,tb_inv_komputer.network,tb_inv_komputer.tgl_inv,tb_inv_komputer.tgl_garansi,tb_inv_komputer.harga_beli,
        tb_inv_komputer.status,tb_inv_komputer.note,tb_inv_komputer.gid,tb_inv_komputer.aset_hrd,tb_cabang.namacabang,tb_lisensi.key_lisensi,tb_lisensi.tgl_habis,tb_lisensi.id_lisensi
            FROM tb_inv_komputer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_komputer.id_pengguna 
            INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_pengguna.id_cabang
            INNER JOIN tb_lisensi ON tb_lisensi.kode_lisensi = tb_inv_komputer.kode_lisensi
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_komputer.kode_komputer ='$id' ");
        return $query;
    }

    function getkode($id) {
        $kode = array('kode_komputer' => $id);
        return $this->db->get_where('tb_inv_komputer', $kode);
    }
   
    function kdotomatis() {
    	$group=$this->db->get_where('tb_group',array('gid'=>$this->session->userdata('gid')))->row_array();
    	$kode=$group['nama_alias'];
        $jenis = "CPU-".$kode."-".date('y');
        $query = $this->db->query("SELECT max(kode_komputer) as maxID FROM tb_inv_komputer WHERE kode_komputer LIKE '$jenis%'");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 10, 3);
        $noUrut++;
        $newID = $jenis . sprintf("%03s", $noUrut);
        return $newID;       
    }

    function get_mutasi($id){
        $query=$this->db->query("SELECT tb_inv_history.id_history,tb_inv_history.no_inventaris,tb_inv_history.tgl_update,tb_inv_history.status,tb_inv_history.admin,tb_inv_history.id_pengguna_awal,tb_inv_history.id_pengguna,tb_inv_history.lokasi,tb_inv_history.note,tb_inv_komputer.nama_komputer,tb_inv_komputer.aset_hrd,tb_inv_komputer.spesifikasi FROM tb_inv_history INNER JOIN tb_inv_komputer ON tb_inv_komputer.kode_komputer = tb_inv_history.no_inventaris WHERE tb_inv_history.id_history ='$id'");
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
        $this->db->insert('tb_inv_komputer', $data);
        return $this->db->insert_id();
    }

    function update($kode,$data) {        
        $this->db->where('kode_komputer', $kode);
        $this->db->update('tb_inv_komputer', $data);
    }

    function hapus($kode) {
        $this->db->where('id_komputer', $kode);
        $this->db->delete('tb_inv_komputer');
    }
    function getmerk(){
        $query=$this->db->query("SELECT * 
        	FROM tb_manufacture
        	WHERE jenis ='MERK-PC' ");
        return $query;
    }
    function gettipe(){
        $query=$this->db->query("SELECT * 
        	FROM tb_manufacture
        	WHERE jenis ='MODEL-PC' ");
        return $query;
    }
    function getlisensi(){
        $this->db->order_by('id_lisensi','ASC');
        return $this->db->get('tb_lisensi');
    }
}
