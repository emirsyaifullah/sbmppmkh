<?php
include "koneksi.php";
?>

<?php

$total=mysqli_query($koneksi,"SELECT BACA_QURAN,UJIAN_TULIS,WAWANCARA, BACA_QURAN+UJIAN_TULIS+WAWANCARA
FROM seleksi WHERE ID_SELEKSI='SL001'");

echo $total;
?>