<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('koneksi.php');


$sql = mysqli_query($koneksi, "SELECT * FROM pegawai") or die(mysqli_error($koneksi));
$no1 = 1;
while ($row = mysqli_fetch_array($sql)) {
  $Matrik[$no1 - 1] = array($row['kehadiran'], $row['kualitas_kerja'], $row['disiplin'], $row['kerjasama'], $row['pengembangan_pribadi']);
  $no1++;
}

$bobot1 = 3;
$bobot2 = 5;
$bobot3 = 5;
$bobot4 = 4;
$bobot5 = 3;

$totalbobot = $bobot1 + $bobot2 + $bobot3 + $bobot4 + $bobot5;
$bobotarray = [0.15, 0.25, 0.25, 0.2, 0.15];

$totalS = 0;
$nilaiV = 0;

function nilaiS($bobotarray, $matrik)
{
  global $totalS;
  for ($i = 0; $i < sizeof($matrik); $i++) {
    $nilaiS[$i] = 1;
    for ($j = 0; $j < sizeof($bobotarray); $j++) {
      $nilaiS[$i] *= pow($matrik[$i][$j], $bobotarray[$j]);
    }
    $totalS += $nilaiS[$i];
  }
  return $nilaiS;
}

function nilaiV($hasilNilaiS, $matrik)
{
  global $totalS;
  for ($i = 1; $i <= sizeof($matrik); $i++) {
    $nilaiV[$i] = $hasilNilaiS[$i - 1] / $totalS;
  }
  return $nilaiV;
}

function rangking($nilaiV, $matrik)
{
  for ($i = 1; $i <= sizeof($matrik); $i++) {
    $rank[$i] = 1;
    for ($j = 1; $j <= sizeof($matrik); $j++) {
      if ($nilaiV[$i] < $nilaiV[$j]) {
        $rank[$i]++;
      }
    }
  }
  return $rank;
}
?>


<head>
  <?php include('components/head.php') ?>
  <title>SPK Pemilihan Kualitas Madu</title>
</head>

<body>
  <div class="wrapper">
    <?php include('components/sidebar.php') ?>
    <div class="main_content">
      <div class="header">
        <h4>SPK Pemilihan Kualitas Madu</h4>
      </div>
      <div class="box">
        <div class="container-table">
          <div class="judul">
            <h2>Data Sub Kriteria</h2>
          </div>
          <div class="container-tombol">
            <a class="tombol-tambah btn" href="tambah.php" role="button">tambah data</a>
          </div>
          <table class="table table-striped table-hover" id="dataTables">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kehadiran</th>
                <th>Kualitas Kerja</th>
                <th>Disiplin</th>
                <th>Kerjasama</th>
                <th>Pengembangan Pribadi</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $query = mysqli_query($koneksi, "SELECT * FROM pegawai") or die(mysqli_error($koneksi));
              $no = 1;
              $hasilNilaiS = nilaiS($bobotarray, $Matrik);
              $hasilNilaiV = nilaiV($hasilNilaiS, $Matrik);
              while ($row = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <td class="text-center"><?php echo $no++; ?></td>
                  <td class="text-left"><?php echo $row['nama_pegawai']; ?></td>
                  <td class="text-center"><?php echo $row['kehadiran']; ?></td>
                  <td class="text-center"><?php echo $row['kualitas_kerja']; ?></td>
                  <td class="text-center"><?php echo $row['disiplin']; ?></td>
                  <td class="text-center"><?php echo $row['kerjasama']; ?></td>
                  <td class="text-center"><?php echo $row['pengembangan_pribadi']; ?></td>
                  <td class="text-center">
                    <div class="container-aksi">
                      <a class="btn tombol-edit" href="edit.php?id=<?= $row['id_pegawai'] ?>"><i class="fas fa-pencil"></i></a>
                      <a class="btn tombol-hapus" href="hapus.php?id=<?= $row['id_pegawai'] ?>"><i class="fas fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
    $('#dataTables').DataTable({
      aaSorting: [],
      "columnDefs": [{

        className: "dt-head-center",
        targets: "_all"

      }],
      "preDrawCallback": function(settings) {
        $('#dataTables tbody').hide();
      },

      "drawCallback": function() {
        $('#dataTables tbody td').addClass("blurry");
        $('#dataTables tbody').fadeIn(200);
        setTimeout(function() {
          $('#dataTables tbody td').removeClass("blurry");
        }, 200);
      }
    });
  });
</script>

</html>