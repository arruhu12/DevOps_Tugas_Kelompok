<?php
 class Kelas {
    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }
    
    public function tampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM kelas";

        if($id != null)
        {
            $sql .= " WHERE id_kelas = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
     }


     public function tambah($nama_kelas, $kompetensi_keahlian)
     {
        $sql = "INSERT INTO kelas (nama_kelas, kompetensi_keahlian)
                Values('$nama_kelas', '$kompetensi_keahlian')"; 
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

     public function hapus($id_kelas){
        $db  = $this->mysqli->conn;
        $db->query("DELETE from kelas where id_kelas ='$id_kelas'") or die($db->error);
     }

     function __destruct(){
        $db = $this->mysqli->conn;
        $db->close();
     }
 }

?>