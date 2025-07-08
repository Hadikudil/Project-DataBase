<?php
session_start();
if ($_SESSION['level'] != 'karyawan') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard Karyawan</title>
  <style>
    body { font-family: sans-serif; background: #f9f9f9; text-align: center; padding: 40px; }
    h2 { margin-bottom: 30px; }
    .menu { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; }
    a { text-decoration: none; display: inline-block; background: #28a745; color: white; padding: 20px 30px; border-radius: 10px; width: 200px; }
    a:hover { background: #1e7e34; }
    .logout { margin-top: 30px; display: inline-block; background: red; padding: 10px 20px; color: white; border-radius: 8px; }
  </style>
</head>
<body>
  <h2>Halo <?= $_SESSION['nama_user'] ?>, Selamat Datang</h2>
  <div class="menu">
    <a href="../barang_masuk/input.php">Input Barang Masuk</a>
    <a href="../barang_keluar/input.php">Input Barang Keluar</a>
  </div>
  <br>
  <a class="logout" href="../logout.php">Logout</a>
</body>
</html>
