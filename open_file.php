<?php 

@$page = $_GET['page'];


  switch ($page) 
  {
    case 'home':
      include 'dashboard.php';
      break;
    
    case 'kelas':
      include 'Admin/kelas/home.php';
      break;

    case 'siswa':
      include 'Admin/siswa/home.php';
      break;

    case 'spp':
      include 'Admin/spp/home.php';
      break;

    case 'petugas':
      include 'Admin/petugas/home.php';
      break;

    case 'transaksi':
      include 'Admin/transaksi/home.php';
      break;

    case 'history':
      include 'Admin/history/home.php';
      break;
      
    case 'laporan':
      include 'Admin/laporan/home.php';
      break;
    
    default:
      include 'dashboard.php';
      break;
  } 
?>