<div class="box-header with-border">
  <h3 class="box-title">
    Data Kelas(Per Mata Pelajaran)
  </h3>
  <div class="pull-right">
  
  </div>
  
</div>


<?php
  
  $perintah="SELECT * From kelas group by tingkat";
  $jalan=mysqli_query($conn, $perintah);

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<table class="table table-striped table-bordered" id="example1">
	<thead>
	<tr>
		<td>No</td>
    <td>Kelas</td>
    <td>Jumlah Mata Pelajaran</td>
		<td>Option</td>
	</tr>
</thead>
	

<?php

while ($data=mysqli_fetch_array($jalan))
{ 
  $idkelas = $data['id_kelas'];
  $tingkat = $data['tingkat'];
$q = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.status_wali_kelas='1' and a.id_kelas = '$idkelas'");
$d = mysqli_fetch_array($q);
$j = mysqli_num_rows($q);

$qmapel = mysqli_query($conn, "SELECT * from mapel where tingkat='$tingkat'");
$jmapel = mysqli_num_rows($qmapel);
$status_wali_kelas = $d['status_wali_kelas'];
if ($status_wali_kelas>0) {
  $walikelas = $d['nama_guru'];
}else{
  $walikelas = "Wali kelas belum ditentukan";

}
$id=$data['id_kelas'];
$kelas=$data['nama_kelas'];
;

?>
	<tr>
		<td><?php echo $no++; ?></td>
    <td><?php echo $data['tingkat']; ?></td>
    <td>  <?php echo  $jmapel; ?></td>	
    <td>
      <a href="?a=manage_mapel&tingkat=<?php echo $data['tingkat'] ?>" class="btn btn-info btn-xs">Management Mata Pelajaran</a> 
    </td>
	</tr>

<?php } ?>
				
</table>
