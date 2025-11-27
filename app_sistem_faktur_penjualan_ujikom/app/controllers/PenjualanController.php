<?php

require_once __DIR__ . '/../models/Faktur.php';
require_once __DIR__ . '/../models/Costumer.php';
require_once __DIR__ . '/../models/Perusahaan.php';
require_once __DIR__ . '/../models/Produk.php';

class PenjualanController {
    private $model;
    private $costumerModel;
    private $perusahaanModel;
    private $produkModel;

    public function __construct() {
        $this->model = new Faktur();
        $this->costumerModel = new Costumer();
        $this->perusahaanModel = new Perusahaan();
        $this->produkModel = new Produk();
    }

    
    public function index() {
        $data = $this->model->readAll();
        require_once __DIR__ . '/../views/penjualan/index.php';
    }

    
    public function create() {
        $costumers = $this->costumerModel->readAll();
        $perusahaans = $this->perusahaanModel->readAll();
        $produks = $this->produkModel->readAll();
        require_once __DIR__ . '/../views/penjualan/create.php';
    }

    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->tgl_faktur = $_POST['tgl_faktur'];
            $this->model->due_date = $_POST['due_date'];
            $this->model->metode_bayar = $_POST['metode_bayar'];
            $this->model->ppn = $_POST['ppn'];
            $this->model->dp = $_POST['dp'];
            $this->model->grand_total = $_POST['grand_total'];
            $this->model->user = 1; 
            $this->model->id_costumer = $_POST['id_costumer'];
            $this->model->id_perusahaan = $_POST['id_perusahaan'];

            $no_faktur = $this->model->create();
            
            if ($no_faktur) {
                
                if (isset($_POST['id_produk']) && is_array($_POST['id_produk'])) {
                    $this->model->no_faktur = $no_faktur;
                    
                    foreach ($_POST['id_produk'] as $key => $id_produk) {
                        if (!empty($id_produk)) {
                            $qty = $_POST['qty'][$key];
                            $price = $_POST['price'][$key];
                            $this->model->addDetail($id_produk, $qty, $price);
                        }
                    }
                }
                
                header("Location: index.php?controller=penjualan&action=index&success=1");
                exit();
            } else {
                header("Location: index.php?controller=penjualan&action=create&error=1");
                exit();
            }
        }
    }

    
    public function view() {
        if (isset($_GET['id'])) {
            $this->model->no_faktur = $_GET['id'];
            $data = $this->model->readOne();
            $details = $this->model->readDetail();
            
            if ($data) {
                require_once __DIR__ . '/../views/penjualan/view.php';
            } else {
                header("Location: index.php?controller=penjualan&action=index&error=2");
                exit();
            }
        }
    }

    
    public function edit() {
        if (isset($_GET['id'])) {
            $this->model->no_faktur = $_GET['id'];
            $data = $this->model->readOne();
            $details = $this->model->readDetail();
            $costumers = $this->costumerModel->readAll();
            $perusahaans = $this->perusahaanModel->readAll();
            $produks = $this->produkModel->readAll();
            
            if ($data) {
                require_once __DIR__ . '/../views/penjualan/edit.php';
            } else {
                header("Location: index.php?controller=penjualan&action=index&error=2");
                exit();
            }
        }
    }

    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->no_faktur = $_POST['no_faktur'];
            $this->model->tgl_faktur = $_POST['tgl_faktur'];
            $this->model->due_date = $_POST['due_date'];
            $this->model->metode_bayar = $_POST['metode_bayar'];
            $this->model->ppn = $_POST['ppn'];
            $this->model->dp = $_POST['dp'];
            $this->model->grand_total = $_POST['grand_total'];
            $this->model->user = 1;
            $this->model->id_costumer = $_POST['id_costumer'];
            $this->model->id_perusahaan = $_POST['id_perusahaan'];

            if ($this->model->update()) {
                
                $this->model->deleteAllDetails();
                
                if (isset($_POST['id_produk']) && is_array($_POST['id_produk'])) {
                    foreach ($_POST['id_produk'] as $key => $id_produk) {
                        if (!empty($id_produk)) {
                            $qty = $_POST['qty'][$key];
                            $price = $_POST['price'][$key];
                            $this->model->addDetail($id_produk, $qty, $price);
                        }
                    }
                }
                
                header("Location: index.php?controller=penjualan&action=index&success=2");
                exit();
            } else {
                header("Location: index.php?controller=penjualan&action=edit&id=" . $_POST['no_faktur'] . "&error=1");
                exit();
            }
        }
    }

    
    public function delete() {
        if (isset($_GET['id'])) {
            $this->model->no_faktur = $_GET['id'];

            if ($this->model->delete()) {
                header("Location: index.php?controller=penjualan&action=index&success=3");
                exit();
            } else {
                header("Location: index.php?controller=penjualan&action=index&error=3");
                exit();
            }
        }
    }

    
    public function print() {
        if (isset($_GET['id'])) {
            $this->model->no_faktur = $_GET['id'];

            
            $faktur = $this->model->readOne();

            if ($faktur) {
                
                $details = $this->model->readDetail();

                
                require_once __DIR__ . '/../views/penjualan/print.php';
            } else {
                header("Location: index.php?controller=penjualan&action=index&error=4");
                exit();
            }
        } else {
            header("Location: index.php?controller=penjualan&action=index");
            exit();
        }
    }
}

