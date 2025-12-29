<?php
include_once("../connectdb.php");

// 1. XỬ LÝ THÊM LOẠI HÀNG
if (isset($_POST['btnThem'])) {
    $textMaLoaiHang = $_POST['txtMaLoaiHang'];
    $textTenLoaiHang = $_POST['txtTenLoaiHang'];

    // Kiểm tra trùng mã
    $textCheckMa = mysqli_query($con, "SELECT maloaihang FROM loaihang WHERE maloaihang='$textMaLoaiHang'");
    if (mysqli_num_rows($textCheckMa) > 0) {
        echo "<script> alert ('Mã loại hàng đã tồn tại'); </script>";
    } else {
        $sqlInsert = "INSERT INTO loaihang VALUES ('$textMaLoaiHang','$textTenLoaiHang')";
        try {
            mysqli_query($con, $sqlInsert);
            echo "<script> alert('Thêm thành công'); </script>";
        } catch (mysqli_sql_exception) {
            echo "<script> alert('Lỗi insert'); </script>";
        }
    }
}

// 2. XỬ LÝ XÓA LOẠI HÀNG
if (isset($_GET['btnXoa'])) {
    $textMaLoaiHangForm = $_GET['maloaihang'];
    // Xóa loại hàng
    $sqlDelete = "DELETE FROM loaihang WHERE maloaihang = '$textMaLoaiHangForm'";
    mysqli_query($con, $sqlDelete);
    echo "<script> alert('Xóa thành công');
        window.location='quanlyloaihang.php';
    </script>";
}

// 3. XỬ LÝ TÌM KIẾM
if (isset($_POST['btnTimKiem'])) {
    $textTimKiem = $_POST['txtTimKiem'];
} else {
    $textTimKiem = "";
}

$sqlTimKiem = "SELECT * FROM loaihang WHERE
            maloaihang LIKE'%$textTimKiem%' OR tenloaihang LIKE '%$textTimKiem%'";
$resultTimKiem = mysqli_query($con, $sqlTimKiem);

if (mysqli_num_rows($resultTimKiem) == 0) {
    // Nếu tìm không thấy thì echo cảnh báo (tùy chọn)
    // echo "<script> alert('Không tìm thấy loại hàng'); </script>";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý loại hàng</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>

<body>
    <div style="display: flex;">
        <form action="" method="POST" style="width: 500px; height: auto;">
            <h1>Quản lý loại hàng</h1>
            <br>
            <label for="txtMaLoaiHang">Mã loại hàng</label>
            <input type="text" name="txtMaLoaiHang" placeholder="Nhập mã loại hàng (VD: LH01)" required>

            <br>
            <label for="txtTenLoaiHang">Tên loại hàng</label>
            <input type="text" name="txtTenLoaiHang" placeholder="Nhập tên loại hàng" required>
            <br>

            <button name="btnThem">➕ Thêm</button>
        </form>

        <form action="" method="POST" style="display: flex; width: 300px; height: 70px;">
            <input type="text" name="txtTimKiem" placeholder="Nhập mã hoặc tên để tìm">
            <button name="btnTimKiem">Tìm kiếm</button>
        </form>
    </div>

    <table>
        <thead>
            <th>Mã loại hàng</th>
            <th>Tên loại hàng</th>
            <th>Thao tác</th>
        </thead>
        <tbody>
            <?php
            if ($resultTimKiem && mysqli_num_rows($resultTimKiem) > 0) {
                while ($row = mysqli_fetch_assoc($resultTimKiem)) {
                    echo "<tr>";
                    echo "<td>" . $row['maloaihang'] . "</td>";
                    echo "<td>" . $row['tenloaihang'] . "</td>";

                    echo "<td>";
                    echo "<a href='sualoaihang.php?maloaihang=" . $row['maloaihang'] . "' target='contentFrame'>Sửa</a> | ";
                    echo "<a href='?btnXoa=1&maloaihang=" . $row['maloaihang'] . "' name='btnXoa' onclick=\"return confirm('Bạn có chắc chắn muốn xóa?')\">Xóa</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' style='text-align:center;'>Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>