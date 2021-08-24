<?php
include("koneksi.php");
?>
<script type="text/javascript" src="hadmin/js/jquery-1.4.2.min.js"></script>
<?php
	//apabila klik tombol simpan
	if(isset($_POST['simpan'])) {
		
	//buat variabel untuk tabel akun
	//$nama=$_POST['ID_AKUN'];
	$nama=$_POST['EMAIL'];
	$nama1=$_POST['USERNAME'];
	$nama2=$_POST['PASSWORD'];
	
	//buat query input ke akun
	$daftar = "insert akun (EMAIL, ID_OTORITAS, USERNAME, PASSWORD) values('$nama','2','$nama1','$nama2') ";
	mysqli_query($koneksi,$daftar); 
	echo 
	"<script>window.alert('Akun pendaftaran berhasil dibuat')
	window.location='loginSantri.php'</script>";
//	$daftar = mysqli_num_rows(mysqli_query($koneksi,"insert akun (EMAIL, ID_OTORITAS, USERNAME, PASSWORD) values('$nama','2','$nama1','$nama2')"));
//	if ($daftar > 1){
    
//    }
	
	//cek username
	$cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM akun WHERE EMAIL='$nama'"));
    if ($cek > 0){
    echo 
	"<script>window.alert('Email yang Anda Masukkan Sudah terdaftar !')
    window.location='loginSantri.php'</script>";
    }
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SBMPPMKH </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div class="login_wrapper"> 
         
          <section class="login_content">
            <form method="POST" action="">
              <h1>Create Account</h1>
              <div>
                <input type="email" class="form-control" name="EMAIL" placeholder="Email" required="" />
              </div>
              <div>
                <input type="text" class="form-control" name="USERNAME" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="PASSWORD" placeholder="Password" required="" />
              </div>
              <div>
               <input type="submit" value="simpan" class="btn btn-default submit" name="simpan" id="submit" />
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="loginsantri.html" class="to_register"> Log in </a>
				  </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>© SBMPPMKH 2018</p>
                </div>
              </div>
            </form>
          </section>
      </div>
  </body>
</html>
