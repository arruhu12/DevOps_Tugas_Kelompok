<div style="margin-top: 10px; margin-bottom: 20px;">
	<h3>
		Aplikasi Pembayaran SPP
		<br>
	</h3>
</div>

<div id="page-inner">
	<div class="row">
		<div class="col-md-12">
			<h4>Selamat Datang <b>  
				<?php 
					if(@$_SESSION['username_admin']) {
						echo "Admin";
					}else if(@$_SESSION['username_petugas']){
						echo "Petugas";
					}else if(@$_SESSION['username_siswa']){
						echo "Siswa";
					}
				?>
			</h4>
		</div>
	</div>
</div>