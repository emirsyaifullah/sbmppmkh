<?php
include "koneksi.php";

//buat query input
$del="delete from jabatan where ID_JABATAN='$_GET[ID_JABATAN]'";
$hasil=mysqli_query($koneksi,$del);
    if($hasil){
    header("location:data_jabatan.php");
    }else{
    echo "<font color='#000000'><b><i>Data Gagal Dihapus</i></b></font>";
    }
?>
