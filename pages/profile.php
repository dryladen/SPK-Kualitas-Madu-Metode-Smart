<!DOCTYPE html>
<html lang="en">
<?php
include('../components/koneksi.php');
session_start();
$sql = mysqli_query($koneksi, "SELECT * FROM users WHERE id_admin = '$_SESSION[id]'") or die(mysqli_error($koneksi));
$data = mysqli_fetch_array($sql);
$id = $_SESSION['id'];

if (isset($_POST["edit"])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_admin']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
    $password_confirmation = mysqli_real_escape_string($koneksi, $_POST['password-confirm']);

    if ($pass != $password_confirmation) {
        echo "
        <script>
            alert('Password Yang Anda Masukkan Berbeda');
            document.location.href = 'profile.php?id=" . $id . "';
        </script>
        ";
    }

    if ($pass == $password_confirmation) {
        $password = md5($pass);

        $query = "UPDATE users SET 
        nama_admin = '$nama',
        password = '$password'
        WHERE id_admin='$id'";

        $query_run = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
        if ($query_run) {
            echo "
        <script>
            alert('Data Berhasil Diubah');
            document.location.href = 'profile.php';
        </script>
        ";
        } else {
            echo "
        <script>
            alert('Data Gagal Diubah');
            document.location.href = 'profile.php?id=" . $id . "';
        </script>
        ";
        }
    }
}
?>

<head>
  <?php include('../components/head.php') ?>
  <title>Data Profile</title>
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

              <center><button name="edit" type="submit" class="btn tombol-tambah2" style="margin-bottom:15px;">Update</button></center>
            </form>
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