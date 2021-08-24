<?php
include("koneksi.php");
if(!isset($_SESSION['idcus'])){
	session_start();
}
$idcusc = $_SESSION['idcus'];

$hasil=mysqli_query($koneksi,"select * from calon_santri where EMAIL = '$idcusc'");
$hasil = mysqli_fetch_array($hasil);
$idcs = $hasil['ID_CS'];
$namacs = $hasil['NAMA_CS'];
$statcs = $hasil['STATUS'];

$hasil2=mysqli_query($koneksi,"SELECT * FROM `calon_santri` WHERE `ID_CS` = '$idcs'");
$hasil2 = mysqli_fetch_array($hasil2);
$statsel = $hasil2['STATUS_SELEKSI'];

$hasil3=mysqli_query($koneksi,"SELECT * FROM calon_santri, periode,tahun, detil WHERE detil.ID_CS=calon_santri.ID_CS AND detil.ID_PERIODE=periode.ID_PERIODE AND periode.ID_TAHUN=tahun.ID_TAHUN AND calon_santri.ID_CS = '$idcs'");
$hasil3 = mysqli_fetch_array($hasil3);
//$statsel = $hasil3['STATUS_SELEKSI'];
$tglsel = $hasil3['TGL_UJIAN'];
$tglpeng = $hasil3['TGL_PENGUMUMAN'];
$periode = $hasil3['PERIODE'];
$tahun = $hasil3['TAHUN'];

//$hasil4=mysqli_query($koneksi,"SELECT * FROM detil, periode, tahun WHERE periode.ID_PERIODE` = (select ID_PERIODE from detil where ID_CS = '$idcs')");
//$hasil4 = mysqli_fetch_array($hasil4);
//$tahun = $hasil4['TAHUNPERIODE'];

$pen=mysqli_query($koneksi,"select * from calon_santri where ID_CS = '$idcs'");
if (mysqli_num_rows($pen)==1 ){
	$stat =	 1;
}

?>

<?php 
 // Cek Login Apakah Sudah Login atau Belum
 if (!isset($_SESSION['username'])){
  // Jika Tidak Arahkan Kembali ke Halaman Login
  header("location:../loginSantri.html");
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

    <title>SBMPPMKH </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
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
                  <li><a href="index.php"><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Pendaftaran <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="formDaftar.php">Formulir Pendaftaran</a></li>
                      <?php
							if(isset($stat)){
						?>
                      <li><a href="Detail_formDaftar.php">Formulir Anda</a></li>
                      <li><a href="cetak_kartu.php">Cetak Kartu Ujian</a></li>
                      <?php
							}
						?>
                    </ul>
                  </li>
                  <li><a href="seleksi.php"><i class="fa fa-desktop"></i> Seleksi</a>
                  </li>
                  <li><a><i class="fa fa-table"></i> Daftar Ulang <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="daftar_ulang.php">Pembayaran Daftar Ulang</a></li>
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
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../logoutSantri.php">
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
                    <li><a href="../logoutSantri.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <div class="right_col" role="main">
          <div class="">
            <div class="row top_tiles">
              
            <?php
			if ($statcs == 'TERDAFTAR' && $statsel == 'DITERIMA'){
			?>
             <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Hasil Seleksi </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                      
                      <table width="100%" border="0">
					  <tbody>
						<tr>
						  <td align="center" bgcolor="#A2A2A2">
							  <img src="images/ppm.png" width="100" height="100" alt=""/><br/>
					  	  <strong> <font color="#000000">YAYASAN PPMKH SURABAYA</font></strong><br/>
					  	  </td>
						</tr>
						<tr>
						  <td>
						  	<h2 align="center"> <font color="
						  	#000000">PENGUMUMAN HASIL SELEKSI </font></h2>
						  	<center><font color="#000000">Seleksi Bersama Masuk Pondok Pesantren Mahasiswa Khoirul Huda Surabaya Tahun Periode <?php echo $tahun?>-<?php echo $periode?> </font></center>
						  </td>
						</tr>
						<tr>
						  <td bgcolor="#38FF61">
						  	<h2 align="center"> <b><font color="
						  	#000000">SELAMAT </font></b></h2>
						  	
						  </td>
						</tr>
						<tr>
						  <td align="center"><center>
						   <font color="#000000"> Peserta <?php echo $namacs;?> dengan nomor peserta <?php echo $idcs;?> </font>
						  </center><br/>
						  <center><font color="#000000">Di terima di Pondok Pesantren Mahasiswa Khoirul Huda pada Seleksi Bersama Masuk Pondok Pesantren Mahasiswa Khoirul Huda (SBMPPMKH) pada tahun periode <?php echo $tahun?>-<?php echo $periode?></font><br/><center>
						  </td>
						</tr>
						<tr>
						  <td align="center">
						  <font color="#000000">Selanjutnya anda harus melakukan daftar ulang sebagaimana prosedur yang telah di tentukan,silahkan klik link berikut <a href="daftar_ulang.php">daftar ulang</a> </font>
						  
						  </td>
						</tr>
					  </tbody>
					</table>

                    </div>
                  </div>

                </div>
              </div>
            </div>
              
              <!-- page content hasil tidak ditrima / selekasi status tidak ditrima-->
              <?php
				}elseif($statcs == 'TERDAFTAR' && $statsel == 'TIDAK DITERIMA'){
				?>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Hasil Seleksi </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                    <table>
						<tr>
						  <td bgcolor="#A3A3A3">
						  	<h2 align="center"> <b><font color="
						  	#000000">MOHON MAAF </font></b></h2>
						  	
						  </td>
						</tr>
						<tr>
						  <td align="center"><center>
						   <font color="#000000"> Peserta dengan nomor peserta </font>
						  </center><br/>
						  <center><font color="#000000">Anda belum di terima dalam Seleksi Bersama Masuk Pondok Pesantren Mahasiswa Khoirul Huda pada periode <?php echo $tahun?> silahkan coba di kesempatan berikutnya. </font><br/><center>
						  </td>
						</tr>
                    </table>
                    </div>
                  </div>

                </div>
              </div>
            </div><!-- page content pelaksanaan /santri belum aktif-->
        <?php
			}else{
		?>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Pelaksanaan Seleksi </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                      <ul>
                      <li>
						  <p>Ujian Seleksi dilaksanakan pada tanggal <?php echo $tglsel?></p>
                      </li>
                      <li>
						  <p>Hasil seleksi akan diumumkan pada tanggal <?php echo $tglpeng?></p>
                      </li>
					  </ul>
                    </div>
                  </div>

                </div>
              </div>
            </div>
              <?php
				}
				?>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
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
    <!-- jQuery Sparklines -->
    <script src="vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
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