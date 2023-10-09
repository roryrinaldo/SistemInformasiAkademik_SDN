
  <?php 
  $id = $_SESSION['id_user'];
  $nama_semester = [1=>'Ganjil','Genap'];

  $q = mysqli_query($conn, "SELECT * from admin where id='$id'");
  $d = mysqli_fetch_array($q);
  $d1 = $d;
  $namauser =  $d['nama_admin']; 
  ?>
	
  <?php
    include "../../koneksi.php";
    $jalan=mysqli_query($conn, "SELECT * From siswa Where status_siswa='Aktif'");
    $total1 = mysqli_num_rows($jalan);
  ?>

  <?php
    include "../../koneksi.php";
    $jalan=mysqli_query($conn, "SELECT * From guru");
    $total2 = mysqli_num_rows($jalan);
  ?>

  <?php
    include "../../koneksi.php";
    $jalan=mysqli_query($conn, "SELECT * From kelas");
    $total3 = mysqli_num_rows($jalan);
  ?>




	        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
              <div class="widget-user-image">
                <img class="img" src="<?php echo $gambar ?>" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h5 class="widget-user-desc">Selamat Datang di Halaman Operator</h5>
              <h3 class="widget-user-desc"><?php echo $namauser ?></h3>
              <!-- <h4 class="widget-user-desc">Hak Akses : <?php echo $_SESSION['level'] ?></h4> -->
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
                    <h3><?php echo $total1 ?></h3>

                    <p>Jumlah Siswa Aktif</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="?a=siswa_aktif" class="small-box-footer">Lihat Data<i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3><?php echo $total2 ?><sup style="font-size: 20px"></sup></h3>

                    <p>Jumlah Guru</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="?a=guru" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3><?php echo $total3 ?></h3>

                    <p>Jumlah Kelas</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="?a=kelas" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
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
            
        
      

              
      




