<?php 
$title = "Edit Customer";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <h2>Edit Customer</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            Gagal mengupdate data customer!
        </div>
    <?php endif; ?>

    <form action="index.php?controller=costumer&action=update" method="POST">
        <input type="hidden" name="id_costumer" value="<?php echo $data['id_costumer']; ?>">
        
        <div class="form-group">
            <label for="nama_costumer">Nama Customer *</label>
            <input type="text" id="nama_costumer" name="nama_costumer" 
                   value="<?php echo htmlspecialchars($data['nama_costumer']); ?>" required>
        </div>

        <div class="form-group">
            <label for="perusahaan_cust">Perusahaan *</label>
            <input type="text" id="perusahaan_cust" name="perusahaan_cust" 
                   value="<?php echo htmlspecialchars($data['perusahaan_cust']); ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat *</label>
            <textarea id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="index.php?controller=costumer&action=index" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

