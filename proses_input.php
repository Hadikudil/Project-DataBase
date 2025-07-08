<?php
include '../db.php';

$kode_barang   = $_POST['kode_barang'];
$nama_produk   = $_POST['nama_produk'];
$jumlah_masuk  = $_POST['jumlah_masuk'];
$tanggal_masuk = date("Y-m-d H:i:s");
$id_karyawan   = $_POST['id_karyawan'];

// Tambah produk jika belum ada
mysqli_query($conn, "
  INSERT INTO produk (kode_barang, nama_produk, stok_gudang)
  VALUES ('$kode_barang', '$nama_produk', 0)
  ON DUPLICATE KEY UPDATE nama_produk = VALUES(nama_produk)
");

// Update stok
mysqli_query($conn, "
  UPDATE produk 
  SET stok_gudang = stok_gudang + $jumlah_masuk 
  WHERE kode_barang = '$kode_barang'
");

// Catat barang masuk
mysqli_query($conn, "
  INSERT INTO barang_masuk (kode_barang, jumlah_masuk, tanggal_masuk, id_karyawan)
  VALUES ('$kode_barang', $jumlah_masuk, '$tanggal_masuk', $id_karyawan)
");

header("Location: list.php");
