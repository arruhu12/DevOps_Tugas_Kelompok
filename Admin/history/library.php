<?php
 class Pembayaran {
    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    public function tampil($nisnSiswa = null)
    {
        $db = $this->mysqli->conn;
        $sql = "SELECT 
        petugas.id_petugas, 
        petugas.nama_petugas, 
        pembayaran.nisn, tgl_bayar,bulan_dibayar,tahun_dibayar,
        spp.id_spp,
        spp.nominal
        FROM pembayaran
        join petugas ON pembayaran.id_petugas = petugas.id_petugas
        join spp ON pembayaran.id_spp = spp.id_spp";

        if($nisnSiswa != null)
        {
            $sql .= " WHERE pembayaran.nisn = $nisnSiswa";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
     }

     function __destruct(){
        $db = $this->mysqli->conn;
        $db->close();
     }
 }

?>