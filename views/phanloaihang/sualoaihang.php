<?php 
   include_once("../connectdb.php"); 

   // Lấy mã từ URL
   if(isset($_GET['maloaihang'])){
       $textMaLoaiHang = $_GET['maloaihang'];
       $sqlSelect = "SELECT * FROM loaihang WHERE maloaihang='$textMaLoaiHang'";
       $resultSelect = mysqli_query($con, $sqlSelect);
       $rowLoaiHang = mysqli_fetch_assoc($resultSelect);
   }

   // Xử lý cập nhật
   if(isset($_POST['btnSua'])){
    $textMaLoaiHang = $_POST['txtMaLoaiHang'];
    $textTenLoaiHang = $_POST['txtTenLoaiHang'];

    $sqlUpdate = "UPDATE loaihang SET tenloaihang ='$textTenLoaiHang' WHERE maloaihang='$textMaLoaiHang'";
    mysqli_query($con, $sqlUpdate);

    echo "<script> alert('Sửa thành công'); 
        window.location='quanlyloaihang.php';
    </script>";
   }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa loại hàng</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>
<body>
    <form action="" method="POST" style="width: 500px; height: auto;">
        <h1>Sửa loại hàng</h1>
        <br>
        <label for="txtMaLoaiHang">Mã loại hàng</label>
        <input type="text" name="txtMaLoaiHang" value="<?php echo isset($rowLoaiHang['maloaihang']) ? $rowLoaiHang['maloaihang'] : ''; ?>" readonly>

        <br>
        <label for="txtTenLoaiHang">Tên loại hàng</label>
        <input type="text" name="txtTenLoaiHang" value="<?php echo isset($rowLoaiHang['tenloaihang']) ? $rowLoaiHang['tenloaihang'] : ''; ?>" required>

        <br>
        <button name="btnSua" onclick="return confirm('Bạn có chắc chắn muốn sửa?')">Lưu Sửa</button>
        <button type="button" name="btnThoat" onclick="window.location = 'quanlyloaihang.php'" style="background-color: #ff6b6b;">Thoát</button>
    </form>
</body>
</html>