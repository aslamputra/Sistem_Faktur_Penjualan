<?php

require_once __DIR__ . '/../models/Perusahaan.php';

class PerusahaanController {
    private $model;

    public function __construct() {
        $this->model = new Perusahaan();
    }

    
    public function index() {
        $data = $this->model->readAll();
        require_once __DIR__ . '/../views/perusahaan/index.php';
    }

    
    public function create() {
        require_once __DIR__ . '/../views/perusahaan/create.php';
    }

    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->nama_perusahaan = $_POST['nama_perusahaan'];
            $this->model->alamat = $_POST['alamat'];
            $this->model->no_telp = $_POST['no_telp'];
            $this->model->fax = $_POST['fax'];

            if ($this->model->create()) {
                header("Location: index.php?controller=perusahaan&action=index&success=1");
                exit();
            } else {
                header("Location: index.php?controller=perusahaan&action=create&error=1");
                exit();
            }
        }
    }

    
    public function edit() {
        if (isset($_GET['id'])) {
            $this->model->id_perusahaan = $_GET['id'];
            $data = $this->model->readOne();
            
            if ($data) {
                require_once __DIR__ . '/../views/perusahaan/edit.php';
            } else {
                header("Location: index.php?controller=perusahaan&action=index&error=2");
                exit();
            }
        }
    }

    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->id_perusahaan = $_POST['id_perusahaan'];
            $this->model->nama_perusahaan = $_POST['nama_perusahaan'];
            $this->model->alamat = $_POST['alamat'];
            $this->model->no_telp = $_POST['no_telp'];
            $this->model->fax = $_POST['fax'];

            if ($this->model->update()) {
                header("Location: index.php?controller=perusahaan&action=index&success=2");
                exit();
            } else {
                header("Location: index.php?controller=perusahaan&action=edit&id=" . $_POST['id_perusahaan'] . "&error=1");
                exit();
            }
        }
    }

    
    public function delete() {
        if (isset($_GET['id'])) {
            $this->model->id_perusahaan = $_GET['id'];
            
            if ($this->model->delete()) {
                header("Location: index.php?controller=perusahaan&action=index&success=3");
                exit();
            } else {
                header("Location: index.php?controller=perusahaan&action=index&error=3");
                exit();
            }
        }
    }
}

