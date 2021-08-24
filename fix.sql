-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jul 2019 pada 08.17
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fix`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `kode_du` (`nomer` INT) RETURNS CHAR(5) CHARSET latin1 NO SQL
BEGIN
DECLARE kodebaru CHAR(5);
DECLARE urut INT;
 
SET urut = IF(nomer IS NULL, 1, nomer + 1);
SET kodebaru = CONCAT("DU", LPAD(urut, 3, 0));
 
RETURN kodebaru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `kode_ortu` (`nomer` INT) RETURNS CHAR(5) CHARSET latin1 NO SQL
BEGIN
DECLARE kodebaru CHAR(5);
DECLARE urut INT;
 
SET urut = IF(nomer IS NULL, 1, nomer + 1);
SET kodebaru = CONCAT("OT", LPAD(urut, 3, 0));
 
RETURN kodebaru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `kode_periode` (`nomer` INT) RETURNS CHAR(5) CHARSET latin1 NO SQL
BEGIN
DECLARE kodebaru CHAR(5);
DECLARE urut INT;
 
SET urut = IF(nomer IS NULL, 1, nomer + 1);
SET kodebaru = CONCAT("PR", LPAD(urut, 3, 0));
 
RETURN kodebaru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `kode_tahun` (`nomer` INT) RETURNS CHAR(5) CHARSET latin1 NO SQL
BEGIN
DECLARE kodebaru CHAR(5);
DECLARE urut INT;
 
SET urut = IF(nomer IS NULL, 1, nomer + 1);
SET kodebaru = CONCAT("TH", LPAD(urut, 3, 0));
 
RETURN kodebaru;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `EMAIL` char(10) NOT NULL,
  `ID_OTORITAS` char(5) NOT NULL,
  `USERNAME` varchar(15) NOT NULL,
  `PASSWORD` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`EMAIL`, `ID_OTORITAS`, `USERNAME`, `PASSWORD`) VALUES
('adit@gmail', '2', 'adit', 'adit'),
('didi@gmail', '2', 'didi', 'didi'),
('dika@gmail', '2', 'dika', 'dika'),
('dita@gmail', '2', 'dita', 'dita'),
('emir@gmail', '1', 'admin', 'admin'),
('heru@gmail', '2', 'heru', 'heru'),
('iwan@gmail', '2', 'iwan', 'iwan'),
('poko@gmail', '2', 'poko', 'poko'),
('tata@gmail', '2', 'tata', 'tata'),
('toto@gmail', '2', 'toto', 'toto'),
('yaya@gmail', '2', 'yaya', 'YAYA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_santri`
--

