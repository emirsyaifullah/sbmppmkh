<?php
include "koneksi.php";

//buat query input
$del="delete from pegawai where ID_PANITIA='$_GET[ID_PANITIA]'";
$hasil=mysqli_query($koneksi,$del);
    if($hasil){
    header("location:data_periodePendaftaran.php");
    }else{
    echo "<font color='#000000'><b><i>Data Gagal Dihapus</i></b></font>";
    }
?>
