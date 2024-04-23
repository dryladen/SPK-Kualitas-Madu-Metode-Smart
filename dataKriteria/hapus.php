<?php
session_start();
include('../components/koneksi.php');

$id = $_GET["id"];

try {
	mysqli_query($koneksi, "DELETE FROM kriteria WHERE id = '$id'");
	if (mysqli_affected_rows($koneksi) > 0) {
		echo "<script> 
				alert('data berhasil dihapus');
				document.location.href ='index.php';
				</script>";
		$query_reorder_id = mysqli_query($koneksi, "ALTER TABLE kriteria AUTO_INCREMENT = 1");
	}
} catch (Exception $e) {
	echo "<script> 
            alert('Gagal menghapus data: Hapus data alternatif terlebih dahulu' );
            document.location.href ='index.php';
        </script>";
	return false;
}
