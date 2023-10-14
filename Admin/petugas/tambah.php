<?php 
	if(isset($_POST['tambah']))
	{
		
		$nama_petugas = $connection->conn->real_escape_string($_POST['nama_petugas']);
		$username = $connection->conn->real_escape_string($_POST['username']);
		$password = md5($connection->conn->real_escape_string($_POST['password']));
		$level = $connection->conn->real_escape_string($_POST['level']);
		$nisn = $connection->conn->real_escape_string($_POST['nisn']);
		
		
		$add = $petugas->tambah($username,$password,$nama_petugas,$level,$nisn);
		if($add)
		{
			?>
			<script>
				alert('Data di tambahkan');
				document.location='home.php?page=petugas'
			</script>
			<?php
		}else{
			?>
			<script>
				alert('Data Gagal di tambah tambahkan');
				document.location = 'home.php?page=petugas'
			</script>
			<?php
		}
	}
?>