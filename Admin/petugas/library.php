<?php
 class Petugas {
    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    public function tampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM petugas";

        if($id != null)
        {
            $sql .= " WHERE id_petugas = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }


     public function tambah($username,$password,$nama_petugas,$level,$nisn)
     {
        $sql = "INSERT INTO petugas (username,password,nama_petugas,level,nisn)
                Values('$username', '$password','$nama_petugas', '$level','$nisn')";
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

     public function hapus($id_petugas){
        $db  = $this->mysqli->conn;
        $db->query("DELETE from petugas where id_petugas ='$id_petugas'") or die($db->error);
     }

     function __destruct(){
        $db = $this->mysqli->conn;
        $db->close();
     }
 }

?>