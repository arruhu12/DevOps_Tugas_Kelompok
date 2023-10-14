<?php 
	include_once "library.php";
	$spp = new Spp($connection);
	
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
				<th>Tahun</th>
				<th>Nominal</th>
				<th>Action</th>
			</tr>
		</thead>
		<?php
			$no = 1;
			$tampil = $spp->tampil();
			while($data = $tampil->fetch_object()){

		?>
			<tr style="text-align: center">
				<td><?= $no++; ?></td>
				<td><?= $data->tahun ?></td>
				<td><?= number_format($data->nominal) ?></td>
				<td>
					<a id='editSpp' data-toggle="modal" data-target="#edit" 
						data-id_spp="<?= $data->id_spp ?>"
						data-tahun="<?= $data->tahun ?>"
						data-nominal="<?= $data->nominal ?>">
						<button class='btn btn-primary'>
						<i class="fa fa-edit"></i>
						</button>  
					</a> 
						
					<a href='?page=spp&act=del&id=<?= $data->id_spp ?>' onclick="return confirm('Yakin ingin menghapus data? ');" >
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
				<h4 class="modal-title" id="myModalLabel">Tambah Data SPP</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

			<div class="modal-body">
				<form action="" name="modal_popup" enctype="multipart/form-data" method="POST">
					<?php include 'tambah.php'; ?>

					<div class="form-group" >
						<label for="Modal Name">Tahun</label>
						<input type="number" name="tahun" class="form-control" placeholder="Tahun" required/>
					</div>

					<div class="form-group" >
						<label for="Modal Name">Nominal</label>
						<input type="number" name="nominal" class="form-control" placeholder="nominal" required/>
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
				<h4 class="modal-title" id="myModalLabel">Edit Data SPP</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>

			<div class="modal-body" id="modal-edit">
				<form id="form" name="modal_popup" enctype="multipart/form-data">
					<div class="form-group" >
						<input type="hidden" name="id_spp" id="id_spp" class="form-control" readonly=""/>
					</div>

					<div class="form-group">
						<label for="Modal Name">Tahun</label>
						<input type="number" name="tahun" id="tahun" class="form-control" placeholder="Tahun" required />
					</div>

					<div class="form-group">
						<label for="Modal Name">Nominal</label>
						<input type="number" name="nominal" id="nominal" class="form-control" placeholder="nominal" required />
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
	$(document).on("click", "#editSpp", function(e){
		var id_spp = $(this).data('id_spp');
		var tahun = $(this).data('tahun');
		var nominal = $(this).data('nominal');

		$("#modal-edit #id_spp").val(id_spp);
		$("#modal-edit #tahun").val(tahun);
		$("#modal-edit #nominal").val(nominal);
	})

$(document).ready(function(e){
	$("#form").on("submit", (function(e){
		e.preventDefault();
		$.ajax({
			url : 'Admin/spp/edit.php',
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
		$spp->hapus($_GET['id']);
		header('location:home.php?page=spp');
	}
?>