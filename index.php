<?php
session_start();
if (!isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['level'] == 'admin') {
    header("Location: admin/dashboard.php");
} elseif ($_SESSION['level'] == 'karyawan') {
    header("Location: karyawan/dashboard.php");
} else {
    echo "Level user tidak dikenali.";
}
