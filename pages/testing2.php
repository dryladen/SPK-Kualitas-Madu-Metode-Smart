<!DOCTYPE html>
<html lang="en">
<?php
include('koneksi.php');

$sql = mysqli_query($koneksi, "SELECT * FROM pegawai") or die(mysqli_error($koneksi));

$bobot = [30, 50, 50, 40, 30];

// perhitungan matriks metode spk moora
function PembentukanMatriks($koneksi)
{
  $sql = mysqli_query($koneksi, "SELECT * FROM pegawai") or die(mysqli_error($koneksi));
  $matriks = array();
  while ($row = mysqli_fetch_array($sql)) {
    $matriks[] = array(
      $row['nama_pegawai'],
      $row['kehadiran'],
      $row['kualitas_kerja'],
      $row['disiplin'],
      $row['kerjasama'],
      $row['pengembangan_pribadi']
    );
  }
  return $matriks;
}
function mencariNilaiUtility($koneksi)
{
  $matriks = PembentukanMatriks($koneksi);
  $nilaiUtility = array();
  for ($i = 0; $i < count($matriks); $i++) {
    $nilaiUtility[$i][0] = $matriks[$i][0]; // nama pegawai
    for ($j = 1; $j < count($matriks[$i]); $j++) {
      // Mencari nilai utility
      $nilaiUtility[$i][$j] = 100 * ((100 - $matriks[$i][$j]) / (100 - 0));
    }
  }
  return $nilaiUtility;
}
// perangkingan
function Perangkingan($koneksi, $bobot)
{
  $nilaiUtility = mencariNilaiUtility($koneksi);
  $nilaiUtilityTerbobot = array();
  for ($i = 0; $i < count($nilaiUtility); $i++) {
    $nilaiUtilityTerbobot[$i][0] = $nilaiUtility[$i][0]; // nama pegawai
    $nilaiUtilityTerbobot[$i][1] = $nilaiUtility[$i][1] * ($bobot[0] / 100); // kehadiran
    $nilaiUtilityTerbobot[$i][2] = $nilaiUtility[$i][2] * ($bobot[1] / 100); // kualitas kerja
    $nilaiUtilityTerbobot[$i][3] = $nilaiUtility[$i][3] * ($bobot[2] / 100); // disiplin
    $nilaiUtilityTerbobot[$i][4] = $nilaiUtility[$i][4] * ($bobot[3] / 100); // kerjasama
    $nilaiUtilityTerbobot[$i][5] = $nilaiUtility[$i][5] * ($bobot[4] / 100); // pengembangan pribadi
    $nilaiUtilityTerbobot[$i][6] = $nilaiUtilityTerbobot[$i][1] + $nilaiUtilityTerbobot[$i][2] + $nilaiUtilityTerbobot[$i][3] + $nilaiUtilityTerbobot[$i][4] + + $nilaiUtilityTerbobot[$i][5]; // nilai y
  }
  // Pengurutan Rangking
  $rangking = $nilaiUtilityTerbobot;
  for ($i = 0; $i < count($rangking); $i++) {
    for ($j = 0; $j < count($rangking); $j++) {
      if ($rangking[$i][6] > $rangking[$j][6]) {
        $temp = $rangking[$i];
        $rangking[$i] = $rangking[$j];
        $rangking[$j] = $temp;
      }
    }
  }
  return $rangking;
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="Description" content="Enter your description here" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/png" href="image/logo.png">
  <title>SPK Kejaksaan Negeri Samarinda</title>
</head>

<body>
  <div class="wrapper">
    <div class="sidebar">
      <h2>Dashboard</h2>
      <ul>
        <li><a href="beranda.php"><i class="fas fa-home"></i>Data pegawai</a></li>
        <li><a href="rangking.php"><i class="fas fa-list"></i>Rangking</a></li>
        <li><a href="admin/admin.php"><i class="fas fa-user"></i>Admin</a></li>
        <li><a href="tentang.php"><i class="fas fa-address-card"></i>Tentang</a></li>
        <li><a href="index.php?logout='1'"><i class="fas fa-sign-out"></i>Keluar</a></li>
      </ul>
    </div>
    <div class="main_content">
      <div class="header">
        <img src="image/logo.png" alt="logo">
        <h4>SPK Penilaian Pegawai Tetap</h4>
      </div>
      <div class="box">
        <div class="container-table">

          <!-- tabel alternatif -->
          <div class="judul3">
            <h2 class="text-center">Tabel Alternatif</h2>
          </div>
          <table class="table table-striped table-hover tabel" id="dataTables1">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th clas="text-center">Nama</th>
                <th class="text-center">Kehadiran</th>
                <th class="text-center">Kualitas Kerja</th>
                <th class="text-center">Disiplin</th>
                <th class="text-center">Kerjasama</th>
                <th class="text-center">Pengembangan Pribadi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_array($sql)) {
                $Matrik[$no - 1] = array($row['kehadiran'], $row['kualitas_kerja'], $row['disiplin'], $row['kerjasama'], $row['pengembangan_pribadi']);
              ?>
                <tr>
                  <td class="text-center"><?php echo $no++; ?></td>
                  <td class="text-left"><?php echo $row['nama_pegawai']; ?></td>
                  <td class="text-center"><?php echo $row['kehadiran']; ?></td>
                  <td class="text-center"><?php echo $row['kualitas_kerja']; ?></td>
                  <td class="text-center"><?php echo $row['disiplin']; ?></td>
                  <td class="text-center"><?php echo $row['kerjasama']; ?></td>
                  <td class="text-center"><?php echo $row['pengembangan_pribadi']; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- tabel normalisasi bobot -->
          <div class="judul2">
            <h2 class="text-center">Nilai Utility</h2>
          </div>
          <table class="table table-striped table-hover tabel" id="">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Kehadiran</th>
                <th class="text-center">Kualitas Kerja</th>
                <th class="text-center">Disiplin</th>
                <th class="text-center">Kerjasama</th>
                <th class="text-center">Pengembangan Pribadi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
              $matriks = mencariNilaiUtility($koneksi);
              foreach ($matriks as $row) {
              ?>
                <tr>
                  <td class="text-center"><?php echo ($no) ?></td>
                  <td class="text-center"><?php echo ($row[0]) ?></td>
                  <td class="text-center"><?php echo (number_format($row[1], 4, '.', '')); ?></td>
                  <td class="text-center"><?php echo (number_format($row[2], 4, '.', '')); ?></td>
                  <td class="text-center"><?php echo (number_format($row[3], 3, '.', '')); ?></td>
                  <td class="text-center"><?php echo (number_format($row[4], 1, '.', '')); ?></td>
                  <td class="text-center"><?php echo (number_format($row[5], 4, '.', '')); ?></td>
                </tr>
              <?php $no++;
              }
              ?>
            </tbody>
          </table>
          <!-- tabel perangkingan -->
          <div class="judul2">
            <h2 class="text-center">Perangkingan</h2>
          </div>
          <table class="table table-striped table-hover tabel" id="">
            <thead>
              <tr>
                <th class="text-center">Ranking</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Kehadiran</th>
                <th class="text-center">Kualitas Kerja</th>
                <th class="text-center">Disiplin</th>
                <th class="text-center">Kerjasama</th>
                <th class="text-center">Pengembangan Pribadi</th>
                <th class="text-center">Nilai Y</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
              $perangkingan = Perangkingan($koneksi, $bobot);
              foreach ($perangkingan as $row) {
              ?>
                <tr>
                  <td class="text-center"><?php echo ($no) ?></td>
                  <td class="text-center"><?php echo ($row[0]) ?></td>
                  <td class="text-center"><?php echo (number_format($row[1], 3, '.', '')); ?></td>
                  <td class="text-center"><?php echo (number_format($row[2], 3, '.', '')); ?></td>
                  <td class="text-center"><?php echo (number_format($row[3], 3, '.', '')); ?></td>
                  <td class="text-center"><?php echo (number_format($row[4], 1, '.', '')); ?></td>
                  <td class="text-center"><?php echo (number_format($row[5], 3, '.', '')); ?></td>
                  <td class="text-center"><?php echo (number_format($row[6], 3, '.', '')); ?></td>

                </tr>
              <?php $no++;
              }
              ?>


            </tbody>
          </table>




        </div>
      </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
    var table1 = $('#dataTables1').DataTable({
      searching: false,
      paging: true,
      aaSorting: [],
      "columnDefs": [{
        "className": "dt-head-center",
        "targets": "_all"
      }],
      "preDrawCallback": function(settings) {
        $('#dataTables1 tbody').hide();
      },

      "drawCallback": function() {
        $('#dataTables1 tbody td').addClass("blurry");
        $('#dataTables1 tbody').fadeIn(200);
        setTimeout(function() {
          $('#dataTables1 tbody td').removeClass("blurry");
        }, 200);
      }
    });
    var table2 = $('#dataTables2').DataTable({
      searching: false,
      paging: true,
      aaSorting: [],
      "columnDefs": [{
        "className": "dt-head-center",
        "targets": "_all"
      }],
      "preDrawCallback": function(settings) {
        $('#dataTables2 tbody').hide();
      },

      "drawCallback": function() {
        $('#dataTables2 tbody td').addClass("blurry");
        $('#dataTables2 tbody').fadeIn(200);
        setTimeout(function() {
          $('#dataTables2 tbody td').removeClass("blurry");
        }, 200);
      }
    });
    var table3 = $('#dataTables3').DataTable({
      searching: false,
      paging: true,
      aaSorting: [],
      "columnDefs": [{
        "className": "dt-head-center",
        "targets": "_all"
      }],
      "preDrawCallback": function(settings) {
        $('#dataTables3 tbody').hide();
      },

      "drawCallback": function() {
        $('#dataTables3 tbody td').addClass("blurry");
        $('#dataTables3 tbody').fadeIn(200);
        setTimeout(function() {
          $('#dataTables3 tbody td').removeClass("blurry");
        }, 200);
      }
    });
  });
</script>

</html>