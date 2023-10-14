<?php 
	include_once "library.php";
	$bayar = new Pembayaran($connection);
	
	if (@$_GET['act'] == '')
	{ 
?>

<div class="isi">
	<a href="Admin/laporan/laporan/cetak.php" target="_blank">
		<button type="button" class="btn btn-success tbh">
			<i class="fa fa-print"></i> Print data
		</button>
	</a>

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
			$no = 1;
			$tampil = $bayar->tampil();
			while($data = $tampil->fetch_object()){

		?>
			<tr style="text-align: center">
				<td><?= $no++; ?></td>
				<td><?= ucfirst($data->nama_petugas) ?></td>
				<td><?= $data->nisn ?></td>
				<td><?= date("d", strtotime($data->tgl_bayar))."/$data->bulan_dibayar/$data->tahun_dibayar" ?></td>
				<td><?= "Rp ".number_format($data->nominal) ?></td>
				<td><b style="color:green;">Berhasil</b></td>
			</tr>
		<?php } ?>
	</table>



<!-- Modal Popup untuk Add-->
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Tambah Data Pembayaran</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

			<div class="modal-body">
				<form action="" name="modal_popup" enctype="multipart/form-data" method="POST">
					<?php include 'tambah.php'; ?>

					<div class="form-group" >
						<input type="hidden" name="id_petugas" class="form-control" value="<?= @$_SESSION['id_petugas'] ?>" />
						<h4>PETUGAS = <?= @strtoupper($_SESSION['nama_petugas']) ?></h4>
					</div>

					<div class="form-group">
						<label for="Modal Name">NISN</label>
						<select name="nisn" id="nisn" onchange="GetSPPData()" class="form-control" required="">
							<option value="" selected="selected">-Pilih NISN-</option>
							<?php
								$nisnTampil = $bayar->tampilNISN();
								while($data = $nisnTampil->fetch_object()){?>
								<option value="<?= $data->nisn ?>">
									<?= "$data->nisn - $data->nama" ?>
								</option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label for="Modal Name">Tanggal</label>
						<input type="date" class="form-control" name="tgl_bayar" id="tgl" required />
					</div>

					<div class="form-group">
						<label for="Modal Name">Bulan</label>
						<input readonly type="text" class="form-control" name="bulan_dibayar" id="bln" value="" />
					</div>
					
					<div class="form-group">
						<label for="Modal Name">Tahun</label>
						<input readonly type="text" class="form-control" name="tahun_dibayar" id="thn" value="" />
					</div>

					<div class="form-group">
						<label for="Modal Name">SPP</label>
						<input readonly type="hidden" class="form-control" name="id_spp" id="id_spp" value="" />
						<input readonly type="text" class="form-control" id="spp" value="" />
					</div>
					
					<div class="form-group">
						<label for="Modal Name">Jumlah Dibayar</label>
						<input type="text" class="form-control" name="jumlah_bayar" id="jlh_dibayar" />
					</div>

					<div class="form-group">
						<label for="Modal Name">Sisa Dibayar</label>
						<input readonly type="text" class="form-control" name="sisa_dibayar" id="sisa_dibayar" />
					</div>

					<div class="modal-footer">
						<button class="btn btn-success" type="submit" name="tambah">
							Confirm
						</button>

					<button type="reset" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">
							Cancel
					</button>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

function GetSPPData()
{
	var nisn = $("#nisn").val();
	$.ajax({
		method: "GET",
		url : 'Admin/transaksi/ajax.php',
		data : {nisn:nisn},
		success : function(msg){
			var json = msg,
			obj = JSON.parse(json);
			$('#spp').val(obj.spp);
			$('#id_spp').val(obj.id_spp);
		}
	});
	
}

$('#tgl').change(function() {
	var date = $(this).val();
	var arr = date.split('-');
	$('#bln').val(arr[1]);
	$('#thn').val(arr[0]);
});

$('#jlh_dibayar').keyup(function() {
	var jlh_dibayar = $(this).val();
	var spp = $('#spp').val();
	var sum = jlh_dibayar-spp;
	$('#sisa_dibayar').val(sum);
});


</script>


<?php } ?>