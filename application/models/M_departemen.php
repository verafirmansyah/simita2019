<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_departemen extends CI_Model {    

    function semua() {
        //$this->db->order_by("id_departemen", "DESC");
        return $this->db->get("tb_departemen");
    }
    
    function treeview() {
        //$this->db->order_by("id_departemen", "DESC");
        return $this->db->get_where('tb_departemen', array('parent' => 0,'gid'=>$this->session->userdata('gid')));        
    }
 
    function simpan($data) {
        $this->db->insert('tb_departemen', $data);
        return $this->db->insert_id();
    }

    function getkode($id) {
        $kode = array('id_dept' => $id);
        return $this->db->get_where('tb_departemen', $kode);
    }
    
    function edit($kode,$data) {        
        $this->db->where('id_dept',$kode);
        $this->db->update('tb_departemen', $data);
    }

    function hapus($kode) {
        $this->db->where('id_dept', $kode);
        $this->db->delete('tb_departemen');
    }
}
