<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_network extends CI_Model {    

    function semua1() {
        $this->db->order_by('id_network','DESC');
        return $this->db->get('tb_inv_network');
    }

    function semua() {
        $gid=$this->session->userdata('gid');
        $query= $this->db->query("SELECT tb_inv_network.id_network,tb_inv_network.kode_network,tb_inv_network.lokasi,tb_inv_network.jenis_network,tb_inv_network.spesifikasi,tb_inv_network.tgl_inv,tb_inv_network.harga_beli,tb_inv_network.status,tb_inv_network.gid FROM tb_inv_network WHERE tb_inv_network.status='DIGUNAKAN' OR tb_inv_network.status='DIPERBAIKI' OR tb_inv_network.status='SIAP DIGUNAKAN' ORDER BY tb_inv_network.id_network DESC");
        return $query;
    }

    function semuagid() {
        $gid=$this->session->userdata('gid');
        $query= $this->db->query("SELECT tb_inv_network.id_network,tb_inv_network.kode_network,tb_inv_network.lokasi,tb_inv_network.jenis_network,tb_inv_network.spesifikasi,tb_inv_network.tgl_inv,tb_inv_network.harga_beli,tb_inv_network.status,tb_inv_network.gid FROM tb_inv_network 
		WHERE tb_inv_network.gid ='$gid' AND tb_inv_network.status='DIGUNAKAN' 
		OR tb_inv_network.gid ='$gid' AND tb_inv_network.status='DIPERBAIKI' 
		OR tb_inv_network.gid ='$gid' AND tb_inv_network.status='SIAP DIGUNAKAN' 
		OR tb_inv_network.gid ='$gid' AND tb_inv_network.status='DIPINJAMKAN' 
		ORDER BY tb_inv_network.id_network DESC");
        return $query;
    }

    function semua_arsip() {
        $gid=$this->session->userdata('gid');
        $query= $this->db->query("SELECT tb_inv_network.id_network,tb_inv_network.kode_network,tb_inv_network.lokasi,tb_inv_network.jenis_network,tb_inv_network.spesifikasi,tb_inv_network.tgl_inv,tb_inv_network.harga_beli,tb_inv_network.status,tb_inv_network.gid FROM tb_inv_network WHERE tb_inv_network.status='ARSIP/DISIMPAN' OR tb_inv_network.status='RUSAK/NOT FIXABLE' OR tb_inv_network.status='HILANG/DICURI' ORDER BY tb_inv_network.id_network DESC");
        return $query;
    }

    function semuagid_arsip() {
        $gid=$this->session->userdata('gid');
        $query= $this->db->query("SELECT tb_inv_network.id_network,tb_inv_network.kode_network,tb_inv_network.lokasi,tb_inv_network.jenis_network,tb_inv_network.spesifikasi,tb_inv_network.tgl_inv,tb_inv_network.harga_beli,tb_inv_network.status,tb_inv_network.gid FROM tb_inv_network 
		WHERE tb_inv_network.gid ='$gid' AND tb_inv_network.status='ARSIP/DISIMPAN' 
		OR tb_inv_network.gid ='$gid' AND tb_inv_network.status='RUSAK/NOT FIXABLE' 
		OR tb_inv_network.gid ='$gid' AND tb_inv_network.status='HILANG/DICURI' 
		ORDER BY tb_inv_network.id_network DESC");
        return $query;
    }

    function get_inv($id) {
        $kode = array('kode_network' => $id);
        return $this->db->get_where('tb_inv_network', $kode);
    }

    function getkode($id) {
        $kode = array('kode_network' => $id);
        return $this->db->get_where('tb_inv_network', $kode);
    }
   
    function kdotomatis() {
    	$group=$this->db->get_where('tb_group',array('gid'=>$this->session->userdata('gid')))->row_array();
    	$kode=$group['nama_alias'];
        $jenis = "NET-".$kode."-".date('y');
        $query = $this->db->query("SELECT max(kode_network) as maxID FROM tb_inv_network WHERE kode_network LIKE '$jenis%'");
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

    function get_history($id){
        return $this->db->get_where('tb_inv_history',array('no_inventaris'=>$id));        
    }

    function get_mutasi($id){
        $query=$this->db->query("SELECT tb_inv_history.id_history,tb_inv_history.no_inventaris,tb_inv_history.tgl_update,tb_inv_history.status,tb_inv_history.admin,tb_inv_history.id_pengguna,tb_inv_history.lokasi,tb_inv_history.note,tb_inv_network.jenis_network,tb_inv_network.spesifikasi FROM tb_inv_history INNER JOIN tb_inv_network ON tb_inv_network.kode_network = tb_inv_history.no_inventaris WHERE tb_inv_history.id_history ='$id'");
        return $query;
    }
        
    function simpan($data) {
        $this->db->insert('tb_inv_network', $data);
        return $this->db->insert_id();
    }

    function simpan_history($data2) {
        $this->db->insert('tb_inv_history', $data2);
        return $this->db->insert_id();
    }

    function update($kode,$data) {        
        $this->db->where('kode_network', $kode);
        $this->db->update('tb_inv_network', $data);
    }

    function hapus($kode) {
        $this->db->where('id_network', $kode);
        $this->db->delete('tb_inv_network');
    }
}
