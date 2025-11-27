<?php

require_once __DIR__ . '/../models/Costumer.php';

class CostumerController {
    private $model;

    public function __construct() {
        $this->model = new Costumer();
    }

    
    public function index() {
        $data = $this->model->readAll();
        require_once __DIR__ . '/../views/costumer/index.php';
    }

    
    public function create() {
        require_once __DIR__ . '/../views/costumer/create.php';
    }

    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->nama_costumer = $_POST['nama_costumer'];
            $this->model->perusahaan_cust = $_POST['perusahaan_cust'];
            $this->model->alamat = $_POST['alamat'];

            if ($this->model->create()) {
                header("Location: index.php?controller=costumer&action=index&success=1");
                exit();
            } else {
                header("Location: index.php?controller=costumer&action=create&error=1");
                exit();
            }
        }
    }

    
    public function edit() {
        if (isset($_GET['id'])) {
            $this->model->id_costumer = $_GET['id'];
            $data = $this->model->readOne();
            
            if ($data) {
                require_once __DIR__ . '/../views/costumer/edit.php';
            } else {
                header("Location: index.php?controller=costumer&action=index&error=2");
                exit();
            }
        }
    }

    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->id_costumer = $_POST['id_costumer'];
            $this->model->nama_costumer = $_POST['nama_costumer'];
            $this->model->perusahaan_cust = $_POST['perusahaan_cust'];
            $this->model->alamat = $_POST['alamat'];

            if ($this->model->update()) {
                header("Location: index.php?controller=costumer&action=index&success=2");
                exit();
            } else {
                header("Location: index.php?controller=costumer&action=edit&id=" . $_POST['id_costumer'] . "&error=1");
                exit();
            }
        }
    }

    
    public function delete() {
        if (isset($_GET['id'])) {
            $this->model->id_costumer = $_GET['id'];
            
            if ($this->model->delete()) {
                header("Location: index.php?controller=costumer&action=index&success=3");
                exit();
            } else {
                header("Location: index.php?controller=costumer&action=index&error=3");
                exit();
            }
        }
    }
}

