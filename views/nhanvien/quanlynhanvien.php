<?php
include_once("../connectdb.php");

if (isset($_POST['btnThem'])) {
    $textMaNhanVien = $_POST['txtMaNhanVien'];
    $textTenNhanVien = $_POST['txtTenNhanVien'];
    $textNgaySinh = $_POST['txtNgaySinh'];
    $textGioiTinh = $_POST['selectGioiTinh'];
    $textDiaChi = $_POST['txtDiaChi'];
    $textSoDienThoai = $_POST['txtSoDienThoai'];
    $textTaiKhoan = $_POST['txtTaiKhoan'];
    $textMatKhau = $_POST['txtMatKhau'];

    $textCheckMaNhanVien = mysqli_query($con, "SELECT manhanvien FROM nhanvien WHERE manhanvien='$textMaNhanVien'");
    if (mysqli_num_rows($textCheckMaNhanVien) > 0) {
        echo "<script> alert ('mã nhân viên đã tồn tại'); </script>";
    } else {
        $sqlInsertNhanVien = "INSERT INTO nhanvien VALUES ('$textMaNhanVien','$textTenNhanVien','$textNgaySinh','$textGioiTinh','$textDiaChi','$textSoDienThoai','$textTaiKhoan','$textMatKhau')";
        try {
            mysqli_query($con, $sqlInsertNhanVien);
            echo "<script> alert('thêm thành công'); </script>";

        } catch (mysqli_sql_exception) {
            echo "<script> alert('Lỗi insert'); </script>";
        }
    }

}

if (isset($_GET['btnXoa'])) {
    $textMaNhanVienForm = $_GET['manhanvien'];
    $sqlDelete = "DELETE FROM nhanvien WHERE manhanvien = '$textMaNhanVienForm'";
    mysqli_query($con, $sqlDelete);
    echo "<script> alert('xóa thành công');
        window.location='quanlynhanvien.php';
    </script>";
}

if (isset($_POST['btnTimKiem'])) {
    $textTimKiem = $_POST['txtTimKiem'];
} else {
    $textTimKiem = "";
}
$sqlTimKiem = "SELECT * FROM nhanvien WHERE
            manhanvien LIKE'%$textTimKiem%' OR tennhanvien LIKE '%$textTimKiem%'";
$resultTimKiem = mysqli_query($con, $sqlTimKiem);
if (mysqli_num_rows($resultTimKiem) == 0) {
    echo "<script> alert('không có nhân viên'); </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quanlynhanvien</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>

<body>
    <div style="display: flex;">
        <form action="" method="POST" style="width: 500px; height: auto;">
            <h1>quản lý nhân viên</h1>
            <br>
            <label for="txtMaNhanVien">Mã nhân viên</label>
            <input type="text" name="txtMaNhanVien" placeholder="Nhập mã nhân viên" required>

            <br>
            <label for="txtTenNhanVien">Tên nhân viên</label>
            <input type="text" name="txtTenNhanVien" placeholder="Nhập tên nhân viên" required>

            <br>
            <label for="txtNgaySinh">Ngày sinh</label>
            <input type="date" name="txtNgaySinh" required>

            <br>
            <label for="selectGioiTinh">Giới tính</label>
            <select name="selectGioiTinh" id="">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Khác">Khác</option>
            </select>

            <br>
            <label for="txtDiaChi">Địa chỉ</label>
            <input type="text" name="txtDiaChi" placeholder="Nhập địa chỉ" required>

            <br>
            <label for="txtSoDienThoai">Số điện thoại</label>
            <input type="number" name="txtSoDienThoai" placeholder="Nhập số điện thoại" required>
            <br>

            <label for="txtTaiKhoan">Tài khoản</label>
            <input type="text" name="txtTaiKhoan" placeholder="Nhập tài khoản" required>
            <br>

            <label for="txtMatKhau">Mật khẩu</label>
            <input type="text" name="txtMatKhau" placeholder="Nhập mật khẩu" required>
            <br>

            <button name="btnThem">➕ Thêm</button>
        </form>
        <form action="" method="POST" style="display: flex;  width: 300px; height: 70px;">
            <input type="text" name="txtTimKiem" placeholder="vui lòng nhập mã hoặc tên để tìm kiếm">
            <button name="btnTimKiem">Tìm kiếm</button>
        </form>
    </div>
    <table>
        <thead>
            <th>manhanvien</th>
            <th>tennhanvien</th>
            <th>ngaysinh</th>
            <th>gioitinh</th>
            <th>diachi</th>
            <th>sodienthoai</th>
            <th>taikhoan</th>
            <th>matkhau</th>
            <th>thaotac</th>
        </thead>
        <tbody>
            <?php
            if ($resultTimKiem && mysqli_num_rows($resultTimKiem) > 0) {
                while ($row = mysqli_fetch_assoc($resultTimKiem)) {
                    echo "<tr>";
                    echo "<td>" . $row['manhanvien'] . "</td>";
                    echo "<td>" . $row['tennhanvien'] . "</td>";
                    echo "<td>" . $row['ngaysinh'] . "</td>";
                    echo "<td>" . $row['gioitinh'] . "</td>";
                    echo "<td>" . $row['diachi'] . "</td>";
                    echo "<td>" . $row['sodienthoai'] . "</td>";
                    echo "<td>" . $row['taikhoan'] . "</td>";
                    echo "<td>" . $row['matkhau'] . "</td>";

                    echo "<td>";
                    echo "<a href='suanhanvien.php?manhanvien=" . $row['manhanvien'] . "' target = 'contentFrame'>sửa</a>";
                    echo "<a href='?btnXoa=1&manhanvien=" . $row['manhanvien'] . "' name='btnXoa' onclick=\"return confirm('bạn có chắc chắn muốn xóa?')\">xóa</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

</body>

</html>