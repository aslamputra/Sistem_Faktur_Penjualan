<?php 
$title = "Daftar Produk";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Daftar Produk</h2>
        <a href="index.php?controller=produk&action=create" class="btn btn-primary">Tambah Produk</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php 
                if ($_GET['success'] == 1) echo "Data produk berhasil ditambahkan!";
                elseif ($_GET['success'] == 2) echo "Data produk berhasil diupdate!";
                elseif ($_GET['success'] == 3) echo "Data produk berhasil dihapus!";
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            <?php 
                if ($_GET['error'] == 1) echo "Gagal menyimpan data produk!";
                elseif ($_GET['error'] == 2) echo "Data produk tidak ditemukan!";
                elseif ($_GET['error'] == 3) echo "Gagal menghapus data produk!";
            ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jenis</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data)): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data produk</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_produjk']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                        <td>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($row['jenis']); ?></td>
                        <td><?php echo htmlspecialchars($row['stock']); ?></td>
                        <td>
                            <a href="index.php?controller=produk&action=edit&id=<?php echo $row['id_produjk']; ?>" 
                               class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?controller=produk&action=delete&id=<?php echo $row['id_produjk']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

