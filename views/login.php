<?php

include_once("./connectdb.php");
session_start();

if (isset($_POST['btnDangnhap'])) {
    $textTaiKhoan = $_POST['txtTaiKhoan'];
    $textMatKhau = $_POST['txtMatKhau'];
    $selectTaiKhoan = "SELECT * FROM khachhang WHERE taikhoan = '$textTaiKhoan' and matkhau = '$textMatKhau'";
    $resultSelectTaiKhoan = mysqli_query($con, $selectTaiKhoan);
    $rowresult = mysqli_fetch_assoc($resultSelectTaiKhoan);

    if ((mysqli_num_rows($resultSelectTaiKhoan) > 0)) {
         // ⭐ BẮT BUỘC PHẢI CÓ
        $_SESSION['makhachhang'] = $row['makhachhang'];
        $_SESSION['tenkhachhang'] = $row['tenkhachhang'];

        if ($rowresult['taikhoan'] == "admin" && $rowresult['matkhau'] = "admin") {
            header("Location:menu_admin.php");
            exit;
        } else {
            header("Location:../khachhangviews/menu_khachhang.php");
            exit;
        }
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
    <!-- <link rel="stylesheet" href="../css/themsuaxoatimkiem.css"> -->
     <link rel="stylesheet" href="../css/dinhdang1.css">
</head>

<body>
    <form action="" method="POST" style="height: 300px;width: 500px; margin-top: 100px; margin: 50px auto;" class="formnhap">
        <label for="txtTaiKhoan">Tài khoản</label>
        <input type="text" name="txtTaiKhoan" required>
        <br>

        <label for="txtMatKhau">Mật khẩu</label>
        <input type="text" name="txtMatKhau" required>
        <br>

        <button name="btnDangnhap" class="buttonThem">đăng nhập</button>
    </form>

</body>

</html>