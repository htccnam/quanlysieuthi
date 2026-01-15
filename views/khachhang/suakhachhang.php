<?php
include_once("../connectdb.php");

if (!isset($_GET['makhachhang'])) {
    header("location:quanlykhachhang.php");
    exit();
}

$makh = $_GET['makhachhang'];

/* ========== LƯU SỬA ========== */
if (isset($_POST['btnLuu'])) {
    $ten = $_POST['txtTenKH'];
    $sdt = $_POST['txtSDT'];
    $diachi = $_POST['txtDiaChi'];
    $diem = $_POST['txtDiem'];
    $taikhoan=$_POST['txtTaikhoan'];
    $matkhau=$_POST['txtMatkhau'];

    mysqli_query($con, "UPDATE khachhang SET
        tenkhachhang='$ten',
        sodienthoai='$sdt',
        diachi='$diachi',
        diemtichluy='$diem',
        taikhoan = '$taikhoan',
        matkhau= '$matkhau'
        WHERE makhachhang='$makh'");

    echo "<script>
        alert('Cập nhật thành công');
        window.location='quanlykhachhang.php';
    </script>";
}

/* ========== LẤY DATA ========== */
$result = mysqli_query($con, "SELECT * FROM khachhang WHERE makhachhang='$makh'");
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa khách hàng</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>
<body>

<h2>SỬA KHÁCH HÀNG</h2>

<form method="POST" style="width:450px">
    <label>Mã khách hàng</label>
    <input value="<?= $row['makhachhang'] ?>" class="highlight" readonly>

    <label>Tên khách hàng</label>
    <input name="txtTenKH" value="<?= $row['tenkhachhang'] ?>" required>

    <label>Số điện thoại</label>
    <input name="txtSDT" value="<?= $row['sodienthoai'] ?>" required>

    <label>Địa chỉ</label>
    <input name="txtDiaChi" value="<?= $row['diachi'] ?>">

    <label>Điểm tích lũy</label>
    <input name="txtDiem" value="<?= $row['diemtichluy'] ?>">

    <label>Tài khoản</label>
    <input name="txtTaikhoan" value="<?= $row['taikhoan'] ?>">

    <label>Điểm tích lũy</label>
    <input name="txtMatkhau" value="<?= $row['matkhau'] ?>">

    <button name="btnLuu">💾 Lưu</button>
    <a href="quanlykhachhang.php">⬅️ Quay lại</a>
</form>

</body>
</html>
