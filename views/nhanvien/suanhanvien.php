<?php 
   include_once("../connectdb.php"); 

   $textMaNhanVien = $_GET['manhanvien'];
   $sqlSeclectNhanVien = "SELECT * FROM nhanvien WHERE manhanvien='$textMaNhanVien'";
   $resultSelectNhanVien = mysqli_query($con, $sqlSeclectNhanVien);
   $rowNhanVien = mysqli_fetch_assoc($resultSelectNhanVien);

   if(isset($_POST['btnSua'])){
    $textMaNhanVien = $_POST['txtMaNhanVien'];
    $textTenNhanVien = $_POST['txtTenNhanVien'];
    $textNgaySinh =$_POST['txtNgaySinh'];
    $textGioiTinh= $_POST['selectGioiTinh'];
    $textDiaChi = $_POST['txtDiaChi'];
    $textSoDienThoai = $_POST['txtSoDienThoai'];
    $textTaiKhoan = $_POST['txtTaiKhoan'];
    $textMatKhau =$_POST['txtMatKhau'];

    $sqlCapNhatNhanVien = "UPDATE nhanvien SET tennhanvien ='$textTenNhanVien' , ngaysinh= '$textNgaySinh',gioitinh='$textGioiTinh',diachi='$textDiaChi',sodienthoai='$textSoDienThoai',taikhoan='$textTaiKhoan',matkhau='$textMatKhau' WHERE manhanvien='$textMaNhanVien'";
    mysqli_query($con,$sqlCapNhatNhanVien);

    echo "<script> alert('Sửa thành công'); 
        window.location='quanlynhanvien.php';
    </script>";
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>suanhanvien</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>
<body>
    <form action="" method="POST" style="width: 500px; height: auto;">
        <h1>sửa nhân viên</h1>
        <br>
        <label for="txtMaNhanVien">Mã nhân viên</label>
        <input type="text" name="txtMaNhanVien" placeholder="Nhập mã nhân viên" value = "<?php echo  $rowNhanVien['manhanvien']  ?>" readonly>

        <br>
        <label for="txtTenNhanVien">Tên nhân viên</label>
        <input type="text" name="txtTenNhanVien" placeholder="Nhập tên nhân viên" value="<?php echo $rowNhanVien['tennhanvien'] ?>" required>

        <br>
        <label for="txtNgaySinh">Ngày sinh</label>
        <input type="date" name="txtNgaySinh" value="<?php echo $rowNhanVien['ngaysinh'] ?>" required>

        <br>
        <label for="slGioiTinh">Giới tính</label>
        <select name="selectGioiTinh" id="">
            <option value="Nam" <?php if($rowNhanVien['gioitinh'] == 'Nam') echo 'selected';?>>Nam</option>
            <option value="Nữ" <?php if($rowNhanVien['gioitinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
            <option value="Khác" <?php if($rowNhanVien['gioitinh'] == 'Khác') echo 'selected'; ?>>Khác</option>
        </select>

        <br>
        <label for="txtDiaChi">Địa chỉ</label>
        <input type="text" name="txtDiaChi" placeholder="Nhập địa chỉ" value="<?php echo $rowNhanVien['diachi'] ?>" required>

        <br>
        <label for="txtSoDienThoai">Số điện thoại</label>
        <input type="number" name="txtSoDienThoai" placeholder="Nhập số điện thoại" value="<?php echo $rowNhanVien['sodienthoai'] ?>" required>
        <br>

        <button name="btnSua" onclick="return confirm('bạn có chắc chắn muốn sửa')">Sửa</button>
        <button type="button" name="btnThoat" onclick="window.location = 'quanlynhanvien.php'" >Thoát</button>
    </form>
    
</body>
</html>