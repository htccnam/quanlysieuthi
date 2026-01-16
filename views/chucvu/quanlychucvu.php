<?php
include_once("../connectdb.php");

if (isset($_POST['btnThem'])) {
    $textMaChucVu = $_POST['txtMaChucVu'];
    $textTenChucVu = $_POST['txtTenChucVu'];

    $checkTrung = mysqli_execute_query($con, "select machucvu from chucvu where machucvu='$textMaChucVu'");
    if (mysqli_num_rows($checkTrung) > 0) {
        echo "<script> alert ('mã nhân viên đã tồn tại') </script>";
    } else {
        $sqlInsertChucVu = "insert into chucvu values ('$textMaChucVu','$textTenChucVu')";
        mysqli_execute_query($con, $sqlInsertChucVu);
        echo "<script> alert ('Thêm thành công') </script>";
    }
}

if (isset($_GET['btnXoa'])) {
    $textMaChucVu = $_GET['machucvu'];

    $chechXoa = mysqli_execute_query($con, "select machucvu from nhanvien where machucvu='$textMaChucVu'");
    if (mysqli_num_rows($chechXoa) > 0) {
        echo "<script> alert ('mã chức vụ đã được chọn cho nhân viên , vui lòng xóa bên nhân viên trước')  </script>";
    } else {
        mysqli_execute_query($con, "delete from chucvu where machucvu='$textMaChucVu'");
        echo "<script> alert ('Xóa thành công')  </script>";
    }
}

if (isset($_POST['btnTimKiem'])) {
    $maChucVu = $_POST['txtTimKiem'];
} else {
    $maChucVu = "";
}
try {
    $sqlSelectChucVu = "select * from chucvu where machucvu like '%$maChucVu%' or tenchucvu like '%$maChucVu%'";
    $result = mysqli_execute_query($con, $sqlSelectChucVu);
} catch (Exception $e) {
    echo "lỗi select chức vụ : " + $e->getMessage();
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quanlychucvu</title>
    <!-- <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css"> -->
    <link rel="stylesheet" href="../../css/dinhdang1.css">
</head>

<body>
    <div class="hang">
        <div class="cot">
            <form action="" method="POST" class="formnhap">
                <h1>quản lý chức vụ</h1>
                <br>
                <label for="txtMaChucVu">Mã chức vụ</label>
                <input type="text" name="txtMaChucVu" placeholder="Nhập mã chức vụ" required>
                <br>
                <label for="txtTenChucVu">Tên chức vụ</label>
                <input type="text" name="txtTenChucVu" placeholder="Nhập tên chức vụ" required>
                <br>
                <button name="btnThem" style="width: 100%;" class="buttonThem">➕ Thêm chức vụ</button>
            </form>
        </div>
        <div class="cot">
            <form action="" method="post" class="formnhap">
                <input type="text" name="txtTimKiem" placeholder="Nhập mã hoặc tên để tìm kiếm">
                <button name="btnTimKiem" class="buttonTimKiem">🔍 Tìm kiếm</button>
            </form>
            <div class="thanhkeotable">
                <h1>DANH SÁCH CHỨC VỤ</h1>
                <table>
                    <thead>
                        <th>Mã chức vụ</th>
                        <th>Tên chức vụ</th>
                        <th>Thao tác</th>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td class='highlight'>" . $row['machucvu'] . "</td>";
                                echo "<td>" . $row['tenchucvu'] . "</td>";
                                echo "<td>";
                                echo "<a href='suachucvu.php?machucvu=" . $row['machucvu'] . "' target ='contentFrame' class='buttonSua'>Sửa</a>";
                                echo "<a href='?btnXoa=1&machucvu=" . $row['machucvu'] . "' onclick=\"return confirm('bạn có chắc chắn muốn xóa')\" class='buttonXoa'>Xóa</a>";
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