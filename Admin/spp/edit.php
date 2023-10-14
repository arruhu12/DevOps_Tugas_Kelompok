<?php 
	include_once "library.php";
	include_once "../../config/koneksi.php";
	include_once "../../config/database.php";
	$connection = new Database($host, $user, $pass, $database);
	$spp = new Spp($connection);

	$id_spp = $connection->conn->real_escape_string($_POST['id_spp']);
	$tahun = $connection->conn->real_escape_string($_POST['tahun']);
	$nominal = $connection->conn->real_escape_string($_POST['nominal']);

	$edit = $spp->edit("UPDATE spp Set
	tahun = '$tahun',
	nominal = '$nominal'
	where id_spp = '$id_spp'");

	?>
		<script type="text/javascript">
			window.location='home.php?page=spp'
		</script>
	<?php
?>