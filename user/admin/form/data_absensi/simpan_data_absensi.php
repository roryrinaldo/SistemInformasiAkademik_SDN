<?php 
session_start();
include "../../../../assets/koneksi.php";
$id_walikelas   = $_POST['id_walikelas'];
$id_kelas       = $_POST['id_kelas'];
$id_ta          = $_POST['id_ta'];
$semester       = $_POST['semester'];
$tanggal        = $_POST['tanggal'];
$id_siswa       = $_POST['id_siswa'];
$ket            = $_POST['ket'];

$jml_input=count($id_siswa);

for($x=0;$x<$jml_input;$x++){
    $sql = "INSERT into data_absensi VALUES (
        '',	
        '$id_walikelas',
        '$id_kelas',
        '$id_ta',
        '$semester',
        '$tanggal',
        '$id_siswa[$x]',
        '$ket[$x]'
        )";
    mysqli_query($conn, $sql)or die (mysqli_error());
}


?>
<script type='text/javascript'>
	alert('Data Absensi berhasil disimpan <?php echo $jml_input ?>');
	window.location.href="../../index.php?a=data_absensi"
</script>