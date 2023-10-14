<?php 
	if(isset($_POST['tambah']))
	{
		
		$nisn = $connection->conn->real_escape_string($_POST['nisn']); 
		$nis = $connection->conn->real_escape_string($_POST['nis']);
		$nama = $connection->conn->real_escape_string($_POST['nama']);
		$id_kelas = $connection->conn->real_escape_string($_POST['id_kelas']);
		$alamat = $connection->conn->real_escape_string($_POST['alamat']);
		$no_telp = $connection->conn->real_escape_string($_POST['no_telp']);
		$id_spp = $connection->conn->real_escape_string($_POST['id_spp']);
		
		
		$add = $siswa->tambah($nisn, $nis,$nama,$id_kelas,$alamat,$no_telp,$id_spp);
		if($add)
		{
			?>
			<script>
				alert('Data di tambahkan');
				document.location='home.php?page=siswa'
			</script>
			<?php
		}else{
			?>
			<script>
				alert('Data Gagal di tambah tambahkan');
				document.location = 'home.php?page=siswa'
			</script>
			<?php
		}
	}
?>