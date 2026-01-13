<?php
// --- PHẦN 1: KẾT NỐI CSDL & XỬ LÝ LOGIC (GIỮ NGUYÊN 100%) ---

// Gọi file kết nối
require_once '../connectdb.php'; 
if (isset($con)) {
    $conn = $con;
} else {
    die("Lỗi: Không tìm thấy biến kết nối '$con' trong file connectdb.php");
}

$message = "";
$msg_type = ""; // Biến để xác định màu thông báo (xanh/đỏ)
$edit_customer = null;

// A. XỬ LÝ KHI NGƯỜI DÙNG BẤM NÚT LƯU
if (isset($_POST['btn_save'])) {
    $makh = $_POST['makhachhang'];
    $tenkh = $_POST['tenkhachhang'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // UPDATE
        $id = $_POST['id'];
        $sql = "UPDATE khachhang SET 
                makhachhang='$makh', tenkhachhang='$tenkh', gioitinh='$gioitinh', 
                ngaysinh='$ngaysinh', email='$email', sdt ='$sdt', diachi='$diachi' 
                WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            $message = "Cập nhật thông tin khách hàng thành công!";
            $msg_type = "success";
        } else {
            $message = "Lỗi cập nhật: " . mysqli_error($conn);
            $msg_type = "error";
        }
    } else {
        // INSERT
        $check = mysqli_query($conn, "SELECT * FROM khachhang WHERE makhachhang='$makh'");
        if (mysqli_num_rows($check) > 0) {
            $message = "Lỗi: Mã khách hàng '$makh' đã tồn tại!";
            $msg_type = "error";
        } else {
            $sql = "INSERT INTO khachhang (makhachhang, tenkhachhang, gioitinh, ngaysinh, diachi, email,sdt, diemtichluy) 
                    VALUES ('$makh', '$tenkh', '$gioitinh', '$ngaysinh', '$diachi', '$email','$sdt', 0)";
            if (mysqli_query($conn, $sql)) {
                $message = "Thêm khách hàng mới thành công!";
                $msg_type = "success";
            } else {
                $message = "Lỗi thêm mới: " . mysqli_error($conn);
                $msg_type = "error";
            }
        }
    }
}

// B. XỬ LÝ XÓA
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM khachhang WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        $message = "Đã xóa khách hàng khỏi hệ thống!";
        $msg_type = "success";
    }
}

// C. XỬ LÝ SỬA
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM khachhang WHERE id = $id");
    $edit_customer = mysqli_fetch_assoc($result);
}

// D. LẤY DANH SÁCH
$keyword = "";
$sql_list = "SELECT * FROM khachhang";
if (isset($_GET['tukhoa']) && !empty($_GET['tukhoa'])) {
    $keyword = $_GET['tukhoa'];
    $sql_list .= " WHERE makhachhang LIKE '%$keyword%' OR tenkhachhang LIKE '%$keyword%'";
}
$sql_list .= " ORDER BY id DESC";
$list_customers = mysqli_query($conn, $sql_list);
?>

<!-- --- PHẦN 2: GIAO DIỆN HTML --- -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Khách Hàng - Retail System</title>
    <!-- Nhúng Font Awesome để lấy icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Nhúng Font Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Link file CSS riêng biệt -->
    <link rel="stylesheet" href="khachhang.css">
