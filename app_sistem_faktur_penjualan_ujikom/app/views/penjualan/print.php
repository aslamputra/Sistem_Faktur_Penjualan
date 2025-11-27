<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Faktur #<?php echo $faktur['no_faktur']; ?></title>
    <style>
        @media print {
            .no-print {
                display: none;
            }
            body {
                margin: 0;
                padding: 20px;
            }
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 20px;
        }
        
        .invoice-header h1 {
            margin: 0;
            font-size: 28px;
            color: #2c3e50;
        }
        
        .invoice-header p {
            margin: 5px 0;
            color: #666;
        }
        
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .invoice-info-left, .invoice-info-right {
            width: 48%;
        }
        
        .invoice-info h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }
        
        .invoice-info p {
            margin: 5px 0;
        }
        
        .invoice-info strong {
            display: inline-block;
            width: 120px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table thead {
            background-color: #3498db;
            color: white;
        }
        
        table th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        
        table td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
        }
        
        table tbody tr:hover {
            background-color: #f5f5f5;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .invoice-summary {
            float: right;
            width: 300px;
            margin-top: 20px;
        }
        
        .invoice-summary table {
            margin-bottom: 0;
        }
        
        .invoice-summary td {
            padding: 8px 12px;
        }
        
        .invoice-summary .total-row {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }
        
        .invoice-footer {
            clear: both;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            text-align: center;
            color: #666;
        }
        
        .btn-print {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin: 10px 5px;
        }
        
        .btn-print:hover {
            background-color: #2980b9;
        }
        
        .btn-back {
            background-color: #95a5a6;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
        }
        
        .btn-back:hover {
            background-color: #7f8c8d;
        }
        
        .print-actions {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="print-actions no-print">
        <button onclick="window.print()" class="btn-print">🖨️ Cetak / Save as PDF</button>
        <a href="index.php?controller=penjualan&action=index" class="btn-back">← Kembali</a>
    </div>

    <div class="invoice-header">
        <h1>FAKTUR PENJUALAN</h1>
        <p><strong>No. Faktur: <?php echo $faktur['no_faktur']; ?></strong></p>
    </div>

    <div class="invoice-info">
        <div class="invoice-info-left">
            <h3>Informasi Perusahaan</h3>
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($faktur['nama_perusahaan']); ?></p>
            <p><strong>Alamat:</strong> <?php echo htmlspecialchars($faktur['alamat_perusahaan']); ?></p>
            <p><strong>Telepon:</strong> <?php echo htmlspecialchars($faktur['no_telp']); ?></p>
            <p><strong>Fax:</strong> <?php echo htmlspecialchars($faktur['fax']); ?></p>
        </div>

        <div class="invoice-info-right">
            <h3>Informasi Customer</h3>
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($faktur['nama_costumer']); ?></p>
            <p><strong>Perusahaan:</strong> <?php echo htmlspecialchars($faktur['perusahaan_cust']); ?></p>
            <p><strong>Alamat:</strong> <?php echo htmlspecialchars($faktur['alamat_costumer']); ?></p>
            <p style="margin-top: 15px;"><strong>Tanggal:</strong> <?php echo date('d/m/Y', strtotime($faktur['tgl_faktur'])); ?></p>
            <p><strong>Jatuh Tempo:</strong> <?php echo date('d/m/Y', strtotime($faktur['due_date'])); ?></p>
            <p><strong>Metode Bayar:</strong> <?php echo htmlspecialchars($faktur['metode_bayar']); ?></p>
        </div>
    </div>

    <h3>Detail Produk</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama Produk</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $subtotal_all = 0;
            foreach($details as $detail):
                $subtotal = $detail['qty'] * $detail['price'];
                $subtotal_all += $subtotal;
            ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($detail['nama_produk']); ?></td>
                <td class="text-center"><?php echo $detail['qty']; ?></td>
                <td class="text-right">Rp <?php echo number_format($detail['price'], 0, ',', '.'); ?></td>
                <td class="text-right">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="invoice-summary">
        <table>
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td class="text-right">Rp <?php echo number_format($subtotal_all, 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td><strong>PPN:</strong></td>
                <td class="text-right">Rp <?php echo number_format($faktur['ppn'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td><strong>Down Payment:</strong></td>
                <td class="text-right">Rp <?php echo number_format($faktur['dp'], 0, ',', '.'); ?></td>
            </tr>
            <tr class="total-row">
                <td><strong>GRAND TOTAL:</strong></td>
                <td class="text-right"><strong>Rp <?php echo number_format($faktur['grand_total'], 0, ',', '.'); ?></strong></td>
            </tr>
        </table>
    </div>

    <div class="invoice-footer">
        <p>Terima kasih atas kepercayaan Anda</p>
        <p style="font-size: 10px; margin-top: 10px;">Dokumen ini dicetak pada: <?php echo date('d/m/Y H:i:s'); ?></p>
    </div>
</body>
</html>

