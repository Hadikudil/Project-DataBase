<?php
date_default_timezone_set('Asia/Jakarta');
include '../db.php';

// Generate kode barang otomatis
$last = mysqli_query($conn, "SELECT kode_barang FROM produk ORDER BY id_produk DESC LIMIT 1");
$data = mysqli_fetch_assoc($last);
$lastNum = $data ? intval(substr($data['kode_barang'], 3)) + 1 : 1;
$kodeOtomatis = 'PRD' . str_pad($lastNum, 3, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Input Produk</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body { font-family: Arial, sans-serif; background: #f4f6f8; padding: 30px; }
    .form-container {
      background: white; max-width: 500px; margin: auto; padding: 30px;
      border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    label { display: block; margin-top: 15px; font-weight: bold; }
    input {
      width: 100%; padding: 10px; margin-top: 5px;
      border: 1px solid #ccc; border-radius: 6px;
    }
    input[readonly] { background: #eee; }
    input[type="submit"] {
      background-color: #007BFF; color: white; margin-top: 25px;
      border: none; cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Input Produk</h2>
    <form action="proses_input.php" method="POST">
      <label>Kode Barang</label>
      <input type="text" name="kode_barang" value="<?= $kodeOtomatis ?>" readonly required>

      <label>NIK Karyawan</label>
      <input type="text" name="nik_karyawan" required placeholder="Contoh: 210501230001">

      <label>Nama Produk</label>
      <input type="text" name="nama_produk" required placeholder="Contoh: Masker Kain">

      <label>Stok Gudang</label>
      <input type="number" name="stok_gudang" required placeholder="Contoh: 100">

      <label>Tanggal & Waktu Produk Datang</label>
      <input type="datetime-local" name="tanggal_produk" value="<?= date('Y-m-d\TH:i:s') ?>" required>

      <input type="submit" value="Simpan Produk">
    </form>
  </div>
</body>
</html>