CREATE TABLE `calon_santri` (
  `ID_CS` char(5) NOT NULL,
  `ID_ORTU` char(15) NOT NULL,
  `EMAIL` char(10) NOT NULL,
  `ID_KEC` char(5) NOT NULL,
  `NAMA_CS` varchar(25) NOT NULL,
  `TEMPAT_LHR_CS` varchar(10) NOT NULL,
  `TGL_LHR_CS` date NOT NULL,
  `NO_HP_CS` char(12) NOT NULL,
  `ALAMAT_CS` varchar(100) NOT NULL,
  `JK_CS` varchar(10) NOT NULL,
  `KULIAH` varchar(50) NOT NULL,
  `JURUSAN` varchar(50) NOT NULL,
  `SEMESTER` char(1) NOT NULL,
  `TGL_DAFTAR` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FOTO` varchar(30) NOT NULL,
  `TOTAL_NILAI` decimal(4,0) NOT NULL,
  `STATUS_SELEKSI` varchar(30) NOT NULL,
  `STATUS` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `calon_santri`
--

INSERT INTO `calon_santri` (`ID_CS`, `ID_ORTU`, `EMAIL`, `ID_KEC`, `NAMA_CS`, `TEMPAT_LHR_CS`, `TGL_LHR_CS`, `NO_HP_CS`, `ALAMAT_CS`, `JK_CS`, `KULIAH`, `JURUSAN`, `SEMESTER`, `TGL_DAFTAR`, `FOTO`, `TOTAL_NILAI`, `STATUS_SELEKSI`, `STATUS`) VALUES
('19001', 'OT001', 'iwan@gmail', '3', 'iwan', 'Sidoarjo', '1998-04-16', '085123456789', 'desa taman kecamatan taman sidoarjo', 'Laki-Laki', 'untag', 'manajemen', '6', '2019-07-24 06:11:09', '18072019055441.jpeg', '0', 'TIDAK DITERIMA', NULL),
('19002', 'OT002', 'heru@gmail', '1', 'heru zami', 'Surabaya', '1998-03-13', '085123456789', 'nginden jangkungan', 'Laki-Laki', 'Universitas Airlangga', 'Sistem Informasi', '6', '2019-07-24 06:11:14', '19072019022740.jpeg', '0', 'TIDAK DITERIMA', NULL),
('19003', 'OT003', 'adit@gmail', '1', 'adit falacha arvin', 'Surabaya', '1998-05-03', '085123456789', 'nginden jangkungan', 'Laki-Laki', 'Universitas Airlangga', 'Sistem Informasi', '6', '2019-07-24 06:11:20', '19072019031718.jpeg', '0', 'TIDAK DITERIMA', NULL),
('19004', 'OT004', 'poko@gmail', '2', 'poko setiawan', 'Sidoarjo', '1998-02-16', '085123456789', 'desa taman kecamatan taman sidoarjo', 'Laki-Laki', 'Universitas Airlangga', 'Sistem Informasi', '6', '2019-07-24 06:11:24', '19072019042017.jpeg', '0', 'TIDAK DITERIMA', NULL),
('19005', 'OT005', 'dita@gmail', '2', 'dita', 'Sidoarjo', '1998-04-16', '085123456789', 'desa taman kecamatan taman sidoarjo', 'Laki-Laki', 'Universitas Airlangga', 'Sistem Informasi', '6', '2019-07-24 06:11:29', '19072019093547.jpeg', '0', 'TIDAK DITERIMA', NULL),
('19006', 'OT006', 'tata@gmail', '1', 'tata', 'Surabaya', '1998-03-16', '085123456789', 'nginden jangkungan', 'Laki-Laki', 'Universitas Airlangga', 'Sistem Informasi', '6', '2019-07-24 06:11:32', '19072019103034.jpeg', '0', 'TIDAK DITERIMA', NULL),
('19007', 'OT008', 'yaya@gmail', '1', 'yaya nur m.', 'Surabaya', '1998-03-14', '085123456789', 'nginden jangkungan', 'Laki-Laki', 'Universitas Airlangga', 'Sistem Informasi', '6', '2019-07-25 08:32:39', '19072019103422.jpeg', '255', 'TIDAK DITERIMA', 'TERDAFTAR'),
('19008', 'OT010', 'emir@gmail', '1', 'bagas adi syaputra', 'Surabaya', '1998-03-02', '085123456789', 'bendul merisi no.12', 'Laki-Laki', 'untag', 'S1 manajemen', '2', '2019-07-25 08:32:47', '19072019070611.jpeg', '285', 'TIDAK DITERIMA', 'TERDAFTAR'),
('19009', 'OT011', 'emir@gmail', '3', 'heneigger yovanda nauval', 'Surabaya', '1998-02-20', '085123456789', 'desa taman kecamatan taman sidoarjo', 'Laki-Laki', 'Universitas Airlangga', 'D3 Sistem Informasi', '6', '2019-07-25 08:36:35', '19072019071301.jpeg', '245', 'DITERIMA', 'TERDAFTAR'),
('19010', 'OT012', 'emir@gmail', '1', 'aldino', 'Surabaya', '1998-03-14', '085123456789', 'nginden jangkungan', 'Laki-laki', 'Universitas Airlangga', 'Sistem Informasi', '6', '2019-07-25 08:32:30', '22072019040700.jpeg', '245', 'TIDAK DITERIMA', 'TERDAFTAR'),
('19011', 'OT014', 'dika@gmail', '3', 'dika', 'Sidoarjo', '1998-02-15', '085123456789', 'desa taman kecamatan taman sidoarjo', 'Laki-Laki', 'untag', 'S1 manajemen', '2', '2019-07-24 13:27:56', '24072019042037.jpeg', '240', 'TIDAK DITERIMA', 'TERDAFTAR'),
('19012', 'OT017', 'emir@gmail', '1', 'tika', '1', '1998-03-16', '085123456789', 'nginden jangkungan', 'Laki-laki', 'Universitas Airlangga', 'D3 Sistem Informasi', '6', '2019-07-25 08:32:55', '24072019044901.jpeg', '295', 'TIDAK DITERIMA', 'TERDAFTAR'),
('19013', 'OT018', 'emir@gmail', '1', 'wewe', 'Sidoarjo', '1998-05-17', '085123456789', 'nginden jangkungan', 'Laki-laki', 'Universitas Airlangga', 'manajemen', '6', '2019-07-25 08:36:35', '24072019045336.jpeg', '265', 'DITERIMA', 'TERDAFTAR'),
('19014', 'OT019', 'toto@gmail', '1', 'toto', 'Surabaya', '1998-02-18', '085123456789', 'nginden jangkungan', 'Laki-Laki', 'Universitas Airlangga', 'manajemen', '2', '2019-07-24 06:13:03', '24072019053044.jpeg', '180', 'TIDAK DITERIMA', 'TERDAFTAR'),
('19015', 'OT020', 'didi@gmail', '3', 'didi', 'Sidoarjo', '1998-02-11', '085123456789', 'taman sidoarjo', 'Laki-Laki', 'ubaya', 'teknik industri', '2', '2019-07-25 08:36:35', '24072019064315.jpeg', '294', 'DITERIMA', 'TERDAFTAR');

--
-- Trigger `calon_santri`
--
DELIMITER $$
CREATE TRIGGER `set_calonsantri` BEFORE INSERT ON `calon_santri` FOR EACH ROW begin
	declare jumlah integer;
    declare urut integer;
    DECLARE telepon VARCHAR(30);
    select count(*) into jumlah from calon_santri where
	SUBSTRING(ID_CS, 1, 2)= SUBSTRING(EXTRACT(YEAR FROM CURRENT_TIMESTAMP), 3, 2);
    set urut := jumlah +1;
	set NEW.ID_CS:= concat((SUBSTRING(EXTRACT(YEAR FROM CURRENT_TIMESTAMP), 3, 2)),LPAD(urut,3,'0'));
    
    SET NEW.TGL_DAFTAR = CURRENT_TIMESTAMP();
    
    SET NEW.STATUS = 'TERDAFTAR';
    
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_ulang`
--

CREATE TABLE `daftar_ulang` (
  `ID_DU` char(5) NOT NULL,
  `ID_CS` char(5) NOT NULL,
  `TGL_DU` varchar(20) NOT NULL,
  `TOTAL_DU` varchar(10) NOT NULL,
  `STATUS_BAYAR` varchar(20) NOT NULL,
  `BUKTI_DU` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_ulang`
--

INSERT INTO `daftar_ulang` (`ID_DU`, `ID_CS`, `TGL_DU`, `TOTAL_DU`, `STATUS_BAYAR`, `BUKTI_DU`) VALUES
('DU001', '19009', '22-07-2019', '686.000', 'Lunas', ''),
('DU002', '19008', '22-07-2019', '686.000', 'Lunas', ''),
('DU003', '19007', '23-07-2019', '686.000', 'LUNAS', '23072019064608.png'),
('DU004', '19011', '24-07-2019', '686.000', 'LUNAS', '24072019052046.jpeg'),
('DU005', '19014', '24-07-2019', '686.000', 'LUNAS', '24072019053250.jpeg'),
('DU006', '19015', '24-07-2019', '686.000', 'LUNAS', '24072019064808.png'),
('DU007', '19010', '25-07-2019', '686.000', 'BELUM LUNAS', '');

--
-- Trigger `daftar_ulang`
--
DELIMITER $$
CREATE TRIGGER `set_du` BEFORE INSERT ON `daftar_ulang` FOR EACH ROW BEGIN

DECLARE s CHAR(5);
DECLARE i INTEGER;

	SET i = (SELECT SUBSTRING(ID_DU,4,4) AS Nomer
	FROM daftar_ulang ORDER BY Nomer DESC LIMIT 1);
 
	SET s = (SELECT kode_du(i));
 
	IF(NEW.id_du IS NULL OR NEW.id_du = '')
 	THEN SET NEW.id_du =s;
	END IF;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil`
--

CREATE TABLE `detil` (
  `ID_PERIODE` char(5) NOT NULL,
  `ID_CS` char(5) NOT NULL,
  `ID_UJIAN` char(5) NOT NULL,
  `NILAI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detil`
--

INSERT INTO `detil` (`ID_PERIODE`, `ID_CS`, `ID_UJIAN`, `NILAI`) VALUES
('PR001', '19009', '1', 80),
('PR001', '19009', '2', 80),
('PR001', '19009', '3', 85),
('PR001', '19010', '1', 90),
('PR001', '19010', '2', 65),
('PR001', '19010', '3', 90),
('PR001', '19011', '1', 80),
('PR001', '19011', '2', 85),
('PR001', '19011', '3', 75),
('PR001', '19013', '1', 100),
('PR001', '19013', '2', 75),
('PR001', '19013', '3', 90),
('PR001', '19015', '1', 96),
('PR001', '19015', '2', 98),
('PR001', '19015', '3', 100),
('PR002', '19007', '1', 90),
('PR002', '19007', '2', 80),
('PR002', '19007', '3', 85),
('PR002', '19008', '1', 100),
('PR002', '19008', '2', 90),
('PR002', '19008', '3', 95),
('PR002', '19010', '1', 90),
('PR002', '19010', '2', 65),
('PR002', '19010', '3', 90),
('PR002', '19011', '1', 80),
('PR002', '19011', '2', 85),
('PR002', '19011', '3', 75),
('PR002', '19012', '1', 100),
('PR002', '19012', '2', 95),
('PR002', '19012', '3', 100),
('PR002', '19014', '1', 60),
('PR002', '19014', '2', 70),
('PR002', '19014', '3', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `ID_KEC` char(5) NOT NULL,
  `ID_KOTA` char(5) NOT NULL,
  `KECAMATAN` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`ID_KEC`, `ID_KOTA`, `KECAMATAN`) VALUES
('1', '1', 'Sukolilo'),
('2', '2', 'Krian'),
('3', '2', 'Taman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `ID_KOTA` char(5) NOT NULL,
  `ID_PROV` char(5) NOT NULL,
  `NAMA_KOTA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`ID_KOTA`, `ID_PROV`, `NAMA_KOTA`) VALUES
('1', '1', 'Surabaya'),
('2', '1', 'Sidoarjo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orang_tua`
--

CREATE TABLE `orang_tua` (
  `ID_ORTU` char(15) NOT NULL,
  `NAMA_AYAH` varchar(25) NOT NULL,
  `PEKERJAAN_AYAH` varchar(15) NOT NULL,
  `NO_HP_AYAH` decimal(12,0) NOT NULL,
  `NAMA_IBU` varchar(25) NOT NULL,
  `PEKERJAAN_IBU` varchar(15) NOT NULL,
  `NO_HP_IBU` decimal(12,0) NOT NULL,
  `ALAMAT_ORTU` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orang_tua`
--

INSERT INTO `orang_tua` (`ID_ORTU`, `NAMA_AYAH`, `PEKERJAAN_AYAH`, `NO_HP_AYAH`, `NAMA_IBU`, `PEKERJAAN_IBU`, `NO_HP_IBU`, `ALAMAT_ORTU`) VALUES
('OT001', 'lukman', 'wiraswasta', '850987655432', 'yayang', 'ibu rumah tangg', '85890678567', 'desa taman kecamatan taman sidoarjo'),
('OT002', 'poko', 'PNS', '850987655432', 'sri', 'ibu rumah tangg', '85678345123', 'nginden jangkungan'),
('OT003', 'juli', 'wiraswasta', '85607123456', 'santi', 'ibu rumah tangg', '85890678567', 'nginden jangkungan'),
('OT004', 'hakim', 'PNS', '85607123456', 'yayang', 'ibu rumah tangg', '85890678567', 'desa taman kecamatan taman sidoarjo'),
('OT005', 'juli', 'PNS', '850987655432', 'santi', 'ibu rumah tangg', '85678345123', 'desa taman kecamatan taman sidoarjo'),
('OT006', 'yadi', 'wiraswasta', '85607123456', 'yayang', 'ibu rumah tangg', '85890678567', 'nginden jangkungan'),
('OT007', 'yadi', 'wiraswasta', '85607123456', 'yayang', 'ibu rumah tangg', '85890678567', 'nginden jangkungan'),
('OT008', 'aditiyo', 'wiraswasta', '85607123456', 'santiasih', 'pegawai', '85890678567', 'nginden jangkungan'),
('OT009', 'aziz', 'PNS', '850987655432', 'nana', 'ibu rumah tangg', '85678345123', 'Surabaya '),
('OT010', 'aziz', 'PNS', '850987655432', 'nana ', 'ibu rumah tangg', '85678345123', 'Surabaya '),
('OT011', 'wahyudi', 'PNS', '85607123456', 'rahmadhani', 'pegawai', '85890678567', 'sidoarjo'),
('OT012', 'juli', 'PNS', '85607123456', 'ibu', 'ibu rumah tangg', '85890678567', 'Surabaya '),
('OT013', 'yadi', 'PNS', '85607123456', 'ibu', 'ibu rumah tangg', '85890678567', 'Surabaya '),
('OT014', 'adi', 'wiraswasta', '85607123456', 'lilik', 'ibu rumah tangg', '85890678567', 'desa taman kecamatan taman sidoarjo'),
('OT017', 'rere', 'wiraswasta', '850987655432', 'rara', 'ibu rumah tangg', '85890678567', 'Surabaya '),
('OT018', 'ali', 'wiraswasta', '850987655432', 'lia', 'pegawai', '85890678567', 'Surabaya '),
('OT019', 'ayah', 'wiraswasta', '850987655432', 'siti', 'ibu rumah tangg', '85890678567', 'nginden jangkungan'),
('OT020', 'dodon', 'PNS', '850987655432', 'yani', 'guru', '85890678567', 'taman sidoarjo');

--
-- Trigger `orang_tua`
--
DELIMITER $$
CREATE TRIGGER `set_ortu` BEFORE INSERT ON `orang_tua` FOR EACH ROW BEGIN

DECLARE s CHAR(5);
DECLARE i INTEGER;

	SET i = (SELECT SUBSTRING(ID_ORTU,4,4) AS Nomer
	FROM orang_tua ORDER BY Nomer DESC LIMIT 1);
 
	SET s = (SELECT kode_ortu(i));
 
	IF(NEW.id_ortu IS NULL OR NEW.id_ortu = '')
 	THEN SET NEW.id_ortu =s;
	END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `otoritas`
--

CREATE TABLE `otoritas` (
  `ID_OTORITAS` char(5) NOT NULL,
  `NAMA_OTORITAS` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `otoritas`
--

INSERT INTO `otoritas` (`ID_OTORITAS`, `NAMA_OTORITAS`) VALUES
('1', 'panitia'),
('2', 'calon santri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_PANITIA` char(5) NOT NULL,
  `ID_KEC` char(5) NOT NULL,
  `EMAIL` char(10) NOT NULL,
  `NAMA_PEG` varchar(30) NOT NULL,
  `TGL_LHR_PEG` date NOT NULL,
  `JK_PEG` varchar(10) NOT NULL,
  `TLP_PEG` varchar(12) NOT NULL,
  `ALAMAT_PEG` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `ID_PERIODE` char(5) NOT NULL,
  `ID_TAHUN` char(5) NOT NULL,
  `PERIODE` varchar(6) NOT NULL,
  `KUOTA` varchar(3) DEFAULT NULL,
  `TGL_UJIAN` date DEFAULT NULL,
  `TGL_PENGUMUMAN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`ID_PERIODE`, `ID_TAHUN`, `PERIODE`, `KUOTA`, `TGL_UJIAN`, `TGL_PENGUMUMAN`) VALUES
('PR001', 'TH001', 'genap', '3', '2019-02-07', '2019-07-14'),
('PR002', 'TH002', 'ganjil', NULL, '2020-07-19', '2020-07-26'),
('PR003', 'TH003', 'genap', NULL, '2021-02-02', '2021-02-09');

--
-- Trigger `periode`
--
DELIMITER $$
CREATE TRIGGER `set_periode` BEFORE INSERT ON `periode` FOR EACH ROW BEGIN

DECLARE s CHAR(5);
DECLARE i INTEGER;

	SET i = (SELECT SUBSTRING(ID_PERIODE,4,4) AS Nomer
	FROM periode ORDER BY Nomer DESC LIMIT 1);
 
	SET s = (SELECT kode_periode(i));
 
	IF(NEW.id_periode IS NULL OR NEW.id_periode = '')
 	THEN SET NEW.id_periode =s;
	END IF;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `provinsi`
--

CREATE TABLE `provinsi` (
  `ID_PROV` char(5) NOT NULL,
  `NAMA_PROV` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `provinsi`
--

INSERT INTO `provinsi` (`ID_PROV`, `NAMA_PROV`) VALUES
('1', 'Jawa Timur'),
('2', 'Jawa Tengah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun`
--

CREATE TABLE `tahun` (
  `ID_TAHUN` char(5) NOT NULL,
  `TAHUN` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tahun`
--

INSERT INTO `tahun` (`ID_TAHUN`, `TAHUN`) VALUES
('TH001', '2019'),
('TH002', '2020'),
('TH003', '2021');

--
-- Trigger `tahun`
--
DELIMITER $$
CREATE TRIGGER `set_tahun` BEFORE INSERT ON `tahun` FOR EACH ROW BEGIN

DECLARE s CHAR(5);
DECLARE i INTEGER;

	SET i = (SELECT SUBSTRING(ID_TAHUN,4,4) AS Nomer
	FROM tahun ORDER BY Nomer DESC LIMIT 1);
 
	SET s = (SELECT kode_tahun(i));
 
	IF(NEW.id_tahun IS NULL OR NEW.id_tahun = '')
 	THEN SET NEW.id_tahun =s;
	END IF;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE `ujian` (
  `ID_UJIAN` char(5) NOT NULL,
  `NAMA_UJIAN` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ujian`
--

INSERT INTO `ujian` (`ID_UJIAN`, `NAMA_UJIAN`) VALUES
('1', 'Baca Quran'),
('2', 'Ujian Tulis'),
('3', 'Wawancara');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`EMAIL`),
  ADD KEY `FK_MEMPUNYAI2` (`ID_OTORITAS`);

--
-- Indeks untuk tabel `calon_santri`
--
ALTER TABLE `calon_santri`
  ADD PRIMARY KEY (`ID_CS`),
  ADD KEY `FK_MEMERLUKAN` (`EMAIL`),
  ADD KEY `FK_MENCANTUMKAN` (`ID_ORTU`),
  ADD KEY `FK_MENEMPATI` (`ID_KEC`);

--
-- Indeks untuk tabel `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD PRIMARY KEY (`ID_DU`),
  ADD KEY `FK_MELAKUKAN2` (`ID_CS`);

--
-- Indeks untuk tabel `detil`
--
ALTER TABLE `detil`
  ADD PRIMARY KEY (`ID_PERIODE`,`ID_CS`,`ID_UJIAN`),
  ADD KEY `FK_MELAKUKAN` (`ID_UJIAN`),
  ADD KEY `FK_MEMPUNYAI3` (`ID_CS`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`ID_KEC`),
  ADD KEY `FK_MEMILIKI` (`ID_KOTA`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`ID_KOTA`),
  ADD KEY `FK_MEMILIKI2` (`ID_PROV`);

--
-- Indeks untuk tabel `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`ID_ORTU`);

--
-- Indeks untuk tabel `otoritas`
--
ALTER TABLE `otoritas`
  ADD PRIMARY KEY (`ID_OTORITAS`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID_PANITIA`),
  ADD KEY `FK_MEMILIKI3` (`EMAIL`),
  ADD KEY `FK_MEMPUNYAI` (`ID_KEC`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`ID_PERIODE`),
  ADD KEY `FK_MEMPUNYAI5` (`ID_TAHUN`);

--
-- Indeks untuk tabel `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`ID_PROV`);

--
-- Indeks untuk tabel `tahun`
--
ALTER TABLE `tahun`
  ADD PRIMARY KEY (`ID_TAHUN`);

--
-- Indeks untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`ID_UJIAN`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `FK_MEMPUNYAI2` FOREIGN KEY (`ID_OTORITAS`) REFERENCES `otoritas` (`ID_OTORITAS`);

--
-- Ketidakleluasaan untuk tabel `calon_santri`
--
ALTER TABLE `calon_santri`
  ADD CONSTRAINT `FK_MEMERLUKAN` FOREIGN KEY (`EMAIL`) REFERENCES `akun` (`EMAIL`),
  ADD CONSTRAINT `FK_MENCANTUMKAN` FOREIGN KEY (`ID_ORTU`) REFERENCES `orang_tua` (`ID_ORTU`),
  ADD CONSTRAINT `FK_MENEMPATI` FOREIGN KEY (`ID_KEC`) REFERENCES `kecamatan` (`ID_KEC`);

--
-- Ketidakleluasaan untuk tabel `daftar_ulang`
--
ALTER TABLE `daftar_ulang`
  ADD CONSTRAINT `FK_MELAKUKAN2` FOREIGN KEY (`ID_CS`) REFERENCES `calon_santri` (`ID_CS`);

--
-- Ketidakleluasaan untuk tabel `detil`
--
ALTER TABLE `detil`
  ADD CONSTRAINT `FK_MELAKUKAN` FOREIGN KEY (`ID_UJIAN`) REFERENCES `ujian` (`ID_UJIAN`),
  ADD CONSTRAINT `FK_MEMILIKI4` FOREIGN KEY (`ID_PERIODE`) REFERENCES `periode` (`ID_PERIODE`),
  ADD CONSTRAINT `FK_MEMPUNYAI3` FOREIGN KEY (`ID_CS`) REFERENCES `calon_santri` (`ID_CS`);

--
-- Ketidakleluasaan untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_KOTA`) REFERENCES `kota` (`ID_KOTA`);

--
-- Ketidakleluasaan untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD CONSTRAINT `FK_MEMILIKI2` FOREIGN KEY (`ID_PROV`) REFERENCES `provinsi` (`ID_PROV`);

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `FK_MEMILIKI3` FOREIGN KEY (`EMAIL`) REFERENCES `akun` (`EMAIL`),
  ADD CONSTRAINT `FK_MEMPUNYAI` FOREIGN KEY (`ID_KEC`) REFERENCES `kecamatan` (`ID_KEC`);

--
-- Ketidakleluasaan untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD CONSTRAINT `FK_MEMPUNYAI5` FOREIGN KEY (`ID_TAHUN`) REFERENCES `tahun` (`ID_TAHUN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
