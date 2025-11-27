<?php

require_once __DIR__ . '/../../config/database.php';

class Faktur {
    private $conn;
    private $table_name = "faktur";
    private $detail_table = "detail_faktur";

    public $no_faktur;
    public $tgl_faktur;
    public $due_date;
    public $metode_bayar;
    public $ppn;
    public $dp;
    public $grand_total;
    public $user;
    public $id_costumer;
    public $id_perusahaan;


    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * 
     * @return array
     */
    public function readAll() {
        $query = "SELECT f.*, c.nama_costumer, p.nama_perusahaan 
                  FROM " . $this->table_name . " f
                  LEFT JOIN costumer c ON f.id_costumer = c.id_costumer
                  LEFT JOIN perusahaan p ON f.id_perusahaan = p.id_perusahaan
                  ORDER BY f.no_faktur DESC";
        
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
        $query = "SELECT f.*, c.nama_costumer, c.perusahaan_cust, c.alamat as alamat_costumer,
                         p.nama_perusahaan, p.alamat as alamat_perusahaan, p.no_telp, p.fax
                  FROM " . $this->table_name . " f
                  LEFT JOIN costumer c ON f.id_costumer = c.id_costumer
                  LEFT JOIN perusahaan p ON f.id_perusahaan = p.id_perusahaan
                  WHERE f.no_faktur = ? 
                  LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->no_faktur);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }

    /**
     * @return array
     */
    public function readDetail() {
        $query = "SELECT df.*, pr.nama_produk, pr.jenis
                  FROM " . $this->detail_table . " df
                  LEFT JOIN produk pr ON df.id_produjk = pr.id_produjk
                  WHERE df.no_faktur = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->no_faktur);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $data = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }

    /**
     * @return bool|int
     */
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (tgl_faktur, due_date, metode_bayar, ppn, dp, grand_total, user, id_costumer, id_perusahaan) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        $this->tgl_faktur = htmlspecialchars(strip_tags($this->tgl_faktur));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        
        $stmt->bind_param("ssiiiiiii",
            $this->tgl_faktur,
            $this->due_date,
            $this->metode_bayar,
            $this->ppn,
            $this->dp,
            $this->grand_total,
            $this->user,
            $this->id_costumer,
            $this->id_perusahaan
        );
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        
        return false;
    }

    /**
     * @return bool
     */
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET tgl_faktur = ?, 
                      due_date = ?, 
                      metode_bayar = ?, 
                      ppn = ?,
                      dp = ?,
                      grand_total = ?,
                      user = ?,
                      id_costumer = ?,
                      id_perusahaan = ?
                  WHERE no_faktur = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $this->tgl_faktur = htmlspecialchars(strip_tags($this->tgl_faktur));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        
        $stmt->bind_param("ssiiiiiiii",
            $this->tgl_faktur,
            $this->due_date,
            $this->metode_bayar,
            $this->ppn,
            $this->dp,
            $this->grand_total,
            $this->user,
            $this->id_costumer,
            $this->id_perusahaan,
            $this->no_faktur
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
        
        $query_detail = "DELETE FROM " . $this->detail_table . " WHERE no_faktur = ?";
        $stmt_detail = $this->conn->prepare($query_detail);
        $stmt_detail->bind_param("i", $this->no_faktur);
        $stmt_detail->execute();

        $query = "DELETE FROM " . $this->table_name . " WHERE no_faktur = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->no_faktur);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * 
     * @param int $id_produk
     * @param int $qty
     * @param int $price
     * @return bool
     */
    public function addDetail($id_produk, $qty, $price) {
        $query = "INSERT INTO " . $this->detail_table . "
                  (id_produjk, no_faktur, qty, price)
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iisi", $id_produk, $this->no_faktur, $qty, $price);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function deleteAllDetails() {
        $query = "DELETE FROM " . $this->detail_table . " WHERE no_faktur = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->no_faktur);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

