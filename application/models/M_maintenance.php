<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_maintenance extends CI_Model { 

    function getall($id) {
        $query=$this->db->get_where('tb_maintenance',array('no_permohonan'=>$id));
        return $query;
    }   

    function listid() {
        $gid=$this->session->userdata('gid');
        $this->db->order_by('no_permohonan','DESC');
        return $this->db->get_where('tb_maintenance',array('gid'=>$gid));
    }

    function update_inv($kategori,$no_inv) { 
        if($kategori=='Laptop'){
            return $this->db->query("UPDATE tb_inv_laptop SET status='DIPERBAIKI' WHERE kode_laptop='$no_inv'");
        }elseif ($kategori=='Komputer') {
            return $this->db->query("UPDATE tb_inv_komputer SET status='DIPERBAIKI' WHERE kode_komputer='$no_inv'");
        }elseif ($kategori=='Monitor') {
            return $this->db->query("UPDATE tb_inv_monitor SET status='DIPERBAIKI' WHERE kode_monitor='$no_inv'");
        }elseif ($kategori=='Printer') {
            return $this->db->query("UPDATE tb_inv_printer SET status='DIPERBAIKI' WHERE kode_printer='$no_inv'");
        }else{
            return $this->db->query("UPDATE tb_inv_network SET status='DIPERBAIKI' WHERE kode_network='$no_inv'");
        }
    }

    function update_status($kategori,$no_inv) { 
        if($kategori=='Laptop'){
            return $this->db->query("UPDATE tb_inv_laptop SET status='DIGUNAKAN' WHERE kode_laptop='$no_inv'");
        }elseif ($kategori=='Komputer') {
            return $this->db->query("UPDATE tb_inv_komputer SET status='DIGUNAKAN' WHERE kode_komputer='$no_inv'");
        }elseif ($kategori=='Monitor') {
            return $this->db->query("UPDATE tb_inv_monitor SET status='DIGUNAKAN' WHERE kode_monitor='$no_inv'");
        }elseif ($kategori=='Printer') {
            return $this->db->query("UPDATE tb_inv_printer SET status='DIGUNAKAN' WHERE kode_printer='$no_inv'");
        }else{
            return $this->db->query("UPDATE tb_inv_network SET status='DIGUNAKAN' WHERE kode_network='$no_inv'");
        }
    }
	
	function detail($id){
        return $this->db->get_where('tb_maintenance_detail',array('no_permohonan'=>$id));
    }
	
    function kdotomatis($id) {       
        $jenis = "MTC".$id.".".date('md').".";
        $query = $this->db->query("SELECT max(no_permohonan) as maxID FROM tb_maintenance WHERE no_permohonan LIKE '$jenis%'");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 8, 3);
        $noUrut++;
        $newID = $jenis . sprintf("%03s", $noUrut);
        return $newID;       
    }

    function getKategori() {
        return $this->db->get("tb_kategori");
    }
        
    function simpan($data) {
        $this->db->insert('tb_maintenance', $data);
        return $this->db->insert_id();
    }    

    function simpan_detail($data) {
        $this->db->insert('tb_maintenance_detail', $data);
        return $this->db->insert_id();
    }  

    function update($kode,$data) {        
        $this->db->where('no_permohonan', $kode);
        $this->db->update('tb_maintenance', $data);
    }

}
