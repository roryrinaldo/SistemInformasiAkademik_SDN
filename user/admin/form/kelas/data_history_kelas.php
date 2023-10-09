<?php 
$idta = $_GET['id_ta'];
 $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$idta'");
          $jta = mysqli_num_rows ($qta);
          $dta = mysqli_fetch_array($qta);
          $id_ta = $dta['id_ta'];


           ?><div class="box-header with-border">
  <h3 class="box-title">
    Data Kelas <br>
    Tahun Ajaran <?php echo $dta['nama_ta'] ?>
  </h3>
  <div class="pull-right">
    
  </div>
</div>


<?php
  
  $perintah="SELECT * From kelas ";
  $jalan=mysqli_query($conn, $perintah);

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<table class="table table-striped table-bordered" id="example1">
	<thead>
	<tr>
		<td>No</td>
    <td>Kelas</td>
    <td>Lokal</td>
		<td>Wali Kelas</td>
    <td>Jumlah Siswa</td>
		<td>Option</td>
	</tr>
</thead>
	

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
$idkelas = $data['id_kelas'];
$q = mysqli_query($conn, "SELECT c.status_ks as status_ks, b.nama_guru, a.status_wali_kelas from wali_kelas a 
                          left join guru b on a.id_guru = b.id_guru left join kelas_siswa c on a.id_kelas=c.id_kelas where a.id_kelas = '$idkelas' and c.id_ta='$idta' ");
$d = mysqli_fetch_array($q);
$j = mysqli_num_rows($q);

$qmapel = mysqli_query($conn, "SELECT * from kelas_siswa where id_kelas='$idkelas' and id_ta='$id_ta'");
$jmapel = mysqli_num_rows($qmapel);

$status_wali_kelas = $d['status_wali_kelas'];
$status_ks=$d['status_ks'];
if ($status_ks=='Lanjut') {
  $walikelas = $d['nama_guru'];
}else{
  $walikelas = "-";
}

$id=$data['id_kelas'];
$kelas=$data['nama_kelas'];
;

?>
	<tr>
		<td><?php echo $no++; ?></td>
    <td><?php echo $data['tingkat']; ?></td>
    <td><?php echo $kelas; ?></td>
    <td><?php echo $walikelas; ?></td>
    <td><?php echo $jmapel; ?></td>
    
    <td>
      <a href="?a=manage_history_kelas&id=<?php echo $id ?>&id_ta=<?php echo $idta ?>" class="btn btn-info btn-xs">Management kelas</a> 
    </td>
  </tr>

		<?php } ?>
				
	</table>
