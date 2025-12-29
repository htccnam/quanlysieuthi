<?php
include_once("../connectdb.php");

/* ========== THÊM KHÁCH HÀNG ========== */
if (isset($_POST['btnThem'])) {
    $makh = $_POST['txtMaKH'];
    $tenkh = $_POST['txtTenKH'];
    $sdt = $_POST['txtSDT'];
    $diachi = $_POST['txtDiaChi'];
    $diem = $_POST['txtDiem'];

    $check = mysqli_query($con, "SELECT makhachhang FROM khachhang WHERE makhachhang='$makh'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Mã khách hàng đã tồn tại');</script>";
    } else {
        $sql = "INSERT INTO khachhang VALUES 
        ('$makh','$tenkh','$sdt','$diachi','$diem',NULL,NULL)";
        mysqli_query($con, $sql);
        echo "<script>alert('Thêm thành công');</script>";
    }
}

/* ========== XÓA KHÁCH HÀNG ========== */
if (isset($_GET['makhachhang'])) {
    $makh = $_GET['makhachhang'];
    mysqli_query($con, "DELETE FROM khachhang WHERE makhachhang='$makh'");
    echo "<script>alert('Xóa thành công'); window.location='quanlykhachhang.php';</script>";
}

/* ========== TÌM KIẾM ========== */
$timkiem = $_POST['txtTimKiem'] ?? "";
$sqlSelect = "SELECT * FROM khachhang
              WHERE makhachhang LIKE '%$timkiem%'
              OR tenkhachhang LIKE '%$timkiem%'
              OR sodienthoai LIKE '%$timkiem%'";
$result = mysqli_query($con, $sqlSelect);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý khách hàng</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>

<body>

    <h2>QUẢN LÝ KHÁCH HÀNG</h2>

    <form method="POST" style="width:450px">
        <label>Mã KH</label>
        <input name="txtMaKH" required>

        <label>Tên KH</label>
        <input name="txtTenKH" required>

        <label>SĐT</label>
        <input name="txtSDT" required>

        <label>Địa chỉ</label>
        <input name="txtDiaChi">

        <label>Điểm tích lũy</label>
        <input name="txtDiem" value="0">

        <button name="btnThem">➕ Thêm</button>
    </form>

    <form method="POST" style="margin-top:10px">
        <input name="txtTimKiem" placeholder="Tìm mã / tên / SĐT">
        <button>Tìm</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>MÃ KH</th>
                <th>TÊN KH</th>
                <th>SĐT</th>
                <th>ĐỊA CHỈ</th>
                <th>ĐIỂM</th>
                <th>TÀI KHOẢN</th>
                <th>MẬT KHẨU</th>
                <th>THAO TÁC</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['makhachhang'] ?></td>
                    <td><?= $row['tenkhachhang'] ?></td>
                    <td><?= $row['sodienthoai'] ?></td>
                    <td><?= $row['diachi'] ?></td>
                    <td><?= $row['diemtichluy'] ?></td>
                    <td><?= $row['taikhoan'] ?></td>
                    <td><?= $row['matkhau'] ?></td>
                    <td>
                        <a href="suakhachhang.php?makhachhang=<?= $row['makhachhang'] ?>">✏️ sửa</a>
                        |
                        <a onclick="return confirm('Xóa khách hàng?')" href="?makhachhang=<?= $row['makhachhang'] ?>">➖
                            xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>