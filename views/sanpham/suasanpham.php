<?php 
    include_once("../../connectdb.php");
    
    // Lấy dữ liệu cũ
    $rowSP = [];
    if(isset($_GET['masanpham'])){
        $maSP = $_GET['masanpham'];
        $result = mysqli_query($con, "SELECT * FROM sanpham WHERE masanpham='$maSP'");
        $rowSP = mysqli_fetch_assoc($result);
    }

    // Lấy dropdown
    $dsLoaiHang = mysqli_query($con, "SELECT * FROM loaihang");
    $dsThuongHieu = mysqli_query($con, "SELECT * FROM thuonghieu");

    // --- XỬ LÝ CẬP NHẬT (Đơn giản hóa) ---
    if(isset($_POST['btnSua'])){
        $maSP = $_POST['txtMaSP'];
        $tenSP = $_POST['txtTenSP'];
        $maLoai = $_POST['slMaLoai'];
        $maTH = $_POST['slMaThuongHieu'];
        $soLuong = $_POST['txtSoLuong'];
        $giaNhap = $_POST['txtGiaNhap'];
        $giaBan = $_POST['txtGiaBan'];
        $dvt = $_POST['txtDVT'];

        // Câu lệnh Update không còn dính dáng đến hinhanh
        $sqlUpdate = "UPDATE sanpham SET tensanpham='$tenSP', maloaihang='$maLoai', mathuonghieu='$maTH', 
                      soluong='$soLuong', gianhap='$giaNhap', giaban='$giaBan', donvitinh='$dvt'
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
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>
<body>
    <form action="" method="post" style="width: 500px; margin: 20px auto;">
        <h1>Sửa sản phẩm</h1>
        
        <label>Mã sản phẩm (Không sửa)</label>
        <input type="text" name="txtMaSP" value="<?php echo $rowSP['masanpham']; ?>" readonly style="background: #eee;">

        <label>Tên sản phẩm</label>
        <input type="text" name="txtTenSP" value="<?php echo $rowSP['tensanpham']; ?>" required>

        <div style="display:flex; gap:10px;">
            <div style="width:50%;">
                <label>Loại hàng</label>
                <select name="slMaLoai" style="width:100%; padding: 10px;">
                    <?php while($lh = mysqli_fetch_assoc($dsLoaiHang)){ ?>
                        <option value="<?php echo $lh['maloaihang']; ?>" 
                            <?php if($lh['maloaihang'] == $rowSP['maloaihang']) echo "selected"; ?>>
                            <?php echo $lh['tenloaihang']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div style="width:50%;">
                <label>Thương hiệu</label>
                <select name="slMaThuongHieu" style="width:100%; padding: 10px;">
                    <?php while($th = mysqli_fetch_assoc($dsThuongHieu)){ ?>
                        <option value="<?php echo $th['mathuonghieu']; ?>" 
                            <?php if($th['mathuonghieu'] == $rowSP['mathuonghieu']) echo "selected"; ?>>
                            <?php echo $th['tenthuonghieu']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <br>

        <label>Số lượng</label>
        <input type="number" name="txtSoLuong" value="<?php echo $rowSP['soluong']; ?>">

        <label>Đơn vị tính</label>
        <input type="text" name="txtDVT" value="<?php echo $rowSP['donvitinh']; ?>">

        <div style="display:flex; gap:10px;">
            <input type="number" name="txtGiaNhap" value="<?php echo $rowSP['gianhap']; ?>" placeholder="Giá nhập">
            <input type="number" name="txtGiaBan" value="<?php echo $rowSP['giaban']; ?>" placeholder="Giá bán">
        </div>

        <br>
        <button name="btnSua" onclick="return confirm('Lưu thay đổi?')">Lưu Sửa</button>
        <button type="button" onclick="window.location='quanlysanpham.php'" style="background: #ff6b6b;">Hủy</button>
    </form>
</body>
</html>