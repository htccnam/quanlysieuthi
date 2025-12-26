<?php 
    include_once("../connectdb.php");
    if(isset($_GET['mathuonghieu'])){
         $txtMathuonghieu = $_GET['mathuonghieu'];
       $sqlSelect = "SELECT * FROM thuonghieu WHERE mathuonghieu='$txtMathuonghieu'";
       $resultSelect = mysqli_query($con, $sqlSelect);
       $rowthuonghieu = mysqli_fetch_assoc($resultSelect);
    }
    if(isset($_POST['btnSua'])){
    $txtMathuonghieu = $_POST['txtMathuonghieu'];
    $txtTenthuonghieu = $_POST['txtTenthuonghieu'];
    $txtDiachi = $_POST['txtDiachi'];

    $sqlUpdate = "UPDATE thuonghieu SET tenthuonghieu ='$txtTenthuonghieu',diachi='$txtDiachi' WHERE mathuonghieu='$txtMathuonghieu'";
    mysqli_query($con, $sqlUpdate);

    echo "<script> alert('Sửa thành công'); 
        window.location='quanlythuonghieu.php';
    </script>";
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thương hiệu</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>
<body>
    <form action="" method="post" style="width=500px;height: auto;">
        <h1>Sửa thương hiệu</h1>
        <br>
        <label for="" >Mã thương hiệu</label>
        <input type="text" name="txtMathuonghieu" placeholder="Ma thuong hieu" value ="<?php echo $rowthuonghieu['mathuonghieu']?>" readonly>
        <br>
        <label for="">Tên thương hiệu</label>
        <input type="text" name="txtTenthuonghieu" placeholder="Ten thuong hieu" value="<?php echo $rowthuonghieu['tenthuonghieu'] ?>" required>
        <br>
        <label for="">Địa chỉ</label>
        <input type="text" name="txtDiachi" placeholder="Dia chi" value="<?php echo $rowthuonghieu['diachi']?>" required>
        <br>
        <button name="btnSua" onclick="return confirm('Bạn có chắc chắn muốn sửa?')">Lưu sửa</button>
        <button type="button" name="btnThoat" onclick="window.location = 'quanlythuonghieu.php'" style="background-color: #ff6b6b;">Thoát</button>
    </form>
</body>
</html>