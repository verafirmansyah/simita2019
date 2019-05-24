<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_model extends CI_Model {    

   function list_model() {
        $query = $this->db->query("SELECT tb_manufacture.nama_manufacture,tb_tipe.tipe,tb_tipe.id_tipe
            FROM tb_tipe INNER JOIN tb_manufacture ON tb_manufacture.id_manufacture = tb_tipe.id_manufacture
            ORDER BY tb_tipe.id_tipe DESC");
        return $query;
    } 
    function list_manufactureid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT * FROM tb_manufacture 
            ORDER BY tb_manufacture.id_manufacture DESC");
        return $query;
    }

    function semua() {
        $this->db->order_by("id_tipe", "DESC");
        return $this->db->get("tb_tipe");
    }

    function getmanufacture() {
        return $this->db->get('tb_manufacture');
    }

    function getkode($id) {
        $kode = array('id_tipe' => $id);
        return $this->db->get_where('tb_tipe', $kode);
    }

    function simpan($data) {
        $this->db->insert('tb_tipe', $data);
        return $this->db->insert_id();
    }

    function edit($kode,$data) {        
        $this->db->where('id_tipe', $kode);
        $this->db->update('tb_tipe', $data);
    }

    function hapus($kode) {
        $this->db->where('id_tipe', $kode);
        $this->db->delete('tb_tipe');
    }
}
