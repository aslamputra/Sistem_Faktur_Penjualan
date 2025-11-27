<?php 
$title = "Edit Produk";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <h2>Edit Produk</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            Gagal mengupdate data produk!
        </div>
    <?php endif; ?>

    <form action="index.php?controller=produk&action=update" method="POST">
        <input type="hidden" name="id_produjk" value="<?php echo $data['id_produjk']; ?>">
        
        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" 
                   value="<?php echo htmlspecialchars($data['nama_produk']); ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" min="0" step="0.01"
                   value="<?php echo htmlspecialchars($data['price']); ?>" required>
        </div>

        <div class="form-group">
            <label for="jenis">Jenis</label>
            <input type="text" id="jenis" name="jenis" 
                   value="<?php echo htmlspecialchars($data['jenis']); ?>" required>
        </div>

        <div class="form-group">
            <label for="stock">Stok</label>
            <input type="number" id="stock" name="stock" min="0"
                   value="<?php echo htmlspecialchars($data['stock']); ?>" required>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="index.php?controller=produk&action=index" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

