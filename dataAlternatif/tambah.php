<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('../components/koneksi.php');
if (isset($_POST["tambah"])) {
  $kode = $_POST["kode"];
  $nama = $_POST["nama"];
  // print_r($_POST);
  // exit();
  mysqli_query($koneksi, "INSERT INTO alternatif VALUES('','$kode','$nama')");

  $alternatif_id = mysqli_insert_id($koneksi); // Get the ID of the newly inserted alternatif

  $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
  while ($row = mysqli_fetch_array($query)) {
    $kriteria_value = $_POST["$row[kode]"];
    // print_r($kriteria_value);
    // exit();
    mysqli_query($koneksi, "INSERT INTO nilai_alternatif (id_alternatif, id_kriteria, id_subkriteria) VALUES ($alternatif_id, $row[id], $kriteria_value)");
  }
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
            <h2 style="margin-bottom:20px;">Masukkan Data Alternatif</h2>
            <form method="POST" enctype="multipart/form-data">
              <div class="" style="margin-top: 10px">
                <b>Kode Alternatif</b>
              </div>
              <div class="">
                <input style="height: 4rem;" class="form-control" name="kode" type="text" required placeholder="Cth: A1">
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Nama Alternatif</b>
              </div>
              <div class="">
                <input style="height: 4rem;" class="form-control" name="nama" type="text" required placeholder="Cth: Bunga Pagoda">
              </div>
              <hr>
              <!-- Tambahkan input dropdown tiap kriteria dari database dengan option masing masing subkriteria -->
              <div class="" style="margin-top: 10px;">
                <h2 style="margin-bottom:20px;">Masukkan Data Kriteria</h2>
              </div>
              <div>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
                while ($row = mysqli_fetch_array($query)) { ?>
                  <div class="" style="margin-top: 10px">
                    <b><?php echo $row['nama']; ?></b>
                  </div>
                  <div class="">
                    <select style="height: 4rem;" class="form-control" name="<?= $row['kode'] ?>" required>
                      <?php
                      $kriteria_id = $row['id'];
                      $subkriteria_query = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE id_kriteria = '$kriteria_id'") or die(mysqli_error($koneksi));
                      while ($subkriteria_row = mysqli_fetch_array($subkriteria_query)) {
                      ?>
                        <option value="<?php echo $subkriteria_row['id']; ?>"><?php echo $subkriteria_row['nama']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                <?php } ?>
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