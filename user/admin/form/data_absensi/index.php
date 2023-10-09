<?php 
$id_wk = $_SESSION['id_user'];
$lv = $_SESSION['level'];
$username=$_SESSION['username'];
$nama_semester = [1=>'Ganjil','Genap'];

if ($lv=="Wali Kelas" ) {
  $quser    = mysqli_query($conn, "SELECT * from wali_kelas a left join guru b on a.id_guru = b.id_guru 
    left join kelas c on a.id_kelas = c.id_kelas
    where a.id_guru='$iduser' and  a.username='$username'")or die(mysqli_error());
  $duser      = mysqli_fetch_array($quser);
  $namauser   = $duser['nama_guru'];
  $namakelas  = $duser['nama_kelas'];
  $idkelas    = $duser['id_kelas'];
  $id_wali_kelas=$duser['id_walikelas'];

  $data_tahun=mysqli_query($conn, "SELECT * from kelas_siswa a
                LEFT JOIN tahun_ajaran b ON a.id_ta=b.id_ta
                where a.id_wali_kelas='$id_wali_kelas' AND a.status_ks='Aktif' group by a.id_ta")or die(mysqli_error());
  $dtahun=mysqli_fetch_array($data_tahun);
  $id_ta=$dtahun['id_ta'];
  $nama_tahun=$dtahun['nama_ta'];
}
 ?>




  <div class="box-header with-border">
    <h3 class="box-title">
      Identitas Kelas   
    </h3>
    <div class="box-tools pull-right">

    </div>
  </div>

  <div class="alert row">
   
      <div class="col-md-6 alert">
        <div class="box-body">
            <table class="table" >
              <tr>
                <td>Tahun Ajaran</td>
                <td> <?php echo $id_ta?></td>
              </tr>
              <tr>
                <td>Lokal</td>
                <td><?php echo   $namakelas ?></td>
              </tr>
              
            </table>
        </div>
        <a href="#" class="btn btn-success btn-sm"  data-toggle="modal" data-target="#to">Tambah Absensi</a>
      </div>

      <div class="col-md-6 alert">
        <form action="form/data_absensi/print_data_absensi.php" method="post">
          <div class="box-body">
          <h4 >
              Cetak Data Absensi   
          </h4>
              <table class="table" >
                <tr>
                  <td>Tanggal</td>
                  <td><input type="date" name="tanggal" class="form-control" required></td>
                </tr>
                <tr>
                  <td>Semester</td>
                  <td><label>
                      <input type="radio" name="semester" class="minimal" value="1" checked> Ganjil    
                      </label>
                      <label>
                      <input type="radio" name="semester" class="minimal" value="2"> Genap
                      </label></td>
                </tr>
                <input type="hidden" name="id_walikelas" class="form-control" value="<?php echo $id_wali_kelas ?>">
                <input type="hidden" name="id_kelas" class="form-control" value="<?php echo $idkelas ?>">
                <input type="hidden" name="id_ta" class="form-control" value="<?php echo $id_ta ?>">
                
              </table>
          </div>
          <div class="box-tools pull-right">
            <button type="submit" class="btn btn-info">Cetak Absensi</button>
          </div>
        </form>
      </div>
        
    
  </div>


<form action="form/data_absensi/simpan_data_absensi.php" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="to">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Masukkan Absensi Siswa</h4>
        </div>
        <div class="modal-body">

            <div class="form-group">
            <table class="table" style="width:100%">
            
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td><?php echo $namakelas ?></td>
            </tr>
            <tr>
                <td>Tahun Ajaran</td>
                <td>:</td>
                <td><?php echo $nama_tahun?></td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>:</td>
                <td>
                    <label>
                    <input type="radio" name="semester" class="minimal" value="1" checked> Ganjil    
                    </label>
                    <label>
                    <input type="radio" name="semester" class="minimal" value="2"> Genap
                    </label>
                </td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><input type="date" name="tanggal" class="form-control" required></td>
            </tr>
            <tr>
                <td colspan="3">Daftar Siswa</td>

            </tr>
            <?php 
                    $data_siswa = mysqli_query($conn, "SELECT * from kelas_siswa a
                            LEFT JOIN wali_kelas b ON a.id_wali_kelas=b.id_walikelas 
                            LEFT JOIN siswa c ON a.id_siswa=c.id_siswa
                            where b.id_guru='$iduser' and  b.username='$username' and a.id_kelas='$idkelas' AND a.status_ks='Aktif'")
                          or die(mysqli_error());

                  $qsiswa=mysqli_num_rows ($data_siswa);


                  while($dsiswa = mysqli_fetch_array($data_siswa))

                  {
                  ?>
            <tr>
                <td colspan="2">
                  <input type="hidden" name="id_siswa[]" class="form-control" value="<?php echo $dsiswa['id_siswa'] ?>" >
                  <input type="text" name="nama_siswa[]" class="form-control" value="<?php echo $dsiswa['nama_siswa'] ?>" disabled>
                </td>
                <td>
                    <select class="form-control select2" style="width: 100%;" name="ket[]" required>
                    <option>Hadir</option>
                    <option>Sakit</option>
                    <option>Izin</option>
                    <option>Alfa</option>
                    </select>
                </td>
            </tr>
            <?php } ?>        
            
            </table>
            
            <input type="hidden" name="id_walikelas" class="form-control" value="<?php echo $id_wali_kelas ?>">
            <input type="hidden" name="id_kelas" class="form-control" value="<?php echo $idkelas ?>">
            <input type="hidden" name="id_ta" class="form-control" value="<?php echo $id_ta ?>">

            <!-- <option value="<?php echo $dsiswa['id_siswa'] ?>"></option> -->
            

            
        </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan Absensi</button>
            
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
</form>

<?php
  $perintah="SELECT * 
    FROM data_absensi a
    LEFT JOIN wali_kelas b ON a.id_walikelas=b.id_walikelas
    LEFT JOIN kelas c ON a.id_kelas=c.id_kelas
    LEFT JOIN tahun_ajaran d ON a.id_ta=d.id_ta
    LEFT JOIN siswa e ON a.id_siswa=e.id_siswa
    where a.id_kelas='$idkelas' and a.id_walikelas='$id_wali_kelas' and d.id_ta='$id_ta' AND d.status_ta='Aktif'
    ORDER BY a.tanggal DESC";
  $jalan=mysqli_query($conn, $perintah);

  $total = mysqli_num_rows($jalan);
  $no=1;
?>
<hr>
<div class="">
<table class="table table-striped table-bordered" id="example1">
  <thead>
  <tr>
    <td>No</td>
  
    <td>Semester</td>

    <td>Hari, Tanggal</td>
    <td>Nama</td>
    <td>Keterangan</td>
    <td>Option</td>
  </tr>
</thead>
  

<?php
  while ($data=mysqli_fetch_array($jalan))
{ 

?>
  <tr>
    <td><?php echo $no++; ?></td>  

    <td><?php echo $nama_semester[$data['semester']] ?></td>

    <td><?php echo $data['tanggal']; ?></td>
    <td><?php echo $data['nama_siswa']; ?></td>
    <td><?php echo $data['ket']; ?></td>
    
    <td>
        <?php  if ($id!=$data['id']) { ?>
        <a href="form/data_absensi/hapus_data_absensi.php?id=<?php echo $data['id'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('Hapus data atas nama <?php echo $data['nama_siswa'] ?>.?')">Hapus</a> 
        <?php } ?>
    
    </td>
  </tr>

    <?php } ?>
        
  </table>
</div>
