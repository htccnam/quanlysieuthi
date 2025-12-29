<?php 
    include_once("../connectdb.php");

    if(isset($_POST['btnThem'])){
        $txtMathuonghieu = $_POST['txtMathuonghieu'];
        $txtTenthuonghieu = $_POST['txtTenthuonghieu'];
        $txtDiachi = $_POST['txtDiachi'];

    $textCheckma = mysqli_query($con,"select mathuonghieu from thuonghieu where mathuonghieu = '$txtMathuonghieu'");
    if (mysqli_num_rows($textCheckma)>0){
        echo" <script> alert('Ma thuong hieu da ton tai');</script>";
    } else{
        $sqlInsert = "Insert into thuonghieu values ('$txtMathuonghieu','$txtTenthuonghieu',' $txtDiachi')";
        try{
            mysqli_query($con,$sqlInsert);
            echo "<script> alert('Thêm thành công'); </script>";

        }catch(mysqli_sql_exception){
            echo "<script> alert('Lỗi insert'); </script>";
        }
    }
    }
    if(isset($_GET['btnXoa'])){
        $txtMathuonghieuForm = $_GET['mathuonghieu'];
        $sqlDelete = "DELETE FROM thuonghieu WHERE mathuonghieu = '$txtMathuonghieuForm'";
        mysqli_query($con,$sqlDelete);
        echo "<script> alert('Xóa thành công');
        window.location='quanlythuonghieu.php';
    </script>";
    }
    if(isset($_POST['btnTimkiem'])){
        $txtTimKiem = $_POST['txtTimKiem'];
    }else{
        $txtTimKiem = "";
    }
    $sqlTimKiem = "SELECT * FROM thuonghieu WHERE
            mathuonghieu LIKE '%$txtTimKiem%' OR tenthuonghieu LIKE '%$txtTimKiem%'";
    $resultTimKiem = mysqli_query($con,$sqlTimKiem);
    if(mysqli_num_rows($resultTimKiem)==0){
        // echo "<script> alert('Không tìm thấy '); </script>";
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thuonghieu</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>
<body>
    <div style="display:flex">
        <form action="" method="post" style="width:500px; height:auto;">
        <h1> Quản lý thương hiệu</h1>
        <br>
        <label for="txtMathuonghieu">Mã thương hiệu</label>
        <input type="text" name="txtMathuonghieu" placeholder="nhap ma thuong hieu (vd:TH01)" required>
        <br>
        <label for="">Tên thương hiệu</label>
        <input type="text" name="txtTenthuonghieu" placeholder="Nhập tên thương hiệu" required>
        <br>
        <label for="">Địa chỉ</label>
        <input type="text" name="txtDiachi" placeholder="Nhập địa chỉ thương hiệu" required>
        <br>
        <button name="btnThem">➕ Thêm</button>
        </form>
        
        <form action="" method="post" style="display:flex; width:300px;height:70px">
            <input type="text" name="txtTimKiem" placeholder="Nhập mã hoặc tên để tìm">
            <button name="btnTimkiem">Tìm kiếm</button>
        </form>
    </div>
    <table>
        <thead>
            <th>Mã thương hiệu</th>
            <th>Tên thương hiệu</th>
            <th>Địa chỉ</th>
            <th>Thao tác</th>
        </thead>
        <tbody>
            <?php 
                // Kiểm tra và hiển thị dữ liệu
                if ($resultTimKiem && mysqli_num_rows($resultTimKiem) > 0) {
                    while($row = mysqli_fetch_assoc($resultTimKiem)){
                        echo "<tr>";
                        echo "<td>" . $row['mathuonghieu'] . "</td>";
                        echo "<td>" . $row['tenthuonghieu'] . "</td>";
                        echo "<td>" . $row['diachi'] . "</td>";
                        echo "<td>";
                        // Link sửa (Bạn cần tạo file suathuonghieu.php tương tự)
                        echo "<a href='suathuonghieu.php?mathuonghieu=".$row['mathuonghieu']."'>Sửa</a> | ";
                        // Link xóa
                        echo "<a href='?btnXoa=1&mathuonghieu=".$row['mathuonghieu']."' onclick=\"return confirm('Bạn có chắc muốn xóa?')\">Xóa</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' style='text-align:center'>Không tìm thấy dữ liệu</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>