<?php if(@$_SESSION['username_admin']){ ?>

    <a href="?page=home" class="list-group-item list-group-item-action menu">
        <i class="fa fa-tachometer"></i> Dashboard
      </a>

      <a href="?page=siswa" class="list-group-item list-group-item-action menu">
        <i class="fa fa-graduation-cap"></i> Data Siswa
      </a>

      <a href="?page=kelas" class="list-group-item list-group-item-action menu">
        <i class="fa fa-bars"></i> Data Kelas
      </a>

      <a href="?page=spp" class="list-group-item list-group-item-action menu">
        <i class="fa fa-book"></i> Data SPP
      </a>

      <a href="?page=petugas" class="list-group-item list-group-item-action menu">
        <i class="fa fa-users"></i> Data User
      </a>

      <a href="?page=transaksi" class="list-group-item list-group-item-action menu">
        <i class="fa fa-money"></i> Transaksi Pembayaran
      </a>

      <a href="?page=history" class="list-group-item list-group-item-action menu">
        <i class="fa fa-history"></i> History Pembayaran
      </a>

      <a href="?page=laporan" class="list-group-item list-group-item-action menu">
        <i class="fa fa-bar-chart"></i> Generate Laporan
      </a>

<?php }else if(@$_SESSION['username_petugas']){ ?>

    <a href="?page=transaksi" class="list-group-item list-group-item-action menu">
      <i class="fa fa-money"></i> Transaksi Pembayaran
    </a>

    <a href="?page=history" class="list-group-item list-group-item-action menu">
      <i class="fa fa-history"></i> History Pembayaran
    </a>

<?php }else if(@$_SESSION['username_siswa']){ ?>

     <a href="?page=history" class="list-group-item list-group-item-action menu">
       <i class="fa fa-history"></i> History Pembayaran
     </a>

<?php } ?>