<?php 
$title = "Detail Penjualan";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Detail Faktur #<?php echo htmlspecialchars($data['no_faktur']); ?></h2>
        <div>
            <a href="index.php?controller=penjualan&action=print&id=<?php echo $data['no_faktur']; ?>"
               class="btn btn-success" target="_blank">Cetak PDF</a>
            <a href="index.php?controller=penjualan&action=index" class="btn btn-primary">Kembali</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
        <div>
            <h3 style="margin-bottom: 1rem; color: #2c3e50;">Informasi Perusahaan</h3>
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($data['nama_perusahaan']); ?></p>
            <p><strong>Alamat:</strong> <?php echo htmlspecialchars($data['alamat_perusahaan']); ?></p>
            <p><strong>Telp:</strong> <?php echo htmlspecialchars($data['no_telp']); ?></p>
            <p><strong>Fax:</strong> <?php echo htmlspecialchars($data['fax']); ?></p>
        </div>
        <div>
            <h3 style="margin-bottom: 1rem; color: #2c3e50;">Informasi Customer</h3>
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($data['nama_costumer']); ?></p>
            <p><strong>Perusahaan:</strong> <?php echo htmlspecialchars($data['perusahaan_cust']); ?></p>
            <p><strong>Alamat:</strong> <?php echo htmlspecialchars($data['alamat_costumer']); ?></p>
        </div>
    </div>

    <div style="margin-bottom: 2rem;">
        <h3 style="margin-bottom: 1rem; color: #2c3e50;">Informasi Faktur</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <p><strong>Tanggal Faktur:</strong> <?php echo htmlspecialchars($data['tgl_faktur']); ?></p>
            <p><strong>Jatuh Tempo:</strong> <?php echo htmlspecialchars($data['due_date']); ?></p>
            <p><strong>Metode Bayar:</strong> 
                <?php 
                    $metode = ['', 'Cash', 'Transfer', 'Credit'];
                    echo $metode[$data['metode_bayar']] ?? 'Unknown';
                ?>
            </p>
        </div>
    </div>

    <h3 style="margin-bottom: 1rem; color: #2c3e50;">Detail Produk</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jenis</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $total = 0;
            foreach ($details as $detail): 
                $subtotal = $detail['qty'] * $detail['price'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($detail['nama_produk']); ?></td>
                    <td><?php echo htmlspecialchars($detail['jenis']); ?></td>
                    <td><?php echo htmlspecialchars($detail['qty']); ?></td>
                    <td>Rp <?php echo number_format($detail['price'], 0, ',', '.'); ?></td>
                    <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: right;"><strong>Subtotal:</strong></td>
                <td><strong>Rp <?php echo number_format($total, 0, ',', '.'); ?></strong></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: right;"><strong>PPN (<?php echo $data['ppn']; ?>%):</strong></td>
                <td><strong>Rp <?php echo number_format($total * ($data['ppn'] / 100), 0, ',', '.'); ?></strong></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: right;"><strong>Down Payment:</strong></td>
                <td><strong>Rp <?php echo number_format($data['dp'], 0, ',', '.'); ?></strong></td>
            </tr>
            <tr style="background-color: #f8f9fa;">
                <td colspan="5" style="text-align: right;"><strong>Grand Total:</strong></td>
                <td><strong style="color: #27ae60; font-size: 1.2rem;">Rp <?php echo number_format($data['grand_total'], 0, ',', '.'); ?></strong></td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 2rem; display: flex; gap: 1rem;">
        <a href="index.php?controller=penjualan&action=edit&id=<?php echo $data['no_faktur']; ?>" class="btn btn-warning">Edit</a>
        <a href="index.php?controller=penjualan&action=delete&id=<?php echo $data['no_faktur']; ?>" 
           class="btn btn-danger"
           onclick="return confirm('Apakah Anda yakin ingin menghapus faktur ini?')">Hapus</a>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

