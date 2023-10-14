<?php
 class Pembayaran {
    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    
    public function tampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT 
        petugas.id_petugas, 
        petugas.nama_petugas,
        pembayaran.nisn,
        tgl_bayar,bulan_dibayar, 
        tahun_dibayar, 
        spp.id_spp,
        spp.nominal
        FROM pembayaran
        join petugas ON pembayaran.id_petugas = petugas.id_petugas
        join spp ON pembayaran.id_spp = spp.id_spp";

        if($id != null)
        {
            $sql .= " WHERE id_pembayaran = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
     }

     public function tampilNISN()
     {
         $db = $this->mysqli->conn;
         $sql = "SELECT * FROM siswa";
         $query = $db->query($sql) or die ($db->error);
         return $query;
     }

     public function GetSPP($nisn)
     {
         $db = $this->mysqli->conn;
         $sql = "SELECT id_siswa,nisn,spp.id_spp,spp.nominal 
         FROM siswa
         join spp ON siswa.id_spp = spp.id_spp
         where nisn = $nisn";
         
         $query = $db->query($sql) or die ($db->error);
         return $query;
     }


     public function tambah($id_petugas, $nisn,$tgl_bayar,$bulan_dibayar,$tahun_dibayar,$spp,$jumlah_bayar)
     {
        $sql = "INSERT INTO pembayaran (id_petugas, nisn,tgl_bayar,bulan_dibayar,tahun_dibayar,id_spp,jumlah_bayar)
                Values('$id_petugas', '$nisn','$tgl_bayar','$bulan_dibayar','$tahun_dibayar','$spp','$jumlah_bayar')";
        $query= $this->mysqli->conn->query($sql);
        
        if(!$query)
        {
            return 'failed';
        }else{
            return 'success';
        }
     }

     
     public function edit($sql){
        $db = $this->mysqli->conn;
        $db->query($sql) or die ($db->error);
     }

     public function hapus($id_pembayaran){
        $db  = $this->mysqli->conn;
        $db->query("DELETE from pembayaran where id_pembayaran ='$id_pembayaran'") or die($db->error);
     }

     function __destruct(){
        $db = $this->mysqli->conn;
        $db->close();
     }
 }

?>