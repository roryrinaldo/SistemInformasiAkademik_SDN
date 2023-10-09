<?php 
// ta = tahun ajaran  
$id_ta_aktif = $_GET['id_ta'];
$id_kelas = $_GET['id_kelas'];
$id_wk = $_SESSION['id_user'];
$semester_ke = $_GET['semester'];
$semester = [1=>'Ganjil','Genap'];  

  $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$id_ta_aktif' and semester='$semester_ke'");
  $jta = mysqli_num_rows ($qta);
  $dta = mysqli_fetch_array($qta);
  $id_ta = $dta['id_ta'];
  $semester_aktif = $dta['semester'];
  $qkelas = mysqli_query($conn, "SELECT * from kelas where id_kelas='$id_kelas'");
  $dkelas = mysqli_fetch_array($qkelas);


   $qcekwk = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_guru, b.nip, a.username, 
   a.id_walikelas from wali_kelas a left join guru b on a.id_guru = b.id_guru where a.id_kelas='$id_kelas' 
   order by id_walikelas desc limit 1");
      $jcekwk = mysqli_num_rows($qcekwk);
      $dcekwk = mysqli_fetch_array($qcekwk);
      $id_wk_aktif = $dcekwk['id_guru'];
      $id_wali_kelas = $_SESSION['id_walikelas'];
 ?>

<div class="col-md-4">
   <div class="box-header with-border">
      <h3 class="box-title">
       Identitas Kelas

      </h3>
      
      
      
    </div>
    <div class="box-body">
      
      
        <table class="table">
          <tr>
            <td>Kelas</td>
            <td><?php echo $dkelas['tingkat'] ?></td>
          </tr>
          <tr>
            <td>Lokal</td>
            <td><?php echo   $dkelas['nama_kelas'] ?></td>
          </tr>
          <tr>
            <td>Tahun Ajaran</td>
            <td><?php echo $dta['nama_ta'] ?></td>
          </tr>
          <tr>
            <td>Semester</td>
            <td>
              <?php echo $semester[$semester_ke].'<br>'; 
              if ($dta['semester']=='2') { ?>
                <!-- <a href="">Lihat Semester Ganjil</a> -->
              <?php } ?>
              
            </td>
          </tr>
          <tr>
            <td>Status Tahun Ajaran</td>
            <td><?php echo $dta['status_ta'] ?></td>
          </tr>
     
          <tr>
            <td>Wali Kelas</td>
            <td><?php echo $dcekwk['nama_guru'] ?></td>
          </tr>
          <tr>
            <td>NIP</td>
            <td><?php echo $dcekwk['nip'] ?></td>
          </tr>
     
         
        </table>
    </div>



</div>
<div class="col-md-8">
  <div class="box-header with-border">
    <h3 class="box-title">
      Data Absensi

    </h3>
   
  </div>
<div style="overflow-x: scroll;">
  <table class="table table-striped table-bordered" id="example1">
    <thead>
      <tr>
        <td rowspan="2">No</td>
        <td rowspan="2">NIS</td>
        
        <td rowspan="2">Nama siswa</td>
        <td rowspan="2">Jenis Kelamin</td>
        <td rowspan="2">Kehadiran</td>
        <td colspan="3" align="center">Ketidak hadiran</td>
        <!-- <td colspan="6" align="center">Kondisi Kesehatan</td> -->
       
        
      </tr>
      <tr>
        <td>Sakit</td>
        <td>Izin</td>
        <td>Tanpa Keterangan</td>
        
        
      </tr>
      
    </thead>
    

  <?php
  $no=1;
  $siswa = mysqli_query($conn, "SELECT a.status_ks, a.id_siswa, a.id_kelas, a.id_ta, 
  b.nama_siswa, b.nis, b.nisn, b.jk, b.agama, b.tmpl, b.tgll, c.tingkat, c.nama_kelas, ta.nama_ta
  from kelas_siswa a
  left join siswa b on a.id_siswa = b.id_siswa
  left join kelas c on a.id_kelas = c.id_kelas
  left join tahun_ajaran ta on a.id_ta = ta.id_ta
  where a.id_kelas='$id_kelas' and a.id_ta='$id_ta_aktif'
  group by id_ks");
  while ($data=mysqli_fetch_array($siswa))
  { 
  $id_siswa = $data['id_siswa'];
  $id_kelas = $data['id_kelas'];
  $id_ta = $data['id_ta'];
  $q_absen = mysqli_query($conn, "SELECT * from data_absensi 
  where id_kelas='$id_kelas' and id_siswa='$id_siswa' and id_ta='$id_ta' and semester='$semester_ke'");
  $d_absen = mysqli_fetch_array($q_absen);
  $pt = explode('-', $data['tgll']);
  $tgll = $pt[2].'-'.$pt[1].'-'.$pt[0];

  $q_all = mysqli_query($conn, "SELECT COUNT(ket) as jumlah_absensi from data_absensi where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='$semester_ke'"); 
  $j_all = mysqli_fetch_array($q_all);

  $q_hadir = mysqli_query($conn, "SELECT COUNT(ket) as jumlah_hadir from data_absensi where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='$semester_ke' AND ket='Hadir'"); 
  $j_hadir = mysqli_fetch_array($q_hadir);
  
  $q_sakit = mysqli_query($conn, "SELECT COUNT(ket) as jumlah_sakit from data_absensi where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='$semester_ke' AND ket='Sakit'");
  $j_sakit = mysqli_fetch_array($q_sakit);
  
  $q_izin = mysqli_query($conn, "SELECT COUNT(ket) as jumlah_izin from data_absensi where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='$semester_ke' AND ket='Izin'");
  $j_izin = mysqli_fetch_array($q_izin);
  
  $q_alfa = mysqli_query($conn, "SELECT COUNT(ket) as jumlah_alfa from data_absensi where id_siswa='$id_siswa' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='$semester_ke' AND ket='Alfa'");
  $j_alfa = mysqli_fetch_array($q_alfa);
  ?>
  <tr>
    <td><?php echo $no++; ?></td>    
    <td><?php echo $data['nis']; ?></td>
    <td><?php echo $data['nama_siswa']; ?></td>
    <td><?php echo $data['jk']; ?></td>
    <td><?php echo $j_hadir['jumlah_hadir'] ?></td>
    <td><?php echo $j_sakit['jumlah_sakit'] ?></td>
    <td><?php echo $j_izin['jumlah_izin'] ?></td>
    <td><?php echo $j_alfa['jumlah_alfa'] ?></td>
   
  </tr>

  <?php } ?>
        
        
    </table>
  </div>
</div>