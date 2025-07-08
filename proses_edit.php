<?php
include '../db.php';

$id = $_POST['id_karyawan'];
$nik = $_POST['nik_karyawan'];
$nama = $_POST['nama_karyawan'];

$query = "UPDATE karyawan SET nik_karyawan='$nik', nama_karyawan='$nama' WHERE id_karyawan='$id'";
mysqli_query($conn, $query);

header("Location: list.php");
exit;
?>
