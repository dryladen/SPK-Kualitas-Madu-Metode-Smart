<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('../components/koneksi.php');
include('../pages/spkMoora.php');
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
                    <!-- tabel alternatif -->
                    <div class="judul3">
                        <h2 class="text-center">Tabel Alternatif</h2>
                    </div>
                    <table class="table table-striped table-hover tabel dataTables" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <!-- add dynamic column from kriteria table -->
                                <?php
                                $kriteria_query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
                                while ($kriteria = mysqli_fetch_array($kriteria_query)) {
                                    echo "<th class='text-center'>{$kriteria['nama']}</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM alternatif ORDER BY kode") or die(mysqli_error($koneksi));
                            $no = 1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?php echo $row['kode']; ?></td>
                                    <td class="text-center"><?php echo $row['nama']; ?></td>
                                    <!-- add dynamic column from kriteria table -->
                                    <?php
                                    $kriteria_query2 = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
                                    while ($kriteria2 = mysqli_fetch_array($kriteria_query2)) {
                                        $id_kriteria = $kriteria2['id'];
                                        $id_alternatif = $row['id'];
                                        $nilai_query = mysqli_query($koneksi, "SELECT nilai_alternatif.*, subkriteria.skala_nilai FROM nilai_alternatif 
                                        JOIN subkriteria ON nilai_alternatif.id_subkriteria = subkriteria.id 
                                        WHERE nilai_alternatif.id_kriteria = $id_kriteria AND nilai_alternatif.id_alternatif = $id_alternatif") or die(mysqli_error($koneksi));
                                        while ($nilai = mysqli_fetch_array($nilai_query)) {
                                            echo "<td class='text-center'>{$nilai['skala_nilai']}</td>";
                                        }
                                    }
                                    ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- tabel normalisasi bobot -->
                    <div class="judul2">
                        <h2 class="text-center">Matriks Normalisasi</h2>
                    </div>
                    <table class="table table-striped table-hover tabel dataTables" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <!-- add dynamic column from kriteria table -->
                                <?php
                                $kriteria_query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
                                while ($kriteria = mysqli_fetch_array($kriteria_query)) {
                                    echo "<th class='text-center'>{$kriteria['nama']}</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $matriks = MatriksNormalisasi($koneksi);
                            foreach ($matriks as $row) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo ($no) ?></td>
                                    <?php foreach ($row as $column) { ?>
                                        <td class="text-center"><?php echo (is_array($column) && isset($column['skala_nilai']) ? number_format($column['skala_nilai'], 2) : $column) ?></td>
                                    <?php } ?>
                                </tr>
                            <?php $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- tabel perangkingan -->
                    <div class="judul2">
                        <h2 class="text-center">Matriks Normalisasi Terbobot</h2>
                    </div>
                    <table class="table table-striped table-hover tabel dataTables" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <!-- add dynamic column from kriteria table -->
                                <?php
                                $kriteria_query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
                                while ($kriteria = mysqli_fetch_array($kriteria_query)) {
                                    echo "<th class='text-center'>{$kriteria['nama']}</th>";
                                }
                                ?>
                                <th class="text-center">Nilai Y</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $matriks = MatriksNormalisasiTerbobot($koneksi);
                            foreach ($matriks as $row) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo ($no) ?></td>
                                    <?php foreach ($row as $column) { ?>
                                        <td class="text-center"><?php echo (is_array($column) && isset($column['skala_nilai']) ? number_format($column['skala_nilai'], 2) . "($column[jenis])" : $column) ?></td>
                                    <?php } ?>
                                </tr>
                            <?php $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- perangkingan -->
                    <div class="judul2">
                        <h2 class="text-center">Perangkingan</h2>
                    </div>
                    <table class="table table-striped table-hover tabel dataTables" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">Rangking</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Nilai Y</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $matriks = Perangkingan($koneksi);
                            foreach ($matriks as $row) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo ($no) ?></td>
                                    <td class="text-center"><?php echo ($row[0]) ?></td>
                                    <td class="text-center"><?php echo ($row[1]) ?></td>
                                    <td class="text-center"><?php echo number_format($row[count($row) - 1]['skala_nilai'], 2) ?></td>
                                </tr>
                            <?php $no++;
                            }
                            ?>
                        </tbody>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.dataTables').DataTable({
                scrollX: true,
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
</body>

</html>