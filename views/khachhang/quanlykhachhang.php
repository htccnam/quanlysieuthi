<?php
// --- PHẦN 1: LOGIC PHP  ---
require_once '../connectdb.php'; 
if (isset($con)) {
    $conn = $con;
} else {
    die("Lỗi kết nối");
}

$message = "";
$msg_type = "";
$edit_customer = null;


if (isset($_POST['btn_save'])) {
    $makh = $_POST['makhachhang'];
    $tenkh = $_POST['tenkhachhang'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "UPDATE khachhang SET makhachhang='$makh', tenkhachhang='$tenkh', gioitinh='$gioitinh', ngaysinh='$ngaysinh', email='$email', sdt ='$sdt', diachi='$diachi' WHERE id = $id";
        if (mysqli_query($conn, $sql)) { $message = "Cập nhật thành công!"; $msg_type = "success"; } 
        else { $message = "Lỗi: " . mysqli_error($conn); $msg_type = "error"; }
    } else {
        $check = mysqli_query($conn, "SELECT * FROM khachhang WHERE makhachhang='$makh'");
        if (mysqli_num_rows($check) > 0) { $message = "Mã KH đã tồn tại!"; $msg_type = "error"; } 
        else {
            $sql = "INSERT INTO khachhang (makhachhang, tenkhachhang, gioitinh, ngaysinh, diachi, email,sdt, diemtichluy) VALUES ('$makh', '$tenkh', '$gioitinh', '$ngaysinh', '$diachi', '$email','$sdt', 0)";
            if (mysqli_query($conn, $sql)) { $message = "Thêm mới thành công!"; $msg_type = "success"; } 
            else { $message = "Lỗi: " . mysqli_error($conn); $msg_type = "error"; }
        }
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM khachhang WHERE id = $id";
    if (mysqli_query($conn, $sql)) { $message = "Đã xóa khách hàng!"; $msg_type = "success"; }
}


if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM khachhang WHERE id = $id");
    $edit_customer = mysqli_fetch_assoc($result);
}


$keyword = "";
$sql_list = "SELECT * FROM khachhang";
if (isset($_GET['tukhoa']) && !empty($_GET['tukhoa'])) {
    $keyword = $_GET['tukhoa'];
    $sql_list .= " WHERE makhachhang LIKE '%$keyword%' OR tenkhachhang LIKE '%$keyword%'";
}
$sql_list .= " ORDER BY id DESC";
$list_customers = mysqli_query($conn, $sql_list);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Khách Hàng</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- LINK TỚI FILE CSS RIÊNG -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="navbar">
        <div class="navbar-brand"><i class="fa-solid fa-cart-shopping"></i>Quản lý Khách Hàng</div>
        <div style="font-size: 14px; color: #666;">Xin chào, <b>Admin</b> | <a href="#" style="color: var(--primary-color);">Đăng xuất</a></div>
    </div>

    <div class="container">
        <!-- FORM -->
        <div class="card">
            <div class="card-header">
                <span><i class="fa-solid <?php echo ($edit_customer) ? 'fa-pen-to-square' : 'fa-user-plus'; ?>"></i> <?php echo ($edit_customer) ? "Cập Nhật" : "Thêm Mới"; ?></span>
            </div>
            <div class="card-body">
                <form action="quanlykhachhang.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo ($edit_customer) ? $edit_customer['id'] : ''; ?>">
                    
                    <div class="form-group">
                        <label class="form-label">Mã KH <span style="color:red">*</span></label>
                        <input type="text" name="makhachhang" class="form-control" required placeholder="VD: KH001" value="<?php echo ($edit_customer) ? $edit_customer['makhachhang'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Họ Tên <span style="color:red">*</span></label>
                        <input type="text" name="tenkhachhang" class="form-control" required value="<?php echo ($edit_customer) ? $edit_customer['tenkhachhang'] : ''; ?>">
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div class="form-group">
                            <label class="form-label">Giới Tính</label>
                            <select name="gioitinh" class="form-control">
                                <option value="Nam" <?php echo ($edit_customer && $edit_customer['gioitinh'] == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                                <option value="Nữ" <?php echo ($edit_customer && $edit_customer['gioitinh'] == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ngày Sinh</label>
                            <input type="date" name="ngaysinh" class="form-control" value="<?php echo ($edit_customer) ? $edit_customer['ngaysinh'] : ''; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">SĐT</label>
                        <input type="number" name="sdt" class="form-control" value="<?php echo ($edit_customer) ? $edit_customer['sdt'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo ($edit_customer) ? $edit_customer['email'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Địa Chỉ</label>
                        <input type="text" name="diachi" class="form-control" value="<?php echo ($edit_customer) ? $edit_customer['diachi'] : ''; ?>">
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" name="btn_save" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i> <?php echo ($edit_customer) ? "Lưu Thay Đổi" : "Lưu Thông Tin"; ?>
                        </button>
                        <?php if($edit_customer): ?>
                            <a href="quanlykhachhang.php" class="btn btn-secondary" style="margin-top: 10px; width: 100%;"><i class="fa-solid fa-ban"></i> Hủy Bỏ</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- LIST -->
        <div class="card">
            <div class="card-header">
                <span><i class="fa-solid fa-list"></i> Danh Sách Khách Hàng</span>
                <span class="badge badge-points"><?php echo mysqli_num_rows($list_customers); ?> Khách</span>
            </div>
            <div class="card-body">
                <?php if ($message != ""): ?>
                    <div class="alert <?php echo ($msg_type == 'success') ? 'alert-success' : 'alert-error'; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <form action="quanlykhachhang.php" method="GET" style="display:flex; gap:10px; margin-bottom:20px;">
                    <input type="text" name="tukhoa" class="form-control" placeholder="Tìm kiếm..." value="<?php echo $keyword; ?>">
                    <button class="btn btn-primary" style="width: auto;"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mã KH</th>
                                <th>Họ Tên</th>
                                <th>Giới Tính</th>
                                <th>Liên Hệ</th>
                                <th>Tích Lũy</th>
                                <th style="text-align: right;">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($list_customers) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($list_customers)): ?>
                                <tr>
                                    <td><span style="font-weight: bold; color: var(--primary-color);"><?php echo $row['makhachhang']; ?></span></td>
                                    <td>
                                        <div style="font-weight: 500;"><?php echo $row['tenkhachhang']; ?></div>
                                        <div style="font-size: 12px; color: #888;"><?php echo date('d/m/Y', strtotime($row['ngaysinh'])); ?></div>
                                    </td>
                                    <td><?php echo $row['gioitinh']; ?></td>
                                    <td>
                                        <div style="font-size: 13px;"><i class="fa-solid fa-phone"></i> <?php echo $row['sdt']; ?></div>
                                    </td>
                                    <td><span class="badge badge-points"><?php echo number_format($row['diemtichluy']); ?></span></td>
                                    <td style="text-align: right;">
                                        <a href="quanlykhachhang.php?action=edit&id=<?php echo $row['id']; ?>" class="btn-action-edit"><i class="fa-solid fa-pen"></i></a>
                                        <a href="quanlykhachhang.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Xóa?');" class="btn-action-delete"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="6" style="text-align:center;">Không có dữ liệu</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>