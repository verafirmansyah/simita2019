<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kartu Komputer</title>
<link rel="stylesheet" href="style_index.css" type="text/css">
<style type="text/css">
#noBorder
{
	border:1;
	font-size: 12px;
}
table
{
	margin:5px 9px;
}
td
{
	padding:5px 9px;
	border:none;
}
#namaField{
	color:#333;
	background-color:#FFF;
	text-align:center;
	padding-top:7px;
	border:none;
	font-size: 12px;
}
</style>
</head>
<body>
<script type="text/javascript">
window.print();
window.onfocus=function(){ window.close();}
</script>
<table width="615" >
  <tr>
    <td width="607" ><u><strong>
    <div align="center" class="title">HISTORY PERBAIKAN LAPTOP</div>
    </strong></u></td>    
  </tr>
 <tr>
<td width="607" font-size="10px" ><strong>
  <div align="center" class="title">PT. SEJAHTERA BUANA TRADA</div></strong></td>
 </tr>
  <tr>
    <td id="noBorder"><table width="436" height="125" cellspacing="0" cellpadding="0" >
      <tr>
        <td width="115" id="noBorder">No. Inventaris</td>
        <td width="22" id="noBorder">:</td>
        <td width="297" id="noBorder"><?php echo $recordall['kode_laptop']; ?></td>
      </tr>
      <tr>
        <td id="noBorder">No.Aset HRD</td>
        <td id="noBorder">:</td>
        <td id="noBorder"><?php echo $recordall['aset_hrd']; ?> </td>
      </tr>
      <tr>
        <td id="noBorder">Nama / Manufacture</td>
        <td id="noBorder">:</td>
        <td id="noBorder"><?php echo $recordall['nama_laptop']; ?> </td>
      </tr>
      <tr>
        <td id="noBorder">Spesifikasi</td>
        <td id="noBorder">:</td>
        <td id="noBorder"><?php echo $recordall['spesifikasi']; ?></td>
      </tr>
      <tr>
        <td id="noBorder">Pengguna/Cabang</td>
        <td id="noBorder">:</td>
        <td id="noBorder"><?php echo $recordall['nama_pengguna']," / ","<b>",$recordall['namacabang'],"</b>"; ?></td>
      </tr>
      <tr>
        <td id="noBorder">Tanggal Inventaris</td>
        <td id="noBorder">:</td>
        <td id="noBorder"><?php echo tgl_lengkap($recordall['tgl_inv']); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td id="noBorder"><table cellspacing="1" cellpadding="0">
      <tr>
        <td id="namaField" width="111" ><div align="left"><strong><u>Tgl. Service</u></strong></div></td>
        <td width="112" id="namaField"><div align="left"><strong><u>Jenis Kerusakan</u></strong></div></td>
        <td width="106" id="namaField"><div align="left"><strong><u>Ket. Kerusakan</u></strong></div></td>
        <td width="142" id="namaField"><div align="left"><strong><u>Ket. Perbaikan</u></strong></div></td>
        <td width="103" id="namaField"><strong><u>Biaya/ Cost</u></strong></td>
	
      </tr>
      <?php 
		foreach ($service as $s) {
          echo"
          <tr>
           	<td>".tgl_indo($s->tgl_permohonan)."</td>
            <td>".$s->jenis_permohonan."</td>
            <td>".$s->catatan_pemohon."</td>                                      
            <td>".$s->catatan_perbaikan."</td>
            <td style='text-align:right'>".rupiah($s->biaya)."</td>
            <td style='text-align:center'>".anchor('maintenance/detail/' . $s->no_permohonan, '<i class="btn btn-sm glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></i>') ."</td>
          </tr> ";
         }
	?>
	<tr>
		<td colspan='5' align='right'> <p>&nbsp;</p>
		  <p>No. Doc : FM.63.3.0.4</p></td>
	</tr>
    </table></td>
  </tr>
</table>
</body>
</html>
