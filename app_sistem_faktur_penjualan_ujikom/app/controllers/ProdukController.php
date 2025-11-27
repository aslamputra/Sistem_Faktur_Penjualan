<?php

require_once __DIR__ . '/../models/Produk.php';

class ProdukController {
    private $model;

    public function __construct() {
        $this->model = new Produk();
    }

    
    public function index() {
        $data = $this->model->readAll();
        include __DIR__ . '/../views/produk/index.php';
    }

    
    public function create() {
        include __DIR__ . '/../views/produk/create.php';
    }

    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->nama_produk = $_POST['nama_produk'];
            $this->model->price = $_POST['price'];
            $this->model->jenis = $_POST['jenis'];
            $this->model->stock = $_POST['stock'];

            if ($this->model->create()) {
                header("Location: index.php?controller=produk&action=index&success=1");
            } else {
                header("Location: index.php?controller=produk&action=create&error=1");
            }
            exit();
        }
    }

    
    public function edit() {
        if (isset($_GET['id'])) {
            $this->model->id_produjk = $_GET['id'];
            $data = $this->model->readOne();
            
            if ($data) {
                include __DIR__ . '/../views/produk/edit.php';
            } else {
                header("Location: index.php?controller=produk&action=index&error=2");
                exit();
            }
        }
    }

    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->id_produjk = $_POST['id_produjk'];
            $this->model->nama_produk = $_POST['nama_produk'];
            $this->model->price = $_POST['price'];
            $this->model->jenis = $_POST['jenis'];
            $this->model->stock = $_POST['stock'];

            if ($this->model->update()) {
                header("Location: index.php?controller=produk&action=index&success=2");
            } else {
                header("Location: index.php?controller=produk&action=edit&id=" . $this->model->id_produjk . "&error=1");
            }
            exit();
        }
    }

    
    public function delete() {
        if (isset($_GET['id'])) {
            $this->model->id_produjk = $_GET['id'];
            
            if ($this->model->delete()) {
                header("Location: index.php?controller=produk&action=index&success=3");
            } else {
                header("Location: index.php?controller=produk&action=index&error=3");
            }
            exit();
        }
    }
}

