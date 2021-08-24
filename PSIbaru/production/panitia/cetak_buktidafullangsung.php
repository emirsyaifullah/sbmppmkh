<?php
session_start();
ob_start();
include_once("koneksi.php");//buat koneksi ke database

$a=$_REQUEST['ID_CS'];

				//menampilkan data
				$data1=mysqli_fetch_array(mysqli_query($koneksi, "select daftar_ulang.ID_DU, calon_santri.ID_CS, calon_santri.NAMA_CS, daftar_ulang.TOTAL_DU, daftar_ulang.TGL_DU from daftar_ulang, calon_santri where daftar_ulang.ID_CS=calon_santri.ID_CS AND ID_DU=(select ID_DU from daftar_ulang where ID_CS='$a')"));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style>

.font1{
	font-family: sans-serif;
	font-size:100px;
	letter-spacing:4px;
}

.font2{
	font-family: sans-serif;
	font-size:9px;
	letter-spacing:1px;
}

</style>

</head>

<body>

<table border="0" align="center" style="width: 100%; text-align: center; align: center; font-size: 12px">
        <tr>
		  <td style="width:10%" rowspan="3" align="center"><img src="img/ppm.png" width='80' align="center"></td>
          <td style="width:85%"><font style="font-size:15px;"><b>BUKTI PEMBAYARAN PENDAFTARAN ULANG</b></font></td>
        </tr>
</table>
<hr/>
<table width="100%" height="" border="0" align="left" bgcolor="#FFFFFF" cellpadding="2" cellspacing="2" >
    <br>
    
    <tr>
	<td style="width:30%" align="left" class="keterangan">Nomor Daftar Ulang</td>
    <td style="width:2%">:</td>
	<td style="width:50%">
		 <?php echo $data1[0];?>
	</td>
    </tr>
    
    <tr>
	<td style="width:30%" align="left" class="keterangan">ID Calon Santri</td>
    <td style="width:2%">:</td>
	<td style="width:50%">
    	<?php echo $data1[1];?>
	</td>
	</tr>
           
    <tr>
	<td style="width:30%" align="left" class="keterangan">Nama Calon Santri</td>
    <td style="width:2%">:</td>
	<td style="width:50%">
    	<?php echo $data1[2];?>
	</td>
	</tr>
            
    <tr>
	<td style="width:30%" align="left" class="keterangan">Jumlah</td>
	<td style="width:2%">:</td>
	<td style="width:50%">
    	<?php echo $data1[3];?>
	</td>
	</tr>
    
    <tr>
	<td style="width:30%" align="left" class="keterangan">Tanggal</td>
	<td style="width:2%">:</td>
	<td style="width:50%">
    	<?php echo $data1[4];?>
	</td>
	</tr>
    
  <tr>
	<td style="width:30%" align="left" class="keterangan">Keterangan</td>
	<td style="width:2%">:</td>
	<td style="width:50%">
    Pembayaran Daftar Ulang
	</td>
	</tr>
</table>

</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
//echo "berhasil";
$filename="buktidaftarulang_'$a'.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
$conten=ob_get_clean();
//convertion HTML ke PDF
require_once('html2pdf/html2pdf.class.php');
try{
 $html2pdf=new HTML2PDF('L','A5','en',array(5,5,5,5));
 $html2pdf->setdefaultfont('arial',10);
 $html2pdf->pdf->setdisplaymode('fullpage');
 $html2pdf->writeHTML($conten,isset($_GET['vuehtml']));
 ob_end_clean();
 $html2pdf->output($filename);
 }
catch(HTML2PDF_exception $e){
 echo $e;
 exit;
 } 
?>
