<?php
$con = mysqli_connect('localhost', "root", null, "quanlysieuthi");
if ($con->connect_error) {
    die("Kết nối thất bại: " . $con->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['repair'])){
        $Madonhang = $_POST["Madonhang"];
        $Makhachhang = $_POST["Makhachhang"];
        $Manhanvien = $_POST["Manhanvien"];
        $Masanpham = $_POST["Masanpham"];
        $Noinhanhang = $_POST["Noinhanhang"];
        $Trangthai = $_POST["Trangthai"];
        $Soluong = $_POST["Soluong"];
        $Dongia = $_POST["Dongia"];
        $Thanhtien = $_POST["Thanhtien"]; 
        $sql = "UPDATE donhang SET makhachhang='$Makhachhang', manhanvien='$Manhanvien', noinhanhang='$Noinhanhang', trangthai='$Trangthai' WHERE madonhang='$Madonhang'";
        $con->query($sql);
        $sql2 = "UPDATE chitietdonhang SET masanpham='$Masanpham', soluong='$Soluong', dongia='$Dongia', thanhtien='$Thanhtien' WHERE madonhang='$Madonhang'";
        $con->query($sql2);
    }
    
    if(isset($_POST['remove'])){
        $Madonhang = $_POST["Madonhang"];
        $sql = "DELETE FROM donhang WHERE madonhang='$Madonhang'";
        $sql1= "DELETE FROM chitietdonhang WHERE madonhang='$Madonhang'";
        $con->query($sql1);
        $con->query($sql);
    }
}

