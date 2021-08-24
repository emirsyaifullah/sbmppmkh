<?php
include "koneksi.php";

//buat query input
$del="delete from kota where ID_KOTA='$_GET[ID_KOTA]'";
$hasil=mysqli_query($koneksi,$del);
    if($hasil){
    header("location:data_kota.php");
    }else{
    echo "<font color='#000000'><b><i>Data Gagal Dihapus</i></b></font>";
    }
?>
