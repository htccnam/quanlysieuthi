<?php
include_once("../connectdb.php");

$textMaTinTuc = $_GET['matintuc'];
$resultSelectTinTuc = mysqli_query($con, "SELECT * FROM tintuc WHERE matintuc='$textMaTinTuc'");
$rowSelectTinTuc = mysqli_fetch_assoc($resultSelectTinTuc);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>suatintuc</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>

<body>
    <div>
        <form action="" method="POST" style="height: auto; width: 500px;">
            <label for="txtMaTinTuc">Mã tin tức</label>
            <input type="text" name="txtMaTinTuc" placeholder="Nhập mã tin tức"
                value="<?php echo $rowSelectTinTuc['matintuc'] ?>" readonly>
            <br>

            <label for="txtTieuDe">Tiêu đề</label>
            <input type="text" name="txtTieuDe" placeholder="Nhập tiêu đề"
                value="<?php echo $rowSelectTinTuc['tieude'] ?>" required>
            <br>

            <label for="selectMaNhanVien">Mã nhân viên tạo tin tức</label>
            <select name="selectMaNhanVien">
                <?php
                $sqlSelectNhanVien = "SELECT manhanvien, tennhanvien FROM nhanvien";
                $resultSelectNhanVien = mysqli_query($con, $sqlSelectNhanVien);

                while ($row = mysqli_fetch_assoc($resultSelectNhanVien)) {
                    $selected = ($row['manhanvien'] == $rowSelectTinTuc['manhanvien']) ? "selected" : "";
                    echo "<option value='{$row['manhanvien']}' $selected>  
                    {$row['manhanvien']} - {$row['tennhanvien']}
          </option>";
                }
                ?>

            </select>
            <br>

            <label for="txtNoiDung">Nội dung</label>
            <textarea name="txtNoiDung" id="" placeholder="Nhập nội dung"
                style="height=60px ;width: 500px;"><?php echo $rowSelectTinTuc['noidung'] ?></textarea>
            <br>

            <label for="selectLoaiTin">Loại tin</label>
            <select name="selectLoaiTin" id="">
                <option value="Khuyến mại" <?php if ($rowSelectTinTuc['loaitin'] == 'Khuyến mại') {
                    echo 'selected';
                } ?>>
                    Khuyến mại</option>
                <option value="Thông báo" <?php if ($rowSelectTinTuc['loaitin'] == 'Thông báo') {
                    echo 'selected';
                } ?>>Thông
                    báo</option>
                <option value="Tuyển dụng" <?php if ($rowSelectTinTuc['loaitin'] == 'Tuyển dụng') {
                    echo 'selected';
                } ?>>
                    Tuyển dụng</option>
                <option value="Khác" <?php if ($rowSelectTinTuc['loaitin'] == 'Khác') {
                    echo 'selected';
                } ?>>Khác</option>
            </select>
            <br>

            <label for="dtNgayDang">Ngày thêm tin</label>
            <input type="date" name="dtNgayDang" value="<?php echo $rowSelectTinTuc['ngaydang'] ?>" required>
            <br>

            <div>
                <button type="submit" name="btnThem">Sửa</button>
                <button type="button" onclick="window.location='tintuc.php'">Thoát</button>
            </div>
        </form>
    </div>
</body>

</html>