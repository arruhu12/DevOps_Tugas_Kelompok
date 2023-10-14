<?php 
	include_once "library.php";
	$kelas = new Kelas($connection);
	
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
				<th>Nama Kelas</th>
				<th>Kompetensi Keahlian</th>
				<th>Action</th>
			</tr>
		</thead>
		<?php
			$no = 1;
			$tampil = $kelas->tampil();
			while($data = $tampil->fetch_object()){
		?>
			<tr style="text-align: center">
				<td><?= $no++; ?></td>
				<td><?= $data->nama_kelas ?></td>
				<td><?= $data->kompetensi_keahlian ?></td>
				<td>
					<a id='editKelas' data-toggle="modal" data-target="#edit" 
						data-id_kelas="<?= $data->id_kelas ?>"
						data-nama_kelas="<?= $data->nama_kelas ?>" 
						data-kompetensi_keahlian="<?= $data->kompetensi_keahlian ?>">
						<button class='btn btn-primary'>
						<i class="fa fa-edit"></i>
						</button>  
					</a> 
						
					<a href='?page=kelas&act=del&id=<?= $data->id_kelas ?>' onclick="return confirm('Yakin ingin menghapus data? ');" >
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
				<h4 class="modal-title" id="myModalLabel">Tambah Data Kelas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

			<div class="modal-body">
				<form action="" name="modal_popup" enctype="multipart/form-data" method="POST">
					<?php include 'tambah.php'; ?>
					<div class="form-group" >
						<label for="Modal Name">Nama Kelas</label>
						<input type="text" name="nama_kelas" class="form-control" placeholder="Nama Kelas" required/>
					</div>

					<div class="form-group" >
						<label for="Modal Name">Kompetensi Keahlian</label>
						<input type="text" name="kompetensi_keahlian" class="form-control" placeholder="Kompetensi Keahlian" required/>
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
				<h4 class="modal-title" id="myModalLabel">Edit Data kelas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

			<div class="modal-body" id="modal-edit">
				<form id="form" name="modal_popup" enctype="multipart/form-data">
					<div class="form-group" >
						<input type="hidden" name="id_kelas" id="id_kelas" class="form-control" readonly=""/>
					</div>

					<div class="form-group" >
						<label for="Modal Name">Nama kelas</label>
						<input type="text" name="nama_kelas" id="nama_kelas" class="form-control" placeholder="Nama kelas" required/>
					</div>

					<div class="form-group" >
						<label for="Modal Name">Kompetensi Keahlian</label>
						<input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control" placeholder="Kompetensi Keahlian" required />
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
	$(document).on("click", "#editKelas", function(e){
		var id_kelas= $(this).data('id_kelas');
		var nama_kelas = $(this).data('nama_kelas');
		var kompetensi_keahlian= $(this).data('kompetensi_keahlian');
		$("#modal-edit #id_kelas").val(id_kelas);
		$("#modal-edit #nama_kelas").val(nama_kelas);
		$("#modal-edit #kompetensi_keahlian").val(kompetensi_keahlian);
	})

$(document).ready(function(e){
	$("#form").on("submit", (function(e){
		e.preventDefault();
		$.ajax({
			url : 'Admin/kelas/edit.php',
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
		$kelas->hapus($_GET['id']);
		header('location:home.php?page=kelas');
	}

?>