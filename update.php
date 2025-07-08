<?php
include '../db.php';

$id = $_POST['id_produk'];
$kode = $_POST['kode_barang'];
$nama = $_POST['nama_produk'];
$stok = $_POST['stok_gudang'];

mysqli_query($conn, "UPDATE produk SET 
    kode_barang = '$kode', 
    nama_produk = '$nama', 
    stok_gudang = '$stok' 
    WHERE id_produk = $id");

header("Location: list.php");
exit;
