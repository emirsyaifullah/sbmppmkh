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
	$daftar=mysqli_num_rows(mysqli_query($koneksi,"insert akun (EMAIL, ID_OTORITAS, USERNAME, PASSWORD)
	values('$nama','2','$nama1','$nama2')"));
	if ($daftar > 0){
    echo 
	"<script>window.alert('Akun pendaftaran berhasil dibuat')
    window.location='loginSantri.php'</script>";
    }
	
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
            <form method="POST" action="prosesloginSantri.php">
              <h1>Login Form</h1>
              <div>
                <input type="text" name="username" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
               <input type="submit" value="login" class="btn btn-default submit" name="login" id="submit" />
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>
                
                <p class="change_link">Back to home?
                  <a href="../index.html" class="to_register"> Home </a>
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
