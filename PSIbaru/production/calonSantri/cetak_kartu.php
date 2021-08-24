<?php
session_start();
ob_start();
include_once("koneksi.php");//buat koneksi ke database

$a=$_SESSION['idcus'];

				//menampilkan data
				$data1=mysqli_fetch_array(mysqli_query($koneksi, "select calon_santri.ID_CS, calon_santri.NAMA_CS, calon_santri.JK_CS, kota.NAMA_KOTA, calon_santri.TGL_LHR_CS, calon_santri.NO_HP_CS, akun.EMAIL, calon_santri.KULIAH , calon_santri.JURUSAN , calon_santri.SEMESTER ,calon_santri.FOTO, periode.PERIODE, tahun.TAHUN 
				from calon_santri, kecamatan, kota, periode, tahun, detil, akun
				where calon_santri.ID_KEC=kecamatan.ID_KEC AND kecamatan.ID_KOTA=kota.ID_KOTA AND detil.ID_CS=calon_santri.ID_CS AND detil.ID_PERIODE=periode.ID_PERIODE AND periode.ID_TAHUN=tahun.ID_TAHUN AND calon_santri.EMAIL=akun.EMAIL AND akun.EMAIL='$a' limit 1"));
				
	$tanggal = $data1['TGL_LHR_CS'];
	$tgl = date('d-m-Y', strtotime($tanggal));
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

<table  align="center" style="width: 100%; text-align: center; font-size: 20px">
        <tr><td style="width:10%" rowspan="4" align="center"><img src="images/ppm.png" width='80' align="center"></td>
          <td style="width:90%"><font style="font-size:20px;"><b>KARTU PESERTA UJIAN</b></font></td>
        </tr>
		
        <tr>
        <td class="style37"><font style="font-size:15px;"><b>SELEKSI BERSAMA MASUK PONDOK PESANTREN MAHASISWA KHOIRUL HUDA</b></font></td>
        </tr>
		
        <tr>
          <td><font style="font-size:10px;">Jl. Nginden Gang III No.50 Surabaya, Telp. 082217261354</font></td>
        </tr>
        <tr>
        <td class="style37"><font style="font-size:15px;"><b>PERIODE <?php echo $data1[11];?>, <?php echo $data1[12];?> </b></font></td>
        </tr>
</table>

		<hr />
<table width="100%" height="" border="0" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="font_tabel">
    <br>
    
    <tr>
	<td style="width:30%" align="left" class="keterangan"><font size="24px"><b>
    	<?php echo $data1[0];?>
	</b></font></td>
    <td style="width:2%"></td>
	<td style="width:50%">
	</td>
    
	<td rowspan="6"> 
    	<img src="uploadfoto/<?php echo $data1[10];?>" width='150' height='200'> </td>
	</tr>
    
    <tr>
	<td style="width:30%" align="left" class="keterangan">Nama Lengkap</td>
    <td style="width:2%">:</td>
	<td style="width:50%">
    	<?php echo $data1[1];?>
	</td>
	</tr>
            
    <tr>
	<td style="width:30%" align="left" class="keterangan">Jenis Kelamin</td>
	<td style="width:2%">:</td>
	<td style="width:50%">
    	<?php echo $data1[2];?>
	</td>
	</tr>
    
    <tr>
	<td style="width:30%" align="left" class="keterangan">Tempat, Tanggal Lahir</td>
	<td style="width:2%">:</td>
	<td style="width:50%">
    	<?php echo $data1[3];?>,<?php echo $data1[4];?>
	</td>
	</tr>
    
  <tr>
	<td style="width:30%" align="left" class="keterangan">Nomor HP</td>
	<td style="width:2%">:</td>
	<td style="width:50%">
    	<?php echo $data1[5];?>
	</td>
	</tr>
    
    <tr>
	<td style="width:30%" align="left" class="keterangan">Email</td>
	<td style="width:2%">:</td>
	<td style="width:50%">
    	<?php echo $data1[6];?>
	</td>
	</tr>
    
    
    <tr>
	<td style="width:30%" align="left" class="keterangan">Kuliah</td>
	<td style="width:2%">:</td>
	<td style="width:30%">
		<?php echo $data1[7];?>
	</td>
	</tr>
   
   <tr>
	<td style="width:30%" align="left" class="keterangan">Jurusan</td>
	<td style="width:2%">:</td>
	<td style="width:30%">
		<?php echo $data1[8];?>
	</td>
	</tr>
	
	<tr>
	<td style="width:30%" align="left" class="keterangan">Semester</td>
	<td style="width:2%">:</td>
	<td style="width:30%">
		<?php echo $data1[9];?>
	</td>
	</tr>
</table>

</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
//echo "berhasil";
$filename="kartuujian_'$a'.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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
