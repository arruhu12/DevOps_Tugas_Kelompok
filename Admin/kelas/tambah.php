<?php 
	if(isset($_POST['tambah']))
	{
		$nama_kelas = $connection->conn->real_escape_string($_POST['nama_kelas']);
		$kompetensi_keahlian = $connection->conn->real_escape_string($_POST['kompetensi_keahlian']);

		$add = $kelas->tambah($nama_kelas, $kompetensi_keahlian);

		if($add)
		{
			?>
			<script>
				alert('Data di tambahkan');
				document.location='home.php?page=kelas'
			</script>
			<?php
		}else{
			?>
			<script>
				alert('Data Gagal di tambah tambahkan');
				document.location = 'home.php?page=kelas'
			</script>
			<?php
		}
	}
?>