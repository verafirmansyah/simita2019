<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_provider extends CI_Model {    

    function semua() {
        $this->db->order_by("id_provider", "DESC");
        return $this->db->get("tb_provider");
    }

    function getkode($id) {
        $kode = array('id_provider' => $id);
        return $this->db->get_where('tb_provider', $kode);
    }

    function simpan($data) {
        $this->db->insert('tb_provider', $data);
        return $this->db->insert_id();
    }

    function edit($kode,$data) {        
        $this->db->where('id_provider', $kode);
        $this->db->update('tb_provider', $data);
    }

    function hapus($kode) {
        $this->db->where('id_provider', $kode);
        $this->db->delete('tb_provider');
    }
}
