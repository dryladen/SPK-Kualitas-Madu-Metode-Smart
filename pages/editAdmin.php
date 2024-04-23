<!DOCTYPE html>
<html lang="en">

<?php
include('../koneksi.php');
$id = $_GET['id'];

$sql = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$id'") or die(mysqli_error($koneksi));
$data = mysqli_fetch_assoc($sql);

if (isset($_POST["edit"])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_admin']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
    $password_confirmation = mysqli_real_escape_string($koneksi, $_POST['password-confirm']);

    if ($pass != $password_confirmation) {
        echo "
        <script>
            alert('Password Yang Anda Masukkan Berbeda');
            document.location.href = 'editAdmin.php?id=" . $id . "';
        </script>
        ";
    }

    if ($pass == $password_confirmation) {
        $password = md5($pass);

        $query = "UPDATE admin SET 
        nama_admin = '$nama',
        password = '$password'
        WHERE id_admin='$id'";

        $query_run = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
        if ($query_run) {
            echo "
        <script>
            alert('Data Berhasil Diubah');
            document.location.href = 'admin.php';
        </script>
        ";
        } else {
            echo "
        <script>
            alert('Data Gagal Diubah');
            document.location.href = 'editAdmin.php?id=" . $id . "';
        </script>
        ";
        }
    }
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
                        <form method="POST" enctype="form-input">

                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="" style="margin-top: 10px">
                                <b>Nama Lengkap</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="nama_admin" type="text" required value="<?= $data['nama_admin'] ?>">
                            </div>

                            <div class="" style="margin-top: 10px">
                                <b>Username</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="username" type="text" required value="<?= $data['username'] ?>" disabled>
                            </div>

                            <div class="" style="margin-top: 10px">
                                <b>Password baru</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="password" type="text" required>
                            </div>

                            <div class="" style="margin-top: 10px">
                                <b>Konfirmasi Password</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="password-confirm" type="text" required>
                            </div>

                            <center><button name="edit" type="submit" class="btn tombol-tambah2" style="margin-bottom:15px;">Ubah Data</button></center>
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

</html>