<?php 
    // Kết nối và Header
    include_once("../../connectdb.php");
    include_once("../header.php"); 

    // --- LẤY DỮ LIỆU DROPDOWN ---
    $dsLoaiHang = mysqli_query($con, "SELECT * FROM loaihang");
    $dsThuongHieu = mysqli_query($con, "SELECT * FROM thuonghieu");

    // --- XỬ LÝ THÊM SẢN PHẨM (Không còn ảnh) ---
    if(isset($_POST['btnThem'])){
        $maSP = $_POST['txtMaSP'];
        $tenSP = $_POST['txtTenSP'];
        $maLoai = $_POST['slMaLoai'];
        $maTH = $_POST['slMaThuongHieu'];
        $soLuong = $_POST['txtSoLuong'];
        $giaNhap = $_POST['txtGiaNhap'];
        $giaBan = $_POST['txtGiaBan'];
        $dvt = $_POST['txtDVT'];

        // Kiểm tra trùng mã
        $check = mysqli_query($con, "SELECT masanpham FROM sanpham WHERE masanpham='$maSP'");
        if(mysqli_num_rows($check) > 0){
            echo "<script>alert('Mã sản phẩm đã tồn tại!');</script>";
        } else {
            // Câu lệnh INSERT đã bỏ cột hinhanh
            $sqlInsert = "INSERT INTO sanpham (masanpham, tensanpham, maloaihang, mathuonghieu, soluong, gianhap, giaban, donvitinh) 
                          VALUES ('$maSP', '$tenSP', '$maLoai', '$maTH', '$soLuong', '$giaNhap', '$giaBan', '$dvt')";
            
            if(mysqli_query($con, $sqlInsert)){
                echo "<script>alert('Thêm thành công!'); window.location='quanlysanpham.php';</script>";
            } else {
                echo "<script>alert('Lỗi: " . mysqli_error($con) . "');</script>";
            }
        }
    }

    // --- XỬ LÝ XÓA ---
    if(isset($_GET['btnXoa'])){
        $maXoa = $_GET['masanpham'];
        mysqli_query($con, "DELETE FROM sanpham WHERE masanpham='$maXoa'");
        echo "<script>alert('Xóa thành công'); window.location='quanlysanpham.php';</script>";
    }

    // --- TÌM KIẾM ---
    $txtTimKiem = "";
    if(isset($_POST['btnTimKiem'])){
        $txtTimKiem = $_POST['txtTimKiem'];
    }
    $sqlTimKiem = "SELECT * FROM sanpham WHERE masanpham LIKE '%$txtTimKiem%' OR tensanpham LIKE '%$txtTimKiem%'";
    $result = mysqli_query($con, $sqlTimKiem);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sản phẩm</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>
<body>
    <div style="display:flex; justify-content: center; margin-top: 20px;">
        
        <form action="" method="post" style="width:600px; height:auto; margin-right: 20px;">
            <h1>Quản lý Sản phẩm</h1>
            
            <div style="display: flex; gap: 10px;">
                <input type="text" name="txtMaSP" placeholder="Mã SP (VD: SP01)" required style="width: 30%;">
                <input type="text" name="txtTenSP" placeholder="Tên sản phẩm" required style="width: 70%;">
            </div>

            <div style="display: flex; gap: 10px;">
                <select name="slMaLoai" style="width: 50%;">
                    <?php while($rowLH = mysqli_fetch_assoc($dsLoaiHang)){ ?>
                        <option value="<?php echo $rowLH['maloaihang']; ?>"><?php echo $rowLH['tenloaihang']; ?></option>
                    <?php } ?>
                </select>

                <select name="slMaThuongHieu" style="width: 50%;">
                    <?php while($rowTH = mysqli_fetch_assoc($dsThuongHieu)){ ?>
                        <option value="<?php echo $rowTH['mathuonghieu']; ?>"><?php echo $rowTH['tenthuonghieu']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div style="display: flex; gap: 10px;">
                <input type="number" name="txtSoLuong" placeholder="Số lượng" required>
                <input type="text" name="txtDVT" placeholder="Đơn vị tính" required>
            </div>

            <div style="display: flex; gap: 10px;">
                <input type="number" name="txtGiaNhap" placeholder="Giá nhập" required>
                <input type="number" name="txtGiaBan" placeholder="Giá bán" required>
            </div>

            <br>
            <button name="btnThem">➕ Thêm sản phẩm</button>
        </form>

        <form action="" method="post" style="width:300px; height:80px;">
            <input type="text" name="txtTimKiem" placeholder="Tìm tên SP..." value="<?php echo $txtTimKiem; ?>">
            <button name="btnTimKiem">Tìm kiếm</button>
        </form>
    </div>

    <table style="width: 95%; margin: 20px auto;">
        <thead>
            <th>Mã SP</th>
            <th>Tên sản phẩm</th>
            <th>SL</th>
            <th>ĐVT</th>
            <th>Giá bán</th>
            <th>Thao tác</th>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['masanpham']; ?></td>
                    <td><?php echo $row['tensanpham']; ?></td>
                    <td><?php echo $row['soluong']; ?></td>
                    <td><?php echo $row['donvitinh']; ?></td>
                    <td><?php echo number_format($row['giaban']); ?> đ</td>
                    <td>
                        <a href="suasanpham.php?masanpham=<?php echo $row['masanpham']; ?>">Sửa</a> | 
                        <a href="?btnXoa=1&masanpham=<?php echo $row['masanpham']; ?>" onclick="return confirm('Xóa SP này?')">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>