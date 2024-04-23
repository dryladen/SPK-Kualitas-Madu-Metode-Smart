<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include('../components/koneksi.php');
$id = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM users WHERE id_admin='$id'") or die(mysqli_error($koneksi));
$data = mysqli_fetch_assoc($sql);

if (isset($_POST["edit"])) {
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama_admin']);
  $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
  $role = mysqli_real_escape_string($koneksi, $_POST['role']);
  $password_confirmation = mysqli_real_escape_string($koneksi, $_POST['password-confirm']);
  // jika password tidak kosong
  if ($pass == '' || $password_confirmation == '') {
    $query = "UPDATE users SET 
        nama_admin = '$nama', role = '$role'
        WHERE id_admin=$id";
    $query_run = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    if ($query_run) {
      echo "
        <script>
            alert('Data Berhasil Diubah');
            document.location.href = 'index.php';
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
  } else {
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
      $query = "UPDATE users SET 
        nama_admin = '$nama',
        role = '$role',
        password = '$password'
        WHERE id_admin=$id";
      $query_run = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
      if ($query_run) {
        echo "
        <script>
            alert('Data Berhasil Diubah');
            document.location.href = 'index.php';
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
        <h4>SPK Pemilihan Kualitas Madu</h4>
      </div>
      <div class="box">
        <div class="container-table">
          <div class="judul">
            <h2 style="margin-bottom:20px;">Ubah Data Admin</h2>
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
              <div class="" style="margin-top: 10px;">
                <b>Role</b>
              </div>
              <div class="">
                <select name="role" id="role" style="height: 4rem; padding: 0 20px;" class="">
                  <option style="height: 4rem;" value="user" <?php if ($data['role'] == 'user') echo 'selected'; ?>>User</option>
                  <option style="height: 4rem;" value="admin" <?php if ($data['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                </select>
              </div>
              <div class="" style="margin-top: 10px">
                <b>Password baru</b>
              </div>
              <div class="">
                <input style="height: 3rem;" class="form-control" name="password" type="text">
              </div>
              <div class="" style="margin-top: 10px">
                <b>Konfirmasi Password</b>
              </div>
              <div class="">
                <input style="height: 3rem;" class="form-control" name="password-confirm" type="text">
              </div>
              <center><button name="edit" type="submit" class="btn tombol-tambah2" style="margin-bottom:15px;">Ubah Data</button></center>
            </form>
          </div>
          <div class="container-tombol2">
            <a class="tombol-kembali btn" href="index.php" role="button">kembali</a>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>