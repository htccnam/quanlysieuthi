<?php 
$con= mysqli_connect('localhost',"root" , null , "quanlysieuthi");
if ($con->connect_error) {
    die("Kết nối thất bại: " . $con->connect_error);
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $Madonhang = $_POST["Madonhang"];
    $Makhachhang = $_POST["Makhachhang"];
    $Manhanvien = $_POST["Manhanvien"];
    $Masanpham = $_POST["Masanpham"];
    $Soluong = $_POST["Soluong"];
    $Dongia = $_POST["Dongia"];
    $Thanhtien = $Soluong * $Dongia;

    $sqlkh = "SELECT makhachhang, tenkhachhang FROM khachhang";
    $resultkh = $con->query($sqlkh);

    $sqlnv = "SELECT manhanvien, tennhanvien FROM nhanvien";
    $resultnv = $con->query($sqlnv);

    $sqlsp = "SELECT masanpham, tensanpham FROM sanpham";
    $resultsp = $con->query($sqlsp);

    $sql = "INSERT INTO donhang(madonhang, makhachhang, manhanvien) VALUES ('$Madonhang','$Makhachhang', '$Manhanvien')";
    $sql1 = "INSERT INTO chitietdonhang VALUES ('$Madonhang','$Masanpham', $Soluong, $Dongia, $Thanhtien)";
    $result = $con->query($sql);
    $result1 = $con->query($sql1);
}
?>


<!DOCTYPE html>
<html lang="vi">

    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <style>
            html, body { 
                font-family: 'Roboto', sans-serif;
                justify-content: center;
                align-items: center;
                margin: 20px;
                height: 100vh;
            }

            form{
                background: #fff;
                width: 1300px;
                margin: 50px auto;
                padding: 20px 30px;
                border-radius: 8px;
                gap: 40px;
                display: flex;       
                flex-wrap: wrap;
                justify-content: space-evenly;         
                box-shadow: 0 0 20px rgba(0,0,0,0.15);
            }

            input{
                width: 400px;
                padding: 10px;
                border: 1px solid black;
                border-radius: 4px;
            }  
            
            select{
                width: 420px;
                padding: 10px;
                border: 1px solid black;
                border-radius: 4px;  
            }

            h2{
                display: block;
                width: 100%;
                height: fit-content;
                text-align: center;
            }

            button{
                background-color: greenyellow;
                width: 400px;
                padding: 10px;
                border: 1px solid black;
                border-radius: 4px;  
            }    
        </style>
    </head>

    <body>
        <form method="post">
            <h2>NHẬP THÔNG TIN ĐƠN HÀNG</h2>
            <input type="text" name="Madonhang" placeholder="Nhập mã đơn hàng*" required>
            <select name="Makhachhang">
                <option value="">--chọn khách hàng--</option>
                <?php 
                    if($resultkh->num_rows > 0){
                        while($row = $resultkh->fetch_assoc()){
                            echo "<option value = '" . $row["makhachhang"] . "'>" . $row["tenkhachhang"] . "</option>";
                        }
                    }                
                ?>
            </select>
            <select name="Manhanvien">
                <option value="">--Chọn nhân viên--</option>
                <?php 
                    if($resultnv->num_rows > 0){
                        while($row = $resultnv->fetch_assoc()){
                            echo "<option value = '" . $row["manhanvien"] . "'>" . $row["tennhanvien"] . "</option>";
                        }
                    }                
                ?>
            </select>
            <select name="Masanpham">
                <option value="">--Chọn sản phẩm--</option>
                <?php 
                    if($resultsp->num_rows > 0){
                        while($row = $resultsp->fetch_assoc()){
                            echo "<option value = '" . $row["masanpham"] . "'>" . $row["tensanpham"] . "</option>";
                        }
                    }                
                ?>
            </select>
            <input type="number" name="Soluong" placeholder="Nhập số lượng*" required>
            <input type="number" name="Dongia" placeholder="Nhập giá bán*" required>           
            <button type="submit">Thêm</button>
        </form>
    </body>
</html>