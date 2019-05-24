<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_mikrotik extends CI_Model {    

    function semua() {        
        $query = $this->db->query("SELECT tb_lisensi.id_lisensi,tb_cabang.namacabang,tb_lisensi.jenis_lisensi,tb_lisensi.tgl_pembelian,tb_lisensi.tgl_habis,
        tb_lisensi.key_lisensi,tb_supplier.nama_supplier
            FROM tb_lisensi INNER JOIN tb_cabang ON tb_lisensi.id_cabang = tb_cabang.id_cabang
            INNER JOIN tb_supplier ON tb_lisensi.id_supplier = tb_supplier.id_supplier");
        return $query;
    }
    function kdotomatis() {
        $group=$this->db->get_where('tb_group',array('gid'=>$this->session->userdata('gid')))->row_array();
        $kode=$group['nama_alias'];
        $jenis = "MKT-".$kode."-".date('m').date('y');
        $query = $this->db->query("SELECT max(kode_mikrotik) as maxID FROM tb_mikrotik WHERE kode_mikrotik");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 10, 3);
        $noUrut++;
        $newID = $jenis . sprintf("%03s", $noUrut);
        return $newID;       
    }

    function getkode($id) {
        $kode = array('id_mikrotik' => $id);
        return $this->db->get_where('tb_mikrotik', $kode);
    }

    function simpan($data) {
        $this->db->insert('tb_mikrotik', $data);
        return $this->db->insert_id();
    }

    function edit($kode,$data) {        
        $this->db->where('id_mikrotik', $kode);
        $this->db->update('tb_mikrotik', $data);
    }

    function hapus($kode) {
        $this->db->where('id_mikrotik', $kode);
        $this->db->delete('tb_mikrotik');
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

    function getsupplier(){
        $this->db->order_by('id_supplier','ASC');
        return $this->db->get('tb_supplier');
    }

    function getall($id) {        
        $query = $this->db->query("SELECT tb_cabang.namacabang,tb_supplier.nama_supplier,tb_supplier.nama_pic,tb_supplier.telepon,
        tb_lisensi.id_lisensi,tb_lisensi.keterangan,tb_lisensi.kode_lisensi,tb_lisensi.jenis_lisensi,tb_lisensi.key_lisensi,tb_lisensi.tgl_pembelian,tb_lisensi.tgl_habis,tb_lisensi.jumlah_lisensi
            FROM tb_lisensi INNER JOIN tb_cabang ON tb_lisensi.id_lisensi= tb_cabang.id_cabang
            INNER JOIN tb_supplier ON tb_lisensi.id_supplier = tb_supplier.id_supplier WHERE tb_lisensi.id_lisensi='$id'");
        return $query;
    }

    function view_inventaris($id) {        
        $query = $this->db->query("SELECT tb_inv_laptop.kode_laptop,tb_inv_laptop.aset_hrd,tb_inv_laptop.kode_lisensi,
            tb_lisensi.kode_lisensi,tb_lisensi.tgl_habis,tb_lisensi.id_lisensi
            FROM tb_inv_laptop INNER JOIN tb_lisensi ON tb_inv_laptop.kode_lisensi = tb_lisensi.kode_lisensi
            WHERE tb_lisensi.id_lisensi='$id'");
        return $query;
    }


}
