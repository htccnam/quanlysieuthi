<?php
include_once("../connectdb.php");

$maxNgaySinh=date('d/m/Y',strtotime('-18 years'));
if (isset($_POST['btnThem'])) {
    $textMaNhanVien = $_POST['txtMaNhanVien'];
    $textTenNhanVien = $_POST['txtTenNhanVien'];
    $textNgaySinh = $_POST['txtNgaySinh'];
    $textGioiTinh = $_POST['selectGioiTinh'];
    $textSoDienThoai = $_POST['txtSoDienThoai'];
    $textEmail = $_POST['txtEmail'];
    $textDiaChi = $_POST['txtDiaChi'];
    $textMaChucVu = $_POST['selectChucVu'];


    $textCheckMaNhanVien = mysqli_query($con, "SELECT manhanvien FROM nhanvien WHERE manhanvien='$textMaNhanVien'");
    if (mysqli_num_rows($textCheckMaNhanVien) > 0) {
        echo "<script> alert ('mã nhân viên đã tồn tại'); </script>";
    } else {

        try {
            $sqlInsertNhanVien = "INSERT INTO nhanvien VALUES ('$textMaNhanVien','$textTenNhanVien','$textNgaySinh','$textGioiTinh','$textSoDienThoai','$textEmail','$textDiaChi','$textMaChucVu')";
            mysqli_query($con, $sqlInsertNhanVien);
            echo "<script> alert('thêm thành công'); </script>";

        } catch (mysqli_sql_exception $e) {
            echo "<script> alert('Lỗi insert'); </script>";
        }
    }

}

if (isset($_GET['btnXoa'])) {
    $textMaNhanVien = $_GET['manhanvien'];
    $checkXoaNhanVien = mysqli_execute_query($con, "select manhanvien from donhang where manhanvien='$textMaNhanVien'");
    if (mysqli_num_rows($checkXoaNhanVien) > 0) {
        echo "<script> alert('Nhân viên đã được tạo đơn vui lòng xóa bên tạo đơn trước') </script>";
    } else {
        $sqlDelete = "DELETE FROM nhanvien WHERE manhanvien = '$textMaNhanVien'";
        mysqli_query($con, $sqlDelete);
        echo "<script> alert('xóa thành công');
        window.location='quanlynhanvien.php';
    </script>";
    }


}

if (isset($_POST['btnTimKiem'])) {
    $textTimKiem = $_POST['txtTimKiem'];
} else {
    $textTimKiem = "";
}
$sqlTimKiem = "SELECT * FROM nhanvien WHERE
            manhanvien LIKE'%$textTimKiem%' OR tennhanvien LIKE '%$textTimKiem%'";
$resultTimKiem = mysqli_query($con, $sqlTimKiem);
if (mysqli_num_rows($resultTimKiem) == 0) {
    echo "<script> alert('không có nhân viên'); </script>";
}

$resultSelectChucVu = mysqli_execute_query($con, "select * from chucvu");