$sqltb = "SELECT * FROM donhang;";
$resulttb = $con->query($sqltb);
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        html,
        body {
            font-family: 'Roboto', sans-serif;
        }

        table {
            border-collapse: collapse;
            border-radius: 5px 5px 5px 5px;
            width: 1100px;
            margin: 50px auto;
            min-width: 400px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        thead tr {
            background-color: greenyellow;
            text-align: left;
        }

        th,
        td {
            max-width: 150px;
            padding: 10px;
            text-align: left;
            overflow: hidden;
        }

        tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        tbody tr:nth-of-type(even) {
            background-color: #f3f3f3ff;
        }

        tbody tr:last-of-type {
            border-bottom: 2px solid #7ae043ff;
        }

        [popover] {
            position: relative;
            width: 300px;
            margin: 30px auto;
            padding: 20px 30px;
            border-radius: 8px;
            border: 1px solid black;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .ppvcontent {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        ::backdrop {
            background: rgba(0, 0, 0, 0.5);
        }

        .ppvcontent input {
            width: 200px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 4px;
        }

        .ppvcontent select {
            width: 225px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 4px;
        }

        .ppvcontent button {
            margin-top: 10px;
            background-color: greenyellow;
            width: 150px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Mã khách hàng</th>
                <th>Mã nhân viên</th>
                <th>Ngày lập</th>
                <th>Nơi nhận hàng</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resulttb->num_rows > 0) {
                while ($row = $resulttb->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row["madonhang"]; ?></td>
                        <td><?php echo $row["makhachhang"]; ?></td>
                        <td><?php echo $row["manhanvien"]; ?></td>
                        <td><?php echo $row["ngaylap"]; ?></td>
                        <td><?php echo $row["noinhanhang"]; ?></td>
                        <td><?php echo $row["trangthai"]; ?></td>
                        <td>
                            <button popovertarget="1<?php echo $row["madonhang"]; ?>"><i class="fa-regular fa-file"></i></button>
                            <div id="1<?php echo $row["madonhang"]; ?>" popover>
                                <div class="ppvcontent">
                                    <h3>CHI TIẾT ĐƠN HÀNG</h3>
                                    <?php 
                                    $sql = "SELECT * FROM chitietdonhang WHERE madonhang = '" .$row['madonhang']. "';";
                                    $result = $con->query($sql);
                                    if ($result->num_rows > 0) {
                                    while ($row1 = $result->fetch_assoc()) {
                                    ?>
                                    <label>Mã sản phẩm</label>
                                    <input type="text" value="<?php echo $row1["masanpham"]; ?>" readonly>
                                    <label>Số lượng</label>
                                    <input type="number" value="<?php echo $row1["soluong"]; ?>" readonly>
                                    <label>Đơn giá</label>
                                    <input type="number" value="<?php echo $row1["dongia"]; ?>" readonly>
                                    <label>Thành tiền</label>
                                    <input type="number" value="<?php echo $row1["thanhtien"]; ?>" readonly>
                                    <?php }
                                    } ?>
                                </div>
                            </div>
                            <button popovertarget="2<?php echo $row["madonhang"]; ?>"><i class="fa-solid fa-hammer"></i></button>
                            <div id="2<?php echo $row["madonhang"]; ?>" popover>
                                <form class="ppvcontent" method="post">
                                    <h3>SỬA THÔNG TIN</h3>
                                    <label>Mã đơn hàng</label>
                                    <input type="text" name="Madonhang" value="<?php echo $row["madonhang"]; ?>" readonly>
                                    <label>Mã khách hàng</label>
                                    <select name="Makhachhang">
                                        <option value="">--chọn khách hàng--</option>
                                        <?php  
                                        $resultkh = $con->query("SELECT makhachhang, tenkhachhang FROM khachhang");
                                        if($resultkh->num_rows > 0){
                                            while($rowkh = $resultkh->fetch_assoc()){
                                                $selected = ($row["makhachhang"] == $rowkh["makhachhang"] ? "selected" : "");?>  
                                                <option value="<?php echo $rowkh["makhachhang"] ?>" <?php echo $selected ?>><?php echo $rowkh["tenkhachhang"] ?></option>
                                           <?php }
                                        }
                                        ?>
                                    </select>
                                    <label>Mã nhân viên</label>
                                    <select name="Manhanvien">
                                        <option value="">--Chọn nhân viên--</option>
                                        <?php  
                                        $resultnv = $con->query("SELECT manhanvien, tennhanvien FROM nhanvien");
                                        if($resultnv->num_rows > 0){
                                            while($rownv = $resultnv->fetch_assoc()){
                                                $selected = ($row["manhanvien"] == $rownv["manhanvien"] ? "selected" : "");?>  
                                                <option value="<?php echo $rownv["manhanvien"] ?>" <?php echo $selected ?>><?php echo $rownv["tennhanvien"] ?></option>
                                           <?php }
                                        }
                                        ?>
                                    </select>
                                    <label>Mã sản phẩm</label>
                                    <select name="Masanpham">
                                        <option value="">--Chọn sản phẩm--</option>
                                        <?php  
                                        $resultsp = $con->query("SELECT masanpham, tensanpham FROM sanpham");
                                        $resultsp1 = $con->query("SELECT masanpham FROM chitietdonhang WHERE madonhang = '" .$row['madonhang']. "';");
                                        $rowsp1 = $resultsp1->fetch_assoc();
                                        if($resultsp->num_rows > 0){
                                            while($rowsp = $resultsp->fetch_assoc()){
                                                $selected = ($rowsp1["masanpham"] == $rowsp["masanpham"] ? "selected" : "");?>  
                                                <option value="<?php echo $rowsp["masanpham"] ?>" <?php echo $selected ?>><?php echo $rowsp["tensanpham"] ?></option>                                                                                             
                                           <?php }} ?>
                                    </select>
                                    <label>số lượng</label>
                                    <?php 
                                        $resultth = $con->query("SELECT soluong, dongia, thanhtien FROM chitietdonhang WHERE madonhang = '" .$row['madonhang']. "';");
                                        $rowth = $resultth->fetch_assoc();
                                    ?>
                                    <input type="number" name="Soluong" value="<?php echo $rowth["soluong"] ?>" required>
                                    <label>đơn giá</label>
                                    <input type="number" name="Dongia" value="<?php echo $rowth["dongia"] ?>" required>
                                    <label>Thành tiền</label>
                                    <input type="number" name="Thanhtien" value="<?php echo $rowth["thanhtien"] ?>" readonly>
                                    <label>Nơi nhận hàng</label>
                                    <input type="text" name="Noinhanhang" value="<?php echo $row["noinhanhang"] ?>" required>
                                    <label>Trạng thái</label>
                                    <select name="Trangthai">
                                        <option value="">--Chọn trạng thái--</option>                                    
                                        <option value="Chờ xử lý" <?php echo ($row["trangthai"] == "Chờ xử lý" ? "selected" : ""); ?>>Chờ xử lý</option>
                                        <option value="Hoàn thành" <?php echo ($row["trangthai"] == "Hoàn thành" ? "selected" : ""); ?>>Hoàn thành</option>                          
                                    </select>
                                    <button type="submit" name="repair">Sửa</button>
                                </form>
                            </div>
                            <form method="post">
                                <input type="hidden" name="Madonhang" value="<?php echo $row["madonhang"]; ?>">
                                <button type="submit" name="remove"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
            <?php }
            } ?>
                    </tr>
        </tbody>
    </table>
</body>

</html>