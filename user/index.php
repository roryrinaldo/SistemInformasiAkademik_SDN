<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LOGIN SIAKAD</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  
  <script src="../assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/adminlte/dist/css/AdminLTE.min.css">

  <script type="text/javascript" src="../assets/adminlte/js/jquery.js"></script>

  <script type="text/javascript" src="../assets/ckeditor/ckeditor.js"></script>

  <link rel="stylesheet" href="../assets/adminlte/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>SIAKAD</b>SDN 004</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <h3 class="title text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Login</h3>
        <form action="login_act.php" method="post">
          <div class="w3pvt-wls-contact-mid">
            <div class="form-group contact-forms">
              <input type="text" name="username" autofocus="" class="form-control" placeholder="Email" required="">
            </div>
            <div class="form-group contact-forms">
              <input type="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <div class="form-group contact-forms">
              <select name="level" class="form-control">
                <option value="">--Pilih Hak Akses--</option>
                <option value="Wali Kelas">Wali Kelas</option>
                <option value="Siswa">Orang Tua Siswa</option>
                <option value="Admin">Operator</option>
              </select>
            </div>
            <button type="submit" class="btn sent-butnn">Login</button>
          </div>
        </form>

    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="../assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/adminlte/dist/js/demo.js"></script>
<!-- page script -->

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
