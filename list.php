<?php
session_start();
include '../db.php';

// Cek apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

// Ambil semua riwayat barang masuk dan keluar dengan nama karyawan
$result = mysqli_query($conn, "
SELECT bm.tanggal_masuk AS tanggal, bm.kode_barang, p.nama_produk, bm.jumlah_masuk AS jumlah,
       'Masuk' AS jenis, k.nama_karyawan
FROM barang_masuk bm
JOIN produk p ON bm.kode_barang = p.kode_barang
LEFT JOIN karyawan k ON bm.id_karyawan = k.id_karyawan

UNION

SELECT bk.tanggal_keluar AS tanggal, bk.kode_barang, p.nama_produk, bk.jumlah_keluar AS jumlah,
       'Keluar' AS jenis, k.nama_karyawan
FROM barang_keluar bk
JOIN produk p ON bk.kode_barang = p.kode_barang
LEFT JOIN karyawan k ON bk.id_karyawan = k.id_karyawan

ORDER BY tanggal DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Barang Masuk & Keluar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      background: #f4f4f4;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    thead {
      background-color: #343a40;
      color: white;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ccc;
    }

    tr.masuk {
      background-color: #d4edda;
    }

    tr.keluar {
      background-color: #f8d7da;
    }

    td:last-child {
      font-weight: bold;
    }

    .back {
      margin-top: 20px;
      display: inline-block;
      background: #007bff;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
    }

    .back:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

<h2>📊 Riwayat Barang Masuk & Keluar</h2>

<table>
  <thead>
    <tr>
      <th>Tanggal</th>
      <th>Jenis</th>
      <th>Kode Barang</th>
      <th>Nama Produk</th>
      <th>Jumlah</th>
      <th>Penanggung Jawab</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr class="<?= strtolower($row['jenis']) ?>">
          <td><?= $row['tanggal'] ?></td>
          <td><?= $row['jenis'] ?></td>
          <td><?= $row['kode_barang'] ?></td>
          <td><?= $row['nama_produk'] ?></td>
          <td><?= $row['jumlah'] ?></td>
          <td><?= $row['nama_karyawan'] ?: '-' ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="6" style="text-align:center;">Tidak ada data riwayat.</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<a class="back" href="../admin/dashboard.php">⬅ Kembali ke Dashboard</a>

</body>
</html>
