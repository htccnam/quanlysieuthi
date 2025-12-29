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

    if (isset($_GET['matintuc'])) {
        try {
            $textMaTinTucXoa = $_GET['matintuc'];
            mysqli_query($con, "DELETE FROM tintuc WHERE matintuc='$textMaTinTucXoa'");
            echo "<script> alert('Xóa thành công');
                window.location='tintuc.php'</script>";
        } catch (mysqli_sql_exception) {
            echo "<script> alert('Lỗi lệnh delete'); </script>";
        }
    }

    //tìm kiếm vào lấy data
    if (isset($_POST['btnTimKiem'])) {
        $textTimKiem = $_POST['txtTimKiem'];
    } else {
        $textTimKiem = "";
    }

    try {
        $sqlSeclectTinTuc = "SELECT * FROM tintuc
                        WHERE matintuc LIKE '%$textTimKiem%' OR manhanvien LIKE '%$textTimKiem%'";
        $resultSelectTinTuc = mysqli_query($con, $sqlSeclectTinTuc);
    } catch (mysqli_sql_exception) {
        echo "<script> alert('Lỗi select bảng tin tức'); </script>";
    }


    $today = date('Y-m-d');
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
        <div style="display: flex;">
            <form action="" method="POSt" style="width: 500px; height: auto;">
                <label for="txtMaTinTuc">Mã tin tức</label>
                <input type="text" name="txtMaTinTuc" placeholder="Nhập mã tin tức" required>
                <br>

                <label for="txtTieuDe">Tiêu đề</label>
                <input type="text" name="txtTieuDe" placeholder="Nhập tiêu đề" required>
                <br>

                <label for="selectMaNhanVien">Mã nhân viên tạo tin tức</label>
                <select name="selectMaNhanVien" id="">
                    <?php
                    //lấy data nhanvien
                    $sqlSelectNhanVien = "SELECT manhanvien,tennhanvien FROM nhanvien";
                    $resultSelectNhanVien = mysqli_query($con, $sqlSelectNhanVien);
                    if (mysqli_num_rows($resultSelectNhanVien) > 0) {
                        while ($row = mysqli_fetch_assoc($resultSelectNhanVien)) {
                            echo "<option>" . $row['manhanvien'] . "</option>";
                        }
                    }
                    ?>

                </select>
                <br>

                <label for="txtNoiDung">Nội dung</label>
                <textarea name="txtNoiDung" id="" placeholder="Nhập nội dung" style="height:60px ;width: 500px;"></textarea>
                <br>

                <label for="selectLoaiTin">Loại tin</label>
                <select name="selectLoaiTin" id="">
                    <option value="Khuyến mại">Khuyến mại</option>
                    <option value="Thông báo">Thông báo</option>
                    <option value="Tuyển dụng">Tuyển dụng</option>
                    <option value="Khác">Khác</option>
                </select>
                <br>

                <label for="dtNgayDang">Ngày thêm tin</label>
                <input type="date" name="dtNgayDang" value="<?php echo "$today"; ?>" readonly>
                <br>

                <button type="submit" name="btnThem">➕ Thêm</button>

            </form>
            <form action="" method="POST" style="width: 450px;height: 70px; display: flex;">
                <input type="text" name="txtTimKiem" placeholder="Nhập mã tin tức hoặc nhập tên nhân viên để tìm">
                <button name="btnTimKiem">Tìm kiếm</button>
            </form>
        </div>
        <table>
            <thead>
                <th>MÃ TIN TỨC</th>
                <th>TIÊU ĐỀ</th>
                <th>MÃ NHÂN VIÊN</th>
                <th>NỘI DUNG</th>
                <th>LOẠI TIN</th>
                <th>NGÀY ĐĂNG</th>
                <th>THAO TÁC</th>
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
                        echo "<td>";
                        echo "<a href='suatintuc.php?matintuc=" . $row['matintuc'] . "'>sửa</a>";
                        echo "<a href='?matintuc=" . $row['matintuc'] . "' name='btnXoa' onclick=\"return confirm('bạn có chắc chắn muốn xóa');\" >➖xóa</a>";
                        echo "</td>";
                        echo "<tr>";
                    }
                }

                ?>
            </tbody>
        </table>
    </body>

    </html>