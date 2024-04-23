<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('../components/koneksi.php');

if (isset($_POST["tambah"])) {
  $kode = $_POST["kode"];
  $nama = $_POST["nama"];
  $bobot = $_POST["bobot"];
  $jenis = $_POST["jenis"];
  mysqli_query($koneksi, "INSERT INTO kriteria VALUES('','$kode','$nama', $bobot, '$jenis')");
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
            <h2 style="margin-bottom:20px;">Masukkan Data Kriteria</h2>
            <form method="POST" enctype="multipart/form-data">
              <div class="" style="margin-top: 10px">
                <b>Kode Kriteria</b>
              </div>
              <div class="">
                <input style="height: 4rem;" class="form-control" name="kode" type="text" required placeholder="Cth: C1">
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Nama Kriteria</b>
              </div>
              <div class="">
                <input style="height: 4rem;" class="form-control" name="nama" type="text" required placeholder="Cth: Rasa">
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Bobot (Persen)</b>
              </div>
              <div class="">
                <input style="height: 4rem;" class="form-control" name="bobot" type="number" step="0.01" required placeholder="1 - 100 (Persen)">
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Jenis Kriteria</b>
              </div>
              <div class="">
                <select name="jenis" id="jenis" style="height: 4rem; padding: 0 20px;" class="">
                  <option style="height: 4rem;" value="benefit">Benefit</option>
                  <option style="height: 4rem;" value="cost">Cost</option>
                </select>
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