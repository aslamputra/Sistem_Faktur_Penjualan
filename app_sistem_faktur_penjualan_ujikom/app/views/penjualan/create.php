<?php 
$title = "Tambah Penjualan";
include __DIR__ . '/../layouts/header.php'; 
?>

<div class="card">
    <h2>Tambah Penjualan / Faktur</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            Gagal menyimpan data penjualan!
        </div>
    <?php endif; ?>

    <form action="index.php?controller=penjualan&action=store" method="POST" id="formPenjualan">
        <div class="form-group">
            <label for="tgl_faktur">Tanggal Faktur</label>
            <input type="date" id="tgl_faktur" name="tgl_faktur" value="<?php echo date('Y-m-d'); ?>" required>
        </div>

        <div class="form-group">
            <label for="due_date">Jatuh Tempo</label>
            <input type="date" id="due_date" name="due_date" required>
        </div>

        <div class="form-group">
            <label for="id_costumer">Customer</label>
            <select id="id_costumer" name="id_costumer" required>
                <option value="">-- Pilih Customer --</option>
                <?php foreach ($costumers as $costumer): ?>
                    <option value="<?php echo $costumer['id_costumer']; ?>">
                        <?php echo htmlspecialchars($costumer['nama_costumer']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_perusahaan">Perusahaan</label>
            <select id="id_perusahaan" name="id_perusahaan" required>
                <option value="">-- Pilih Perusahaan --</option>
                <?php foreach ($perusahaans as $perusahaan): ?>
                    <option value="<?php echo $perusahaan['id_perusahaan']; ?>">
                        <?php echo htmlspecialchars($perusahaan['nama_perusahaan']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="metode_bayar">Metode Bayar</label>
            <select id="metode_bayar" name="metode_bayar" required>
                <option value="">-- Pilih Metode Bayar --</option>
                <option value="1">Cash</option>
                <option value="2">Transfer</option>
                <option value="3">Credit</option>
            </select>
        </div>

        <hr style="margin: 2rem 0;">
        <h3>Detail Produk</h3>
        
        <div id="detailContainer">
            <div class="detail-row" style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr 100px; gap: 1rem; margin-bottom: 1rem; align-items: end;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Produk</label>
                    <select name="id_produk[]" class="produk-select" onchange="updatePrice(this)">
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach ($produks as $produk): ?>
                            <option value="<?php echo $produk['id_produjk']; ?>" 
                                    data-price="<?php echo $produk['price']; ?>">
                                <?php echo htmlspecialchars($produk['nama_produk']); ?> - Rp <?php echo number_format($produk['price'], 0, ',', '.'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Qty</label>
                    <input type="number" name="qty[]" class="qty-input" min="1" value="1" onchange="calculateTotal()">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Harga</label>
                    <input type="number" name="price[]" class="price-input" readonly>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Subtotal</label>
                    <input type="number" class="subtotal-input" readonly>
                </div>
                <div>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary" onclick="addRow()" style="margin-bottom: 1rem;">Tambah Produk</button>

        <hr style="margin: 2rem 0;">

        <div class="form-group">
            <label for="ppn">PPN (%) *</label>
            <input type="number" id="ppn" name="ppn" value="0" min="0" max="100" onchange="calculateTotal()">
        </div>

        <div class="form-group">
            <label for="dp">Down Payment (DP) *</label>
            <input type="number" id="dp" name="dp" value="0" min="0" onchange="calculateTotal()">
        </div>

        <div class="form-group">
            <label for="grand_total">Grand Total *</label>
            <input type="number" id="grand_total" name="grand_total" readonly required>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php?controller=penjualan&action=index" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>

<script>
const produkData = <?php echo json_encode($produks); ?>;

function updatePrice(select) {
    const row = select.closest('.detail-row');
    const priceInput = row.querySelector('.price-input');
    const selectedOption = select.options[select.selectedIndex];
    const price = selectedOption.getAttribute('data-price') || 0;
    priceInput.value = price;
    calculateTotal();
}

function calculateTotal() {
    let subtotal = 0;
    document.querySelectorAll('.detail-row').forEach(row => {
        const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
        const price = parseFloat(row.querySelector('.price-input').value) || 0;
        const rowSubtotal = qty * price;
        row.querySelector('.subtotal-input').value = rowSubtotal;
        subtotal += rowSubtotal;
    });

    const ppn = parseFloat(document.getElementById('ppn').value) || 0;
    const dp = parseFloat(document.getElementById('dp').value) || 0;
    
    const ppnAmount = subtotal * (ppn / 100);
    const grandTotal = subtotal + ppnAmount - dp;
    
    document.getElementById('grand_total').value = Math.max(0, grandTotal);
}

function addRow() {
    const container = document.getElementById('detailContainer');
    const newRow = container.querySelector('.detail-row').cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    newRow.querySelector('select').selectedIndex = 0;
    container.appendChild(newRow);
}

function removeRow(button) {
    const container = document.getElementById('detailContainer');
    if (container.querySelectorAll('.detail-row').length > 1) {
        button.closest('.detail-row').remove();
        calculateTotal();
    }
}
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

