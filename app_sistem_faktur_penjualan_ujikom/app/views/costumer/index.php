<?php 
$title = "Daftar Customer";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Daftar Customer</h2>
        <a href="index.php?controller=costumer&action=create" class="btn btn-primary">Tambah Customer</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php 
                if ($_GET['success'] == 1) echo "Data customer berhasil ditambahkan!";
                elseif ($_GET['success'] == 2) echo "Data customer berhasil diupdate!";
                elseif ($_GET['success'] == 3) echo "Data customer berhasil dihapus!";
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            <?php 
                if ($_GET['error'] == 1) echo "Gagal menyimpan data customer!";
                elseif ($_GET['error'] == 2) echo "Data customer tidak ditemukan!";
                elseif ($_GET['error'] == 3) echo "Gagal menghapus data customer!";
            ?>
        </div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Perusahaan</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data)): ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data customer</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_costumer']); ?></td>
                        <td><?php echo htmlspecialchars($row['perusahaan_cust']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td>
                            <a href="index.php?controller=costumer&action=edit&id=<?php echo $row['id_costumer']; ?>" 
                               class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?controller=costumer&action=delete&id=<?php echo $row['id_costumer']; ?>" 
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

