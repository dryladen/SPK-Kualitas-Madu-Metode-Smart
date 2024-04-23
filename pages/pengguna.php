<!DOCTYPE html>
<html lang="en">
<?php
include('../components/koneksi.php');
session_start();
$sql = mysqli_query($koneksi, "SELECT * FROM admin") or die(mysqli_error($koneksi));
?>

<head>
    <?php include('../components/head.php') ?>
    <link rel="stylesheet" href="css/style.css">
    <title>Data Pengguna</title>
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
                        <h2>Data Pengguna</h2>
                    </div>
                    <table class="table table-striped table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM admin") or die(mysqli_error($koneksi));
                            $no = 1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?php echo $row['nama_admin']; ?></td>
                                    <td class="text-center"><?php echo $row['username']; ?></td>
                                    <td class="text-center"><?php echo $row['role']; ?></td>
                                    <td class="text-center">
                                        <a class="btn tombol-edit" href="editAdmin.php?id=<?= $row['id_admin'] ?>"><i class="fas fa-pencil"></i></a>
                                        <a class="btn tombol-hapus" href="hapusAdmin.php?id=<?= $row['id_admin'] ?>"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="container-tombol2">
                        <a class="tombol-tambah btn" href="tambahAdmin.php" role="button">Tambah Data</a>
                    </div>
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