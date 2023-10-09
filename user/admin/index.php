<?php 
session_start();
include "../../assets/koneksi.php";
// include "../../assets/phpqrcode/qrlib.php";
if ($_SESSION['login']!=true) {
  header("location:../../");
}else{
$lv = $_SESSION['level'];
$iduser = $_SESSION['id_user'];
$username=$_SESSION['username'];
// $status_wk =$_SESSION['status_wali_kelas'];
if ($lv=="Wali Kelas" ) {
  $quser = mysqli_query($conn, "SELECT * from wali_kelas a left join guru b on a.id_guru = b.id_guru 
    left join kelas c on a.id_kelas = c.id_kelas
    where a.id_guru='$iduser' and a.status_wali_kelas=1 and a.username='$username'")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $namauser= $duser['nama_guru'];
  $level = $lv.' '.$duser['nama_kelas'];

}
elseif ($lv=="Siswa") {
  $quser = mysqli_query($conn, "SELECT * from siswa where id_siswa='$iduser'")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $namauser= $duser['nama_siswa'];
  $level = $lv;
}else{
  $quser = mysqli_query($conn, "SELECT * from admin where id='$iduser'")or die(mysqli_error());
  $duser = mysqli_fetch_array($quser);
  $namauser= $duser['nama_admin'];
  $level = $lv;

}

// $namauser= $duser['nama'];
  $gambar = "../../assets/user.jpg";
 ?>

 
<?php
    include "../../koneksi.php";
    $jalan=mysqli_query($conn, "SELECT * From siswa Where jk='L' AND status_siswa='Aktif'");
    $jalan2=mysqli_query($conn, "SELECT * From siswa Where jk='P' AND status_siswa='Aktif'");
    $jumlah_laki = mysqli_num_rows($jalan);
    $jumlah_perempuan = mysqli_num_rows($jalan2);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIAKAD</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">

   <!-- Morris charts -->
   <link rel="stylesheet" href="../../assets/adminlte/bower_components/morris.js/morris.css">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  

  
  <script src="../../assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="../../assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/adminlte/dist/css/AdminLTE.min.css">

  <script type="text/javascript" src="../../assets/adminlte/js/jquery.js"></script>

  <script type="text/javascript" src="../../assets/ckeditor/ckeditor.js"></script>

  <link rel="stylesheet" href="../../assets/adminlte/dist/css/skins/_all-skins.min.css">






  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../assets/adminlte/index2.html" class="logo" style="background-color: #28449e;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><i class="fa fa-map"></i></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIAKAD SDN 004</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #28449e;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav" >
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo  $gambar ?>" class="user-image" alt="<?php echo  $gambar ?>">
              <span class="hidden-xs"><?php echo $namauser; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- <?php echo   $gambar ?> -->
              <li class="user-header" style="background-color: #28449e;">
                <img src="<?php echo  $gambar ?>" class="img" alt="<?php echo   $gambar ?>">

                <p>
                  <?php echo $namauser; ?>  <br> <?php echo $level; ?> 
                </p>
              </li>
              <!-- Menu Body -->
            
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="?a=edit_akun&id=<?php echo $_SESSION['id_user'] ?>" class="btn btn-default btn-flat">Ganti Password</a>
                  
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
     

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
       
    <?php 
        if ($_SESSION['level']=="Administrator") { ?>
        <li><a href="?a="><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>      
        <li class="treeview">
          <a href="#">
            <i class="fa fa-child"></i> <span>Data Siswa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?a=calon_siswa"><i class="fa fa-circle-o"></i>Calon Siswa</a></li>
            <li><a href="?a=siswa_aktif"><i class="fa fa-circle-o"></i>Data Siswa Aktif</a></li>
            <li><a href="?a=alumni"><i class="fa fa-circle-o"></i>Data Alumni</a></li>
          </ul>
        </li>     
       
        <li><a href="?a=guru"><i class="fa fa-user-secret"></i> <span>Data Guru</span></a></li>      
        <li><a href="?a=kelas"><i class="fa fa-group"></i> <span>Kelas</span></a></li>      
        <li><a href="?a=mapel"><i class="fa fa-book"></i> <span>Mata Pelajaran</span></a></li>      
        <li><a href="?a=tahun_ajaran"><i class="fa fa-calendar"></i> <span>Tahun Ajaran</span></a></li>      
        <li><a href="?a=pengumuman"><i class="fa fa-bullhorn"></i> <span>Pengumuman</span></a></li>
        
        <?php }
        else if ($_SESSION['level']=="Siswa") { ?>
        <li><a href="?a="><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>      
        <li><a href="?a=pengumuman"><i class="fa fa-bullhorn"></i> <span>Pengumuman</span></a></li>  
        <li><a href="?a=history_kelas"><i class="fa fa-history"></i> <span>Histori Kelas</span></a></li>      
        <!-- <li><a href="?a=detail_pengambilan&id_siswa=<?php echo $_SESSION['id_user'] ?>"><i class="fa fa-book"></i> <span>Hutang Piutang</span></a></li>       -->
        <?php }else{ ?>
        <li><a href="?a="><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>      
        <li><a href="?a=pengumuman"><i class="fa fa-bullhorn"></i> <span>Pengumuman</span></a></li>  
        <!-- <li><a href="?a=siswa_pj_wk"><i class="fa fa-pencil-square-o"></i> <span>Nilai Siswa</span></a></li>       -->
        <li><a href="?a=data_absensi"><i class="fa fa-calendar-plus-o"></i> <span>Absensi Siswa</span></a></li> 
        
         <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?a=siswa_pj_wk"><i class="fa fa-pencil-square-o"></i><span>Nilai Siswa</span></a></li>      
            <li><a href="?a=absensi"><i class="fa fa-calendar-plus-o"></i> <span>Absensi Siswa</span></a></li> 
          </ul>
        </li>     
        
             
        
        <?php }
         ?>
      
              

      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <div class="box-body" >
             <?php 
             include "konten.php" ;
             ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      
    </div>
    <strong>Copyright &copy; 2023 SIAKAD SDN 004 Pulau Payung </strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../assets/adminlte/dist/js/demo.js"></script>
<!-- Morris.js charts -->
<script src="../../assets/adminlte/bower_components/raphael/raphael.min.js"></script>
<script src="../../assets/adminlte/bower_components/morris.js/morris.min.js"></script>






<!-- fullCalendar -->
<script src="../../assets/adminlte/bower_components/moment/moment.js"></script>
<script src="../../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>



<?php
    include "../../koneksi.php";
    $data1=mysqli_query($conn, "SELECT COUNT(DISTINCT(kelas_siswa.id_siswa)) AS count,tahun_ajaran.nama_ta AS tahun FROM kelas_siswa INNER JOIN tahun_ajaran ON kelas_siswa.id_ta=tahun_ajaran.id_ta GROUP BY tahun_ajaran.nama_ta");
    $totalSiswa = mysqli_num_rows($data1);
  ?>


<script>
  $(function () {
    $('#example1').DataTable();
    $('#example3').DataTable()
    $('#tabelscrol').DataTable( {
    "scrollX": true
    } );
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })

  $(function () {
    "use strict";
    //DONUT CHART
    var donut = new Morris.Donut({
      element: 'data_siswa',
      resize: true,
      colors: ["#39CCCC", "#D81B60"],
      data: [
        {label: "Laki-Laki", value: <?php echo $jumlah_laki ?>},
        {label: "Perempuan", value: <?php echo $jumlah_perempuan ?>},
        
      ],
      hideHover: 'auto'
    });
    
    // LINE CHART
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        <?php while ($data=mysqli_fetch_array($data1))
        { ?>
        {y: '<?php echo $data['tahun'] ?>', item1: <?php echo $data['count'] ?>},
        <?php }?>
      ],
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Jumlah Siswa'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });

  });

  
</script>
</body>
</html>

<?php } ?>