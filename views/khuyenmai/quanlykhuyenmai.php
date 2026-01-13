<?php
include_once("../connectdb.php");

if (isset($_POST['btnThem'])) {
    $maKhuyenMai = $_POST['txtMaKhuyenMai'];
    $tenKhuyenMai = $_POST['txtTenKhuyenMai'];
    $moTa = $_POST['txtMoTa'];
    $soTienGiam = $_POST['txtSoTienGiam'];
    $ngayTao = $_POST['txtNgayTao'];

    $checkTrung = mysqli_execute_query($con, "select makhuyenmai from khuyenmai where makhuyenmai='$maKhuyenMai'");
    if (mysqli_num_rows($checkTrung) > 0) {
        echo "<script>alert('Mã khuyến mãi đã tồn tại')</script>";
    } else {
        $sqlInsert = "insert into khuyenmai values 
        ('$maKhuyenMai','$tenKhuyenMai','$moTa','$soTienGiam','$ngayTao')";
        mysqli_execute_query($con, $sqlInsert);
        echo "<script>alert('Thêm thành công')</script>";
    }
}

if (isset($_GET['btnXoa'])) {
    $maKhuyenMai = $_GET['makhuyenmai'];
    mysqli_execute_query($con, "delete from khuyenmai where makhuyenmai='$maKhuyenMai'");
    echo "<script>alert('Xóa thành công')</script>";
}

if (isset($_POST['btnTimKiem'])) {
    $tuKhoa = $_POST['txtTimKiem'];
} else {
    $tuKhoa = "";
}

$sqlSelect = "select * from khuyenmai 
              where makhuyenmai like '%$tuKhoa%' 
              or tenkhuyenmai like '%$tuKhoa%'";
$result = mysqli_execute_query($con, $sqlSelect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>quanlykhuyenmai</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>

<body>
    <div style="display:flex;">
        <form action="" method="post">
            <h1>Quản lý khuyến mãi</h1>
            <br>
            <label>Mã khuyến mãi</label>
            <input type="text" name="txtMaKhuyenMai" required>

            <label>Tên khuyến mãi</label>
            <input type="text" name="txtTenKhuyenMai" required>

            <label>Mô tả</label>
            <input type="text" name="txtMoTa">

            <label>Số tiền giảm</label>
            <input type="number" name="txtSoTienGiam" required>

            <label>Ngày tạo</label>
            <input type="date" name="txtNgayTao" required>

            <button name="btnThem">➕ Thêm</button>
        </form>

        <form action="" method="post">
            <input type="text" name="txtTimKiem">
            <button name="btnTimKiem">🔍 Tìm kiếm</button>
        </form>
    </div>

    <table>
        <thead>
            <th>Mã</th>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>Số tiền giảm</th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['makhuyenmai']}</td>";
                echo "<td>{$row['tenkhuyenmai']}</td>";
                echo "<td>{$row['mota']}</td>";
                echo "<td>{$row['sotiengiam']}</td>";
                echo "<td>{$row['ngaytao']}</td>";
                echo "<td>
                        <a href='suakhuyenmai.php?makhuyenmai={$row['makhuyenmai']}' target='contentFrame'>Sửa</a>
                        <a href='?btnXoa=1&makhuyenmai={$row['makhuyenmai']}' 
                           onclick=\"return confirm('Bạn có chắc chắn muốn xóa')\">Xóa</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
