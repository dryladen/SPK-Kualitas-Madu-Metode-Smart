<?php 
require '../koneksi.php';

$id = $_GET["id"];

function hapusmenu($id){
	global $koneksi;

	mysqli_query($koneksi,"DELETE FROM admin WHERE id_admin = '$id'");

	return mysqli_affected_rows($koneksi);
}

if (hapusmenu($id)>0) {
	echo"<script> alert('data berhasil dihapus');
        document.location.href ='admin.php';
        </script>";
		
		$query_reorder_id = mysqli_query($koneksi, "ALTER TABLE admin AUTO_INCREMENT = 1");

}else {
	echo "<script> alert('data gagal dihapus');
        document.location.href ='admin.php';
        </script>";
}

?>