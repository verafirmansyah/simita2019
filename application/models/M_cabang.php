<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_cabang extends CI_Model {    

   function list_cabang() {
        $query = $this->db->query("SELECT tb_cabang.id_cabang,tb_cabang.namacabang,tb_cabang.wilayah FROM tb_cabang
            ORDER BY tb_cabang.id_cabang DESC");
        return $query;
    } 
    function list_cabangid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_cabang.namacabang,tb_cabang.wilayah FROM tb_cabang 
            ORDER BY tb_cabang.id_cabang DESC");
        return $query;
    }

    function semua() {
        $this->db->order_by("id_cabang", "DESC");
        return $this->db->get("tb_cabang");
    }

    function getkode($id) {
        $kode = array('id_cabang' => $id);
        return $this->db->get_where('tb_cabang', $kode);
    }

    function simpan($data) {
        $this->db->insert('tb_cabang', $data);
        return $this->db->insert_id();
    }

    function edit($kode,$data) {        
        $this->db->where('id_cabang', $kode);
        $this->db->update('tb_cabang', $data);
    }

    function hapus($kode) {
        $this->db->where('id_cabang', $kode);
        $this->db->delete('tb_cabang');
    }
    function getwilayah(){
        $this->db->order_by('gid','ASC');
        return $this->db->get('tb_group');
    }
}
