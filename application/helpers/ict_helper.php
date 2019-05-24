<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function chek_session() {
    $ci = & get_instance();
    if ($ci->session->userdata('status_login') !== 'login_diterima') {
        redirect('login');
    }
}
function chek_administrator() {
    $ci = & get_instance();
    if ($ci->session->userdata('role') !== 'Administrator') {
        redirect('dashboard');
    }
}

if(!function_exists('active_link')) {
    function active_menu($controller) {
        $CI = get_instance(); 
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'active' : ''; 
    } 

    function active_treeview($controller) {
        $CI = get_instance(); 
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'active treeview' : ''; 
    } 
}

function chek_stok($kode_barang) {
    $ci = & get_instance();
    $gid=$ci->session->userdata('gid');
    $masuk=$ci->db->query("SELECT SUM(qty_masuk) AS jumlah_masuk FROM tb_trans_detail WHERE tb_trans_detail.kode_barang = '$kode_barang' 
            AND tb_trans_detail.gid ='$gid' ")->row_array(); 
    $keluar=$ci->db->query("SELECT SUM(qty_keluar) AS jumlah_keluar FROM tb_trans_detail WHERE tb_trans_detail.kode_barang = '$kode_barang' 
            AND tb_trans_detail.gid ='$gid' ")->row_array();
    $jml_stok=$masuk['jumlah_masuk']-$keluar['jumlah_keluar'];        
    return $jml_stok;
}

function tanggal(){
    return date('Y-m-d');
}

function tanggal_indo() {
    return date('d-m-Y H:i');
}

function tanggal_new() {
    /* script menentukan hari */  
     $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
     $hr = $array_hr[date('N')];

    /* script menentukan tanggal */    
    $tgl= date('j');
    /* script menentukan bulan */ 
      $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
      $bln = $array_bln[date('n')];
    /* script menentukan tahun */ 
    $thn = date('Y');
    /* script perintah keluaran*/ 
     return $hr . ", " . $tgl . " " . $bln . " " . $thn . " " . date('H:i');
}

function rupiah($angka) {
    $rupiah = number_format($angka, 0, ',', '.');
    return $rupiah;
}


function tgl_indo($tgl) {
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr($tgl, 5, 2);
    $tahun = substr($tgl, 0, 4);
    $time = substr($tgl, 11, 5);
    return $tanggal . '-' . $bulan . '-' . $tahun;
}

function tgl_lengkap($tanggals) {

    $tanggal = substr($tanggals, 8, 2);
    $bulan = substr($tanggals, 5, 2);
    $tahun = substr($tanggals, 0, 4);
    $time = substr($tanggals, 11, 5);

    return $tanggal . ' ' . bulan($bulan) . ' ' . $tahun . ' ' . $time;
}

function bulan($bln) {
    switch ($bln) {
        case 1:
            return "Jan";
            break;
        case 2:
            return "Feb";
            break;
        case 3:
            return "Mar";
            break;
        case 4:
            return "Apr";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Jun";
            break;
        case 7:
            return "Jul";
            break;
        case 8:
            return "Agt";
            break;
        case 9:
            return "Sep";
            break;
        case 10:
            return "Okt";
            break;
        case 11:
            return "Nov";
            break;
        case 12:
            return "Des";
            break;
    }
}

function nama_hari($tanggal) {
    $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tgl = $pecah[2];
    $bln = $pecah[1];
    $thn = $pecah[0];

    $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
    $nama_hari = "";
    if ($nama == "Sunday") {
        $nama_hari = "Minggu";
    } else if ($nama == "Monday") {
        $nama_hari = "Senin";
    } else if ($nama == "Tuesday") {
        $nama_hari = "Selasa";
    } else if ($nama == "Wednesday") {
        $nama_hari = "Rabu";
    } else if ($nama == "Thursday") {
        $nama_hari = "Kamis";
    } else if ($nama == "Friday") {
        $nama_hari = "Jumat";
    } else if ($nama == "Saturday") {
        $nama_hari = "Sabtu";
    }
    return $nama_hari;
}

function xTimeAgo ($oldTime, $newTime, $timeType) {

        $timeCalc = strtotime($newTime) - strtotime($oldTime);        

        if ($timeType == "x") {

            if ($timeCalc = 60) {

                $timeType = "m";

            }

            if ($timeCalc = (60*60)) {

                $timeType = "h";

            }

            if ($timeCalc = (60*60*24)) {

                $timeType = "d";

            }

        }        

        if ($timeType == "s") {

            $timeCalc .= " seconds ago";

        }

        if ($timeType == "m") {

            $timeCalc = round($timeCalc/60) . " menit yang lalu";

        }        

        if ($timeType == "h") {

            $timeCalc = round($timeCalc/60/60) . " jam yang lalu";

        }

        if ($timeType == "d") {

            $timeCalc = round($timeCalc/60/60/24) . " hari yang lalu";

        }        

        return $timeCalc;

}

function timeAgo($timestamp){

    date_default_timezone_set('Asia/Jakarta');

    $skrg=date("Y-m-d H:i:s");

    $isi= str_replace("-","",xTimeAgo($skrg,$timestamp,"m"));

    $isi2= str_replace("-","",xTimeAgo($skrg,$timestamp,"h"));

    $isi3= str_replace("-","",xTimeAgo($skrg,$timestamp,"d"));

    $go="";

    if($isi > 60)

    {

        $go=$isi2;

    }elseif($isi2 > 24)

    {

        $go=$isi3;

    }elseif($isi < 61)

    {

        $go=$isi;

    }

    return $go;

} 