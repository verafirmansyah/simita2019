<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_supplier extends CI_Model {    

    function semua() {
        $this->db->order_by("id_supplier", "DESC");
        return $this->db->get("tb_supplier");
    }

    function getkode($id) {
        $kode = array('id_supplier' => $id);
        return $this->db->get_where('tb_supplier', $kode);
    }

    function simpan($data) {
        $this->db->insert('tb_supplier', $data);
        return $this->db->insert_id();
    }

    function edit($kode,$data) {        
        $this->db->where('id_supplier', $kode);
        $this->db->update('tb_supplier', $data);
    }

    function hapus($kode) {
        $this->db->where('id_supplier', $kode);
        $this->db->delete('tb_supplier');
    }
}
