<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('../components/koneksi.php');
$id = $_GET['id'];
$menu = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE id='$id'") or die(mysqli_error($koneksi));
$men = mysqli_fetch_assoc($menu);
if (isset($_POST['edit'])) {
  $nama = $_POST['nama'];
  $skala_nilai = $_POST['skala_nilai'];
  $query = "UPDATE subkriteria SET 
    nama='$nama',
    skala_nilai='$skala_nilai' WHERE id='$id'";
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
		document.location.href ='index.php?id=" . $id . "';
		</script>
		";
  }
}
?>

<head>
  <?php include('../components/head.php') ?>
  <title>SPK Kejaksaan Negeri Samarinda</title>
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
            <h2 style="margin-bottom:20px;">Edit Data Sub Kriteria</h2>
            <form method="POST" enctype="multipart/form-data">
              <!-- get data kriteria from db -->
              <div class="" style="margin-top: 10px;">
                <b>Nama</b>
              </div>
              <div class="">
                <input style="height: 4rem;" class="form-control" name="nama" type="text" required placeholder="Cth: Rasa" value="<?= $men['nama'] ?>">
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Skala Nilai</b>
              </div>
              <div class="">
                <input style="height: 4rem;" class="form-control" name="skala_nilai" type="number" min="1" max="100" required placeholder="1 - 100" value="<?= $men['skala_nilai'] ?>">
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