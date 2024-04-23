<!DOCTYPE html>
<html lang="en">

<?php
include('koneksi.php');

if (isset($_POST["tambah_pegawai"])) {
    $nama_pegawai = $_POST["nama_pegawai"];
    $kehadiran = $_POST["kehadiran"];
    $kualitas_kerja = $_POST["kualitas_kerja"];
    $disiplin = $_POST["disiplin"];
    $kerjasama = $_POST["kerjasama"];
    $pengembangan_pribadi = $_POST["pengembangan_pribadi"];

    mysqli_query($koneksi, "INSERT INTO pegawai VALUES('','$nama_pegawai','$kehadiran', '$kualitas_kerja', '$disiplin', '$kerjasama', '$pengembangan_pribadi','')");
?>
    <script language="javascript">
        alert("Data berhasil ditambahkan");
        document.location = "beranda.php";
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
                    <div class="judul">
                        <h2 style="margin-bottom:20px;">Masukkan Data Pegawai</h2>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="" style="margin-top: 10px">
                                <b>Nama Lengkap</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="nama_pegawai" type="text" min="1" max="100" required>
                            </div>

                            <div class="" style="margin-top: 10px;">
                                <b>Kehadiran</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="kehadiran" type="number" min="1" max="100" required>
                            </div>

                            <div class="" style="margin-top: 10px;">
                                <b>Kualitas kerja</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="kualitas_kerja" type="number" min="1" max="100" required>
                            </div>

                            <div class="" style="margin-top: 10px;">
                                <b>Disiplin</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="disiplin" type="number" min="1" max="100" required>

                            </div>

                            <div class="" style="margin-top: 10px;">
                                <b>Kerjasama</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="kerjasama" type="number" min="1" max="100" required>
                            </div>

                            <div class="" style="margin-top: 10px;">
                                <b>Pengembangan pribadi</b>
                            </div>
                            <div class="">
                                <input style="height: 3rem;" class="form-control" name="pengembangan_pribadi" type="number" min="1" max="100" required>
                            </div>
                            <center><button name="tambah_pegawai" type="submit" class="btn tombol-tambah2" style="margin-bottom:15px;">Tambah</button></center>
                        </form>
                    </div>

                    <div class="container-tombol2">
                        <a class="tombol-kembali btn" href="beranda.php" role="button">kembali</a>
                    </div>
                </div>
            </div>
        </div>

</body>
<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

</html>