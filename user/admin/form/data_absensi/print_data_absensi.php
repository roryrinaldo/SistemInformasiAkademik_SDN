<?php
session_start();
include "../../../../assets/koneksi.php";
require_once("../../../../assets/dompdf/src/Autoloader.php");
Dompdf\Autoloader::register();
use Dompdf\Dompdf;

$id_walikelas   = $_POST['id_walikelas'];
$id_kelas       = $_POST['id_kelas'];
$id_ta          = $_POST['id_ta'];
$semester       = $_POST['semester'];
$tanggal        = $_POST['tanggal'];
$nama_semester = [1=>'Ganjil','Genap'];

$quser = mysqli_query($conn, 
        "SELECT * from wali_kelas a 
        left join guru b on a.id_guru = b.id_guru 
        left join kelas c on a.id_kelas = c.id_kelas
        where a.id_walikelas='$id_walikelas'")
        or die(mysqli_error());
$duser = mysqli_fetch_array($quser);
$namauser= $duser['nama_guru'];
$namakelas = $duser['nama_kelas'];



$data_tahun=mysqli_query($conn, "SELECT * from kelas_siswa a
            LEFT JOIN tahun_ajaran b ON a.id_ta=b.id_ta
            where a.id_wali_kelas='$id_walikelas' group by a.id_ta")or die(mysqli_error());
$dtahun=mysqli_fetch_array($data_tahun);
$id_ta=$dtahun['id_ta'];
$nama_tahun=$dtahun['nama_ta'];


$html = '

<center>
  <h3>LAPORAN DATA ABSENSI SISWA</h3>
  
</center>
<hr> 
<br>

<table class="table" >
    <tr>
        <td>Kelas</td>
        <td>:</td>
        <td>'.$namakelas.'</td>
    </tr>
    <tr>
        <td>Tahun Ajaran</td>
        <td>:</td>
        <td>'.$nama_tahun.'</td>
    </tr>
    <tr>
        <td>Semester</td>
        <td>:</td>
        <td>'.$nama_semester[$semester].'</td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>'.$tanggal.'</td>
    </tr>

    
</table><br>
    ';




$html .= '
 <table style="font-size:12px;border-collapse: collapse; width:100%" border = 1>
    <thead style="text-align:center">
      <tr> 
        <td>No</td>

        <td>Nama</td>
        <td>Keterangan</td>
        
        
      </tr>
    </thead>
';
    $perintah="SELECT * 
    FROM data_absensi a
    LEFT JOIN wali_kelas b ON a.id_walikelas=b.id_walikelas
    LEFT JOIN kelas c ON a.id_kelas=c.id_kelas
    LEFT JOIN tahun_ajaran d ON a.id_ta=d.id_ta
    LEFT JOIN siswa e ON a.id_siswa=e.id_siswa
    where a.id_kelas='$id_kelas' and a.id_walikelas='$id_walikelas' and a.tanggal='$tanggal' and a.semester='$semester'";
    $jalan=mysqli_query($conn, $perintah)or die(mysqli_error());
    $no = 1;

    while ($data=mysqli_fetch_array($jalan))
    { 
    $html .= '
        <tr>
            <td style="text-align:center">'.$no++.'</td>

            <td>'.$data['nama_siswa'].'</td>
            <td>'.$data['ket'].'</td>
            
            
        </tr>

    ';

    }

$html .= '

<div style="float:right; font-size:14px">
<br>
Pulau Payung, '.date('d').' '.$nama_bulan[date('n')].' '.date('Y').' <br>
Wali Kelas '.$namakelas.' 
<br> <br> <br> <br>
'.$namauser.'
</div>';




$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('Data Absensi Siswa.pdf', ['Attachment'=>0]);

?>


