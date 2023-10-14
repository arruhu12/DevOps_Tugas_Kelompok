<?php 
	include_once "library.php";
	include_once "../../config/koneksi.php";
	include_once "../../config/database.php";
	$connection = new Database($host, $user, $pass, $database);
	$petugas = new Petugas($connection);

	$id_petugas = $connection->conn->real_escape_string($_POST['id_petugas']);
	$nama_petugas = $connection->conn->real_escape_string($_POST['nama_petugas']);
	$username = $connection->conn->real_escape_string($_POST['username']);
	$password = md5($connection->conn->real_escape_string($_POST['password']));
	$level = $connection->conn->real_escape_string($_POST['level']);

	$edit = $petugas->edit("UPDATE petugas Set
	nama_petugas = '$nama_petugas',
	username = '$username',
	password = '$password',
	level = '$level'
	where id_petugas = '$id_petugas'");

	?>
		<script type="text/javascript">
			window.location='home.php?page=petugas'
		</script>
	<?php
?>