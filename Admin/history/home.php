<?php 
	include_once "library.php";
	$bayar = new Pembayaran($connection);
	
	if (@$_GET['act'] == '')
	{ 
?>

<div class="isi">
	<table id="data" class="table table-striped table-hover" >
		<thead style="text-align: center">
			<tr>
				<th>No</th>
				<th>Petugas</th>
				<th>NISN</th>
				<th>Tgl/Bln/Thn Bayar</th>
				<th>Jumlah SPP</th>
				<th>Status</th>
			</tr>
		</thead>
		<?php
    		$nisnSiswa = @$_SESSION['nisn_siswa'];
			$no = 1;
			$tampil = $bayar->tampil($nisnSiswa);
			while($data = $tampil->fetch_object()){

		?>
			<tr style="text-align: center">
				<td><?= $no++; ?></td>
				<td><?= ucfirst($data->nama_petugas) ?></td>
				<td><?= $data->nisn ?></td>
				<td><?= date("d", strtotime($data->tgl_bayar))."/$data->bulan_dibayar/$data->tahun_dibayar" ?></td>
				<td><?= "Rp ".number_format($data->nominal) ?></td>
				<td><b style="color:green;">LUNAS</b></td>
			</tr>
		<?php } ?>
	</table>
<?php } ?>