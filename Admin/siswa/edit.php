<?php 
	include_once "library.php";
	include_once "../../config/koneksi.php";
	include_once "../../config/database.php";
	$connection = new Database($host, $user, $pass, $database);
	$siswa = new Siswa($connection);

	$id_siswa = $connection->conn->real_escape_string($_POST['id_siswa']);
	$nisn = $connection->conn->real_escape_string($_POST['nisn']);
	$nis = $connection->conn->real_escape_string($_POST['nis']);
	$nama = $connection->conn->real_escape_string($_POST['nama']);
	$id_kelas = $connection->conn->real_escape_string($_POST['id_kelas']);
	$alamat = $connection->conn->real_escape_string($_POST['alamat']);
	$no_telp = $connection->conn->real_escape_string($_POST['no_telp']);
	$id_spp = $connection->conn->real_escape_string($_POST['id_spp']);

	$edit = $siswa->edit("UPDATE siswa Set
	nisn = '$nisn',
	nis = '$nis',
	nama = '$nama',
	id_kelas = '$id_kelas',
	alamat = '$alamat',
	no_telp = '$no_telp',
	id_spp = '$id_spp'
	where id_siswa = '$id_siswa'");

	?>
		<script type="text/javascript">
			window.location='home.php?page=siswa'
		</script>
	<?php
?>