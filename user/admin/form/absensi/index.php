<?php 
$id_wk = $_SESSION['id_user'];
$lv = $_SESSION['level'];
$nama_semester = [1=>'Ganjil','Genap'];

if ($lv=="Wali Kelas" ) {
  $quser = mysqli_query($conn, "SELECT * from wali_kelas a left join guru b on a.id_guru = b.id_guru 
    left join kelas c on a.id_kelas = c.id_kelas
    where a.id_guru='$iduser' and a.status_wali_kelas=1")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $namauser= $duser['nama_guru'];
  $namakelas = $duser['nama_kelas'];
  $idkelas = $duser['id_kelas'];
}
 ?>

<div class="box-header with-border">
  <h3 class="box-title">
    Data Absensi
    <?php echo $namakelas; ?>  
  </h3>
</div>

<?php
  $perintah="SELECT a.id_ks, a.id_kelas, a.id_ta,
    b.nama_ta, b.status_ta,
    c.nama_kelas, c.tingkat,
    d.id_walikelas
    from kelas_siswa a 
    left join tahun_ajaran b on a.id_ta = b.id_ta
    left join kelas c on a.id_kelas = c.id_kelas
    left join wali_kelas d on c.id_kelas = d.id_kelas
    LEFT JOIN guru e on d.id_guru = e.id_guru
    where a.id_kelas='$idkelas' and d.status_wali_kelas='1' and b.status_ta='Aktif' group by a.id_ta";
  $jalan=mysqli_query($conn, $perintah);

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<div class="alert">
<table class="table table-striped table-bordered" id="example1">
  <thead>
  <tr>
    <td>No</td>
    <td>Kelas</td>
    <td>Lokal</td>
    <td>Tahun Ajaran</td>
    <td>Status Tahun Ajaran</td>
    <td>Status Wali Kelas</td>
    <td>Jumlah Siswa</td>
    <td>Lihat Absensi Semester</td>
  </tr>
</thead>
  

<?php
  $status_wali_kelas = ['Tidak Aktif','Aktif'];
  while ($data=mysqli_fetch_array($jalan))
{ 

  $id_walikelas = $data['id_walikelas'];
  $q_cek_status_wk = mysqli_query($conn, "SELECT * from wali_kelas where id_walikelas='$id_walikelas'");
  $d_cek_status_wk = mysqli_fetch_array($q_cek_status_wk);
  $idkelas = $data['id_kelas'];
  $id_ta = $data['id_ta'];

  $q_semester = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$id_ta'");

  // qks = query kelas siswa
  $qks = mysqli_query($conn, "SELECT * from kelas_siswa where id_kelas='$idkelas'  and id_ta='$id_ta'");
  $jks = mysqli_num_rows($qks);

?>
  <tr>
    <td><?php echo $no++; ?></td>  
    <td><?php echo $data['tingkat']; ?></td>
    <td><?php echo $data['nama_kelas']; ?></td>
    <td><?php echo $data['nama_ta']; ?></td>
    <td><?php echo $data['status_ta']; ?></td>
    <td><?php echo $status_wali_kelas[$d_cek_status_wk['status_wali_kelas']]; ?></td>
    <td>  <?php echo  $jks; ?></td>
    
    <td>
      <?php while ($d_semester = mysqli_fetch_array($q_semester)) { 
        $semester_aktif= $nama_semester[$d_semester['semester']]?>
        <a href="?a=data_absensi_siswa_perkelas&id_kelas=<?php echo $idkelas ?>&id_ta=<?php echo $id_ta ?>&semester=<?php echo $d_semester['semester'] ?>" class="btn btn-info btn-xs"><?php echo $semester_aktif ?></a> 
        
      <?php } ?>

    </td>
  </tr>

    <?php } ?>
        
  </table>
      </div>
