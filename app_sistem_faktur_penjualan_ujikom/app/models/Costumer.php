<?php

require_once __DIR__ . '/../../config/database.php';

class Costumer {
    private $conn;
    private $table_name = "costumer";

    public $id_costumer;
    public $nama_costumer;
    public $perusahaan_cust;
    public $alamat;

    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * @return array
     */
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_costumer DESC";
        $result = $this->conn->query($query);
        
        $data = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }

    /**
     * @return array|null
     */
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_costumer = ? LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_costumer);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }

    /**
     * 
     * @return bool
     */
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nama_costumer, perusahaan_cust, alamat) 
                  VALUES (?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nama_costumer = htmlspecialchars(strip_tags($this->nama_costumer));
        $this->perusahaan_cust = htmlspecialchars(strip_tags($this->perusahaan_cust));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        
        $stmt->bind_param("sss",
            $this->nama_costumer,
            $this->perusahaan_cust,
            $this->alamat
        );
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    /**
     * 
     * @return bool
     */
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama_costumer = ?, 
                      perusahaan_cust = ?, 
                      alamat = ? 
                  WHERE id_costumer = ?";
        
        $stmt = $this->conn->prepare($query);
        
        
        $this->nama_costumer = htmlspecialchars(strip_tags($this->nama_costumer));
        $this->perusahaan_cust = htmlspecialchars(strip_tags($this->perusahaan_cust));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        $this->id_costumer = htmlspecialchars(strip_tags($this->id_costumer));
        
        $stmt->bind_param("sssi",
            $this->nama_costumer,
            $this->perusahaan_cust,
            $this->alamat,
            $this->id_costumer
        );
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    /**
     * 
     * @return bool
     */
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_costumer = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_costumer);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}

