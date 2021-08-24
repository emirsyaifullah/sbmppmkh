<?php
include "koneksi.php";

//buat query input
$del="delete from tahun where ID_TAHUN='$_GET[ID_TAHUN]'";
$hasil=mysqli_query($koneksi,$del);
    if($hasil){
    header("location:data_tahun.php");
    }else{
    echo 
	"<script>window.alert('data gagal dihapus!')
    window.location='data_tahun.php'</script>";
    }
?>
