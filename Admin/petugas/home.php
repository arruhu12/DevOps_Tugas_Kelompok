<?php 
	include_once "library.php";
	$petugas = new Petugas($connection);
	
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
				<th>Username</th>
				<th>Nama</th>
				<th>Level</th>
				<th>Action</th>
			</tr>
		</thead>
		<?php
			$no = 1;
			$tampil = $petugas->tampil();
			while($data = $tampil->fetch_object()){

		?>
			<tr style="text-align: center">
				<td><?= $no++; ?></td>
				<td><?= ucfirst($data->username) ?></td>
				<td><?= ucfirst($data->nama_petugas) ?></td>
				<td><?= ucfirst($data->level) ?></td>
				<td>
					<a id='editPetugas' data-toggle="modal" data-target="#edit" 
						data-id_petugas="<?= $data->id_petugas ?>"
						data-username="<?= $data->username ?>"
						data-password="<?= $data->password ?>"
						data-nama_petugas="<?= $data->nama_petugas ?>"
						data-level="<?= $data->level ?>">
						<button class='btn btn-primary'>
						<i class="fa fa-edit"></i>
						</button>  
					</a> 
						
					<a href='?page=petugas&act=del&id=<?= $data->id_petugas ?>' onclick="return confirm('Yakin ingin menghapus data? ');" >
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
				<h4 class="modal-title" id="myModalLabel">Tambah Data Petugas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

			<div class="modal-body">
				<form action="" name="modal_popup" enctype="multipart/form-data" method="POST">
					<?php include 'tambah.php'; ?>

					<div class="form-group" >
						<label for="Modal Name">Nama</label>
						<input type="text" name="nama_petugas" class="form-control" placeholder="Nama" required/>
					</div>

					<div class="form-group" >
						<label for="Modal Name">Username</label>
						<input type="text" name="username" class="form-control" placeholder="Username" required/>
					</div>

					<div class="form-group" >
						<label for="Modal Name">Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password" required/>
					</div>

					<div class="form-group" >
						<label for="Modal Name">Level</label>
						<select name="level" id="level" class="form-control" required="">
							<option value="">-Pilih Level-</option>
							<option value="admin">Admin</option>
							<option value="petugas">Petugas</option>
							<option value="siswa">Siswa</option>
						</select>
					</div>

					<div class="form-group hide nisnform">
						<label for="Modal Name">NISN</label>
						<input type="nisn" name="nisn" id="nisn" class="form-control" placeholder="NISN" value="" />
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
				<h4 class="modal-title" id="myModalLabel">Edit Data Petugas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

			<div class="modal-body" id="modal-edit">
				<form id="form" name="modal_popup" enctype="multipart/form-data">
					<div class="form-group" >
						<input type="hidden" name="id_petugas" id="id_petugas" class="form-control" readonly=""/>
					</div>

					<div class="form-group">
						<label for="Modal Name">Nama</label>
						<input type="text" name="nama_petugas" id="nama_petugas" class="form-control" placeholder="Nama"
							required />
					</div>

					<div class="form-group">
						<label for="Modal Name">Username</label>
						<input type="text" name="username" id="username" class="form-control" placeholder="Username" required />
					</div>

					<div class="form-group">
						<label for="Modal Name">Password</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
					</div>

					<div class="form-group">
						<label for="Modal Name">Level</label>
						<select name="level" id="level" class="form-control" required="">
							<option value="admin">Admin</option>
							<option value="petugas">Petugas</option>
							<option value="siswa">Siswa</option>
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

$('select').on('change', function (e) {
	var optionSelected = $("option:selected", this);
	var valueSelected = this.value;
	
	if(valueSelected == 'siswa')
	{
		$('.nisnform').removeClass('hide')
	}else{
		$('.nisnform').addClass('hide')
	}
});

$(document).on("click", "#editPetugas", function(e){
	var id_petugas = $(this).data('id_petugas');
	var nama_petugas = $(this).data('nama_petugas');
	var username = $(this).data('username');
	var password = $(this).data('password');
	var level = $(this).data('level');
	

	$("#modal-edit #id_petugas").val(id_petugas);
	$("#modal-edit #nama_petugas").val(nama_petugas);
	$("#modal-edit #username").val(username);
	$("#modal-edit #password").val(password);
	$("#modal-edit #level").val(level);
})

$(document).ready(function(e){
	$("#form").on("submit", (function(e){
		e.preventDefault();
		$.ajax({
			url : 'Admin/petugas/edit.php',
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

<style>
.hide
{
	display:none;
}
</style>



<?php
	}else if (@$_GET['act'] == 'del') {
		$petugas->hapus($_GET['id']);
		header('location:home.php?page=petugas');
	}
?>