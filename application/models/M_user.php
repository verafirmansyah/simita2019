<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {

    private $table = "tb_user";

   function login($username, $password) {
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        return $this->db->get("tb_user");
    }

    function semua() {
        return $this->db->get("tb_user");
    }

    function cekKode($kode) {
        $this->db->where("username", $kode);
        return $this->db->get("tb_user");
    }

    function cekId($kode) {
        $this->db->where("id_user", $kode);
        return $this->db->get("user");
    }

    function update($id, $info) {
        $this->db->where("u_id", $id);
        $this->db->update("user", $info);
    }

    function simpan($info) {
        $this->db->insert("user", $info);
    }

    function hapus($kode) {
        $this->db->where("u_id", $kode);
        $this->db->delete("user");
    }
}
