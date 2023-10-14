<?php 
	include 'fpdf.php';

	include_once "../../../config/koneksi.php";
	include_once "../../../config/database.php";
	include_once "../library.php";
	$connection = new Database($host, $user, $pass, $database);
	$bayar = new Pembayaran($connection);

	$pdf = new FPDF();
	$pdf->AddPage('P','A4','');
	$pdf->setFont('Arial','B',16);
	$pdf->cell(0,5,'Laporan SPP','0','1','C',false);
	$pdf->setFont('Arial','i',8);
	$pdf->cell(0,5,'SMKN-9 MEDAN','0','1','C',false);
	$pdf->Ln(7);

	$pdf->Line(10,10,10,10);
	$pdf->setFont('Arial','B',15);
	$pdf->cell(50,5,'Laporan Pembayaran','0','1','L',false);
	$pdf->Ln(3);

	$pdf->setFont('Arial','B',12);
	$pdf->cell(15,7,'No.',1,0,'C');
	$pdf->cell(30,7,'Petugas',1,0,'C');
	$pdf->cell(30,7,'NISN',1,0,'C');
	$pdf->cell(50,7,'Tgl/Bln/Thn Bayar',1,0,'C');
	$pdf->cell(30,7,'Jumlah SPP',1,0,'C');
	$pdf->cell(30,7,'Status',1,0,'C');

	$no = 0;
	$tampil = $bayar->tampil();
	while($data = $tampil->fetch_object()){
		$no++;
		$pdf->Ln(7);
		$pdf->setFont('Arial','',10);
		$pdf->cell(15,7,$no.".",1,0,'C');
		$pdf->cell(30,7,ucfirst($data->nama_petugas),1,0,'L');
		$pdf->cell(30,7,$data->nisn,1,0,'C');
		$pdf->cell(50,7,date("d", strtotime($data->tgl_bayar))."/$data->bulan_dibayar/$data->tahun_dibayar",1,0,'C');
		$pdf->cell(30,7,"Rp ".number_format($data->nominal),1,0,'L');
		$pdf->cell(30,7,"Lunas",1,0,'L');
	}
$pdf->Output();
?>