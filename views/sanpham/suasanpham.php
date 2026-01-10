<?php 
        include_once("../connectdb.php");
    $rowSP = [];
    if(isset($_GET['masanpham'])){
        $maSP = $_GET['masanpham'];
        $result = mysqli_query($con, "SELECT * FROM sanpham WHERE masanpham='$maSP'");
        if($result) $rowSP = mysqli_fetch_assoc($result);
    }

    $dsLoai = mysqli_query($con, "SELECT * FROM loaihang");
    $dsNCC = mysqli_query($con, "SELECT * FROM nhacungcap");

    if(isset($_POST['btnSua'])){
        $maSP = $_POST['txtMaSP']; 
        $tenSP = $_POST['txtTenSP'];
        $maLoai = $_POST['slMaLoai'];
        $maNCC = $_POST['slMaNCC'];
        $xuatXu = $_POST['txtXuatXu'];
        $soLuong = $_POST['txtSoLuong'];
        $ngaySX = $_POST['txtNgaySX'];
        $hanSD = $_POST['txtHanSD'];
        $tinhTrang = $_POST['slTinhTrang'];
        $giaNhap = $_POST['txtGiaNhap'];
        $giaBan = $_POST['txtGiaBan'];
        $dvt = $_POST['txtDVT'];

        $sqlUpdate = "UPDATE sanpham SET 
                      tensanpham='$tenSP', maloai='$maLoai', manhacungcap='$maNCC', 
                      xuatxu='$xuatXu', soluong='$soLuong', ngaysanxuat='$ngaySX', hansudung='$hanSD',
                      tinhtrang='$tinhTrang', gianhap='$giaNhap', giaban='$giaBan', donvitinh='$dvt'
                      WHERE masanpham='$maSP'";

        if(mysqli_query($con, $sqlUpdate)){
            echo "<script>alert('Sửa thành công'); window.location='quanlysanpham.php';</script>";
        } else {
            echo "<script>alert('Lỗi: " . mysqli_error($con) . "');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Sản Phẩm</title>
    <link rel="stylesheet" href="../../css/hanghoavakho.css">
    
    <style>
        .form-row { display: flex; gap: 10px; }
        .form-col { flex: 1; }
        select {
            width: 100%; padding: 10px;
            border: 1px solid #ddd; border-radius: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    
    <div class="card edit-container" style="max-width: 600px;"> <h2 style="text-align: center;">✏️ Sửa Thông Tin Sản Phẩm</h2>
        
        <form action="" method="post">
            
            <div class="form-group">
                <div class="form-row">
                    <div class="form-col" style="flex: 1;">
                        <label>Mã SP</label>
                        <input type="text" name="txtMaSP" value="<?php echo isset($rowSP['masanpham']) ? $rowSP['masanpham'] : ''; ?>" readonly>
                    </div>
                    <div class="form-col" style="flex: 2;">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="txtTenSP" value="<?php echo isset($rowSP['tensanpham']) ? $rowSP['tensanpham'] : ''; ?>" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="form-col">
                        <label>Loại hàng</label>
                        <select name="slMaLoai">
                            <?php while($row = mysqli_fetch_assoc($dsLoai)){ ?>
                                <option value="<?php echo $row['maloai']; ?>" 
                                    <?php if(isset($rowSP['maloai']) && $row['maloai'] == $rowSP['maloai']) echo "selected"; ?>>
                                    <?php echo $row['tenloai']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-col">
                        <label>Nhà cung cấp</label>
                        <select name="slMaNCC">
                            <?php while($row = mysqli_fetch_assoc($dsNCC)){ ?>
                                <option value="<?php echo $row['manhacungcap']; ?>" 
                                    <?php if(isset($rowSP['manhacungcap']) && $row['manhacungcap'] == $rowSP['manhacungcap']) echo "selected"; ?>>
                                    <?php echo $row['tennhacungcap']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="form-col">
                        <label>Xuất xứ</label>
                        <input type="text" name="txtXuatXu" value="<?php echo isset($rowSP['xuatxu']) ? $rowSP['xuatxu'] : ''; ?>">
                    </div>
                    <div class="form-col">
                        <label>Tình trạng</label>
                        <select name="slTinhTrang">
                            <option value="Tốt" <?php if(isset($rowSP['tinhtrang']) && $rowSP['tinhtrang'] == 'Tốt') echo "selected"; ?>>Tốt</option>
                            <option value="Đã hết hạn" <?php if(isset($rowSP['tinhtrang']) && $rowSP['tinhtrang'] != 'Tốt') echo "selected"; ?> style="color:red">Đã hết hạn</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="form-col">
                        <label>Ngày sản xuất</label>
                        <input type="date" name="txtNgaySX" value="<?php echo isset($rowSP['ngaysanxuat']) ? $rowSP['ngaysanxuat'] : ''; ?>">
                    </div>
                    <div class="form-col">
                        <label>Hạn sử dụng</label>
                        <input type="date" name="txtHanSD" value="<?php echo isset($rowSP['hansudung']) ? $rowSP['hansudung'] : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="form-col">
                        <label>Giá nhập</label>
                        <input type="number" name="txtGiaNhap" value="<?php echo isset($rowSP['gianhap']) ? $rowSP['gianhap'] : ''; ?>">
                    </div>
                    <div class="form-col">
                        <label>Giá bán</label>
                        <input type="number" name="txtGiaBan" value="<?php echo isset($rowSP['giaban']) ? $rowSP['giaban'] : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="form-col">
                        <label>Số lượng</label>
                        <input type="number" name="txtSoLuong" value="<?php echo isset($rowSP['soluong']) ? $rowSP['soluong'] : ''; ?>">
                    </div>
                    <div class="form-col">
                        <label>Đơn vị tính</label>
                        <input type="text" name="txtDVT" value="<?php echo isset($rowSP['donvitinh']) ? $rowSP['donvitinh'] : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="btn-group">
                <button name="btnSua" class="btn btn-save" onclick="return confirm('Lưu thay đổi?')">💾 Lưu Cập Nhật</button>
                <button type="button" class="btn btn-cancel" onclick="window.location = 'quanlysanpham.php'">↩️ Thoát</button>
            </div>

        </form>
    </div>

</body>
</html>