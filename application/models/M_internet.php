<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_internet extends CI_Model {    

    function semua() {
        $this->db->order_by("id_internet", "DESC");
        return $this->db->get("tb_internet");
    }
    function kdotomatis() {
        $group=$this->db->get_where('tb_group',array('gid'=>$this->session->userdata('gid')))->row_array();
        $kode=$group['nama_alias'];
        $jenis = "KIC-".$kode."-".date('m').".";
        $query = $this->db->query("SELECT max(kode_internet) as maxID FROM tb_internet WHERE kode_internet");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 10, 3);
        $noUrut++;
        $newID = $jenis . sprintf("%03s", $noUrut);
        return $newID;       
    }

    function getkode($id) {
        $kode = array('id_internet' => $id);
        return $this->db->get_where('tb_internet', $kode);
    }

    function simpan($data) {
        $this->db->insert('tb_internet', $data);
        return $this->db->insert_id();
    }

    function edit($kode,$data) {        
        $this->db->where('id_internet', $kode);
        $this->db->update('tb_internet', $data);
    }

    function hapus($kode) {
        $this->db->where('id_internet', $kode);
        $this->db->delete('tb_internet');
    }
    function getpenggunagid() {
        $gid=$this->session->userdata('gid');
        $query=$this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.gid 
            FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept 
            WHERE tb_departemen.gid ='$gid' ORDER BY tb_pengguna.nama_pengguna ASC");
        return $query;
    }

    function getcabang(){
        $this->db->order_by('id_cabang','ASC');
        return $this->db->get('tb_cabang');
    }

    function getprovider(){
        $this->db->order_by('id_provider','ASC');
        return $this->db->get('tb_provider');
    }

    function getall($id) {        
        $query = $this->db->query("SELECT tb_internet.nama_provider,tb_internet.nama_cabang,tb_internet.nomor_pelanggan,tb_internet.ip_public,tb_internet.spesifikasi,tb_internet.tanggal_kontrak,tb_internet.masa_kontrak,tb_internet.status,tb_internet.biaya,tb_provider.telpon_provider,tb_provider.nama_sales,tb_provider.nama_sales,tb_provider.email_provider,tb_provider.telpon_sales,tb_internet.tipe_koneksi
            FROM tb_internet INNER JOIN tb_provider ON tb_internet.nama_provider = tb_provider.nama_provider WHERE tb_internet.id_internet='$id'");
        return $query;
    }


}
