<?php
    class Buku{
        // Connection
        private $conn;
        // Table
        private $db_table = "buku";
        // Columns
        public $id;
        public $judul_buku;
        public $pen_buku;
        public $hrg_buku;
        public $gambar_buku;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getBuku(){
            $sqlQuery = "SELECT id, judul_buku, pen_buku, hrg_buku, gambar_buku,  FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createBuku(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        judul buku = :judul_buku, 
                        penulis buku = :pen_buku, 
                        harga buku = :hrg_buku, 
                        gambar buku = :gambar_buku",
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->judul_buku=htmlspecialchars(strip_tags($this->judul_buku));
            $this->pen_buku=htmlspecialchars(strip_tags($this->pen_buku));
            $this->hrg_buku=htmlspecialchars(strip_tags($this->hrg_buku));
            $this->gambar_buku=htmlspecialchars(strip_tags($this->gambar_buku));
        
            // bind data
            $stmt->bindParam(":judul_buku", $this->judul_buku);
            $stmt->bindParam(":pen_buku", $this->pen_buku);
            $stmt->bindParam(":hrg_buku", $this->hrg_buku);
            $stmt->bindParam(":gambar_buku", $this->gambar_buku);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleBuku(){
            $sqlQuery = "SELECT
                        id, 
                        judul_buku, 
                        pen_buku, 
                        hrg_buku, 
                        gambar_buku, 
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->judul_buku = $dataRow['judul_buku'];
            $this->pen_buku = $dataRow['pen_buku'];
            $this->hrg_buku = $dataRow['hrg_buku'];
            $this->gambar_buku = $dataRow['gambar_buku'];
        }        
        // UPDATE
        public function updateBuku(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        judul buku = :judul_buku, 
                        penulis buku = :pen_buku, 
                        harga buku = :hrg_buku, 
                        gambar buku = :gambar_buku, 
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->judul_buku=htmlspecialchars(strip_tags($this->judul_buku));
            $this->pen_buku=htmlspecialchars(strip_tags($this->pen_buku));
            $this->hrg_buku=htmlspecialchars(strip_tags($this->hrg_buku));
            $this->gambar_buku=htmlspecialchars(strip_tags($this->gambar_buku));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":judul_buku", $this->judul_buku);
            $stmt->bindParam(":pen_buku", $this->pen_buku);
            $stmt->bindParam(":hrg_buku", $this->hrg_buku);
            $stmt->bindParam(":gambar_buku", $this->gambar_buku);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteBuku(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>