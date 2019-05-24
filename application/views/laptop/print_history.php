<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print History Mutasi</title>
<link rel="stylesheet" href="style/style_index.css" type="text/css">

<style type="text/css">
#noBorder
{
	border:none;
	text-align: center;
}

#namaField{
	color:#FFF;
	background-color:#333;
	text-align:center;
	padding-top:7px;
	border:none;
}
</style>
</head>
<script type="text/javascript">
window.print();
window.onfocus=function(){ window.close();}
</script>
<body>
<table width="728" height="384" cellpadding="0" cellspacing="0">
 
  <tr>
    <td colspan="6"  id="noBorder"><strong><u>MUTASI INVENTORY LAPTOP </u></strong></td>
  </tr>
  <tr>
    <td colspan="6" id="noBorder2"><div align="center"><u><strong></strong></u></div></td>
  </tr>
  <tr>
    <td colspan="6" id="noBorder">&nbsp;</td>
  </tr>
  <tr>
    <td width="115" height="26" id="noBorder"><div align="left">Tgl. Mutasi</div></td>
    <td width="19"  id="noBorder">:</td>
    <td width="265"  id="noBorder"><div align="left"><?php echo tgl_lengkap($record['tgl_update']); ?></div></td>
    <td colspan="3" id="noBorder">&nbsp;</td>
  </tr>
   
   <tr>
    <td height="26" id="noBorder"><div align="left">Jenis Inventory</div></td>
    <td id="noBorder">:</td>
    <td id="noBorder"><div align="left">Laptop</div></td>
    <td colspan="3" id="noBorder">&nbsp;</td>
   </tr>
  <tr>
    <td height="28" id="noBorder"><div align="left">No. Inventaris</div></td>
    <td id="noBorder">:</td>
    <td id="noBorder"><div align="left"><?php echo $record['no_inventaris']; ?></div></td>
    <td colspan="3" id="noBorder">&nbsp;</td>
   </tr>
    <tr>
    <td height="28" id="noBorder"><div align="left">No. Aset HRD</div></td>
    <td id="noBorder">:</td>
    <td id="noBorder"><div align="left"><?php echo $record['aset_hrd']; ?></div></td>
    <td colspan="3" id="noBorder">&nbsp;</td>
   </tr>
  <tr>
    <td height="25" id="noBorder"><div align="left">Spesifikasi</div></td>
    <td id="noBorder">:</td>
    <td id="noBorder"><div align="left"><?php echo $record['spesifikasi']; ?></div></td>
    <td colspan="3" id="noBorder">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" id="noBorder">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">
    <table width="726" height="82" >
      <tr>
        <td colspan="2" align="center"><strong><u>Mutasi Awal</u>
            </strong></div>
        </div></td>
        <td colspan="2" align="center"><strong><u>Mutasi Akhir</u>
            </strong></div>
        </div></td>
        <td width="167" rowspan="2" align="left"><strong><u>Keterangan</u>          
            </div>
        </strong></td>
      </tr>
      <tr>
        <td align="left" ><strong><u>Nama</u>
            </div>
        </strong></td>
        <td align="left" ><u><strong>Departemen</strong></u></td>
        <td align="left" ><strong><u>Nama</u>
            </div>
        </strong></td>
        <td align="left" ><u><strong>Departemen</strong></u></td>
        </tr>
      <?php 
		$pengguna = $this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.nama,tb_departemen.parent 
					FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept 
					WHERE tb_pengguna.id_pengguna ='$record[id_pengguna]'")->row_array();
		$pengguna_awal = $this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna,tb_departemen.nama,tb_departemen.parent FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept 
					WHERE tb_pengguna.id_pengguna ='$record[id_pengguna_awal]'")->row_array();
		?>
      <tr >
        <td width="122" ><?php echo $pengguna_awal['nama_pengguna']; ?></td>
        <td width="133" height="28" align="left"><?php echo $pengguna_awal['nama']; ?></div></td>
        <td width="118" style=" border:none"><?php echo $pengguna['nama_pengguna']; ?></td>
        <td width="138"  align="left"><?php echo $pengguna['nama']; ?></div></td>
        <td style=" align="left"><?php echo $record['note']; ?></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="48" colspan="3" id="noBorder">&nbsp;</td>
    <td width="4" id="noBorder">&nbsp;</td>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">&nbsp;</td>
  </tr>
  <tr>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">Mengetahui,</td>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder"><div align="center">Penerima,</div></td>
    <td id="noBorder">&nbsp;</td>
  </tr>
  <tr>
    <td height="40" id="noBorder">&nbsp;</td>
    <td height="40" id="noBorder">&nbsp;</td>
    <td height="40" id="noBorder">&nbsp;</td>
    <td height="40" id="noBorder">&nbsp;</td>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">&nbsp;</td>
  </tr>
  <tr>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">.....................................</td>
    <td id="noBorder">&nbsp;</td>
    <td width="259" id="noBorder"><div align="center"><?php echo $pengguna['nama_pengguna']; ?></div></td>
    <td width="64" id="noBorder">&nbsp;</td>
  </tr>
  <tr>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">( Divisi IT )</td>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">&nbsp;</td>
  </tr>
</table>
</body>
</html>
