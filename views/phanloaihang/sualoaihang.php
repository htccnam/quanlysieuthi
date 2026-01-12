<?php 
    include_once("../connectdb.php");
  
   $rowLoaiHang = [];
   if(isset($_GET['maloai'])){
       $textMaLoai = $_GET['maloai'];
       $sqlSelect = "SELECT * FROM loaihang WHERE maloai='$textMaLoai'";
       $resultSelect = mysqli_query($con, $sqlSelect);
       if($resultSelect) {
           $rowLoaiHang = mysqli_fetch_assoc($resultSelect);
       }
   }

   if(isset($_POST['btnSua'])){
        $textMaLoai = $_POST['txtMaLoai'];
        $textTenLoai = $_POST['txtTenLoai'];

        $sqlUpdate = "UPDATE loaihang SET tenloai ='$textTenLoai' WHERE maloai='$textMaLoai'";
        
        if(mysqli_query($con, $sqlUpdate)){
            echo "<script> alert('Sửa thành công'); 
                window.location='quanlyloaihang.php';
            </script>";
        } else {
            echo "<script>alert('Lỗi: ".mysqli_error($con)."');</script>";
        }
   }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa loại hàng</title>
    
    <link rel="stylesheet" href="../../css/sanpham.css">

</head>
<body>
    
    <div class="card edit-container">
        <h2 style="text-align: center;">✏️ Sửa Loại Hàng</h2>
        
        <form action="" method="POST">
            <div class="form-group">
                <label>Mã loại hàng</label>
                <input type="text" name="txtMaLoai" 
                       value="<?php echo isset($rowLoaiHang['maloai']) ? $rowLoaiHang['maloai'] : ''; ?>" 
                       readonly>
                <small style="color: #888; font-style: italic;">(Mã loại hàng không được phép sửa)</small>
            </div>

            <div class="form-group">
                <label>Tên loại hàng</label>
                <input type="text" name="txtTenLoai" 
                       value="<?php echo isset($rowLoaiHang['tenloai']) ? $rowLoaiHang['tenloai'] : ''; ?>" 
                       placeholder="Nhập tên mới..." required>
            </div>

            <div class="btn-group">
                <button name="btnSua" class="btn btn-save" onclick="return confirm('Lưu thay đổi?')">💾 Lưu Cập Nhật</button>
                <button type="button" class="btn btn-cancel" onclick="window.location = 'quanlyloaihang.php'">↩️ Thoát</button>
            </div>
        </form>
    </div>

</body>
</html>