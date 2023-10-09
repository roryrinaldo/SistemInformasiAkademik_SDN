
<?php 
$id = $_SESSION['id_user'];

$nama_semester = [1=>'Ganjil','Genap'];
$username=$_SESSION['username'];

$q = mysqli_query($conn, "SELECT * from guru a 
      left join wali_kelas b on a.id_guru=b.id_guru 
      where b.id_guru='$id' and b.username='$username'");
$d = mysqli_fetch_array($q);
$d1 = $d;
$namauser =  $d['nama_guru']; 
$namauser= $d['nama_guru'];
$namakelas = $d['nama_kelas'];
$idkelas = $d['id_kelas'];
$id_wali_kelas=$d['id_walikelas'];

$data_tahun=mysqli_query($conn, "SELECT * from kelas_siswa a
              LEFT JOIN tahun_ajaran b ON a.id_ta=b.id_ta
              where a.id_wali_kelas='$id_wali_kelas' AND b.status_ta='Aktif' group by a.id_ta")or die(mysqli_error());
$dtahun=mysqli_fetch_array($data_tahun);
$id_ta=$dtahun['id_ta'];
$nama_tahun=$dtahun['nama_ta'];

$daftar_siswa=mysqli_query($conn, "SELECT * from kelas_siswa a where a.id_wali_kelas='$id_wali_kelas' and a.status_ks='Aktif'")or die(mysqli_error());
$total_siswa= mysqli_num_rows($daftar_siswa);

$perintah="SELECT COUNT(DISTINCT(a.tanggal)) AS jumlah_hari
    FROM data_absensi a
    where a.id_kelas='$idkelas' and a.id_walikelas='$id_wali_kelas' AND a.id_ta='$id_ta' ";
  $jalan=mysqli_query($conn, $perintah);

  $tampung=mysqli_fetch_array($jalan);
  $total_hari=$tampung['jumlah_hari'];
   
  $mapel=mysqli_query($conn, "SELECT * from mapel a 
  LEFT JOIN kelas b ON a.tingkat=b.tingkat
  where b.id_kelas='$idkelas' ")
  or die(mysqli_error());
  $total_mapel= mysqli_num_rows($mapel);

?>
	
	<div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-aqua">
      <div class="widget-user-image">
        <img class="img" src="<?php echo $gambar ?>" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h5 class="widget-user-desc">Selamat Datang di Halaman Wali Kelas</h5>
      <h3 class="widget-user-desc"><?php echo $namauser ?></h3>
      <h4 class="widget-user-desc">Hak Akses : <?php echo $_SESSION['level'] ?></h4>
      </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box box-info">
            <!-- <div class="box-header">
              <h3 class="box-title" id="judul_konten">Wellcome To Administrator Page</h3>
              <h3 class="box-title" id="btn_tambah" style="float:right;"></h3>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body" >
              <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-purple">
                  <div class="inner">
                    <h3><?php echo $total_siswa ?></h3>

                    <p>Jumlah Siswa Di Kelas</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>

                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3><?php echo $total_hari ?><sup style="font-size: 20px"></sup></h3>

                    <p>Total Absensi /Hari</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3><?php echo $total_mapel ?></h3>

                    <p>Jumlah Mata Pelajaran</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  
                </div>
              </div>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row" hidden>
      <div class="col-xs-8">
          <!-- LINE CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Grapik Jumlah Siswa Pertahun</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="line-chart" style="height: 300px;"></div>
              </div>
          </div>
        </div>
        <div class="col-xs-4">
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Grapik Jumlah Siswa Aktif Perjenis Kelamin</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="data_siswa" style="height: 300px; position: relative;"></div>
            
        
      

              
      




