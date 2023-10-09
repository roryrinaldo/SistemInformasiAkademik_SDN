<?php

$id=$_GET['id'];
$idta=$_GET['id_ta'];

  $perintah="SELECT * From kelas where id_kelas='$id'";
  $jalan=mysqli_query($conn, $perintah);
  $d1=mysqli_fetch_array($jalan);
  $no=1;
 $tingkat = $d1['tingkat'] -1;
 $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$idta'");
          $jta = mysqli_num_rows ($qta);
          $dta = mysqli_fetch_array($qta);
          $id_ta = $dta['id_ta'];

  $qcekwk = mysqli_query($conn, "SELECT b.nama_guru, a.status_wali_kelas, a.id_guru, b.nip, a.username, a.id_walikelas from wali_kelas a 
                                left join guru b on a.id_guru = b.id_guru left join kelas_siswa c on
                                 c.id_kelas=a.id_kelas where a.id_kelas='$id' and c.id_ta='$idta' group by c.id_kelas ");
      $jcekwk = mysqli_num_rows($qcekwk);
      $dcekwk = mysqli_fetch_array($qcekwk);
      $id_wk_aktif = $dcekwk['id_guru'];
?>
<div class="box-header with-border">
  <h3 class="box-title">
    Manajemen Kelas <?php echo $d1['nama_kelas'] ?> <br>
    Tahun Ajaran <?php echo $dta['nama_ta'] ?>

  </h3>
<div class="pull-right">
      <a href="?a=history_kelas&id_ta=<?php echo $idta ?>" class="btn btn-default btn-sm"  >Kembali</a>
    </div>
  
</div>

<?php
  $no=1;
?>
<div class="col-md-4">
   <div class="box-header with-border">
      <h3 class="box-title">
        Wali Kelas 

      </h3>
      
      
      
    </div>
    <div class="box-body">
      <?php 
      
      if ($jcekwk==1) { ?>
        <table class="table">
          <tr>
            <td>Nama</td>
            <td><?php echo $dcekwk['nama_guru'] ?></td>
          </tr>
          <tr>
            <td>NIP</td>
            <td><?php echo $dcekwk['nip'] ?></td>
          </tr>
          <tr>
            <td>Username</td>
            <td><?php echo $dcekwk['username'] ?></td>
          </tr>
        </table>
        <?php 
        // ta = tahun ajaran  
          $qta = mysqli_query($conn, "SELECT * from tahun_ajaran where id_ta='$idta'");
          $jta = mysqli_num_rows ($qta);
          $dta = mysqli_fetch_array($qta);
          $id_ta = $dta['id_ta'];
           ?>
        
      <?php }else{ ?>
        <!-- <a href="" class=" btn btn-info btn-xs"  data-toggle="modal" data-target="#addwali">Atur Wali Kelas</a> -->
      <?php } ?>
    </div>



</div>
<div class="col-md-8">
  <div class="box-header with-border">
    <h3 class="box-title">
      Data Siswa 

    </h3>
    <div class="pull-right">
      
    </div>
    
  </div>

  <table class="table table-striped table-bordered" id="example1">
  	<thead>
  	<tr>
  		<td>No</td>
      <td>NIS</td>
      <td>NISN</td>
      <td>Nama</td>
  		<td>Keterangan</td>
  	</tr>
  </thead>
  	

  <?php
$mapel = mysqli_query($conn, "SELECT ks.*, s.nama_siswa, s.nis, s.nisn, ks.status_ks, k.tingkat from kelas_siswa ks
left join siswa s on ks.id_siswa = s.id_siswa 
left join kelas k on ks.id_kelas = k.id_kelas
where ks.id_kelas='$id' and ks.id_ta='$id_ta' order by s.nama_siswa asc");
  while ($data=mysqli_fetch_array($mapel))
  { 

  $naik_kelas = $data['tingkat'] +1;
  $tinggal_kelas = $data['tingkat'];
  ?>
  	<tr>
  		<td><?php echo $no++; ?></td>
      <td><?php echo $data['nis']; ?></td>
      <td><?php echo $data['nisn']; ?></td>
      <td><?php echo $data['nama_siswa']; ?></td>
    
  	
  	<td>
     <?php if ($data['status_ks']=='Lanjut') {
       echo "Naik Ke Kelas ".$naik_kelas;
     }else if ($data['status_ks']=='Tinggal') {
       echo "Tinggal Di Kelas ".$tinggal_kelas;
       
     }else{
      echo "Belum Ada Keputusan"; ?><br>
      <a href="form/kelas/keputusan.php?id=<?php echo $data['id_ks'] ?>&status_ks=Lanjut&id_ta=<?php echo $idta ?>&id_kelas=<?php echo $id ?>" class="btn btn-info btn-xs">Naikkan ke kelas <?php echo $naik_kelas ?></a>
      <a href="form/kelas/keputusan.php?id=<?php echo $data['id_ks'] ?>&status_ks=Tinggal&id_ta=<?php echo $idta ?>&id_kelas=<?php echo $id ?>" class="btn btn-info btn-xs">Tinggalkan Di kelas <?php echo $tinggal_kelas ?></a>
      
     <?php } ?> 
     
  	</td>
  		</tr>

  		<?php } ?>
  				
  	</table>
</div>