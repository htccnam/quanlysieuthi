<?php
include_once("../../views/connectdb.php");
session_start();

$makh = $_SESSION['makhachhang'];

/* ========== CẬP NHẬT PROFILE ========== */
if (isset($_POST['btnLuu'])) {
    $ten = $_POST['txtTen'];
    $sdt = $_POST['txtSDT'];
    $diachi = $_POST['txtDiaChi'];

    mysqli_query($con, "UPDATE khachhang SET
        tenkhachhang='$ten',
        sodienthoai='$sdt',
        diachi='$diachi'
        WHERE makhachhang='$makh'");

    echo "<script>alert('Cập nhật thành công');</script>";
}

$result = mysqli_query($con, "SELECT * FROM khachhang WHERE makhachhang='$makh'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>
<body>

<h2>THÔNG TIN CÁ NHÂN</h2>

<form method="POST" style="width:400px">
    <label>Mã khách hàng</label>
    <input value="<?= $row['makhachhang'] ?>" readonly>

    <label>Tên khách hàng</label>
    <input name="txtTen" value="<?= $row['tenkhachhang'] ?>">

    <label>Số điện thoại</label>
    <input name="txtSDT" value="<?= $row['sodienthoai'] ?>">

    <label>Địa chỉ</label>
    <input name="txtDiaChi" value="<?= $row['diachi'] ?>">

    <label>Điểm tích lũy</label>
    <input value="<?= $row['diemtichluy'] ?>" readonly>

    <button name="btnLuu">💾 Lưu thay đổi</button>
</form>

</body>
</html>
