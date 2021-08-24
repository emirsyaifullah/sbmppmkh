<?php
include("koneksi.php");
$hasil=mysqli_query($koneksi,"select * from calon_santri");

if(!isset($_SESSION['idcus'])){
	session_start();
}
$idcusc = $_SESSION['idcus'];
$hasil=mysqli_query($koneksi,"select * from calon_santri where EMAIL = '$idcusc'");
$hasil = mysqli_fetch_array($hasil);
$idcs = $hasil['ID_CS'];
$pen=mysqli_query($koneksi,"select * from calon_santri where ID_CS = '$idcs'");
if (mysqli_num_rows($pen)==1 ){
	$stat =	 1;
}
?>

<?php
//	//mencari id akun
//	$data = "select ID_CS as last_idCS from calon_santri ";
//	$result1=mysqli_query($koneksi,$data);
//	$row = mysqli_fetch_array($result1);
//	$lastIdCS = $row['last_idCS'];

	$data1="select * from calon_santri, kecamatan, kota, provinsi, orang_tua
	where calon_santri.ID_CS ='$idcs'
	&& calon_santri.ID_KEC = kecamatan.ID_KEC
	&& kecamatan.ID_KOTA = kota.ID_KOTA
	&& kota.ID_PROV = provinsi.ID_PROV
	&& calon_santri.ID_ORTU = orang_tua.ID_ORTU";
	$hasil1=mysqli_query($koneksi,$data1);
	$result1=mysqli_fetch_array($hasil1);

	$tanggal = $result1['TGL_LHR_CS'];
	$tgl = date('d-m-Y', strtotime($tanggal));	
	
?>

<?php 
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
          
        <!-- page content -->
        <div class="right_col" role="main">

          <div class="row">
			<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Detail Formulir Pendaftaran</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

    <table width="90%" height="" border="0" align="center" bgcolor="#FFFFFF" cellpadding="6" cellspacing="6" class="font_tabel">
    <br>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>ID Calon Santri</b></td>
    <td width="2%">:</td>
	<td width="50%">
    	<?php
			echo $result1['ID_CS'];
		?>
	</td>
    
	<td rowspan="6"> 
    	<?php
		//echo "<center><img src='upload/".$result1['FOTO_PEGAWAI']."' width=\"400\"</center>";
		echo "<img src='uploadfoto/".$result1['FOTO']."' width=\"200\" height=\"250\"/>"; ?> </td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Nama Lengkap</b></td>
    <td width="2%">:</td>
	<td width="50%">
    	<?php
			echo $result1['NAMA_CS'];
		?>
	</td>
	</tr>
            
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Jenis Kelamin</b></td>
	<td width="2%">:</td>
	<td width="50%">
    	<?php
			echo $result1['JK_CS'];
		?>
	</td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Tempat, Tanggal Lahir</b></td>
	<td width="2%">:</td>
	<td width="50%">
    	<?php
			echo $result1['NAMA_KOTA']." , ".$tgl;
		?>
	</td>
	</tr>
    
    <td width="30%" align="left" class="keterangan"><b>Alamat</b></td>
	<td width="2%">:</td>
	<td width="50%">
    	<?php echo $result1['ALAMAT_CS'] ?>,<?php echo $result1['KECAMATAN'] ?>,<?php echo $result1['NAMA_KOTA'] ?>,<?php echo $result1['NAMA_PROV'] ?>
		
	</td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Nomor HP<p></b></td>
	<td width="2%">:</td>
	<td width="50%">
    	<?php
			echo $result1['NO_HP_CS'];
		?>
	</td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Email<p></b></td>
	<td width="2%">:</td>
	<td width="50%">
    	<?php
			echo $result1['EMAIL'];
		?>
	</td>
	</tr>
    
    <tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Kuliah<p></b></td>
	<td width="2%">:</td>
	<td width="50%">

    	<?php
			echo $result1['KULIAH'];
		?>
	</td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Jurusan<p></b></td>
	<td width="2%">:</td>
	<td width="50%">

    	<?php
			echo $result1['JURUSAN'];
		?>
	</td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Semester<p></b></td>
	<td width="2%">:</td>
	<td width="50%">

    	<?php
			echo $result1['SEMESTER'];
		?>
	</td>
	</tr>
   
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Nama Ayah<p></b></td>
	<td width="2%">:</td>
	<td width="50%">

    	<?php
			echo $result1 ['NAMA_AYAH'];
		?>
	</td>
	</tr>

    <tr>
	<td width="30%" align="left" class="keterangan"><b>NO Telepon Ayah<p></b></td>
	<td width="2%">:</td>
	<td width="50%">

    	<?php
			echo $result1['NO_HP_AYAH'];
		?>
	</td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Pekerjaan Ayah<p></b></td>
	<td width="2%">:</td>
	<td width="50%">

    	<?php
			echo $result1['PEKERJAAN_AYAH'];
		?>
	</td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Nama Ibu<p></b></td>
	<td width="2%">:</td>
	<td width="50%">

    	<?php
			echo $result1['NAMA_IBU'];
		?>
	</td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>No Telepon Ibu<p></b></td>
	<td width="2%">:</td>
	<td width="50%">

    	<?php
			echo $result1['NO_HP_IBU'];
		?>
	</td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Pekerjaan Ibu<p></b></td>
	<td width="2%">:</td>
	<td width="50%">

    	<?php
			echo $result1['PEKERJAAN_IBU'];
		?>
	</td>
	</tr>
    
    <tr>
	<td width="30%" align="left" class="keterangan"><b>Alamat Orang Tua<p></b></td>
	<td width="2%">:</td>
	<td width="50%">

    	<?php
			echo $result1['ALAMAT_ORTU'];
		?>
	</td>
	</tr>
    
    <tr>
	<td colspan="3" align="right">
    <br>
    <br>
        <a href="index.php" style="text-decoration:none"><input type="button" value="KEMBALI" class="btn btn-primary"></a>
        <a href="edit_formDaftar.php" style="text-decoration:none"><input type="button" value="EDIT" class="btn btn-success"></a>
	</td>
	</tr>
    
</table>
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
mysqli_close($koneksi);
?>
 
<?php 
 }
?>
  </body>
</html>
