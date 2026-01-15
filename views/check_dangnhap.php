<?php
session_start();
if (!isset($_SESSION['taikhoan'])) {
    header("Location: login.php");
    exit;
}
?>