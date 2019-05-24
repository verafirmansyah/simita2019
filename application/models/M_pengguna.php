<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_pengguna extends CI_Model {    

    function semua() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nik,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_jabatan,tb_pengguna.id_cabang,tb_pengguna.ruang_kantor,tb_jabatan.nama_jabatan,tb_jabatan.jobdes,tb_cabang.namacabang
            FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept
            INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_pengguna.id_cabang
            INNER JOIN tb_jabatan ON tb_jabatan.id_jabatan = tb_pengguna.id_jabatan ORDER BY tb_pengguna.id_pengguna DESC");
        return $query;
    }

    function semuagid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nik,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_jabatan,tb_pengguna.ruang_kantor,tb_jabatan.nama_jabatan,tb_jabatan.jobdes,tb_cabang.namacabang
            FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept
            INNER JOIN tb_cabang ON tb_cabang.id_cabang = tb_pengguna.id_cabang 
            INNER JOIN tb_jabatan ON tb_jabatan.id_jabatan = tb_pengguna.id_jabatan WHERE tb_departemen.gid ='$gid' ORDER BY tb_pengguna.id_pengguna DESC");
        return $query;
    }

    function getdepartemen() {        
        return $this->db->get_where('tb_departemen', array('parent'=>0));
    }

    function getdepartemengid() {        
        return $this->db->get_where('tb_departemen', array('parent'=>0,'gid'=>$this->session->userdata('gid')));
    }
   
    function getjabatan() {        
        return $this->db->get('tb_jabatan');
    }    

    function getcabang() {
        return $this->db->get('tb_cabang');
    }

    function kdotomatis2() {
        $jenis = "U0".date('y').".";
        $query = mysql_query("SELECT max(id_pengguna) as maxID FROM tb_pengguna WHERE id_pengguna LIKE '$jenis%'");
        $data = mysql_fetch_array($query);
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 5, 4);
        $noUrut++;
        $newID = $jenis . sprintf("%04s", $noUrut);
        return $newID;
       
    }   

    function kdotomatis() {
        $jenis = "U0".date('y').".";
        $query = $this->db->query("SELECT max(id_pengguna) as maxID FROM tb_pengguna WHERE id_pengguna LIKE '$jenis%'");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 5, 4);
        $noUrut++;
        $newID = $jenis . sprintf("%04s", $noUrut);
        return $newID;
       
    }       

    function getpengguna($id) {       
        $query = $this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nik,tb_pengguna.nama_pengguna,tb_departemen.id_dept,
            tb_departemen.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_jabatan,tb_pengguna.id_cabang,tb_pengguna.ruang_kantor
            FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept
            WHERE tb_pengguna.id_pengguna ='$id'");
        return $query;
    }
    
    function getkode($id) {
        $kode = array('id_pengguna' => $id);
        return $this->db->get_where('tb_pengguna', $kode);
    }

    function simpan($data) {
        $this->db->insert('tb_pengguna', $data);
        return $this->db->insert_id();
    }

    function simpanjab($data) {
        $this->db->insert('tb_jabatan', $data);
        return $this->db->insert_id();
    }

    function edit($kode,$data) {        
        $this->db->where('id_pengguna', $kode);
        $this->db->update('tb_pengguna', $data);
    }

    function hapus($kode) {
        $this->db->where('id_pengguna', $kode);
        $this->db->delete('tb_pengguna');
    } 


}
