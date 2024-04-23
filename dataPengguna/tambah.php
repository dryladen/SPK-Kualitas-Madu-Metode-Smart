<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('../components/koneksi.php');

$sql = mysqli_query($koneksi, "SELECT * FROM users") or die(mysqli_error($koneksi));

if (isset($_POST["tambah_admin"])) {
  $nama_admin = $_POST["nama_admin"];
  $username = $_POST["username"];
  $password = md5($_POST["password"]);
  $role = $_POST["role"];
  mysqli_query($koneksi, "INSERT INTO users VALUES('','$nama_admin','$username', '$password','$role')");
?>
  <script language="javascript">
    alert("Data berhasil ditambahkan");
    document.location = "index.php";
  </script>

<?php
}
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
        <img src="../image/logo.png" alt="logo">
        <h4>SPK Penilaian Pegawai Tetap</h4>
      </div>
      <div class="box">
        <div class="container-table">
          <div class="judul">
            <h2 style="margin-bottom:20px;">Masukkan Data Users</h2>
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
              <div class="" style="margin-top: 10px;">
                <b>Role</b>
              </div>
              <div class="">
                <select name="role" id="role" style="height: 4rem; padding: 0 20px;" class="">
                  <option style="height: 4rem;" value="user">User</option>
                  <option style="height: 4rem;" value="admin">Admin</option>
                </select>
              </div>
              <center><button name="tambah_admin" type="submit" class="btn tombol-tambah2" style="margin-bottom:15px;">Tambah</button></center>
            </form>
          </div>
          <div class="container-tombol2">
            <a class="tombol-kembali btn" href="index.php" role="button">kembali</a>
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