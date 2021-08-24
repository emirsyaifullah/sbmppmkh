<?php
include "koneksi.php";

//buat query input
$del="delete from periode where ID_PERIODE='$_GET[ID_PERIODE]'";
$hasil=mysqli_query($koneksi,$del);
    if($hasil){
    header("location:data_periode.php");
    }else{
    echo 
			"<script>window.alert('data gagal dihapus!')
    		window.location='data_periode.php'</script>";
    }
?>
