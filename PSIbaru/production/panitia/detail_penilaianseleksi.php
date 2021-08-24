<?php
include "koneksi.php";
?>

<?php	
	//menampilkan data
	$data1="select calon_santri.ID_CS, calon_santri.NAMA_CS, detil.NILAI, ujian.NAMA_UJIAN from calon_santri, detil, ujian
	where detil.ID_CS=calon_santri.ID_CS and detil.ID_UJIAN=ujian.ID_UJIAN AND calon_santri.ID_CS='$_GET[ID_CS]' AND detil.ID_UJIAN='1'";
	$hasil1=mysqli_query($koneksi,$data1);
	$result1=mysqli_fetch_array($hasil1);

	$data3="select calon_santri.ID_CS, calon_santri.NAMA_CS, detil.NILAI, ujian.NAMA_UJIAN from calon_santri, detil, ujian
	where detil.ID_CS=calon_santri.ID_CS and detil.ID_UJIAN=ujian.ID_UJIAN AND calon_santri.ID_CS='$_GET[ID_CS]' AND detil.ID_UJIAN='2'";
	$hasil3=mysqli_query($koneksi,$data3);
	$result3=mysqli_fetch_array($hasil3);

	$data4="select calon_santri.ID_CS, calon_santri.NAMA_CS, detil.NILAI, ujian.NAMA_UJIAN from calon_santri, detil, ujian
	where detil.ID_CS=calon_santri.ID_CS and detil.ID_UJIAN=ujian.ID_UJIAN AND calon_santri.ID_CS='$_GET[ID_CS]' AND detil.ID_UJIAN='3'";
	$hasil4=mysqli_query($koneksi,$data4);
	$result4=mysqli_fetch_array($hasil4);
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
                      <li><a href="data_seleksi.php">Data Ujian Seleksi</a></li>
                      <li><a href="penyeleksian.php">Penyeleksian</a></li>
                      <li><a href="data_hasilseleksi.php">Data Hasil Seleksi</a></li>
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
                      <li><a href="data_tahun.php">Data Tahun</a></li>
                      <li><a href="data_periode.php">Data Periode</a></li>
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
						
                     <span class="section">Detail Nilai</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">ID Calon Santri <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo $result1[0]; ?>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Nama Calon Santri <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo $result1[1]; ?>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Tes Tulis <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo $result1[2]; ?>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Tes Membaca Al-quran <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo $result3[2]; ?>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">Tes Wawancara <span class="required">:</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo $result4[2]; ?>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="periode">
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<P>* Nilai 0-100</P>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                         <a href="edit_penilaianseleksi.php?ID_CS=<?php echo $result1[0];?>" style="text-decoration:none"><input type="button" value="Edit" class="btn btn-success"></a>
                          <a href="data_seleksi.php" style="text-decoration:none"><input type="button" value="Kembali" class="btn btn-primary"></a>
                        </div>
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
echo @$_REQUEST["pesan"];
?>
 <?php 
 }
 ?>
  </body>
</html>