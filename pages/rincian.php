<!DOCTYPE html>
<html lang="en">
<?php
include('koneksi.php');

$sql = mysqli_query($koneksi, "SELECT * FROM pegawai") or die(mysqli_error($koneksi));

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

                    <!-- tabel bobot kriteria -->
                    <div class="judul2">
                        <h2 class="text-center">Bobot Kriteria</h2>
                    </div>
                    <table class="table table-striped table-hover tabel" id="">
                        <thead>
                            <tr>
                                <th class="text-center">Kehadiran</th>
                                <th class="text-center">Kualitas Kerja</th>
                                <th class="text-center">Disiplin</th>
                                <th class="text-center">Kerjasama</th>
                                <th class="text-center">Pengembangan Pribadi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="text-center"><?php echo $bobot1; ?> (benefit)</td>
                                <td class="text-center"><?php echo $bobot2; ?> (benefit)</td>
                                <td class="text-center"><?php echo $bobot3; ?> (benefit)</td>
                                <td class="text-center"><?php echo $bobot4; ?> (benefit)</td>
                                <td class="text-center"><?php echo $bobot5; ?> (benefit)</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- tabel normalisasi bobot -->
                    <div class="judul2">
                        <h2 class="text-center">Normalisasi Bobot Kriteria</h2>
                    </div>
                    <table class="table table-striped table-hover tabel" id="">
                        <thead>
                            <tr>
                                <th class="text-center">Kehadiran</th>
                                <th class="text-center">Kualitas Kerja</th>
                                <th class="text-center">Disiplin</th>
                                <th class="text-center">Kerjasama</th>
                                <th class="text-center">Pengembangan Pribadi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="text-center"><?php echo $bobot1 / $totalbobot; ?></td>
                                <td class="text-center"><?php echo $bobot2 / $totalbobot; ?></td>
                                <td class="text-center"><?php echo $bobot3 / $totalbobot; ?></td>
                                <td class="text-center"><?php echo $bobot4 / $totalbobot; ?></td>
                                <td class="text-center"><?php echo $bobot5 / $totalbobot; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- tabel nilai S -->
                    <div class="judul2">
                        <h2 class="text-center">Nilai S</h2>
                    </div>
                    <table class="table table-striped table-hover tabel" id="dataTables2">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Nilai S</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM pegawai");
                            $hasilNilaiS = nilaiS($bobotarray, $Matrik);
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td class="text-center"> <?= $no++; ?></td>
                                    <td class="text-center"><?php echo $row['nama_pegawai']; ?></td>
                                    <td class="text-center"><?php echo round($hasilNilaiS[$no - 2], 4); ?></td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>

                    <!-- tabel nilai V -->
                    <div class="judul2">
                        <h2 class="text-center">Nilai V</h2>
                    </div>
                    <table class="table table-striped table-hover tabel" id="dataTables3">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Nilai V</th>
                                <th class="text-center">Rangking</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            $query1 = mysqli_query($koneksi, "SELECT * FROM pegawai");
                            $nilaiV = nilaiV($hasilNilaiS, $Matrik);
                            $rangking = rangking($nilaiV, $Matrik);

                            while ($row = mysqli_fetch_array($query1)) {
                                $query2 = "UPDATE pegawai SET nilai = '$nilaiV[$no]' WHERE id_pegawai = '$no'";
                                mysqli_query($koneksi, $query2);
                            ?>
                                <tr>
                                    <td class="text-center"> <?= $no++; ?></td>
                                    <td class="text-center"><?php echo $row['nama_pegawai']; ?></td>
                                    <td class="text-center"><?php echo round($nilaiV[$no - 1], 4); ?></td>
                                    <td class="text-center"><?php echo $rangking[$no - 1]; ?></td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                    <div class="container-tombol2">
                        <a class="tombol-kembali btn" href="beranda.php" role="button">kembali</a>
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