<?php
include "koneksi.php";
?>

<?php
	//menampilkan data
	$data1="select * from pegawai where ID_PANITIA='$_GET[ID_PANITIA]'";
	$hasil1=mysqli_query($koneksi,$data1);
	$result1=mysqli_fetch_array($hasil1);

	//apabila klik tombol ubah
	if(isset($_POST['ubah'])) {
		
	//buat variabel
	$nama7=$_POST['ID_PANITIA'];
	$nama8=$_POST['ID_JABATAN'];
	$nama=$_POST['NAMA_PEG'];
	$nama1=$_POST['JK_PEG'];
	$nama2=$_POST['TLP_PEG'];
	$nama3=$_POST['EMAIL_PEG'];
	$nama4=$_POST['USERNAME'];
	$nama5=$_POST['PASSWORD'];
	$nama6=$_POST['ID_KOTA'];
	$nama9=$_POST['TGL_LHR_PEG'];
	$nama10=$_POST['ALAMAT_PEG'];
		
	//buat query ubah
	$data2="update pegawai set 
			ID_PANITIA='$nama7',
			ID_JABATAN='$nama8',
			ID_KOTA='$nama6',
			NAMA_PEG='$nama',
			TGL_LHR_PEG='$nama9',
			JK_PEG='$nama1',
			TLP_PEG='$nama2',
			EMAIL_PEG='$nama3',
			ALAMAT_PEG='$nama10',
			USERNAME='$nama4',
			PASSWORD='$nama5'
			
			where ID_PANITIA='$_GET[ID_PANITIA]'";
	$hasil2=mysqli_query($koneksi,$data2);
		if($hasil2){
		header("location:data_pegawai.php");
		}else{
		echo "<font color='#000000'><b><i>Data gagal diubah</i></b></font>";
		}
	}
?>

<?php 
 session_start();
 // Cek Login Apakah Sudah Login atau Belum
 if (!isset($_SESSION['username'])){
  // Jika Tidak Arahkan Kembali ke Halaman Login
  header("location:../login.html");
  } else {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>SBMPPMKH </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>SBMPPMKH</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $_SESSION['username']?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-edit"></i> Pendaftaran <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php">Data Pendaftaran</a></li>
                      <li><a href="formDaftarLangsung.php">Formulir Pendaftaran</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Seleksi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="data_seleksi.php">Data Seleksi</a></li>
                      <li><a href="data_hasilseleksi.php">Hasil Seleksi</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Daftar Ulang <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="data_daftarulang.php">Data Daftar Ulang</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="laporan_pendaftaran.php">Laporan Pendaftaran</a></li>
                      <li><a href="laporan_hasilseleksi.php">Laporan Hasil Seleksi</a></li>
                      <li><a href="laporan_daful.php">Laporan Daftar Ulang</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Lain-Lain <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="data_periodePendaftaran.php">Tahun/Periode Pendaftaran</a></li>
                      <li><a href="data_jabatan.php">Jabatan</a></li>
                      <li><a href="data_pegawai.php">Pegawai</a></li>
                      <li><a href="data_kota.php">Kota</a></li>
                      <li><a href="data_tglseleksi.php">Tanggal Seleksi</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../logoutPanitia.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?php echo $_SESSION['username']?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="../logoutPanitia.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
          
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">
			<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
       
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" method="POST" action="" enctype="multipart/form-data">

                      <span class="section">Edit Data Pegawai</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">ID Pegawai <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="ID_PANITIA" value="<?php echo $result1['ID_PANITIA']; ?>" required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Jabatan <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="ID_JABATAN">
                  				<?php
                  				$j=mysqli_query($koneksi,"select * from jabatan ORDER BY NAMA_JABATAN");
                 				while($k=mysqli_fetch_array($j)){
                  				echo "<option value='$k[ID_JABATAN]'>$k[NAMA_JABATAN]</option>";
                  				}
							  	?>
              			  </select>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="NAMA_PEG" value="<?php echo $result1['NAMA_PEG']; ?>" required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Kota Lahir <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="ID_KOTA">
                  			<?php
                  			$j=mysqli_query($koneksi,"select * from kota ORDER BY NAMA_KOTA");
                  			while($k=mysqli_fetch_array($j)){
                  			echo "<option value='$k[ID_KOTA]'>$k[NAMA_KOTA]</option>";
                  			}
                  			?>
              			  </select>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Tanggal Lahir <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="TGL_LHR_PEG" value="<?php echo $result1['TGL_LHR_PEG']; ?>" required="required" type="date">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Jenis Kelamin <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              <div id="gender" class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="JK_PEG" value="Laki-Laki"> &nbsp; Laki_Laki &nbsp;
                                </label>
                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="JK_PEG" value="Perempuan"> &nbsp; Perempuan &nbsp;
                                </label>
                              </div>
                            </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Telepon <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="TLP_PEG" value="<?php echo $result1['TLP_PEG']; ?>" required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="EMAIL_PEG" value="<?php echo $result1['EMAIL_PEG']; ?>" required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Alamat <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="ALAMAT_PEG" value="<?php echo $result1['ALAMAT_PEG']; ?>" required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="USERNAME" value="<?php echo $result1['USERNAME']; ?>" required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="PASSWORD" value="<?php echo $result1['PASSWORD']; ?>"  required="required" type="text">
                        </div>
                      </div>
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="data_pegawai.php"><input type="button" name="batal" value="Batal" class="btn btn-primary"></a>
                          <input type="submit" name="ubah" value="Simpan" class="btn btn-success">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br />
          
        </div>
        <!-- /page content -->
        
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            SBMPPMKH 2018
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
 
 <?php 
 }
 ?>
 
  </body>
</html>