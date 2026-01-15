<?php

include_once("../connectdb.php");

if (isset($_POST['btnSua'])) {
    $textMaChucVu = $_POST['txtMaChucVu'];
    $textTenChucVu = $_POST['txtTenChucVu'];

    try {
        $sqlUpdate = "update chucvu set tenchucvu='$textTenChucVu' where machucvu='$textMaChucVu'";
        mysqli_execute_query($con, $sqlUpdate);
        echo "<script> alert('Sửa thành công');
                        window.location='quanlychucvu.php'; 
                        </script>";

    } catch (Exception $e) {
        echo "<script> alert('lỗi sửa chức vụ'+$e->getMessage()) </script>";
    }

}

if(isset($_POST['btnThoat'])){
    echo "<script> window.location='quanlychucvu.php' </script>";
}

$textMaChucVu = $_GET['machucvu'];
$sqlSelectChucVu = "select * from chucvu where machucvu='$textMaChucVu'";
$result = mysqli_execute_query($con, $sqlSelectChucVu);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
    <title>Suachucvu</title>
</head>

<body>
    <form action="" method="post">
        <h1>Sửa chức vụ</h1>
        <br>
        <label for="txtMaChucVu">Mã chức vụ</label>
        <input type="text" name="txtMaChucVu" placeholder="Nhập mã chức vụ" class="highlight" value="<?php echo $row['machucvu'] ?>"
            readonly>
        <br>
        <label for="txtTenChucVu">Tên chức vụ</label>
        <input type="text" name="txtTenChucVu" placeholder="Nhập tên chức vụ" value="<?php echo $row['tenchucvu'] ?>"
            required>
        <br>
        <button name="btnSua" onclick="return confirm('Xác nhận thông tin sửa')">Sửa</button>
        <button name="btnThoat" onclick="return confirm('Những thao tác hiện tại sẽ mất')">Thoát</button>
    </form>
</body>

</html>