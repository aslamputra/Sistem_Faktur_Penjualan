<?php 
$title = "Daftar Perusahaan";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Daftar Perusahaan</h2>
        <a href="index.php?controller=perusahaan&action=create" class="btn btn-primary">Tambah Perusahaan</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php 
                if ($_GET['success'] == 1) echo "Data perusahaan berhasil ditambahkan!";
                elseif ($_GET['success'] == 2) echo "Data perusahaan berhasil diupdate!";
                elseif ($_GET['success'] == 3) echo "Data perusahaan berhasil dihapus!";
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            <?php 
                if ($_GET['error'] == 1) echo "Gagal menyimpan data perusahaan!";
                elseif ($_GET['error'] == 2) echo "Data perusahaan tidak ditemukan!";
                elseif ($_GET['error'] == 3) echo "Gagal menghapus data perusahaan!";
            ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perusahaan</th>
                <th>Alamat</th>
                <th>No. Telp</th>
                <th>Fax</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data)): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data perusahaan</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_perusahaan']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($row['no_telp']); ?></td>
                        <td><?php echo htmlspecialchars($row['fax']); ?></td>
                        <td>
                            <a href="index.php?controller=perusahaan&action=edit&id=<?php echo $row['id_perusahaan']; ?>" 
                               class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?controller=perusahaan&action=delete&id=<?php echo $row['id_perusahaan']; ?>" 
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

