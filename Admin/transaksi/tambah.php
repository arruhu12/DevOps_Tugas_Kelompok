<?php 
	if(isset($_POST['tambah']))
	{
		
		$id_petugas = $connection->conn->real_escape_string($_POST['id_petugas']); 
		$nisn = $connection->conn->real_escape_string($_POST['nisn']);		
		$tgl_bayar = $connection->conn->real_escape_string($_POST['tgl_bayar']); 
		$bulan_dibayar = $connection->conn->real_escape_string($_POST['bulan_dibayar']); 
		$tahun_dibayar = $connection->conn->real_escape_string($_POST['tahun_dibayar']); 
		$id_spp = $connection->conn->real_escape_string($_POST['id_spp']); 
		$jumlah_bayar = $connection->conn->real_escape_string($_POST['jumlah_bayar']);
		
		$add = $bayar->tambah($id_petugas, $nisn,$tgl_bayar,$bulan_dibayar,$tahun_dibayar,$id_spp,$jumlah_bayar);
		if($add)
		{
			?>
			<script>
				alert('Data di tambahkan');
				document.location='home.php?page=transaksi'
			</script>
			<?php
		}else{
			?>
			<script>
				alert('Data Gagal di tambah tambahkan');
				document.location = 'home.php?page=transaksi'
			</script>
			<?php
		}
	}
?>