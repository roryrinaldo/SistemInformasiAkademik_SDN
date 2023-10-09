<?php

$id=$_GET['id'];
$status_wali_kelas='';
$tingkat = $_GET['tingkat'];
$status_ks = $_GET['status_ks'];
$semester = $_GET['semester'];
$status_ta = $_GET['status_ta'];
$nama_semester = [1=>'Ganjil','Genap'];
$semester_aktif = $nama_semester[$semester];


$perintah="SELECT * From siswa where id_siswa='$id'";
$jalan=mysqli_query($conn, $perintah);
$d1=mysqli_fetch_array($jalan);
$no=1;

$id_ta_aktif = $_GET['id_ta'];
$id_kelas = $_GET['id_kelas'];
        


  $qmapel = mysqli_query($conn, "SELECT * from mapel where tingkat='$tingkat' ");
  $jmapel = mysqli_num_rows($qmapel);
  $qmapelinput = mysqli_query($conn, "SELECT * from mapel where tingkat='$tingkat' ");  

  $kumpulkan_mapel = [];
    while($dmapel=mysqli_fetch_array($qmapel)){  
      $isi = [
        'id_mapel' =>$dmapel['id_mapel'],
        'nama_mapel' =>$dmapel['nama_mapel'],
        'kkm' =>$dmapel['kkm'],

      ];
      array_push($kumpulkan_mapel, $isi);
    }

