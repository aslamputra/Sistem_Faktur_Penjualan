<?php 
$title = "Tambah Customer";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <h2>Tambah Customer</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            Gagal menyimpan data customer!
        </div>
    <?php endif; ?>

    <form action="index.php?controller=costumer&action=store" method="POST">
        <div class="form-group">
            <label for="nama_costumer">Nama Customer</label>
            <input type="text" id="nama_costumer" name="nama_costumer" required>
        </div>

        <div class="form-group">
            <label for="perusahaan_cust">Perusahaan</label>
            <input type="text" id="perusahaan_cust" name="perusahaan_cust" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3" required></textarea>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php?controller=costumer&action=index" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

