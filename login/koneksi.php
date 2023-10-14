<?php 

$host = "mysql";
$user ="root";
$pass = "root";
$database = "db_spp";

$koneksi = new mysqli("$host", "$user", "$pass", "$database");

if($koneksi->connect_errno){
	echo "Gagal koneksi ke Database !".$koneksi->connect_error;
}

?>