</head>
<body>

    <!-- Header -->
    <div class="navbar">
        <div class="navbar-brand">
            <i class="fa-solid fa-cart-shopping"></i> Hệ Thống Bán Lẻ
        </div>
        <div style="font-size: 14px; color: #666;">
            Xin chào, <b>Admin</b> | <a href="#" style="color: var(--primary-color);">Đăng xuất</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        
        <!-- CỘT TRÁI: FORM NHẬP LIỆU -->
        <div class="card">
            <div class="card-header">
                <span>
                    <i class="fa-solid <?php echo ($edit_customer) ? 'fa-pen-to-square' : 'fa-user-plus'; ?>"></i> 
                    <?php echo ($edit_customer) ? "Cập Nhật Khách Hàng" : "Thêm Mới Khách Hàng"; ?>
                </span>
            </div>
            <div class="card-body">
                <form action="quanlykhachhang.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo ($edit_customer) ? $edit_customer['id'] : ''; ?>">

                    <div class="form-group">
                        <label class="form-label">Mã Khách Hàng <span style="color:red">*</span></label>
                        <input type="text" name="makhachhang" class="form-control" required placeholder="VD: KH001"
                               value="<?php echo ($edit_customer) ? $edit_customer['makhachhang'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Họ Tên <span style="color:red">*</span></label>
                        <input type="text" name="tenkhachhang" class="form-control" required placeholder="Nhập họ tên đầy đủ"
                               value="<?php echo ($edit_customer) ? $edit_customer['tenkhachhang'] : ''; ?>">
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
                            <input type="date" name="ngaysinh" class="form-control"
                                   value="<?php echo ($edit_customer) ? $edit_customer['ngaysinh'] : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Số Điện Thoại</label>
                        <input type="number" name="sdt" class="form-control" placeholder="09xxx..."
                               value="<?php echo ($edit_customer) ? $edit_customer['sdt'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="example@mail.com"
                               value="<?php echo ($edit_customer) ? $edit_customer['email'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Địa Chỉ</label>
                        <input type="text" name="diachi" class="form-control" placeholder="Số nhà, đường, quận..."
                               value="<?php echo ($edit_customer) ? $edit_customer['diachi'] : ''; ?>">
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" name="btn_save" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <?php echo ($edit_customer) ? "Lưu Thay Đổi" : "Lưu Thông Tin"; ?>
                        </button>

                        <?php if($edit_customer): ?>
                            <a href="quanlykhachhang.php" class="btn btn-secondary" style="margin-top: 10px; width: 100%; box-sizing: border-box;">
                                <i class="fa-solid fa-ban"></i> Hủy Bỏ
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- CỘT PHẢI: DANH SÁCH -->
        <div class="card">
            <div class="card-header">
                <span><i class="fa-solid fa-list"></i> Danh Sách Khách Hàng</span>
                <span class="badge badge-points"><?php echo mysqli_num_rows($list_customers); ?> Khách</span>
            </div>
            <div class="card-body">
                
                <!-- Thông báo -->
                <?php if ($message != ""): ?>
                    <div class="alert <?php echo ($msg_type == 'success') ? 'alert-success' : 'alert-error'; ?>">
                        <i class="fa-solid <?php echo ($msg_type == 'success') ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <!-- Tìm kiếm -->
                <form action="quanlykhachhang.php" method="GET" class="search-box">
                    <input type="text" name="tukhoa" class="search-input" placeholder="Tìm theo tên hoặc mã KH..." value="<?php echo $keyword; ?>">
                    <button type="submit" class="btn btn-primary" style="width: auto;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <a href="quanly_khachhang.php" class="btn btn-secondary" style="width: auto;" title="Làm mới">
                        <i class="fa-solid fa-rotate-right"></i>
                    </a>
                </form>

                <!-- Bảng dữ liệu -->
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
                                        <div style="font-size: 13px;"><i class="fa-solid fa-phone" style="font-size: 11px; color: #888;"></i> <?php echo $row['sdt']; ?></div>
                                        <div style="font-size: 13px;"><i class="fa-solid fa-envelope" style="font-size: 11px; color: #888;"></i> <?php echo $row['email']; ?></div>
                                    </td>
                                    <td><span class="badge badge-points"><?php echo number_format($row['diemtichluy']); ?> điểm</span></td>
                                    <td style="text-align: right;">
                                        <a href="quanlykhachhang.php?action=edit&id=<?php echo $row['id']; ?>" class="btn-action-edit" title="Sửa">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="quanlykhachhang.php?action=delete&id=<?php echo $row['id']; ?>" 
                                           onclick="return confirm('Bạn chắc chắn muốn xóa khách hàng: <?php echo $row['tenkhachhang']; ?>?');" 
                                           class="btn-action-delete" title="Xóa">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="6" style="text-align:center; padding: 30px; color: #888;">
                                    <i class="fa-solid fa-inbox" style="font-size: 40px; margin-bottom: 10px; display: block;"></i>
                                    Không tìm thấy dữ liệu phù hợp
                                </td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>
</html>