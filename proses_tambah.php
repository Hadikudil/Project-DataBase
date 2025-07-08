<?php
include '../db.php';

$nama = $_POST['nama'];
$stok = $_POST['stok'];

$conn->query("INSERT INTO produk (nama_produk, stok_gudang) VALUES ('$nama', $stok)");
header('Location: list.php');
?>
