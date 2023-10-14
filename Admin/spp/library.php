<?php
 class Spp {
    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    
    public function tampil($id = null){
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM spp";

        if($id != null)
        {
            $sql .= " WHERE id_spp = $id";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
     }


     public function tambah($tahun, $nominal)
     {
        $sql = "INSERT INTO spp (tahun, nominal)
                Values('$tahun', '$nominal')";
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

     public function hapus($id_spp){
        $db  = $this->mysqli->conn;
        $db->query("DELETE from spp where id_spp ='$id_spp'") or die($db->error);
     }

     function __destruct(){
        $db = $this->mysqli->conn;
        $db->close();
     }
 }

?>