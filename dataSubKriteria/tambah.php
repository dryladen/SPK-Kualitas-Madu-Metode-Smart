<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('../components/koneksi.php');

if (isset($_POST["tambah"])) {
  $kriteria = $_POST["kriteria"];
  $nama = $_POST["nama"];
  $skala_nilai = $_POST["skala_nilai"];
  mysqli_query($koneksi, "INSERT INTO subkriteria VALUES('','$kriteria','$nama', $skala_nilai)");
?>
  <script language="javascript">
    alert("Data berhasil ditambahkan");
    document.location = "index.php";
  </script>
<?php
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
            <h2 style="margin-bottom:20px;">Masukkan Data Sub Kriteria</h2>
            <form method="POST" enctype="multipart/form-data">
              <!-- get data kriteria from db -->
              <div class="" style="margin-top: 10px">
                <b>Kriteria</b>
              </div>
              <div class="">
                <select name="kriteria" id="kriteria" style="height: 4rem; padding: 0 20px;" class="">
                  <?php
                  $kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria") or die(mysqli_error($koneksi));
                  while ($k = mysqli_fetch_assoc($kriteria)) {
                  ?>
                    <option style="height: 4rem;" <?php if ($k['nama'] == $_GET['kriteria']) echo 'selected'; ?> value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Nama</b>
              </div>
              <div class="">
                <input style="height: 4rem;" class="form-control" name="nama" type="text" required placeholder="Cth: Rasa">
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Skala Nilai</b>
              </div>
              <div class="">
                <input style="height: 4rem;" class="form-control" name="skala_nilai" type="number" min="1" max="100" required placeholder="1 - 100">
              </div>
              <center><button name="tambah" type="submit" class="btn tombol-tambah2" style="margin-bottom:15px;">Tambah</button></center>
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