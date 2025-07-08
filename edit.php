<?php
include '../db.php';
session_start();
if ($_SESSION['level'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $stok = $_POST['stok_gudang'];

    mysqli_query($conn, "UPDATE produk SET nama_produk='$nama_produk', stok_gudang=$stok WHERE id_produk=$id");
    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Produk</title>
</head>
<body>
<h2>Edit Produk</h2>

<form method="POST">
  <label>Kode Barang</label><br>
  <input type="text" value="<?= $data['kode_barang'] ?>" readonly><br><br>

  <label>Nama Produk</label><br>
  <input type="text" name="nama_produk" value="<?= $data['nama_produk'] ?>" required><br><br>

  <label>Stok</label><br>
  <input type="number" name="stok_gudang" value="<?= $data['stok_gudang'] ?>" min="0" required><br><br>

  <button type="submit">Update</button>
</form>
</body>
</html>
