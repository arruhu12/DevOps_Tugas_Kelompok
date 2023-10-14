<?php
	include_once "library.php";
	include_once "../../config/koneksi.php";
	include_once "../../config/database.php";
	$connection = new Database($host, $user, $pass, $database);
	$bayar = new Pembayaran($connection);

	$nisn = $_GET['nisn'];
	$sppData = $bayar->GetSPP($nisn);
	$dataSpp = $sppData->fetch_object();
	$data = array(
        'spp' => $dataSpp->nominal,
        'id_spp' => $dataSpp->id_spp
	);

	//tampil data
	echo json_encode($data);
?>