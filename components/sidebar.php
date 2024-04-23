<?php
// session_start();
if (!$_SESSION['role']) {
  header('Location: ../index.php');
}
?>
<div class="sidebar">
  <h2 style="text-transform: capitalize;"><?= $_SESSION['role'] ?></h2>
  <ul style="padding-left: 0px;">
    <li><a href="../pages/beranda.php"><i class="fas fa-home"></i>Beranda</a></li>
    <?php if ($_SESSION['role'] == "admin") { ?>
      <li><a href="../dataKriteria/index.php"><i class="fas fa-list"></i>Data Kriteria</a></li>
      <li><a href="../dataSubKriteria/index.php"><i class="fas fa-list"></i>Data Sub Kriteria</a></li>
    <?php } ?>
    <li><a href="../dataAlternatif/index.php"><i class="fas fa-list"></i>Data Alternatif</a></li>
    <li><a href="../pages/rangking.php"><i class="fas fa-list"></i>Data Perangkingan</a></li>
    <hr>
    <li><a href="../pages/profile.php"><i class="fas fa-user"></i>Data Profil</a></li>
    <?php if ($_SESSION['role'] == "admin") { ?>
      <li><a href="../dataPengguna/index.php"><i class="fas fa-user"></i>Data Pengguna</a></li>
    <?php } ?>
    <li><a href="../index.php?logout='1'"><i class="fas fa-sign-out"></i>Keluar</a></li>
  </ul>
</div>