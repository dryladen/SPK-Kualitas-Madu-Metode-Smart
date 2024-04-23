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
                        <h2>Data Sub Kriteria</h2>
                    </div>
                    <?php
                    $dataKriteria = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
                    while ($kriteria = mysqli_fetch_array($dataKriteria)) { ?>
                        <h3 style="padding: 20px 0;">Kriteria : <?= $kriteria['nama'] ?></h3>
                        <div class="container-tombol">
                            <a class="tombol-tambah btn" href="tambah.php?kriteria=<?= $kriteria['nama'] ?>" role="button">Tambah data</a>
                        </div>
                        <table class='table table-striped table-hover dataTables'>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Skala Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dataSubKriteria = mysqli_query($koneksi, "SELECT * FROM subkriteria WHERE id_kriteria = " . $kriteria['id']) or die(mysqli_error($koneksi));
                                $no = 1;
                                while ($row = mysqli_fetch_array($dataSubKriteria)) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no++; ?></td>
                                        <td class="text-left"><?php echo $row['nama']; ?></td>
                                        <td class="text-center"><?php echo $row['skala_nilai']; ?></td>
                                        <td class="text-center">
                                            <div class="text-center">
                                                <a class="btn tombol-edit" href="edit.php?id=<?= $row['id'] ?>"><i class="fas fa-pencil"></i></a>
                                                <a class="btn tombol-hapus" href="hapus.php?id=<?= $row['id'] ?>"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
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
        $('.dataTables').DataTable({
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