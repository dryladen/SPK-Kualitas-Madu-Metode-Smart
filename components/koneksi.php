<?php
	$server= "localhost";
	$username="root";
	$password="";
	$database="spk_pegawai_tetap";
	$koneksi = mysqli_connect($server,$username,$password,$database);


	try {
		//create PDO connection
		$db = new PDO("mysql:host=$server;dbname=$database", $username, $password);
	} catch(PDOException $e) {
		//show error
		die("Terjadi masalah: " . $e->getMessage());
	}
