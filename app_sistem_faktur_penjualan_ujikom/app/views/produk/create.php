<?php 
$title = "Tambah Produk";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <h2>Tambah Produk</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            Gagal menyimpan data produk!
        </div>
    <?php endif; ?>

    <form action="index.php?controller=produk&action=store" method="POST">
        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" required>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" min="0" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="jenis">Jenis</label>
            <input type="text" id="jenis" name="jenis" required>
        </div>

        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="number" id="stock" name="stock" min="0" required>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php?controller=produk&action=index" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

