<?php
include_once("./connectdb.php");

if (isset($_POST['btnDangnhap'])) {
    $textTaiKhoan = $_POST['txtTaiKhoan'];
    $textMatKhau = $_POST['txtMatKhau'];
    $selectTaiKhoan = "SELECT * FROM nhanvien WHERE taikhoan = '$textTaiKhoan' and matkhau = '$textMatKhau'";
    $resultSelectTaiKhoan = mysqli_query($con, $selectTaiKhoan);

    if ((mysqli_num_rows($resultSelectTaiKhoan) > 0)) {
        header("Location: menu.php");
        exit;
    } else {
        echo "<script> alert ('tài khoản hoặc mật khẩu không chính xác'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../css/themsuaxoatimkiem.css">
</head>

<body>
    <form action="" method="POST">
        <label for="txtTaiKhoan">Tài khoản</label>
        <input type="text" name="txtTaiKhoan" required>
        <br>

        <label for="txtMatKhau">Mật khẩu</label>
        <input type="text" name="txtMatKhau" required>
        <br>

        <button name="btnDangnhap">đăng nhập</button>
    </form>

</body>

</html>