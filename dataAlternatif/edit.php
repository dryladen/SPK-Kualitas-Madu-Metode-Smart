<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('../components/koneksi.php');

$id = $_GET['id'];

$data_alternatif = mysqli_query($koneksi, "SELECT * FROM alternatif WHERE id='$id'") or die(mysqli_error($koneksi));
$men = mysqli_fetch_assoc($data_alternatif);
if (isset($_POST["edit"])) {
  $kode = $_POST["kode"];
  $nama = $_POST["nama"];
  // Update the alternatif data
  mysqli_query($koneksi, "UPDATE alternatif SET kode='$kode', nama='$nama' WHERE id='$id'");
  $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
  while ($row = mysqli_fetch_array($query)) {
    $kriteria_value = $_POST["$row[kode]"];
    // Check if nilai_alternatif data exists for this alternatif and kriteria
    $check_query = mysqli_query($koneksi, "SELECT * FROM nilai_alternatif WHERE id_alternatif = '$id' AND id_kriteria = '$row[id]'");
    if (mysqli_num_rows($check_query) > 0) {
      // If exists, update the data
      mysqli_query($koneksi, "UPDATE nilai_alternatif SET id_subkriteria = '$kriteria_value' WHERE id_alternatif = '$id' AND id_kriteria = '$row[id]'");
    } else {
      // If not exists, insert new data
      mysqli_query($koneksi, "INSERT INTO nilai_alternatif (id_alternatif, id_kriteria, id_subkriteria) VALUES ('$id', '$row[id]', '$kriteria_value')");
    }
  }
?>
  <script language="javascript">
    alert("Data berhasil diubah");
    document.location = "index.php";
  </script>
<?php
}
?>

<head>
  <?php include('../components/head.php'); ?>
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
                <input style="height: 4rem;" class="form-control" name="kode" type="text" required placeholder="Cth: A1" value="<?php echo $men['kode']; ?>">
              </div>
              <div class="" style="margin-top: 10px;">
                <b>Nama Alternatif</b>
              </div>
              <div class="">
                <input style="height: 4rem;" class="form-control" name="nama" type="text" required placeholder="Cth: Bunga Pagoda" value="<?php echo $men['nama']; ?>">
              </div>
              <hr>
              <div class="" style="margin-top: 10px;">
                <h2 style="margin-bottom:20px;">Masukkan Data Kriteria</h2>
              </div>
              <div>
                <?php
                // Get kriteria data from database
                $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
                while ($row = mysqli_fetch_array($query)) { ?>
                  <div class="" style="margin-top: 10px">
                    <b><?php echo $row['nama']; ?></b>
                  </div>
                  <div class="">
                    <select style="height: 4rem;" class="form-control" name="<?= $row['kode'] ?>" required>
                      <?php
                      // Get subkriteria data from database
                      $kriteria_id = $row['id'];
                      $subkriteria_query = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE id_kriteria = '$kriteria_id'") or die(mysqli_error($koneksi));
                      while ($subkriteria_row = mysqli_fetch_array($subkriteria_query)) {
                        // Get selected data from nilai_alternatif table if exists
                        $nilai_alternatif_query = mysqli_query($koneksi, "SELECT * FROM nilai_alternatif WHERE id_alternatif = '$id' AND id_subkriteria = '" . $subkriteria_row['id'] . "'") or die(mysqli_error($koneksi));
                        $nilai_alternatif_row = mysqli_fetch_array($nilai_alternatif_query);
                        $selected = ($nilai_alternatif_row) ? 'selected' : '';
                      ?>
                        <option value="<?php echo $subkriteria_row['id']; ?>" <?php echo $selected; ?>><?php echo $subkriteria_row['nama']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                <?php } ?>
              </div>
              <center><button name="edit" type="submit" class="btn tombol-tambah2" style="margin-bottom:15px;">Simpan</button></center>
            </form>
          </div>
          <div class="container-tombol2">
            <a class="tombol-kembali btn" href="index.php" role="button">kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>