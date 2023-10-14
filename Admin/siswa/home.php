<?php 
	include_once "library.php";
	$siswa = new Siswa($connection);
	
	if (@$_GET['act'] == '')
	{ 
?>

<div class="isi">
	<button type="button" class="btn btn-success tbh" data-target="#ModalAdd" data-toggle="modal">
		<i class="fa fa-plus"></i> Add Data
	</button>

	<table id="data" class="table table-striped table-hover" >
		<thead style="text-align: center">
			<tr>
				<th>No</th>
				<th>NISN</th>
				<th>NIS</th>
				<th>Nama Siswa</th>
				<th>Kelas</th>
				<th>Alamat</th>
				<th>No. Tlp</th>
				<th>Tahun(SPP)</th>
				<th>Action</th>
			</tr>
		</thead>
		<?php
			$no = 1;
			$tampil = $siswa->tampil();
			while($data = $tampil->fetch_object()){

		?>
			<tr style="text-align: center">
				<td><?= $no++; ?></td>
				<td><?= $data->nisn ?></td>
				<td><?= $data->nis ?></td>
				<td><?= $data->nama ?></td>
				<td><?= $data->nama_kelas ?></td>
				<td><?= $data->alamat ?></td>
				<td><?= $data->no_telp ?></td>
				<td><?= $data->tahun ?></td>
				<td>
					<a id='editSiswa' data-toggle="modal" data-target="#edit" 
						data-id_siswa="<?= $data->id_siswa ?>"
						data-nisn="<?= $data->nisn ?>"
						data-nis="<?= $data->nis ?>"
						data-nama="<?= $data->nama ?>"
						data-id_kelas="<?= $data->id_kelas ?>"
						data-alamat="<?= $data->alamat ?>"
						data-no_telp="<?= $data->no_telp ?>"
						data-id_spp="<?= $data->id_spp ?>">
						<button class='btn btn-primary'>
						<i class="fa fa-edit"></i>
						</button>  
					</a> 
						
					<a href='?page=siswa&act=del&id=<?= $data->id_siswa ?>' onclick="return confirm('Yakin ingin menghapus data? ');" >
						<button class='btn btn-danger'>
						<i class="fa fa-trash"></i></button>
					</a>
				</td>
			</tr>
		<?php } ?>
	</table>



<!-- Modal Popup untuk Add-->
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Tambah Data Siswa</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

			<div class="modal-body">
				<form action="" name="modal_popup" enctype="multipart/form-data" method="POST">
					<?php include 'tambah.php'; ?>

					<div class="form-group" >
						<label for="Modal Name">NISN</label>
						<input type="number" name="nisn" class="form-control" placeholder="NISN" required/>
					</div>

					<div class="form-group" >
						<label for="Modal Name">NIS</label>
						<input type="number" name="nis" class="form-control" placeholder="NIS" required/>
					</div>

					<div class="form-group" >
						<label for="Modal Name">Nama Siswa</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama Siswa" required/>
					</div>

					<div class="form-group" >
						<label for="Modal Name">Alamat</label>
						<input type="text" name="alamat" class="form-control" placeholder="Alamat" required/>
					</div>

					<div class="form-group">
					<label for="Modal Name">Kelas</label>
						<select name="id_kelas" class="form-control" required="">
							<option value="" selected="selected">-Pilih Kelas-</option>
							<?php

								$Kelastampil = $siswa->tampilKelas();
								while($data = $Kelastampil->fetch_object()){?>
									<option value="<?= $data->id_kelas ?>">
										<?= $data->nama_kelas ?>
									</option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group" >
						<label for="Modal Name">No.Tlp</label>
						<input type="number" name="no_telp" class="form-control" placeholder="No.Tlp" required />
					</div>

					<div class="form-group">
						<label for="Modal Name">Tahun</label>
						<select name="id_spp" class="form-control" required="">
							<option value="" selected="selected">-Pilih Tahun SPP-</option>
							<?php
								$spptampil = $siswa->sppTampil();
								while($data = $spptampil->fetch_object()){?>
							<option value="<?= $data->id_spp ?>">
								<?= $data->tahun ?>
							</option>
							<?php } ?>
						</select>
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


<!-- Modal Popup untuk Edit--> 
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Edit Data Siswa</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

			<div class="modal-body" id="modal-edit">
				<form id="form" name="modal_popup" enctype="multipart/form-data">
					<div class="form-group" >
						<input type="hidden" name="id_siswa" id="id_siswa" class="form-control" readonly=""/>
					</div>

					<div class="form-group">
						<label for="Modal Name">NISN</label>
						<input type="number" name="nisn" id="nisn" class="form-control" placeholder="NISN" required />
					</div>

					<div class="form-group">
						<label for="Modal Name">NIS</label>
						<input type="number" name="nis" id="nis" class="form-control" placeholder="NIS" required />
					</div>

					<div class="form-group">
						<label for="Modal Name">Nama Siswa</label>
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Siswa" required />
					</div>

					<div class="form-group">
						<label for="Modal Name">Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat" required />
					</div>

					<div class="form-group">
						<label for="Modal Name">Kelas</label>
						<select name="id_kelas" id="id_kelas" class="form-control" required="">
							<option value="" selected="selected">-Pilih Kelas-</option>
							<?php
								$Kelastampil = $siswa->tampilKelas();
								while($data = $Kelastampil->fetch_object()){?>
							<option value="<?= $data->id_kelas ?>">
								<?= $data->nama_kelas ?>
							</option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label for="Modal Name">No.Tlp</label>
						<input type="number" name="no_telp" id="no_telp" class="form-control" placeholder="No.Tlp" required />
					</div>

					<div class="form-group">
						<label for="Modal Name">Tahun</label>
						<select name="id_spp" id="id_spp" class="form-control" required="">
							<option value="" selected="selected">-Pilih Tahun SPP-</option>
							<?php
								$spptampil = $siswa->sppTampil();
								while($data = $spptampil->fetch_object()){?>
							<option value="<?= $data->id_spp ?>">
								<?= $data->tahun ?>
							</option>
							<?php } ?>
						</select>
					</div>

					<div class="modal-footer">
						<button class="btn btn-success" type="submit" name="edit" value="simpan">
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
	$(document).on("click", "#editSiswa", function(e){
		var id_siswa = $(this).data('id_siswa');
		var nisn = $(this).data('nisn');
		var nis = $(this).data('nis');
		var nama = $(this).data('nama');
		var id_kelas = $(this).data('id_kelas');
		var alamat = $(this).data('alamat');
		var no_telp = $(this).data('no_telp');
		var id_spp = $(this).data('id_spp');

		$("#modal-edit #id_siswa").val(id_siswa);
		$("#modal-edit #nisn").val(nisn);
		$("#modal-edit #nis").val(nis);
		$("#modal-edit #nama").val(nama);
		$("#modal-edit #id_kelas").val(id_kelas);
		$("#modal-edit #alamat").val(alamat);
		$("#modal-edit #no_telp").val(no_telp);
		$("#modal-edit #id_spp").val(id_spp);
	})

$(document).ready(function(e){
	$("#form").on("submit", (function(e){
		e.preventDefault();
		$.ajax({
			url : 'Admin/siswa/edit.php',
			type : 'POST',
			data : new FormData(this),
			contentType : false,
			cache : false,
			processData : false,
			success : function(msg){
				$('.table').html(msg);
			}
		});
	}));
})
</script>


<!-- Javascript untuk popup modal Delete--> 
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modal_delete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>



<?php
	}else if (@$_GET['act'] == 'del') {
		$siswa->hapus($_GET['id']);
		header('location:home.php?page=siswa');
	}
?>