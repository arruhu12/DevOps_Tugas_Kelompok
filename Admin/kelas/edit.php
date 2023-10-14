<?php 
	include_once "../../config/koneksi.php";
	include_once "../../config/database.php";
	include_once "library.php";
	$connection = new Database($host, $user, $pass, $database);
	$kelas = new Kelas($connection);

	$id_kelas = $connection->conn->real_escape_string($_POST['id_kelas']);
	$nama_kelas = $connection->conn->real_escape_string($_POST['nama_kelas']);
	$kompetensi_keahlian = $connection->conn->real_escape_string($_POST['kompetensi_keahlian']);

	$edit = $kelas->edit("UPDATE kelas Set 
	nama_kelas = '$nama_kelas', 
	kompetensi_keahlian = '$kompetensi_keahlian'
	where id_kelas = '$id_kelas'");

	?>
		<script type="text/javascript">
			window.location='home.php?page=kelas'
		</script>
	<?php
?>