$id_siswa = $d1['id_siswa'];
$q_kelas_siswa = mysqli_query($conn, "SELECT * from kelas_siswa ks
  left join tahun_ajaran ta on ks.id_ta = ta.id_ta
  left join kelas k on ks.id_kelas = k.id_kelas
  where ks.id_siswa='$id_siswa' and ks.id_kelas='$id_kelas' and ks.id_ta='$id_ta_aktif'
  ");
$d_kelas_siswa = mysqli_fetch_array($q_kelas_siswa);

?>

<div class="box-header with-border">
  <h3 class="box-title">
  Identitas PBM

  </h3>
<div class="pull-right">
      <a href="?a=history_kelas" class="btn btn-default btn-sm"  >Kembali</a>
    </div>
  
</div>





<div class="clearfix"></div>

<div class="col-md-4">
  
      <table class="table">
        
        <tr>
          <td>Tahun Ajaran</td>
          <td>:</td>
          <td><?php echo $d_kelas_siswa['nama_ta'] ?></td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td><?php echo $d_kelas_siswa['nama_kelas'] ?></td>
        </tr>
    
        <tr>
          <td>Status Tahun Ajaran</td>
          <td>:</td>
          <td><?php echo $d_kelas_siswa['status_ta'] ?></td>
        </tr>
        <?php if ($status_ta=="Aktif"): ?>
          
        <tr>
          <td>Semester Aktif</td>
          <td>:</td>
          <td><?php echo $nama_semester[$semester] ?></td>
        </tr>
        <?php endif ?>
       
      </table>
</div>
<div class="clearfix"></div>


<hr>

<div class="col-md-12">
  

  <div class="box-header with-border">
    <h3 class="box-title">
     Semester <?php echo $nama_semester[$semester] ?>
    </h3>
  </div>

  <div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <label>Absensi : </label>
            <?php 
            $q_all = mysqli_query($conn, "SELECT COUNT(ket) as jumlah_absensi from data_absensi where id_siswa='$id' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='$semester'"); 
            $j_all = mysqli_fetch_array($q_all);

            $q_hadir = mysqli_query($conn, "SELECT COUNT(ket) as jumlah_hadir from data_absensi where id_siswa='$id' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='$semester' AND ket='Hadir'"); 
            $j_hadir = mysqli_fetch_array($q_hadir);
            
            $q_sakit = mysqli_query($conn, "SELECT COUNT(ket) as jumlah_sakit from data_absensi where id_siswa='$id' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='$semester' AND ket='Sakit'");
            $j_sakit = mysqli_fetch_array($q_sakit);
            
            $q_izin = mysqli_query($conn, "SELECT COUNT(ket) as jumlah_izin from data_absensi where id_siswa='$id' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='$semester' AND ket='Izin'");
            $j_izin = mysqli_fetch_array($q_izin);
            
            $q_alfa = mysqli_query($conn, "SELECT COUNT(ket) as jumlah_alfa from data_absensi where id_siswa='$id' and id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and semester='$semester' AND ket='Alfa'");
            $j_alfa = mysqli_fetch_array($q_alfa);
            
            if ($j_all['jumlah_absensi'] > 0) { ?>
                <br>
                <table class="table">
                    <tr>
                        <td>Kehadiran</td>
                        <td>Sakit</td>
                        <td>Izin</td>
                        <td>Tanpa Keterangan</td>
                    </tr>
                    <tr>
                        <td><?php echo $j_hadir['jumlah_hadir'] ?></td>
                        <td><?php echo $j_sakit['jumlah_sakit'] ?></td>
                        <td><?php echo $j_izin['jumlah_izin'] ?></td>
                        <td><?php echo $j_alfa['jumlah_alfa'] ?></td>
                    </tr>
                </table>
            <?php } else { ?>
                Belum ada data absensi
            <?php } ?>
        </div>
    </div>

    <hr>

    <div class="row">
      <label>Nilai : </label>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Mata Pelajaran</th>
            <th>KKM</th>
            <th>Nilai</th>
            <th>Predikat</th>
            <th>Deskripsi</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $total_nilai = 0;
          $tuntas = 0;
          $tidak_tuntas = 0;
            foreach ($kumpulkan_mapel as $dmapel){    ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $dmapel['nama_mapel'] ?></td>
            <td><?php echo $dmapel['kkm'] ?></td>
            
            <td>
              <?php 
              $id_mapel = $dmapel['id_mapel'];
              
              $qnilai = mysqli_query($conn, "SELECT * from nilai where id_kelas='$id_kelas' and id_ta='$id_ta_aktif' and id_mapel='$id_mapel' and id_siswa='$id' and semester='$semester'");
              $dnilai = mysqli_fetch_array($qnilai);
              $nilai = $dnilai['nilai'];
              $deskripsi = $dnilai['deskripsi'];
              $total_nilai += $nilai;
              if ($nilai<$dmapel['kkm']) {
                $warna = "red";
                $satu = 1;
                $tidak_tuntas +=$satu;
              }else{
                $warna = "green";
                $satu = 1;
                $tuntas +=$satu;
              }
              ?>
              <p style="color: <?php echo $warna ?>"><?php echo $nilai ?></p>
              
            </td>
            <td>
                <?php 
                if ($nilai >= 81 && $nilai <= 100) {
                    echo "A";
                } elseif ($nilai >= 71 && $nilai <= 80) {
                    echo "B";
                } elseif ($nilai >= 1 && $nilai <= 70) {
                    echo "C";
                } else {
                    echo "Belum ada nilai";
                }
                ?>
            </td>
            <td style="max-width: 150px;white-space: normal; overflow: hidden;text-overflow: ellipsis;">
              <?php echo $deskripsi ?>
            </td>
          </tr>
        <?php } ?>
        <tr>
          <td colspan="3">Total Nilai</td>
          <td colspan="3"><?php echo $total_nilai ==0 ? '' : $total_nilai ?></td>
        </tr>
        <tr>
          <td colspan="3">Rata Rata</td>
          <td colspan="3"><?php 
          $ratarata = round($total_nilai / $jmapel, 2);
          echo $ratarata == 0 ? '' : $ratarata ?></td>
        </tr>
      
        <tr>
          <td colspan="6"><u>Catatan Guru</u> <br>
          <?php if($semester==1){ ?>
            <?php echo $d_kelas_siswa['catatan_wali_kelas_semester_1'] ?>
          <?php } else { ?>
            <?php echo $d_kelas_siswa['catatan_wali_kelas_semester_2'] ?>
          <?php } ?>
          </td>
        </tr>
          
        </tbody>
      </table>
      <br>
      <a href="form/history_kelas_siswa/print_rapor_siswa.php?id=<?php echo $id ?>&id_kelas=<?php echo $id_kelas ?>&id_ta=<?php echo $id_ta_aktif ?>&status_ks=<?php echo $status_ks ?>&semester=<?php echo $semester?>&tingkat=<?php echo $tingkat ?>&status_ta=<?php echo $status_ta ?>" class="btn btn-info btn-sm" target="_blank">Cetak Rapor Semester <?php echo $nama_semester[$semester] ?></a>
    </div>
  </div>

</div>

<div class="clearfix"></div>
<!-- 
<?php if ($status_ta=="Selesai"): ?>
  
<div class="col-md-12">
  <div class="box-header">
    <div class="alert alert-info">
      Berdasarkan pencapaian kompetensi pada semester 1 dan semester 2, <br>
      Peserta didik dinyatakan 
      <?php if ($status_ks=='Lanjut') {
        $next = $tingkat + 1;
        echo "Naik ke kelas ".$next;
      }if ($status_ks=='Tinggal') {
        echo "Tinggal di kelas ".$tingkat;
      }else{
        echo "Lulus ke tingkat pendidikan selanjutnya";
      } ?>
    </div>
  </div>
</div>          
        
<?php endif ?> -->