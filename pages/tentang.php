<!DOCTYPE html>
<html lang="en">
<?php
include('koneksi.php');
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
            <h2>Tentang</h2>
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
                    <table class="table">
                        <h2 style="margin-bottom:25px;">Tentang Sistem</h2>
                        <tr>
                            <td style="font-weight:bold;">Judul:</td>
                            <td>Sistem Pendukung Keputusan Penilaian Kinerja Pegawai Tetap Kejaksaan Negeri Samarinda Menggunakan Metode Weighted Product</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Metode:</td>
                            <td>Weighted Product</td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;">Tools:</td>
                            <td>HTML, CSS, Javascript,MySQL, Bootstrap 3, Visual Studio Code</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                    <table class="table">
                        <h2 style="margin:75px 0 25px 0;">Penyusun</h2>
                        <tr>
                            <td class="text-center" style="font-weight:bold;">Muhammad xxx</td>
                            <td style="font-weight:bold;">xxx NIM xxx</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>

</html>