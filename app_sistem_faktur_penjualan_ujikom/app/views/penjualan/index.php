<?php 
$title = "Daftar Penjualan";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Daftar Penjualan / Faktur</h2>
        <a href="index.php?controller=penjualan&action=create" class="btn btn-primary">Tambah Penjualan</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php 
                if ($_GET['success'] == 1) echo "Data penjualan berhasil ditambahkan!";
                elseif ($_GET['success'] == 2) echo "Data penjualan berhasil diupdate!";
                elseif ($_GET['success'] == 3) echo "Data penjualan berhasil dihapus!";
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            <?php 
                if ($_GET['error'] == 1) echo "Gagal menyimpan data penjualan!";
                elseif ($_GET['error'] == 2) echo "Data penjualan tidak ditemukan!";
                elseif ($_GET['error'] == 3) echo "Gagal menghapus data penjualan!";
            ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No. Faktur</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Perusahaan</th>
                <th>Grand Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data)): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data penjualan</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['no_faktur']); ?></td>
                        <td><?php echo htmlspecialchars($row['tgl_faktur']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_costumer']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_perusahaan']); ?></td>
                        <td>Rp <?php echo number_format($row['grand_total'], 0, ',', '.'); ?></td>
                        <td>
                            <!-- <a href="index.php?controller=penjualan&action=view&id=<?php echo $row['no_faktur']; ?>"
                               class="btn btn-primary btn-sm">Detail</a>
                            <a href="index.php?controller=penjualan&action=print&id=<?php echo $row['no_faktur']; ?>"
                               class="btn btn-success btn-sm" target="_blank"> Cetak</a> -->
                            <a href="index.php?controller=penjualan&action=edit&id=<?php echo $row['no_faktur']; ?>"
                               class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?controller=penjualan&action=delete&id=<?php echo $row['no_faktur']; ?>"
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

