<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('../components/koneksi.php');
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
                        <h2>Data Alternatif</h2>
                    </div>
                    <?php if ($_SESSION['role'] != 'user') : ?>
                        <div class="container-tombol">
                            <a class="tombol-tambah btn" href="tambah.php" role="button">Tambah data</a>
                        </div>
                    <?php endif; ?>
                    <table class="table table-striped table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <!-- add dynamic column from kriteria table -->
                                <?php
                                $kriteria_query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
                                while ($kriteria = mysqli_fetch_array($kriteria_query)) {
                                    echo "<th class='text-center'>{$kriteria['nama']}</th>";
                                }
                                ?>
                                <?php if ($_SESSION['role'] != 'user') { ?>
                                    <th>Aksi</th>
                                <?php } ?>
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
                                        $nilai_query = mysqli_query($koneksi, "SELECT nilai_alternatif.*, subkriteria.nama FROM nilai_alternatif 
                                        JOIN subkriteria ON nilai_alternatif.id_subkriteria = subkriteria.id 
                                        WHERE nilai_alternatif.id_kriteria = $id_kriteria AND nilai_alternatif.id_alternatif = $id_alternatif") or die(mysqli_error($koneksi));
                                        while ($nilai = mysqli_fetch_array($nilai_query)) {
                                            echo "<td class='text-center'>{$nilai['nama']}</td>";
                                        }
                                    }
                                    ?>
                                    <?php if ($_SESSION['role'] != 'user') { ?>
                                        <td class="text-center">
                                            <div class="text-center">
                                                <a class="btn tombol-edit" href="edit.php?id=<?= $row['id'] ?>"><i class="fas fa-pencil"></i></a>
                                                <a class="btn tombol-hapus" href="hapus.php?id=<?= $row['id'] ?>"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    <?php } ?>
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