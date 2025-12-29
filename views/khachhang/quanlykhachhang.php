<?php
include_once("../connectdb.php");

// --- KHAI BÁO BIẾN ĐỂ CHỨA DỮ LIỆU FORM (Dùng cho cả Thêm và Sửa) ---
$id = "";
$ma_kh = "";
$ho_ten = "";
$sdt = "";
$email = "";
$dia_chi = "";
$is_editing = false; // Biến cờ để biết đang ở chế độ Thêm hay Sửa

// --- 1. XỬ LÝ KHI BẤM NÚT "LƯU" (THÊM HOẶC SỬA) ---
if (isset($_POST['btnLuu'])) {
    $id = $_POST['txtID']; // ID ẩn
    $ma_kh = $_POST['txtMaKH'];
    $ho_ten = $_POST['txtHoTen'];
    $sdt = $_POST['txtSDT'];
    $email = $_POST['txtEmail'];
    $dia_chi = $_POST['txtDiaChi'];

    // Check rỗng
    if ($ma_kh == "" || $ho_ten == "" || $sdt == "") {
        echo "<script>alert('Vui lòng nhập Mã KH, Tên và SĐT!');</script>";
    } else {
        // Check trùng Mã KH hoặc SĐT (Trừ chính nó nếu đang sửa)
        if ($id != "") {
            // Logic cho SỬA: Check trùng với các dòng khác ID hiện tại
            $sqlCheck = "SELECT * FROM khach_hang WHERE (ma_kh='$ma_kh' OR sdt='$sdt') AND id != '$id'";
        } else {
            // Logic cho THÊM: Check trùng bình thường
            $sqlCheck = "SELECT * FROM khach_hang WHERE ma_kh='$ma_kh' OR sdt='$sdt'";
        }

        $resultCheck = mysqli_query($con, $sqlCheck);

        if (mysqli_num_rows($resultCheck) > 0) {
            echo "<script>alert('Mã Khách hàng hoặc SĐT đã tồn tại!');</script>";
        } else {
            if ($id != "") {
                // --- THỰC HIỆN UPDATE ---
                $sql = "UPDATE khach_hang SET ma_kh='$ma_kh', ho_ten='$ho_ten', sdt='$sdt', email='$email', dia_chi='$dia_chi' WHERE id='$id'";
                $msg = "Cập nhật thành công!";
            } else {
                // --- THỰC HIỆN INSERT ---
                $sql = "INSERT INTO khach_hang (ma_kh, ho_ten, sdt, email, dia_chi) VALUES ('$ma_kh', '$ho_ten', '$sdt', '$email', '$dia_chi')";
                $msg = "Thêm mới thành công!";
            }

            if (mysqli_query($con, $sql)) {
                echo "<script>alert('$msg'); window.location='quanlykhachhang.php';</script>";
            } else {
                echo "<script>alert('Lỗi truy vấn SQL!');</script>";
            }
        }
    }
}

// --- 2. XỬ LÝ KHI BẤM NÚT "XÓA" ---
if (isset($_GET['btnXoa'])) {
    $idXoa = $_GET['id'];
    $sqlDelete = "DELETE FROM khach_hang WHERE id = '$idXoa'";
    if (mysqli_query($con, $sqlDelete)) {
        echo "<script>alert('Xóa thành công!'); window.location='quanlykhachhang.php';</script>";
    } else {
        echo "<script>alert('Không thể xóa (Có thể khách hàng đã mua hàng)!');</script>";
    }
}

// --- 3. XỬ LÝ KHI BẤM NÚT "SỬA" (Lấy dữ liệu đổ lên form) ---
if (isset($_GET['btnSua'])) {
    $is_editing = true;
    $idSua = $_GET['id'];
    $sqlGetOne = "SELECT * FROM khach_hang WHERE id = '$idSua'";
    $resultOne = mysqli_query($con, $sqlGetOne);
    $rowOne = mysqli_fetch_assoc($resultOne);
    
    // Gán dữ liệu vào biến để hiển thị ở input value
    $id = $rowOne['id'];
    $ma_kh = $rowOne['ma_kh'];
    $ho_ten = $rowOne['ho_ten'];
    $sdt = $rowOne['sdt'];
    $email = $rowOne['email'];
    $dia_chi = $rowOne['dia_chi'];
}

