<?php
session_start();
ob_start();
include_once("koneksi.php"); //buat koneksi ke database
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
<?php
	$data="
	select calon_santri.ID_CS, calon_santri.NAMA_CS, daftar_ulang.TGL_DU, daftar_ulang.TOTAL_DU, daftar_ulang.STATUS_BAYAR, tahun.ID_TAHUN, periode.ID_PERIODE
	from calon_santri, tahun, periode, daftar_ulang, detil
	where detil.ID_CS=calon_santri.ID_CS AND  detil.ID_PERIODE=periode.ID_PERIODE AND periode.ID_TAHUN=tahun.ID_TAHUN AND daftar_ulang.ID_CS=calon_santri.ID_CS AND periode.ID_PERIODE='".$_REQUEST["ID_PERIODE"]."' GROUP BY periode.ID_PERIODE asc"; // Tampilkan semua data gambar
	
    $i=0;
	$sql = mysqli_query($koneksi, $data); // Eksekusi/Jalankan query dari variabel $query
	$result1= mysqli_fetch_array(mysqli_query($koneksi, "select * from tahun, periode where periode.ID_PERIODE='".$_REQUEST["ID_PERIODE"]."'"));
?>

<table  align="center" style="width: 100%; text-align: center; font-size: 20px">
        <tr><td style="width:10%" rowspan="4" align="center"><img src="img/ppm.png" width='80' align="center"></td>
          <td style="width:90%"><font style="font-size:20px;"><b>YAYASAN PONDOK PESANTREN MAHASISWA KHOIRUL HUDA AL-MUBAROK</b></font></td>
        </tr>
		
        <tr>
        <td class="style37"><font style="font-size:15px;"><b>SELEKSI BERSAMA MASUK PONDOK PESANTREN MAHASISWA KHOIRUL HUDA</b></font></td>
        </tr>
		
        <tr>
          <td><font style="font-size:10px;">Jl. Nginden Gang III No.50 Surabaya, Telp. 082217261354</font></td>
        </tr>
</table>

		<hr />
		<br />
		
<table border="0" align="center" style="width: 100%; text-align: center; font-size: 12px">
        <tr>
          <td style="width:90%"><font style="font-size:10px;"><b>LAPORAN DATA PENDAFTARAN ULANG</b></font></td>
        </tr>
		
		<tr>
          <td></td>
        </tr>
		
        <tr>
        <td class="style37"><font style="font-size:10px;"><b>TAHUN PERIODE <?php echo $result1['TAHUN'];?>-<?php echo $result1['PERIODE'];?></b></font></td>
        </tr>
		
		<br />
		<br />
</table>

<br />
<br />

<table border="1" cellpadding="0" cellspacing="0" rules="all" class="posisi_tabel tabel" bgcolor="#FFFFFF" bordercolor="#CCCCCC">
  <tr>
	<td width="50" bgcolor="#EEEEEE"><div align="center" class="font_table"><b>NO</b></div></td>
	<td width="70" bgcolor="#EEEEEE"><div align="center" class="font_table"><b>ID</b></div></td>
    <td width="250" bgcolor="#EEEEEE"><div align="center" class="font_table"><b>NAMA</b></div></td>
    <td width="300" bgcolor="#EEEEEE"><div align="center" class="font_table"><b>TANGGAL DAFTAR ULANG</b></div></td>
    <td width="300" bgcolor="#EEEEEE"><div align="center" class="font_table"><b>TOTAL DAFTAR ULANG</b></div></td>
    <td width="300" bgcolor="#EEEEEE"><div align="center" class="font_table"><b>STATUS DAFTAR ULANG</b></div></td>
  </tr>
  
    <?php
	$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
	if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
		while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
			$i+=1;
			echo "<tr>";
			echo "<td align=\"center\">"."&nbsp;"."&nbsp;".$i."</td>";
			echo "<td align=\"center\">".$data['ID_CS']."</td>";
			echo "<td>".$data['NAMA_CS']."</td>";
			echo "<td align=\"center\">".$data['TGL_DU']."</td>";
			echo "<td align=\"center\">".$data['TOTAL_DU']."</td>";
			echo "<td align=\"center\">".$data['STATUS_BAYAR']."</td>";
			echo "</tr>";
		}
	}else{ // Jika data tidak ada
		echo "<tr><td colspan='11'>Data tidak ada</td></tr>";
	}
	?>
  </table>
  
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
echo "berhasil";

$filename="laporan_daftarulang.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
$conten=ob_get_clean();
//convertion HTML ke PDF
require_once('html2pdf/html2pdf.class.php');
try{
 $html2pdf=new HTML2PDF('L','Legal','en',array(5,5,5,5));
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