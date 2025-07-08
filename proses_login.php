<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM login_user WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['nama_user'] = $data['nama_user'];
    $_SESSION['level'] = $data['level'];

    header("Location: index.php");
} else {
    echo "Login gagal. <a href='login.php'>Coba lagi</a>";
}
