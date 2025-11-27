<?php 
$title = "Tambah Perusahaan";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <h2>Tambah Perusahaan</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            Gagal menyimpan data perusahaan!
        </div>
    <?php endif; ?>

    <form action="index.php?controller=perusahaan&action=store" method="POST">
        <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan</label>
            <input type="text" id="nama_perusahaan" name="nama_perusahaan" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="no_telp">No. Telepon</label>
            <input type="text" id="no_telp" name="no_telp" required>
        </div>

        <div class="form-group">
            <label for="fax">Fax</label>
            <input type="text" id="fax" name="fax" required>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php?controller=perusahaan&action=index" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

