<?php

require_once __DIR__ . '/../../config/database.php';

class Perusahaan {
    private $conn;
    private $table_name = "perusahaan";

    public $id_perusahaan;
    public $nama_perusahaan;
    public $alamat;
    public $no_telp;
    public $fax;

    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * @return array
     */
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_perusahaan DESC";
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
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_perusahaan = ? LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_perusahaan);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }

    /**
     * @return bool
     */
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nama_perusahaan, alamat, no_telp, fax) 
                  VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nama_perusahaan = htmlspecialchars(strip_tags($this->nama_perusahaan));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        $this->no_telp = htmlspecialchars(strip_tags($this->no_telp));
        $this->fax = htmlspecialchars(strip_tags($this->fax));
        
        $stmt->bind_param("ssss",
            $this->nama_perusahaan,
            $this->alamat,
            $this->no_telp,
            $this->fax
        );
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    /**
     * @return bool
     */
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama_perusahaan = ?, 
                      alamat = ?, 
                      no_telp = ?, 
                      fax = ? 
                  WHERE id_perusahaan = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $this->nama_perusahaan = htmlspecialchars(strip_tags($this->nama_perusahaan));
        $this->alamat = htmlspecialchars(strip_tags($this->alamat));
        $this->no_telp = htmlspecialchars(strip_tags($this->no_telp));
        $this->fax = htmlspecialchars(strip_tags($this->fax));
        $this->id_perusahaan = htmlspecialchars(strip_tags($this->id_perusahaan));
        
        $stmt->bind_param("ssssi",
            $this->nama_perusahaan,
            $this->alamat,
            $this->no_telp,
            $this->fax,
            $this->id_perusahaan
        );
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    /**
     * @return bool
     */
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_perusahaan = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_perusahaan);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}