//lấy từ xuất excel
if (isset($_POST['txtCheckExport'])) {
    $textCheckExport = $_POST['txtCheckExport'];
} else {
    $textCheckExport = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quanlynhanvien</title>
    <!-- <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css"> -->
</head>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .formnhap {
        border: 2px solid gray;
        border-radius: 10px;
        margin: 50px;
        padding: 20px;

        box-shadow: 0px 0px 30px gray;
    }

    form>h1 {
        text-align: center;
        color: burlywood;
        margin-bottom: 10px;
    }

    input,
    select {
        width: 100%;
        padding: 15px;
        margin: 10px 0px 10px 0px;
        border: 2px solid black;
        box-sizing: border-box;
        border-radius: 5px;


    }

    .hang {
        display: flex;
        gap: 5px;
    }

    .cot {
        flex: 50%;
        min-width: 0;
    }

    .buttonThem {
        width: auto;
        height: 40px;
        padding: 10px;
        border: 2px solid black;
        background-color: greenyellow;

        border-radius: 5px;
    }

    table{
        height: auto;
        width: 100%;
        border-collapse: collapse; 
    }
    thead{
        color: white;
        background-color: black;
    }
    tbody{
        border: 1px solid black;
    }
    th,td{
        padding: 15px 20px;
        
    }
    .thanhkeotable{
        overflow-x: auto;
        max-width: 100%;
        border-radius: 12px;
        border: 1px solid gray;
    }

    .buttonSua{
        text-decoration: none;
        padding: 10px 10px;
        border-radius: 5px;
        border: 1px solid black;
        background-color: orange;
    }

    .buttonXoa{
        text-decoration: none;
        padding: 10px 10px;
        border-radius: 5px;
        border: 1px solid black;
        background-color: red;
        color: yellow;

    }
</style>

<body>
    <div class="hang">
        <div class="cot">
            <form action="" method="POST" class="formnhap" style="max-width: 700px; height: auto;">
            <h1>quản lý nhân viên</h1>
            <br>

            <div class="hang">
                <div class="cot">
                    <label for="txtMaNhanVien">Mã nhân viên</label>
                    <input type="text" name="txtMaNhanVien" placeholder="Nhập mã nhân viên" required>
                </div>

                <div class="cot">
                    <label for="txtTenNhanVien">Tên nhân viên</label>
                    <input type="text" name="txtTenNhanVien" placeholder="Nhập tên nhân viên" required>
                </div>

            </div>


            <div class="hang">
                <div class="cot"><label for="txtNgaySinh">Ngày sinh</label>
                    <input type="date" name="txtNgaySinh" max="<?=$maxNgaySinh?>" required>
                </div>
                <div class="cot">
                    <label for="selectGioiTinh">Giới tính</label>
                    <select name="selectGioiTinh" id="">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>

            </div>


            <div class="hang">
                <div class="cot"><label for="txtSoDienThoai">Số điện thoại</label>
                    <input type="number" name="txtSoDienThoai" placeholder="Nhập số điện thoại" required>
                </div>

                <div class="cot"> <label for="txtEmail">Email</label>
                    <input type="text" name="txtEmail" placeholder="Nhập email">
                </div>


            </div>

            <br>
            <label for="txtDiaChi">Địa chỉ</label>
            <input type="text" name="txtDiaChi" placeholder="Nhập địa chỉ" required>
            <br>
            <label for="selectChucVu">Chức vụ</label>
            <select name="selectChucVu">
                <?php
                if (mysqli_num_rows($resultSelectChucVu) > 0) {
                    while ($rowChucVu = mysqli_fetch_assoc($resultSelectChucVu)) {
                        echo "<option value={$rowChucVu['machucvu']}>{$rowChucVu['machucvu']} - {$rowChucVu['tenchucvu']}
                        </option>";
                    }
                } else {
                    // echo "<option value=""></option>"";
                }
                ?>
            </select>
            <br>
            <button name="btnThem" style="width: 100%;" class="buttonThem">➕ Thêm nhân viên</button>
        </form>
        </div>
        <div class="cot">
            <form action="" method="POST">
                <div class="hang">
                    <div class="cot">
                        <input type="text" name="txtTimKiem" placeholder="vui lòng nhập mã hoặc tên để tìm kiếm">
                    </div>
                    <div class="cot">
                        <button name="btnTimKiem" class="buttonThem">Tìm kiếm</button>
                    </div>
                </div>
            </form>

            <form action="exportnhanvien.php" method="GET">
                <div class="hang">
                    <div class="cot">
                        <input type="text" name="manhanvien" placeholder="nhập mã nhân viên để xuất">
                    </div>
                    <div class="cot">
                        <button type="submit" class="buttonThem">Xuất Excel</button>
                    </div>
                </div>
            </form>
            <h1>Danh sách nhân viên</h1>
            <div class="thanhkeotable">
                <table>
                <thead>
                    <th>manhanvien</th>
                    <th>tennhanvien</th>
                    <th>ngaysinh</th>
                    <th>gioitinh</th>
                    <th>sodienthoai</th>
                    <th>email</th>
                    <th>diachi</th>
                    <th>machucvu</th>

                    <th>thaotac</th>
                </thead>
                <tbody>
                    <?php
                    if ($resultTimKiem && mysqli_num_rows($resultTimKiem) > 0) {
                        while ($row = mysqli_fetch_assoc($resultTimKiem)) {
                            echo "<tr>";
                            echo "<td>" . $row['manhanvien'] . "</td>";
                            echo "<td>" . $row['tennhanvien'] . "</td>";
                            echo "<td>" . $row['ngaysinh'] . "</td>";
                            echo "<td>" . $row['gioitinh'] . "</td>";
                            echo "<td>" . $row['sodienthoai'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['diachi'] . "</td>";
                            echo "<td>" . $row['machucvu'] . "</td>";

                            echo "<td>";
                            echo "<a href='suanhanvien.php?manhanvien=" . $row['manhanvien'] . "' target = 'contentFrame' class='buttonSua'>sửa</a>";
                            echo "<a href='?btnXoa=1&manhanvien=" . $row['manhanvien'] . "' name='btnXoa' class='buttonXoa' onclick=\"return confirm('bạn có chắc chắn muốn xóa?')\">xóa</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>

        </div>
    </div>


</body>

</html>