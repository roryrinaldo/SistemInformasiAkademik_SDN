<?php 
session_start();
include "../../../../assets/koneksi.php";
$id_wali_kelas = $_POST['id_walikelas'];
$id_kelas = $_POST['id_kelas'];
$id_siswa = $_POST['id_siswa'];
$id_ta = $_POST['id_ta'];
$id_mapel = $_POST['id_mapel'];
$nilai = $_POST['nilai'];
$deskripsi = $_POST['deskripsi'];
$status_ks = $_POST['status_ks'];
$tingkat = $_POST['tingkat'];
$semester = $_POST['semester'];

foreach ($id_mapel as $key => $v) {
  $nilaiinput = $nilai[$key];
  $deskripsiinput = $deskripsi[$key];
  $idmapel  = $v;
  $qceknilai = mysqli_query($conn, "SELECT * from nilai where id_kelas='$id_kelas' and id_ta='$id_ta' and id_wali_kelas='$id_wali_kelas' and id_mapel='$idmapel' and id_siswa='$id_siswa' and semester='$semester'");
  $jceknilai = mysqli_num_rows($qceknilai);
  if ($jceknilai>0) {
    $u = mysqli_query($conn, "UPDATE nilai set 
      nilai = '$nilaiinput',
      deskripsi = '$deskripsiinput'
      where id_kelas='$id_kelas' and id_ta='$id_ta' and id_wali_kelas='$id_wali_kelas' and id_mapel='$idmapel' and id_siswa='$id_siswa' and semester='$semester'
      ");
  }else{
    $i = mysqli_query($conn, "INSERT into nilai set
       id_kelas='$id_kelas',
       id_ta='$id_ta' ,
       semester = '$semester',
       id_wali_kelas='$id_wali_kelas' ,
       id_mapel='$idmapel' ,
       id_siswa='$id_siswa',
       nilai = '$nilaiinput',
       deskripsi = '$deskripsiinput'
      ");
  }

}
 ?>
 <script type="text/javascript">
   alert('Nilai berhasil disimpan');
   window.location.href="../../?a=detail_siswa&id=<?php echo $id_siswa ?>&t=1&id_kelas=<?php echo $id_kelas ?>&id_ta=<?php echo $id_ta ?>&tingkat=<?php echo $tingkat ?>&status_ks=<?php echo $status_ks ?>&semester=<?php echo $semester ?>"

 </script>