// --- 4. XỬ LÝ TÌM KIẾM ---
$textTimKiem = "";
if (isset($_POST['btnTimKiem'])) {
    $textTimKiem = $_POST['txtTimKiem'];
}
$sqlList = "SELECT * FROM khach_hang WHERE ho_ten LIKE '%$textTimKiem%' OR ma_kh LIKE '%$textTimKiem%' OR sdt LIKE '%$textTimKiem%' ORDER BY id DESC";
$resultList = mysqli_query($con, $sqlList);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section { background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #ddd; }
        .btn-custom-xanh {
        background-color: #84c000 !important; /* Màu xanh giống hình */
        color: white !important; /* Chữ màu trắng */
        border: none;
        font-weight: 500;
    }
    .btn-custom-xanh:hover {
        background-color: #6a9c00 !important; /* Màu khi di chuột vào (đậm hơn chút) */
        color: white !important;
    }
    </style>
</head>
<body class="p-3">

<div class="container-fluid">
    <h3 class="text-center text-uppercase mb-4 fw-bold">Quản Lý Khách Hàng</h3>

    <div class="row">
        <div class="col-md-4">
            <div class="form-section">
                <h5 class="text-primary border-bottom pb-2">
                    <?php echo $is_editing ? "CẬP NHẬT THÔNG TIN" : "THÊM KHÁCH HÀNG MỚI"; ?>
                </h5>

                <form action="quanlykhachhang.php" method="POST">
                    <input type="hidden" name="txtID" value="<?php echo $id; ?>">

                    <div class="mb-2">
                        <label>Mã Khách Hàng (*)</label>
                        <input type="text" class="form-control" name="txtMaKH" value="<?php echo $ma_kh; ?>" required placeholder="VD: KH001">
                    </div>

                    <div class="mb-2">
                        <label>Họ Tên (*)</label>
                        <input type="text" class="form-control" name="txtHoTen" value="<?php echo $ho_ten; ?>" required placeholder="Nhập họ tên">
                    </div>

                    <div class="mb-2">
                        <label>Số Điện Thoại (*)</label>
                        <input type="number" class="form-control" name="txtSDT" value="<?php echo $sdt; ?>" required placeholder="Nhập SĐT">
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" class="form-control" name="txtEmail" value="<?php echo $email; ?>" placeholder="Nhập email">
                    </div>

                    <div class="mb-3">
                        <label>Địa Chỉ</label>
                        <textarea class="form-control" name="txtDiaChi" rows="2"><?php echo $dia_chi; ?></textarea>
                    </div>

                    <button type="submit" name="btnLuu" class="btn btn-custom-xanh w-100">
                        <?php echo $is_editing ? "💾 Cập nhật" : "➕ Thêm mới"; ?>
                    </button>
                    
                    <?php if($is_editing): ?>
                        <a href="quanlykhachhang.php" class="btn btn-secondary w-100 mt-2">❌ Hủy bỏ</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <form action="" method="POST" class="d-flex mb-3">
                <input type="text" name="txtTimKiem" class="form-control me-2" placeholder="Tìm theo Tên, Mã KH, SĐT..." value="<?php echo $textTimKiem; ?>">
                <button name="btnTimKiem" class="btn btn-success" style="width: 150px;">🔍 Tìm kiếm</button>
            </form>

            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Mã KH</th>
                        <th>Họ Tên</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th width="140">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($resultList) > 0) {
                        while ($row = mysqli_fetch_assoc($resultList)) {
                    ?>
                        <tr>
                            <td><?php echo $row['ma_kh']; ?></td>
                            <td><?php echo $row['ho_ten']; ?></td>
                            <td><?php echo $row['sdt']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['dia_chi']; // Lưu ý: Tên cột trong DB là 'diachi' hay 'dia_chi'? Kiểm tra lại nhé ?></td>
                            <td>
                                <a href="quanlykhachhang.php?btnSua=1&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                                
                                <a href="quanlykhachhang.php?btnXoa=1&id=<?php echo $row['id']; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Bạn chắc chắn muốn xóa khách hàng <?php echo $row['ho_ten']; ?>?');">
                                   Xóa
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center text-danger'>Không tìm thấy dữ liệu!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>