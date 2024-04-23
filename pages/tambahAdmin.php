<!DOCTYPE html>
<html lang="en">
<?php
include('../koneksi.php');

$sql = mysqli_query($koneksi, "SELECT * FROM admin") or die(mysqli_error($koneksi));

if (isset($_POST["tambah_admin"])) {
    $nama_admin = $_POST["nama_admin"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    mysqli_query($koneksi, "INSERT INTO admin VALUES('','$nama_admin','$username', '$password')");
?>
    <script language="javascript">
        alert("Data berhasil ditambahkan");
        document.location = "admin.php";
    </script>

<?php
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../image/logo.png">
    <title>SPK Kejaksaan Negeri Samarinda</title>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <h2>Admin</h2>
            <ul>
                <li><a href="../beranda.php"><i class="fas fa-home"></i>Data pegawai</a></li>
                <li><a href="../rangking.php"><i class="fas fa-list"></i>Rangking</a></li>
                <li><a href="admin.php"><i class="fas fa-user"></i>Admin</a></li>
                <li><a href="../tentang.php"><i class="fas fa-address-card"></i>Tentang</a></li>
                <li><a href="../index.php?logout='1'"><i class="fas fa-sign-out"></i>Keluar</a></li>
            </ul>
        </div>
        <div class="main_content">
            <div class="header">
                <img src="../image/logo.png" alt="logo">
                <h4>SPK Penilaian Pegawai Tetap</h4>
            </div>
            <div class="box">
                <div class="container-table">
                    <div class="judul">
                        <h2 style="margin-bottom:20px;">Masukkan Data Admin</h2>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="" style="margin-top: 10px">
                                <b>Nama Lengkap</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="nama_admin" type="text" required>
                            </div>

                            <div class="" style="margin-top: 10px">
                                <b>Username</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="username" type="text" required>
                            </div>

                            <div class="" style="margin-top: 10px">
                                <b>Password</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="password" type="text" required>
                            </div>

                            <center><button name="tambah_admin" type="submit" class="btn tombol-tambah2" style="margin-bottom:15px;">Tambah</button></center>
                        </form>
                    </div>

                    <div class="container-tombol2">
                        <a class="tombol-kembali btn" href="admin.php" role="button">kembali</a>
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