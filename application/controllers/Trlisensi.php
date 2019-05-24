<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stok extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('m_stok','m_barang'));
        chek_session();
    }
	
    function index() {        
        $this->template->display('transaksi/stok/view');              
    }		
   
    function view_data_stok(){
        if ($this->session->userdata('role')=='Administrator'){
            $ambildata=$this->m_trlisensi->list_lisensi()->result();
        }else{
            $ambildata=$this->m_trlisensi->list_lisensiid()->result();
        }  
        $no=1;
        foreach($ambildata as $r) {
            if (chek_stok($r->kode_barang)>0){
                $stok="<span class='label label-success'>" . chek_stok($r->kode_barang) . "</span>";
            }else {
                $stok="<span class='label label-danger'>" . chek_stok($r->kode_barang) . "</span>";
            }
            $query[] = array(
                'no'=>$no++,
                'kode_barang'=>$r->kode_barang,
                'nama_kategori'=>$r->nama_kategori,                
                'nama_barang'=>$r->nama_barang,  
                'merek_barang'=>$r->merek_barang, 
                'spesifikasi'=>$r->spesifikasi, 
                'satuan'=>'<center>'.$r->satuan.'</center>',         
                'stok'=>'<center>'.$stok.'</center>',
                'view'=>anchor('stok/detail/' . $r->kode_barang, '<i class="btn btn-info btn-sm fa fa-eye" data-toggle="tooltip" title="View Detail"></i>'),                 
            );
        }        
        $result=array('data'=>$query);
        echo  json_encode($result);
    }  

    function detail($id) {  
        $data['record']=$this->m_stok->list_barang($id)->row_array(); 
        $data['detail']=$this->m_stok->detail($id)->result();     
        $this->template->display('transaksi/stok/detail',$data);              
    }   

    function detail_print($id) {  
        $data['record']=$this->m_stok->list_barang($id)->row_array(); 
        $data['detail']=$this->m_stok->detail($id)->result();     
        $this->load->view('transaksi/stok/detail_print',$data);              
    }   
}
