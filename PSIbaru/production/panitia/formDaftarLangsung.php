<?php
include("koneksi.php");
?>

<script type="text/javascript" src="hadmin/js/jquery-1.4.2.min.js"></script>
<?php
	//apabila klik tombol simpan
	if(isset($_POST['simpan'])) {
	
	$date=date('dmYhis');
	$file = $date . "." . basename($_FILES["file"]["type"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($file, PATHINFO_EXTENSION);

	$check = getimagesize($_FILES["file"]["tmp_name"]);
	if($check !== false){
	
	move_uploaded_file($_FILES["file"]["tmp_name"], "../calonSantri/uploadfoto/" . $file);
	$uploadOk = 1;
	}
		
	//buat variabel untuk tabel pendaftar
	$nama20=$_POST['periode'];
	$nama7=$_POST['kec'];
	$nama1=$_POST['NAMA_CS'];
	$nama18=$_POST['TEMPAT_LHR_CS'];
	$nama2=$_POST['tahun']."-".$_POST['bulan']."-".$_POST['tanggal'];
	$nama3=$_POST['NO_HP_CS'];
	$nama5=$_POST['ALAMAT_CS'];
	$nama6=$_POST['JK_CS'];
	$nama8=$_POST['KULIAH'];
	$nama9=$_POST['JURUSAN'];
	$nama10=$_POST['SEMESTER'];
	$nama11=$_POST['NAMA_AYAH'];
	$nama12=$_POST['PEKERJAAN_AYAH'];
	$nama13=$_POST['NO_HP_AYAH'];
	$nama14=$_POST['NAMA_IBU'];
	$nama15=$_POST['PEKERJAAN_IBU'];
	$nama16=$_POST['NO_HP_IBU'];
	if($_POST['ALAMAT_ORTU'] == null){
		$nama17=$_POST['ALAMAT_CS'];
	}
		else {$nama17=$_POST['ALAMAT_ORTU'];
			 }
	
		
	//buat query input ke orang_tua
	$daftar="insert into orang_tua (NAMA_AYAH, PEKERJAAN_AYAH, NO_HP_AYAH, NAMA_IBU, PEKERJAAN_IBU, NO_HP_IBU, ALAMAT_ORTU)
	values('$nama11','$nama12','$nama13','$nama14','$nama15','$nama16','$nama17')";
	mysqli_query($koneksi,$daftar) or die('Gagal menyimpan data orangtua calon santri');
	
	//mencari id akun	
	$daftar = "select EMAIL as last_idAkun from akun";
	$result1=mysqli_query($koneksi,$daftar);
	$row = mysqli_fetch_array($result1);
	$lastIdAkun = $row['last_idAkun'];
		
	//mencari id ORTU
	$daftar = "select max(ID_ORTU) as last_id from orang_tua limit 1";
	$result1=mysqli_query($koneksi,$daftar);
	$row = mysqli_fetch_array($result1);
	$lastId = $row['last_id'];
	
	$cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM calon_santri WHERE NAMA_CS='$nama1'"));
    if ($cek > 0){
    echo 
	"<script>window.alert('Nama yang Anda Masukkan Sudah Ada')
    window.location='formDaftarLangsung.php'</script>";
    }else {	
		
	//buat query input ke calon_santri
	$daftar = "insert into calon_santri (ID_ORTU, EMAIL, ID_KEC, NAMA_CS, TEMPAT_LHR_CS, TGL_LHR_CS, NO_HP_CS, ALAMAT_CS, JK_CS, KULIAH, JURUSAN, SEMESTER, FOTO)
	values('$lastId' ,'$lastIdAkun' ,'$nama7' ,'$nama1','$nama18' ,'$nama2' ,'$nama3' ,'$nama5' ,'$nama6' ,'$nama8' ,'$nama9' ,'$nama10','$file')";
	mysqli_query($koneksi,$daftar);	
	
	//cek id_cs
	$cekid = "select max(ID_CS) as last_idcs from calon_santri limit 1";
	$resultid=mysqli_query($koneksi,$cekid);
	$row = mysqli_fetch_array($resultid);
	$lastIdcs = $row['last_idcs'];
		
	//buat query input ke detil	
	$detil = "insert into detil (ID_PERIODE, ID_CS, ID_UJIAN)
	values('$nama20','$lastIdcs', '1'),('$nama20','$lastIdcs', '2'),('$nama20','$lastIdcs', '3')";
	mysqli_query($koneksi,$detil) or die('Gagal menyimpan data calon santri');
	}
	echo 
	"<script>window.alert('Pendaftaran berhasil di tambahkan')</script>";
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
                  <div class="x_title">
                    <h2>Formulir Pendaftaran</h2>
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

                    <form class="form-horizontal form-label-left" method="POST" action="" enctype="multipart/form-data">

                      <span class="section">Data Diri</span>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tahun-Periode Pendaftaran <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <select name="periode" class="options">
							<option value="0" selected>- Pilih Periode -</option>
							<?php
							   $j=mysqli_query($koneksi,"select periode.ID_PERIODE, periode.PERIODE, tahun.TAHUN from periode, tahun where periode.ID_TAHUN=tahun.ID_TAHUN GROUP BY periode.ID_PERIODE ASC");
							   while($k=mysqli_fetch_array($j)){
							   echo "<option value='$k[ID_PERIODE]'>$k[TAHUN]-$k[PERIODE]</option>";
			     			   }
						    ?>
						  </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="NAMA_CS" required="required" type="text">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenis kelamin">Jenis Kelamin <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                              <div id="gender" class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="JK_CS" value="Laki-laki"> &nbsp; Laki-Laki &nbsp;
                                </label>
                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="JK_CS" value="Perempuan"> Perempuan
                                </label>
                              </div>
                            </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tempat lahir">Tempat Lahir <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                     <div class="btn-group">
          				<select name="TEMPAT_LHR_CS" class="options">
						<option value="0" selected>- Pilih Kota -</option>
							<?php
							$j=mysqli_query($koneksi,"select * from kota ORDER BY NAMA_KOTA");
							while($k=mysqli_fetch_array($j)){
							echo "<option value='$k[NAMA_KOTA]'>$k[NAMA_KOTA]</option>";
							}
							?>
						</select>
                     </div>
                     </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal lahir">Tanggal Lahir <span class="required">*</span>
                        </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="btn-group">
                      <select name="tanggal" id="tanggal" class="options">
						<option value="0" selected>- Tanggal -
						<?php
							for ($i=1; $i<32; $i++) 
							echo "<option value= $i >$i";
						?>
					</option>
					</select>
                    </div>
                    
                    <div class="btn-group">
                      <select name="bulan" id="bulan" class="options">
						<option value="0" selected>- Bulan -
						<option value="01">Januari
						<option value="02">Februari
						<option value="03">Maret
						<option value="04">April
						<option value="05">Mei
						<option value="06">Juni
						<option value="07">Juli
						<option value="08">Agustus
						<option value="09">September
						<option value="10">Oktober
						<option value="11">November
						<option value="12">Desember
					</option>
				  </select>
                  </div>
                    <div class="btn-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="tahun" name="tahun" required="required" placeholder="Tahun" class="form-control col-md-7 col-xs-12">
                       </div>
                     </div>
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tempat lahir">Alamat <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                     
                     <div class="form-group">
						<label for="provinsi">provinsi&nbsp;<span class="required">*</span></label><br>
						<select class="form-control" name="provinsi" id="provinsi" style="width:69%">
                            <?php
		  					$j=mysqli_query($koneksi,"select * from provinsi ORDER BY NAMA_PROV");
							while($k=mysqli_fetch_array($j)){
							echo "<option value='$k[ID_PROV]'>$k[NAMA_PROV]</option>";
							}
                            ?>
                        </select>
					</div>
                     
                     <div class="form-group">
						<label for="kota">kota&nbsp;<span class="required">*</span></label><br>
						<select class="form-control" name="kota" id="kota" style="width:69%">
                            <?php
		  					$j=mysqli_query($koneksi,"select * from kota ORDER BY NAMA_KOTA");
							while($k=mysqli_fetch_array($j)){
							echo "<option class='$k[ID_PROV]' value='$k[ID_KOTA]'>$k[NAMA_KOTA]</option>";
							}
                            ?>
                        </select>
					</div>
                     
                     <div class="form-group">
						<label for="kota">Kecamatan&nbsp;<span class="required">*</span></label><br>
          				<select class="form-control" name="kec" id="kec" style="width:69%">
							<?php
							$j=mysqli_query($koneksi,"select * from kecamatan ORDER BY KECAMATAN");
							while($k=mysqli_fetch_array($j)){
							echo "<option class='$k[ID_KOTA]' value='$k[ID_KEC]'>$k[KECAMATAN]</option>";
							}
							?>
						</select>
                     </div>
                     </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="alamat" name="ALAMAT_CS" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no hp">No. HP <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="noHP" type="text" name="NO_HP_CS" data-validate-length-range="12" class="optional form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                     
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Kuliah<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="kuliah" type="text" name="KULIAH" data-validate-length="50" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Jurusan<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="jurusan" type="text" name="JURUSAN" data-validate-length="50" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Semester <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="semester" name="SEMESTER" required="required" data-validate-length-range="1" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Foto <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file" id="fileInput" name="file" />
                      </div>
                      </div>
                      
                      <span class="section">Data Orang Tua</span>
                      
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Ayah<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="nama_ayah" type="text" name="NAMA_AYAH" data-validate-length="50" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Telphone Ayah<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="telp_ayah" type="text" name="NO_HP_AYAH" data-validate-length="50" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Pekerjaan Ayah<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="pekerjaan_ayah" type="text" name="PEKERJAAN_AYAH" data-validate-length="50" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Ibu<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                       <input id="nama_ibu" type="text" name="NAMA_IBU" data-validate-length="50" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Telephone Ibu<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="telp_ibu" type="text" name="NO_HP_IBU" data-validate-length="50" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Pekerjaan Ibu<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="pekerjaan_ibu" type="text" name="PEKERJAAN_IBU" data-validate-length="50" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      
                      <div class="item form-group">
                        <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Orang Tua<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="alamat_ortu" type="text" name="ALAMAT_ORTU" data-validate-length="50" class="form-control col-md-7 col-xs-12" required="required">
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button id="send" name="simpan" type="submit" class="btn btn-success">Submit</button>
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
	
	<script src="js/jquery.chained.min.js"></script>
        <script>
            $("#kota").chained("#provinsi"); // disini kita hubungkan kota dengan provinsi
			$("#kec").chained("#kota");
        </script>


  </body>
</html>
