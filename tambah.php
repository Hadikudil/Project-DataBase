<?php
session_start();
include '../db.php';

if ($_SESSION['level'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Ambil kode terakhir dari database
$getLast = mysqli_query($conn, "SELECT MAX(kode_barang) AS max_kode FROM produk WHERE kode_barang LIKE 'PRD%'");
$data = mysqli_fetch_assoc($getLast);
$lastKode = $data['max_kode'];

// Jika belum ada, mulai dari PRD006
if (!$lastKode) {
    $kode_barang = 'PRD006';
} else {
    $lastNumber = (int)substr($lastKode, 3); // ambil angka setelah 'PRD'
    $nextNumber = $lastNumber + 1;
    $kode_barang = 'PRD' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $stok = $_POST['stok_gudang'];

    mysqli_query($conn, "INSERT INTO produk (kode_barang, nama_produk, stok_gudang) VALUES ('$kode_barang', '$nama_produk', '$stok')");
    header("Location: ../produk/list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk Baru</title>
  <style>
    body { font-family: sans-serif; margin: 0; background: #f4f4f4; }
    header { background: #333; color: white; padding: 15px 30px; display: flex; justify-content: space-between; }
    main { padding: 30px; }
    form {
      background: white; padding: 30px; border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 500px;
    }
    label { display: block; margin: 10px 0 5px; }
    input {
      width: 100%; padding: 10px; margin-bottom: 15px;
      border: 1px solid #ccc; border-radius: 4px;
    }
    button {
      background: #28a745; color: white; padding: 10px 20px;
      border: none; border-radius: 4px; cursor: pointer;
    }
    button:hover { background: #218838; }
    .error {
      background: #f8d7da; color: #721c24; padding: 10px;
      border-radius: 4px; margin-bottom: 15px;
    }
  </style>
</head>
<body>

<header>
  <h1>Monitoring Gudang</h1>
  <div>Halo, <?= $_SESSION['nama_user'] ?> | <a href="../logout.php" style="color:#ffc107;">Logout</a></div>
</header>

<main>
  <h2>🆕 Tambah Produk Baru</h2>

  <?php if ($error): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>

 <form method="POST">
  <label for="kode_barang">Kode Barang (Otomatis)</label>
  <input type="text" name="kode_barang" value="<?= $kode_barang ?>" readonly>

  <label for="nama_produk">Nama Produk</label>
  <input type="text" name="nama_produk" required>

  <label for="stok_gudang">Stok Awal</label>
  <input type="number" name="stok_gudang" min="0" required>

  <button type="submit">Simpan Produk</button>
</form>

</main>

</body>
</html>
