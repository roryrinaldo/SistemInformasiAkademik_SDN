<?php
include '../../../../assets/koneksi.php';
$id=$_GET['id'];

$sql="DELETE from data_absensi where id='$id'";
$result=mysqli_query($conn, $sql) or die ('GAGAL');
?>
<script type="text/javascript">
	alert('Data absensi dihapus');
	window.location.href='../../?a=data_absensi'
</script>