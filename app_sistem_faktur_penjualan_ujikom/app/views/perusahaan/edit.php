<?php 
$title = "Edit Perusahaan";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <h2>Edit Perusahaan</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            Gagal mengupdate data perusahaan!
        </div>
    <?php endif; ?>

    <form action="index.php?controller=perusahaan&action=update" method="POST">
        <input type="hidden" name="id_perusahaan" value="<?php echo $data['id_perusahaan']; ?>">
        
        <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan *</label>
            <input type="text" id="nama_perusahaan" name="nama_perusahaan" 
                   value="<?php echo htmlspecialchars($data['nama_perusahaan']); ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat *</label>
            <textarea id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="no_telp">No. Telepon *</label>
            <input type="text" id="no_telp" name="no_telp"
                   value="<?php echo htmlspecialchars($data['no_telp']); ?>"
                   placeholder="Contoh: 021-12345678" required>
        </div>

        <div class="form-group">
            <label for="fax">Fax *</label>
            <input type="text" id="fax" name="fax"
                   value="<?php echo htmlspecialchars($data['fax']); ?>"
                   placeholder="Contoh: 021-12345679" required>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="index.php?controller=perusahaan&action=index" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

