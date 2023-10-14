<?php 
      include 'koneksi.php';
      session_start();
      if(isset($_POST['login'])){
        $username  = $_POST['username'];
        $password = md5($_POST['password']);

        $query = "SELECT * FROM petugas where username = '$username' && password ='$password' ";
        $result = $koneksi->query($query);
        $row = $result->num_rows;

        $sql = $koneksi->query("SELECT * FROM petugas where username = '$username'");

    
        $akun = $sql->fetch_array();

        if($row > 0){
            if($akun['level'] == "admin") {
                $_SESSION['username_admin'] = $akun['username'];
                $_SESSION['nama_petugas'] = $akun['nama_petugas'];
                $_SESSION['id_petugas'] = $akun['id_petugas'];
                header("location: ../home.php");

            }else if($akun['level'] == "petugas") {
                $_SESSION['username_petugas'] = $akun['username'];
                $_SESSION['nama_petugas'] = $akun['nama_petugas'];
                $_SESSION['id_petugas'] = $akun['id_petugas'];
                header("location: ../home.php");

            }else if($akun['level'] == "siswa") {
              
                $_SESSION['username_siswa'] = $akun['username'];
                $_SESSION['nama_petugas'] = $akun['nama_petugas'];
                $_SESSION['id_petugas'] = $akun['id_petugas'];
                $_SESSION['nisn_siswa'] = $akun['nisn'];
                header("location: ../home.php");
            }

        }else{
            ?>
              <script>
                alert('Login Gagal,Periksa Username dan Password Anda');
              </script>
            <?php
          }
      } 
    ?>
  
  <!DOCTYPE html>
  <html>
  <head>
  	<title>FORM LOGIN</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../Vendor/font-awesome-4.7.0/css/font-awesome.min.css">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../Vendor/materializecss/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="../Vendor/css/login.css">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>
  <body>

    <div class="container">
      <div class="panel">
      	<img src="../vendor/img/tut.png" 
      	style="width:120px; 
      			height:120px;
      			margin-left: 20px;
      			margin-top: 5px;
      			">
        <div class="text">
        	<h5 style="margin-top:-85px; 
        	margin-left: 170px;
        	font-size: 35px;
        	color: white;
        	letter-spacing: 5px">
        SPP</h5>
        <p style="margin-left: 170px; 
        margin-top: -6px; 
        font-size: 17px;
        color: white">
          (Aplikasi Pembayaran SPP)
        </p>
        </div>
      </div>

      <div class="form">
        <form action="" method="POST">
          <div class="input-field input-icon">
            <i class="material-icons prefix">account_circle</i>
            <input id="username" name="username" type="text" class="validate" required=""  autocomplete="off">
            <label for="username">Username</label>
          </div>

          <div class="input-field">
            <i class="material-icons prefix">mode_edit</i>
            <input id="password" name="password" type="password" required="" class="validate">
            <label for="password">Password</label>
          </div>
          

          <div class="main">
           <button class="btn waves-effect waves-teal" type="submit" name="login">Login
            <i class="material-icons right">send</i>
          </button>
        </div>
      </form>
    

    </div>
  </div>
  
  <!--JavaScript at end of body for optimized loading-->
  <script type="text/javascript" src="../Vendor/materializecss/js/materialize.min.js">
    
  </script>
</body>
</html>