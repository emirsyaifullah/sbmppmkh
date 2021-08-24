<?php
include "koneksi.php";

//buat query input
$del="delete from ujian where ID_UJIAN='$_GET[ID_UJIAN]'";
$hasil=mysqli_query($koneksi,$del);
    if($hasil){
    header("location:data_tglseleksi.php");
    }else{
    echo "<font color='#000000'><b><i>Data Gagal Dihapus</i></b></font>";
    }
?>
