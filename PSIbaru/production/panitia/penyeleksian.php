<?php
include("koneksi.php");
error_reporting(0);
if(isset($_POST["simpan"])){
$period = $_POST["periode"];
$angka = $_POST["angka"];
$angkasql = mysqli_query($koneksi,"UPDATE periode SET KUOTA=$angka where ID_PERIODE='$period'");
$kuota = mysqli_query($koneksi,"SELECT periode.KUOTA FROM periode where periode.ID_PERIODE='$period'");
$juml=mysqli_fetch_array($kuota);	
$a=$juml[0];
$sqlquery = mysqli_query($koneksi,"UPDATE calon_santri SET `STATUS_SELEKSI`='DITERIMA'
	WHERE `ID_CS` IN (
		SELECT `ID_CS` FROM (
			SELECT DISTINCT a.`ID_CS` FROM detil a join calon_santri b on a.ID_CS = b.ID_CS where a.ID_PERIODE='$period'
			ORDER BY b.TOTAL_NILAI DESC  
			LIMIT 0, $a
		) tmp
	)");

	
$hasil=mysqli_query($koneksi,"select DISTINCT calon_santri.ID_CS, calon_santri.NAMA_CS, calon_santri.TOTAL_NILAI, calon_santri.STATUS_SELEKSI, periode.PERIODE, tahun.TAHUN from calon_santri, detil, periode, tahun WHERE detil.ID_CS=calon_santri.ID_CS AND detil.ID_PERIODE=periode.ID_PERIODE AND periode.ID_TAHUN=tahun.ID_TAHUN AND periode.ID_PERIODE='$period' order BY calon_santri.TOTAL_NILAI DESC");
	
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

    <title>SBMPPMKH</title>

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
            <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="x_content">
				<div class="x_title">
                    <h2>Data Hasil Seleksi</h2>
                    <div class="clearfix"></div>
                  </div>
                  
                  <?php 
				 
	

//if(isset($_POST["jumlah"])){
//	$jmlh = $_POST["jumlah"];
//	$sqlquery = mysqli_query($koneksi,"UPDATE periode SET KUOTA= '$jmlh''");
//	$sqlquery = mysqli_query($koneksi,"UPDATE calon_santri SET `STATUS_SELEKSI`='DITERIMA'
//	WHERE `ID_CS` IN (
//		SELECT `ID_CS` FROM (
//			SELECT `ID_CS` FROM calon_santri
//			ORDER BY `TOTAL_NILAI` DESC  
//			LIMIT 0, $jmlh
//		) tmp
//	)");
//	mysqli_query($koneksi,"insert into daftar_ulang values ('','','','','BELUM LUNAS','')");
//	 
//}			 
	 
				 ?>
                   
                   <form action="" method="POST" >
                   <table height="" border="0" align="center" bgcolor="#FFFFFF"  style="margin-left:38%">
	   				 <tr align="left">
       				   <td>
       				   <select name="periode" id="periode" class="options">
							<option value="0" selected>- Pilih Tahun Periode -</option>
							<?php
							   $j=mysqli_query($koneksi,"select * from periode, tahun WHERE periode.ID_TAHUN=tahun.ID_TAHUN AND periode.KUOTA IS NULL ORDER BY TAHUN");
							   while($k=mysqli_fetch_array($j)){
							   echo "<option value='$k[ID_PERIODE]'>$k[TAHUN]-$k[PERIODE]</option>";
			     			   }
						    ?>
						  </select>
					   </td>
       					<td>&nbsp;&nbsp;&nbsp;</td>
       					<td>
       				   <input id="angka" class="" data-validate-length-range="6" data-validate-words="2" name="angka" required="required" type="text" placeholder="kuota yang tersedia">
					   </td>
       					<td>&nbsp;&nbsp;&nbsp;</td>
					   <td>
						<input type="submit" name="simpan" value="submit"  onclick="pesan();" class="btn btn-success">
					   </td>
        			</tr>
					</table>
                   </form>
                   
<!--
                   <form action="" method="POST" >
					<table height="" border="0" align="center" bgcolor="#FFFFFF"  style="margin-left:38%">
	   				 <tr>
       				   <td>
       				   <input id="jumlah" class="form-control col-md-7 col-xs-12" data-validate-length-range="10" data-validate-words="2" name="jumlah" required="required" type="text" value="" placeholder="Jumlah Santri yang di terima">
					   </td>
					   <td>&nbsp;&nbsp;&nbsp;</td>
					   <td>
						<input type="submit" name="submit" value="Submit" class="btn btn-success">
					   </td>
        			</tr>
					</table>
				 	</form>
-->
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th align="center" class="column-title">No </th>
                            <th align="center" class="column-title">Id Santri </th>
                            <th align="center" class="column-title">Nama Santri </th>
                            <th align="center" class="column-title">Tahun Periode </th>
                            <th align="center" class="column-title">Nilai Akhir </th>
                            <th align="center" class="column-title">Status </th>
<!--                            <th align="center" class="column-title no-link last"><span class="nobr">Action</span>-->
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                        
                         <?php
							@$i=0; 
		  					$isi=1;
		  					while($data=mysqli_fetch_array($hasil))
							{
							$i+=1;
						 ?>
                          <tr class="even pointer">
                            <td align="center"  class="a-center"><?php echo $i;?></td>
                            <td class=" "><?php echo $data[0]; ?></td>
                            <td class=" "><?php echo $data[1]; ?></td>
                            <td class=" "><?php echo $data[5]; ?>-<?php echo $data[4]; ?></td>
                            <td class=" "><?php echo $data[2]; ?></td>
                            <td class=" "><?php echo $data[3]; ?></td>
<!--
                            <td class=" last">
            				<a title="edit" href="edit_hasilseleksi.php?ID_CS="><img src="img/edit1.png" width="15" height="15" /></a>
                            </td>
-->
                          </tr>
                         <?php
						  $isi += ($i);}
						 ?> 
                        </tbody>
                      </table>
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
    
    <script type="text/javascript">
	function pesan(){
	var number=document.getElementById("periode").value;
	//confirm("Apakah id calon santri yang anda masukan ini "+number+" sudah benar ");
	alert("Apakah ingin melakukan penyeleksian pada tahun periode "+number);
	}
</script>

<?php 
 }
?>
  </body>
</html>
