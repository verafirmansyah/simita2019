<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_web extends CI_Model { 

    function group() {
        return $this->db->get('tb_group');
    } 
	
    function simpan($data) {
        $this->db->insert('tb_maintenance', $data);
        return $this->db->insert_id();
    } 

    function simpan_detail($data) {
        $this->db->insert('tb_maintenance_detail', $data);
        return $this->db->insert_id();
    } 

    function list_ticket($limit,$start) {
        $id=$this->session->userdata('group_id');
        $this->db->order_by('no_permohonan','DESC')->limit($limit,$start);
        return $this->db->get_where('tb_maintenance',array('status'=>'OPEN','gid'=>$id));
    }

    function view_detail($kode){
        return $this->db->get_where('tb_maintenance_detail',array('no_permohonan'=>$kode));
    }

    function list_ticket_close($id) {
        $this->db->order_by('no_permohonan','DESC')->limit('5');
        return $this->db->get_where('tb_maintenance',array('status'=>'CLOSED','gid'=>$id));
    }

    function list_ticket_progress($id){
        $this->db->order_by('no_permohonan','DESC')->limit('10');
        return $this->db->get_where('tb_maintenance',array('status'=>'PROCESS','gid'=>$id));
    }

    function ticket_num_rows($id) {
        return $this->db->get_where('tb_maintenance',array('status'=>'OPEN','gid'=>$id))->num_rows();
    }

    function num_rows_close() {
        return $this->db->get_where('tb_maintenance',array('status'=>'CLOSED'))->num_rows();
    }
}
