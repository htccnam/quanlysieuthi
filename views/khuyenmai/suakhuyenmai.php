<?php
include_once("../connectdb.php");

if (isset($_POST['btnSua'])) {
    $maKhuyenMai = $_POST['txtMaKhuyenMai'];
    $tenKhuyenMai = $_POST['txtTenKhuyenMai'];
    $moTa = $_POST['txtMoTa'];
    $soTienGiam = $_POST['txtSoTienGiam'];
    $ngayTao = $_POST['txtNgayTao'];

    $sqlUpdate = "update khuyenmai set 
        tenkhuyenmai='$tenKhuyenMai',
        mota='$moTa',
        sotiengiam='$soTienGiam',
        ngaytao='$ngayTao'
        where makhuyenmai='$maKhuyenMai'";

    mysqli_execute_query($con, $sqlUpdate);
    echo "<script>
            alert('Sửa thành công');
            window.location='quanlykhuyenmai.php';
          </script>";
}

if (isset($_POST['btnThoat'])) {
    echo "<script>window.location='quanlykhuyenmai.php'</script>";
}

$maKhuyenMai = $_GET['makhuyenmai'];
$sqlSelect = "select * from khuyenmai where makhuyenmai='$maKhuyenMai'";
$result = mysqli_execute_query($con, $sqlSelect);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Suakhuyenmai</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>

<body>
    <form action="" method="post">
        <h1>Sửa khuyến mãi</h1>

        <label>Mã khuyến mãi</label>
        <input type="text" name="txtMaKhuyenMai" value="<?php echo $row['makhuyenmai'] ?>" class="highlight" readonly>

        <label>Tên khuyến mãi</label>
        <input type="text" name="txtTenKhuyenMai" value="<?php echo $row['tenkhuyenmai'] ?>" required>

        <label>Mô tả</label>
        <input type="text" name="txtMoTa" value="<?php echo $row['mota'] ?>">

        <label>Số tiền giảm</label>
        <input type="number" name="txtSoTienGiam" value="<?php echo $row['sotiengiam'] ?>" required>

        <label>Ngày tạo</label>
        <input type="date" name="txtNgayTao" value="<?php echo $row['ngaytao'] ?>" required>

        <button name="btnSua" onclick="return confirm('Xác nhận sửa?')">Sửa</button>
        <button name="btnThoat" onclick="return confirm('Thoát không lưu?')">Thoát</button>
    </form>
</body>

</html>
