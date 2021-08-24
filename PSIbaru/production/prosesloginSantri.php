<?php 
 session_start();
 // Sisipkan File Koneksi
 include "koneksi.php";

 // Jika Login
 if (isset($_POST['login'])){
 $username=($_POST['username']);
 $password=($_POST['password']);
 // Mencari User yang cocok yang ada di tabel database
 $cek_user = mysqli_query($koneksi,"SELECT * FROM akun WHERE USERNAME = '$username' AND PASSWORD = '$password' AND ID_OTORITAS ='2' ");
 if (mysqli_num_rows($cek_user)==1 ){
  $hasil = mysqli_fetch_array($cek_user);
  // Simpan Session USER
	 	$_SESSION['idcus'] = $hasil['EMAIL'];
        $_SESSION['username'] = $username;
  // Arahkan ke Halaman 
  header("location:calonSantri/index.php");
  } else{
  echo "<script>
  alert('username dan password yang anda masukan salah!')
  </script>";
 }
 }
?>


