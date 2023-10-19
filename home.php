<?php
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if(isset($_SESSION['username_admin']) || (@$_SESSION['username_petugas']) || ($_SESSION['username_siswa'])){

  }else{
    echo "<script>  
    alert('Akses di tolak Silahkan login Terlebih dahulu')
    document.location.href='index.php'
    </script>";
  }

  ob_start();
  include_once("config/koneksi.php");
  include_once("config/database.php");
  $connection = new Database($host, $user, $pass, $database);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
<!--   <meta http-equiv="refresh" content="60"/> -->   <!-- untuk membuat refresh otomatis -->
  <meta name="author" content="">

  <title>Admin Page</title>
  <!-- Bootstrap core JavaScript -->
  <script src="Vendor/bootstrap/jquery/jquery-3.3.1.min.js"></script>
  <script src="Vendor/bootstrap/jquery/jquery-3.3.1.slim.min.js"></script>
  <script src="Vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/JavaScript" src="Vendor/DataTables/datatables.min.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="Vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="Vendor/font-awesome/css/font-awesome.min.css">

  <!-- Custom styles for this template -->
  <link href="Vendor/css/MyCss.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="Vendor/DataTables/datatables.min.css">

  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
</head>
<body>

  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">
        <?php 
        if(@$_SESSION['username_admin']) {
          Echo "
          <center>
          <img src='Vendor/img/find_user2.png' style='width:180px; height:180px;'>
          </center>";
          
        }else if(@$_SESSION['username_petugas'] ){
          Echo " <center>
          <img src='Vendor/img/petugas.png' style='width: 150px; height: 150px;'>
          </center>";

        }else if(@$_SESSION['username_siswa'] ){
          Echo " <center>
          <img src='Vendor/img/student.png' style='width: 150px; height: 150px;'>
          </center>";
        }

        ?>        
      </div>
      <div class="list-group list-group-flush">
        <?php include 'menu.php'; ?>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light atas border-bottom" style="background-color: #3d3d3d;">
        <button class="btn btn-primary toggle" id="menu-toggle" style="background-color: #02050e;">
          <i class="fa fa-angle-double-left fa-2x"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="navbarDropdown" role="button" 
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-cog fa-2x" aria-hidden="true" style="color: white!important;"></i> 
            </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="login/logout.php"> 
                  <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>

        <div class="container-fluid">
          <div class="card" id="wrapper">
            <div class="card-header"><b>APLIKASI PEMBAYARAN SPP</b></div>
            <div class="card-body">
              <?php 
              include 'open_file.php';
              ?>
            </div> 
            <div class="card-footer">Created For UKK @ SMK Negeri 9 Medan</div>
          </div>

        </div>
      </div>
    </div>

<!-- Memanggil DataTables -->
<script>
$(document).ready(function() {
  $('#data').DataTable( {
      "scrollY":        "200px",
      "scrollCollapse": true,
      "paging":         false
  });
});
</script> 

<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>

<script>
  $(".toggle").click(function(){
    $(this).find("i").toggleClass("fa-angle-double-right");
  });
</script>


</body>
</html>
