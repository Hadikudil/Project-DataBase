<?php
include '../db.php';
session_start();
if ($_SESSION['level'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id");
header("Location: list.php");
exit;
