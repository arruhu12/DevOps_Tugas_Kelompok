<?php 
	if(isset($_POST['tambah']))
	{
		
		$id_spp = $connection->conn->real_escape_string($_POST['id_spp']);
		$tahun = $connection->conn->real_escape_string($_POST['tahun']); 
		$nominal = $connection->conn->real_escape_string($_POST['nominal']);
		
		
		$add = $spp->tambah($tahun, $nominal);
		if($add)
		{
			?>
			<script>
				alert('Data di tambahkan');
				document.location='home.php?page=spp'
			</script>
			<?php
		}else{
			?>
			<script>
				alert('Data Gagal di tambah tambahkan');
				document.location = 'home.php?page=spp'
			</script>
			<?php
		}
	}
?>