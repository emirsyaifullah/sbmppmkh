<?php
include("koneksi.php");

if(!isset($_SESSION['idcus'])){
	session_start();
}
$idcusc = $_SESSION['idcus'];
$hasil=mysqli_query($koneksi,"select * from calon_santri where EMAIL = '$idcusc'");
$hasil = mysqli_fetch_array($hasil);
$idcs = $hasil['ID_CS'];

$hasil2=mysqli_query($koneksi,"SELECT * FROM `calon_santri` WHERE `ID_CS` = '$idcs'");
$hasil2 = mysqli_fetch_array($hasil2);
$statsel = $hasil2['STATUS_SELEKSI'];
//$statsel = $hasil2['NAMA_CS'];



$hasil3=mysqli_query($koneksi,"SELECT * FROM `daftar_ulang` WHERE `ID_DU` = (select ID_DU from daftar_ulang where ID_CS='$idcs')");
$hasil3 = mysqli_fetch_array($hasil3);
$statbay = $hasil3['STATUS_BAYAR'];

$pen=mysqli_query($koneksi,"select * from calon_santri where ID_CS = '$idcs'");
if (mysqli_num_rows($pen)==1 ){
	$stat =	 1;
}
?>

<script type="text/javascript" src="hadmin/js/jquery-1.4.2.min.js"></script>
<?php

	$data1="select calon_santri.ID_CS, calon_santri.NAMA_CS, daftar_ulang.TOTAL_DU, daftar_ulang.STATUS_BAYAR from calon_santri, daftar_ulang where daftar_ulang.ID_CS=calon_santri.ID_CS AND daftar_ulang.ID_DU = (select ID_DU from daftar_ulang where ID_CS='$idcs')";
	$hasil1=mysqli_query($koneksi,$data1);
	$result1=mysqli_fetch_array($hasil1);

	//apabila klik tombol simpan
	if(isset($_POST['simpan'])) {
	
	
	$date=date('dmYhis');
	$file = $date . "." . basename($_FILES["file"]["type"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($file, PATHINFO_EXTENSION);

	$check = getimagesize($_FILES["file"]["tmp_name"]);
	if($check !== false){
	
	move_uploaded_file($_FILES["file"]["tmp_name"], "uploadfoto/" . $file);
	$uploadOk = 1;
	}
	$tgl= date('d-m-Y');
	//buat query update daftar ulang
	$du = "insert into daftar_ulang (ID_CS, TGL_DU , TOTAL_DU, STATUS_BAYAR, BUKTI_DU) values ('$idcs','$tgl' ,'686.000', 'Belum Di verifikasi', '$file')";
	mysqli_query($koneksi,$du) or die('Gagal melakukan daftar ulang');
	
	header("location:daftar_ulang.php?pesan=<p class='berhasil'>berhasil melakukan daftar ulang</p>");
	}
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
              <div class="x_panel">
                 
                 
                 <?php
				if ($statsel == 'DITERIMA' && $statbay == 'Belum Di verifikasi'){
				?>
                 <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
<!--                <div class="x_content">-->

                  <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                      <ul>
						  <p>Anda telah melakukan daftar ulang, tunggu sampai daftar ulang anda di verifikasi</p>
                    </div>
                  </div>

                </div>
              </div>
            	
               <?php
				}elseif($statsel == 'DITERIMA' && $statbay == 'LUNAS'){
				?>
               <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="x_panel">
                    <div class="x_content">
                    <form class="form-horizontal form-label-left" method="POST" action="" enctype="multipart/form-data">
                      <span class="section">Daftar Ulang</span>
                      <p><font size="3" color=""><strong>Daftar Ulang Anda Telah Di Verifikasi</strong>
						  </font></p>
                      <table width="279" border="0">
					  <tbody>
						<tr>
						  <td width="185">ID</td>
						  <td width="8">:</td>
						  <td width="64"><?php echo $result1['ID_CS']; ?></td>
						</tr>
						<tr>
						  <td>Nama Santri</td>
						  <td>:</td>
						  <td><?php echo $result1['NAMA_CS']; ?></td>
						</tr>
						<tr>
						  <td>Total Daftar Ulang</td>
						  <td>:</td>
						  <td><?php echo $result1['TOTAL_DU']; ?></td>
						</tr>
						<tr>
						  <td>Status Daftar Ulang</td>
						  <td>:</td>
						  <td><?php echo $result1['STATUS_BAYAR']; ?></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>
						<tr>
						  <td align="center"><a title="cetak bukti daftar ulang" href="cetak_buktidaful.php"><img src="images/printer.png" width="30" height="30" /></a></td>
						  <td>&nbsp;</td>
						  <td >&nbsp;</td>
						</tr>
						
					  </tbody>
					</table>
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                        
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                  </div>
               
               <?php
				}else{
				?>
               <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="x_panel">
                    <div class="x_content">
                    <form class="form-horizontal form-label-left" method="POST" action="" enctype="multipart/form-data">
                      <span class="section">Daftar Ulang</span>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Total Daftar Ulang <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <p>Rp. 686.000</p>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"><span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
							<p><font color="
                       #000000">silahkan melakukan pembayaran daftar ulang sejumlah total daftar ulang diatas via transfer melalui nomer rekening ini <b>0580-01-019660-50-4</b>. setelah melakukan transfer pembayaran daftar ulang maka silahkan upload bukti pembayaran daftar ulang di bawah ini.</font></p>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Bukti Pembayaran Daftar Ulang <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file" id="fileInput" name="file" class="input1" />
                      </div>
                      </div>
                      
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                      
                          <input type="submit" name="simpan" value="Submit" class="btn btn-success">
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
                  </div>
                  <?php
					}
				  ?>
                  
                </div>
              </div>
            </div>
          </div>
          <br />
          
        </div>
        <!-- /page content -->
 <?php
echo @$_REQUEST["pesan"];
?>

<?php
mysqli_close($koneksi);
?>
 
<?php 
 }
?>
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



  </body>
</html>
