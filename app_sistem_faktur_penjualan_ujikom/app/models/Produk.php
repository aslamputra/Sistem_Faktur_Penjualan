<?php

require_once __DIR__ . '/../../config/database.php';

class Produk {
    private $conn;
    private $table_name = "produk";

    public $id_produjk;
    public $nama_produk;
    public $price;
    public $jenis;
    public $stock;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * @return array
     */
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_produjk DESC";
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
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_produjk = ? LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_produjk);
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
                  (nama_produk, price, jenis, stock)
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $this->nama_produk = htmlspecialchars(strip_tags($this->nama_produk));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->jenis = htmlspecialchars(strip_tags($this->jenis));
        $this->stock = htmlspecialchars(strip_tags($this->stock));

        $stmt->bind_param("sdsi",
            $this->nama_produk,
            $this->price,
            $this->jenis,
            $this->stock
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
                  SET nama_produk = ?, price = ?, jenis = ?, stock = ?
                  WHERE id_produjk = ?";

        $stmt = $this->conn->prepare($query);

        $this->nama_produk = htmlspecialchars(strip_tags($this->nama_produk));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->jenis = htmlspecialchars(strip_tags($this->jenis));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->id_produjk = htmlspecialchars(strip_tags($this->id_produjk));

        $stmt->bind_param("sdsii",
            $this->nama_produk,
            $this->price,
            $this->jenis,
            $this->stock,
            $this->id_produjk
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
        $query = "DELETE FROM " . $this->table_name . " WHERE id_produjk = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id_produjk);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

