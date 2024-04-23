<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('../components/koneksi.php');

$id = $_GET['id'];

$menu = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id='$id'") or die(mysqli_error($koneksi));
$men = mysqli_fetch_assoc($menu);

if (isset($_POST['edit'])) {

  $query = "UPDATE kriteria SET 
    kode='$_POST[kode]',
    nama='$_POST[nama]',
    bobot='$_POST[bobot]',
    jenis='$_POST[jenis]' WHERE id='$id'";

  $query_run = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

  if ($query_run) {
    echo "
		<script>
		alert('Data Berhasil Diubah');
		document.location.href ='index.php';
		</script>
		";
  } else {
    echo "
		<script>
		alert('Data Gagal Diubah');
		document.location.href ='edit.php?id=" . $id . "';
		</script>
		";
  }
}
?>

<head>
  <?php include('../components/head.php') ?>
  <title>SPK Pemilihan Kualitas Madu</title>
</head>

<body>
  <div class="wrapper">
    <?php include('../components/sidebar.php') ?>
    <div class="main_content">
      <div class="header">
        <h4>SPK Pemilihan Kualitas Madu</h4>
      </div>

      <div class="box">
        <div class="container-table">
          <div class="judul">
            <h2 style="margin-bottom:20px;">Edit Data Kriteria</h2>
            <form method="POST" class="form-input">
              <input type="hidden" name="id" value="<?= $id ?>">
              <div class="" style="margin-top: 10px">
                <b>Kode Kriteria</b>
              </div>
              <div class="">
                <input value="<?= $men['kode'] ?>" style="height: 4rem;" class="form-control" name="kode" type="text" required placeholder="Cth: C1">
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Nama Kriteria</b>
              </div>
              <div class="">
                <input value="<?= $men['nama'] ?>" style="height: 4rem;" class="form-control" name="nama" type="text" required placeholder="Cth: Rasa">
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Bobot (Persen)</b>
              </div>
              <div class="">
                <input value="<?= $men['bobot'] ?>" style="height: 4rem;" class="form-control" name="bobot" type="number" min="1" max="100" required placeholder="1 - 100 (Persen)">
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Jenis Kriteria</b>
              </div>
              <div class="">
                <select name="jenis" id="jenis" style="height: 4rem; padding: 0 20px;" class="">
                  <option style="height: 4rem;" value="benefit" <?php if($men['jenis'] == 'benefit') echo 'selected'; ?>>Benefit</option>
                  <option style="height: 4rem;" value="cost" <?php if($men['jenis'] == 'cost') echo 'selected'; ?>>Cost</option>
                </select>
              </div>
              <center><button name="edit" type="submit" class="btn tombol-tambah2" style="margin-bottom:15px;">Edit</button></center>
            </form>
          </div>
          <div class="container-tombol2">
            <a class="tombol-kembali btn" href="index.php" role="button">kembali</a>
          </div>
        </div>
      </div>
    </div>
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>