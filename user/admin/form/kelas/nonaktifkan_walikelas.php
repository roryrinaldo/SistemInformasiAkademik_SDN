<?php
include '../../../../assets/koneksi.php';
$id=$_GET['id'];
$id_kelas=$_GET['id_kelas'];
$id_wk=$_GET['id_wk'];




$sql="UPDATE wali_kelas set status_wali_kelas='0' where id_walikelas='$id_wk'";

$result=mysqli_query($conn, $sql) or die ('GAGAL');
?>
<script type="text/javascript">
	alert('Wali kelas di nonaktifkan');
	window.location.href='../../?a=manage_kelas&id=<?php echo $id_kelas ?>'
</script>