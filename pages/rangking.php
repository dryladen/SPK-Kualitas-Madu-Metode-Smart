<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('../components/koneksi.php');
include('../pages/spkMoora.php');
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
          <!-- perangkingan -->
          <div class="judul">
            <h2>Data Perangkingan</h2>
          </div>
          <table class="table table-striped table-hover tabel dataTables" style="width: 100%;">
            <thead>
              <tr>
                <th class="text-center">Rangking</th>
                <th class="text-center">Kode</th>
                <th class="text-center">Nama</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $matriks = Perangkingan($koneksi);
              foreach ($matriks as $row) {
              ?>
                <tr>
                  <td class="text-center"><?php echo ($no) ?></td>
                  <td class="text-center"><?php echo ($row[0]) ?></td>
                  <td class="text-center"><?php echo ($row[1]) ?></td>
                </tr>
              <?php $no++;
              }
              ?>
            </tbody>
          </table>
          <div class="container-tombol">
            <a class="tombol-tambah btn" href="detail.php" role="button">Detail</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap.min.js"></script>

  <script>
    $(document).ready(function() {
      $('.dataTables').DataTable({
        scrollX: true,
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
</body>

</html>