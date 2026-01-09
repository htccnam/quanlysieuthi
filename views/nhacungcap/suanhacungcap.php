<?php 
    include_once("../connectdb.php");
  
   $rowNCC = []; 
   if(isset($_GET['manhacungcap'])){
       $txtMa = $_GET['manhacungcap'];
       $sqlSelect = "SELECT * FROM nhacungcap WHERE manhacungcap='$txtMa'";
       $resultSelect = mysqli_query($con, $sqlSelect);
       if($resultSelect && mysqli_num_rows($resultSelect) > 0) {
           $rowNCC = mysqli_fetch_assoc($resultSelect);
       }
   }
   if(isset($_POST['btnSua'])){
        $txtMa = $_POST['txtMa']; 
        $txtTen = $_POST['txtTen'];
        $txtLoai = $_POST['txtLoai'];
        $txtEmail = $_POST['txtEmail'];
        $txtSDT = $_POST['txtSDT'];
        $txtDiaChi = $_POST['txtDiaChi'];
        $sqlUpdate = "UPDATE nhacungcap SET 
                        tennhacungcap ='$txtTen',
                        loaihinh = '$txtLoai',
                        email = '$txtEmail',
                        sodienthoai = '$txtSDT',
                        diachi='$txtDiaChi' 
                      WHERE manhacungcap='$txtMa'";
        
        if(mysqli_query($con, $sqlUpdate)){
            echo "<script> alert('Sửa thành công'); 
                window.location='quanlynhacungcap.php';
            </script>";
        } else {
            echo "<script> alert('Lỗi: " . mysqli_error($con) . "'); </script>";
        }
   }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Nhà Cung Cấp</title>
    
    <link rel="stylesheet" href="../../css/hanghoavakho.css">
</head>
<body>
    
    <div class="card edit-container">
        <h2 style="text-align: center;">✏️ Sửa Nhà Cung Cấp</h2>
        
        <form action="" method="post">
            
            <div class="form-group">
                <label>Mã nhà cung cấp</label>
                <input type="text" name="txtMa" 
                       value="<?php echo isset($rowNCC['manhacungcap']) ? $rowNCC['manhacungcap'] : ''; ?>" 
                       readonly>
                <small style="color: #888; font-style: italic;">(Mã NCC không được phép sửa)</small>
            </div>

            <div class="form-group">
                <label>Tên nhà cung cấp</label>
                <input type="text" name="txtTen" 
                       value="<?php echo isset($rowNCC['tennhacungcap']) ? $rowNCC['tennhacungcap'] : ''; ?>" 
                       required>
            </div>

            <div class="form-group">
                <label>Loại hình</label>
                <input type="text" name="txtLoai" 
                       value="<?php echo isset($rowNCC['loaihinh']) ? $rowNCC['loaihinh'] : ''; ?>" 
                       required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" name="txtEmail" 
                       value="<?php echo isset($rowNCC['email']) ? $rowNCC['email'] : ''; ?>" 
                       required>
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="txtSDT" 
                       value="<?php echo isset($rowNCC['sodienthoai']) ? $rowNCC['sodienthoai'] : ''; ?>" 
                       required>
            </div>

            <div class="form-group">
                <label>Địa chỉ</label>
                <input type="text" name="txtDiaChi" 
                       value="<?php echo isset($rowNCC['diachi']) ? $rowNCC['diachi'] : ''; ?>" 
                       required>
            </div>

            <div class="btn-group">
                <button name="btnSua" class="btn btn-save" onclick="return confirm('Lưu thay đổi?')">💾 Lưu Cập Nhật</button>
                <button type="button" class="btn btn-cancel" onclick="window.location = 'quanlynhacungcap.php'">↩️ Thoát</button>
            </div>

        </form>
    </div>

</body>
</html>