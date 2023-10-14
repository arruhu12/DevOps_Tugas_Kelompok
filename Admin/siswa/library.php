<?php
 class Siswa {
    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    
    public function tampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT id_siswa, 
        kelas.id_kelas,
        spp.id_spp, 
        kelas.nama_kelas,
        spp.tahun,
        nisn,
        nama, 
        nis,
        alamat,
        no_telp FROM siswa
        join kelas ON siswa.id_kelas = kelas.id_kelas
        join spp ON siswa.id_spp = spp.id_spp";

        if($id != null)
        {
            $sql .= " WHERE id_siswa = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
     }

     public function tampilKelas($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM kelas";

        if($id != null)
        {
            $sql .= " WHERE id_kelas = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
     }

    public function sppTampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM spp";

        if($id != null)
        {
            $sql .= " WHERE id_spp = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
     }


     public function tambah($nisn, $nis,$nama,$id_kelas,$alamat,$no_telp,$id_spp)
     {
        $sql = "INSERT INTO siswa (nisn, nis,nama,id_kelas,alamat,no_telp,id_spp)
                Values('$nisn', '$nis','$nama','$id_kelas','$alamat','$no_telp','$id_spp')";
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

     public function hapus($id_siswa){
        $db  = $this->mysqli->conn;
        $db->query("DELETE from siswa where id_siswa ='$id_siswa'") or die($db->error);
     }

     function __destruct(){
        $db = $this->mysqli->conn;
        $db->close();
     }
 }

?>