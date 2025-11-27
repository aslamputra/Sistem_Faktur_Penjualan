<?php

// Error reporting untuk development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// controller dan action dari URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Routing
switch ($controller) {
    case 'perusahaan':
        require_once __DIR__ . '/app/controllers/PerusahaanController.php';
        $controllerObj = new PerusahaanController();
        break;

    case 'costumer':
        require_once __DIR__ . '/app/controllers/CostumerController.php';
        $controllerObj = new CostumerController();
        break;

    case 'produk':
        require_once __DIR__ . '/app/controllers/ProdukController.php';
        $controllerObj = new ProdukController();
        break;

    case 'penjualan':
        require_once __DIR__ . '/app/controllers/PenjualanController.php';
        $controllerObj = new PenjualanController();
        break;
        
    case 'home':
    default:
        // Dashboard/Home
        $title = "Dashboard";
        include __DIR__ . '/app/views/layouts/header.php';
        ?>
        <div class="card">
            <h2>Selamat Datang di Sistem Faktur Penjualan</h2>
            
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; margin-top: 2rem;">
                <div style="background: linear-gradient(135deg, #666666ff 0%, #666666ff 100%); padding: 2rem; border-radius: 8px; color: white; text-align: center;">
                    <h3 style="margin-bottom: 1rem; font-size: 2rem;"></h3>
                    <h4>Perusahaan</h4>
                    <p style="margin: 1rem 0;">Kelola data perusahaan</p>
                    <a href="index.php?controller=perusahaan&action=index"
                       style="display: inline-block; background: white; color: #000000ff; padding: 0.5rem 1.5rem; border-radius: 4px; text-decoration: none; margin-top: 1rem;">
                        Lihat Data
                    </a>
                </div>

                <div style="background: linear-gradient(135deg, #666666ff 0%, #666666ff 100%); padding: 2rem; border-radius: 8px; color: white; text-align: center;">
                    <h3 style="margin-bottom: 1rem; font-size: 2rem;"></h3>
                    <h4>Customer</h4>
                    <p style="margin: 1rem 0;">Kelola data customer</p>
                    <a href="index.php?controller=costumer&action=index"
                       style="display: inline-block; background: white; color: #000000ff; padding: 0.5rem 1.5rem; border-radius: 4px; text-decoration: none; margin-top: 1rem;">
                        Lihat Data
                    </a>
                </div>

                <div style="background: linear-gradient(135deg, #666666ff 0%, #666666ff 100%); padding: 2rem; border-radius: 8px; color: white; text-align: center;">
                    <h3 style="margin-bottom: 1rem; font-size: 2rem;"></h3>
                    <h4>Produk</h4>
                    <p style="margin: 1rem 0;">Kelola data produk</p>
                    <a href="index.php?controller=produk&action=index"
                       style="display: inline-block; background: white; color: #000000ff; padding: 0.5rem 1.5rem; border-radius: 4px; text-decoration: none; margin-top: 1rem;">
                        Lihat Data
                    </a>
                </div>

                <div style="background: linear-gradient(135deg, #666666ff 0%, #666666ff 100%); padding: 2rem; border-radius: 8px; color: white; text-align: center;">
                    <h3 style="margin-bottom: 1rem; font-size: 2rem;"></h3>
                    <h4>Penjualan / Faktur</h4>
                    <p style="margin: 1rem 0;">Kelola transaksi penjualan</p>
                    <a href="index.php?controller=penjualan&action=index"
                       style="display: inline-block; background: white; color: #000000ff; padding: 0.5rem 1.5rem; border-radius: 4px; text-decoration: none; margin-top: 1rem;">
                        Lihat Data
                    </a>
                </div>
            </div>

            <div style="margin-top: 3rem; padding: 2rem; background: #f8f9fa; border-radius: 8px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        </ul>
                    </div>
                    <div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include __DIR__ . '/app/views/layouts/footer.php';
        exit();
}

if (method_exists($controllerObj, $action)) {
    $controllerObj->$action();
} else {
    echo "Action tidak ditemukan!";
}

