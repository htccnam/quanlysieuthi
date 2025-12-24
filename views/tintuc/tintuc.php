<?php
include_once("../connectdb.php");

if (isset($_POST['btnThem'])) {
    $textMaTinTuc = $_POST['txtMaTinTuc'];
    $textTieuDe = $_POST['txtTieuDe'];
    $textMaNhanVien = $_POST['selectMaNhanVien'];
    $textNoiDung = $_POST['txtNoiDung'];
    $textLoaiTin = $_POST['selectLoaiTin'];
    $dateNgayDang = $_POST['dtNgayDang'];

    $textCheck = mysqli_query($con, "SELECT matintuc FROM tintuc WHERE matintuc = '$textMaTinTuc'");
    if (mysqli_num_rows($textCheck) > 0) {
        echo "<script> alert('Mã nhân viên đã tồn tại'); </script>";
    } else {
        $sqlThemTinTuc = "INSERT INTO tintuc VALUES ('$textMaTinTuc','$textTieuDe','$textMaNhanVien','$textNoiDung','$textLoaiTin','$dateNgayDang')";

        try {
            mysqli_query($con, $sqlThemTinTuc);
            echo "<script> alert('Thêm thành công'); </script>";
        } catch (mysqli_sql_exception) {
            echo "<script> alert('Lỗi insert'); </script>";
        }

    }

}

$sqlSeclectTinTuc = "SELECT * FROM tintuc";
$resultSelectTinTuc = mysqli_query($con, $sqlSeclectTinTuc);

//lấy data nhanvien
$sqlSelectNhanVien = "SELECT manhanvien,tennhanvien FROM nhanvien";
$resultSelectNhanVien = mysqli_query($con, $sqlSelectNhanVien);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tintuc</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>

<body>
    <form action="" method="POSt" style="width: 500px; height: auto;">
        <label for="txtMaTinTuc">Mã tin tức</label>
        <input type="text" name="txtMaTinTuc" placeholder="Nhập mã tin tức" required>
        <br>

        <label for="txtTieuDe">Tiêu đề</label>
        <input type="text" name="txtTieuDe" placeholder="Nhập tiêu đề" required>
        <br>

        <label for="selectMaNhanVien">Mã nhân viên</label>
        <select name="selectMaNhanVien" id="">
            <?php
            if (mysqli_num_rows($resultSelectNhanVien) > 0) {
                while ($row = mysqli_fetch_assoc($resultSelectNhanVien)) {
                    echo "<option>" . $row['manhanvien'] . "</option>";
                }
            }
            ?>

        </select>
        <br>

        <label for="txtNoiDung">Nội dung</label>
        <textarea name="txtNoiDung" id="" placeholder="Nhập nội dung" style="height=60px ;width: 500px;"></textarea>
        <br>

        <label for="selectLoaiTin">Loại tin</label>
        <select name="selectLoaiTin" id="">
            <option value="Khuyến mại"> Khuyến mại</option>
            <option value="Thông báo">Thông báo</option>
            <option value="Tuyển dụng">Tuyển dụng</option>
            <option value="khuyến mại">Khuyến mại</option>
            <option value="Khác">Khác</option>
        </select>
        <br>

        <label for="dtNgayDang">Ngày thêm tin</label>
        <input type="date" name="dtNgayDang" required>
        <br>

        <button type="submit" name="btnThem">➕ Thêm</button>

    </form>
    <table>
        <thead>
            <th>MÃ TIN TỨC</th>
            <th>TIÊU ĐỀ</th>
            <th>MÃ NHÂN VIÊN</th>
            <th>NỘI DUNG</th>
            <th>LOẠI TIN</th>
            <th>NGÀY ĐĂNG</th>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($resultSelectTinTuc) > 0) {
                while ($row = mysqli_fetch_assoc($resultSelectTinTuc)) {
                    echo "<tr>";
                    echo "<td>" . $row['matintuc'] . "</td>";
                    echo "<td>" . $row['tieude'] . "</td>";
                    echo "<td>" . $row['manhanvien'] . "</td>";
                    echo "<td>" . $row['noidung'] . "</td>";
                    echo "<td>" . $row['loaitin'] . "</td>";
                    echo "<td>" . $row['ngaydang'] . "</td>";
                    echo "<tr>";
                }
            }

            ?>
        </tbody>
    </table>
</body>

</html>