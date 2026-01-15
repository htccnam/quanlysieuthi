<?php
session_start();
$con = mysqli_connect('localhost', "root", "", "quanlysieuthi");

// 1. KHỞI TẠO DỮ LIỆU ĐỂ GIỮ FORM (Sticky Form)
$old_madon = $_POST['madonhang'] ?? '';
$old_ngay  = $_POST['ngaylap'] ?? date('Y-m-d');
$old_nv    = $_POST['manhanvien'] ?? '';
$old_kh    = $_POST['makhachhang'] ?? '';
$old_pt    = $_POST['phuongthucban'] ?? 'Tại quầy';
$old_tt    = $_POST['thanhtoan'] ?? 'Tiền mặt';
$old_km    = $_POST['makhuyenmai'] ?? ''; 

// 2. LOGIC THÊM SẢN PHẨM (Đã sửa lỗi)
if (isset($_POST['action']) && $_POST['action'] == 'add_product') {
    $search = $_POST['ten_sp_search'] ?? '';
    $sl_mua = (int)($_POST['sl_input'] ?? 1);
    
    if (!empty($search)) {
        // Tìm sản phẩm theo mã hoặc tên
        $stmt = $con->prepare("SELECT masanpham, tensanpham, giaban FROM sanpham WHERE masanpham = ? OR tensanpham = ? LIMIT 1");
        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($sp = $res->fetch_assoc()) {
            $found = false;
            if(isset($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['masanpham'] == $sp['masanpham']) {
                        $item['soluong'] += $sl_mua;
                        $found = true; 
                        break;
                    }
                }
            }
            if (!$found) {
                $_SESSION['cart'][] = [
                    'masanpham'  => $sp['masanpham'],
                    'tensanpham' => $sp['tensanpham'],
                    'dongia'     => $sp['giaban'],
                    'soluong'    => $sl_mua
                ];
            }
        }
    }
}

// 3. XỬ LÝ LƯU ĐƠN HÀNG
if (isset($_POST['action']) && $_POST['action'] == 'save_order') {
    if(!empty($_SESSION['cart'])) {
        $final_total = $_POST['tongtien_sau_km'];
        $sql_dh = "INSERT INTO donhang (madonhang, makhachhang, manhanvien, makhuyenmai, ngaylap, phuongthucban, thanhtoan, tongtien) 
                   VALUES ('$old_madon', '$old_kh', '$old_nv', '$old_km', '$old_ngay', '$old_pt', '$old_tt', '$final_total')";
        
        if ($con->query($sql_dh)) {
            foreach ($_SESSION['cart'] as $item) {
                $tt_item = $item['soluong'] * $item['dongia'];
                $con->query("INSERT INTO chitietdonhang (madonhang, masanpham, tensanpham, soluong, dongia, thanhtien) 
                             VALUES ('$old_madon', '{$item['masanpham']}', '{$item['tensanpham']}', '{$item['soluong']}', '{$item['dongia']}', '$tt_item')");
            }
            unset($_SESSION['cart']);
            echo "<script>alert('Lưu đơn hàng thành công!'); window.location.href='tao_don.php';</script>";
        }
    }
}

// Xử lý xóa sản phẩm
if (isset($_GET['delete'])) {
    $idx = $_GET['delete'];
    if (isset($_SESSION['cart'][$idx])) {
        unset($_SESSION['cart'][$idx]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        header("Location: tao_don.php"); // Load lại trang sạch sẽ
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tạo Đơn Hàng Hoàn Thiện</title>
    <style>
        :root { --primary: #3498db; --success: #2ecc71; --dark: #34495e; --bg: #f4f7f6; }
        body { font-family: 'Segoe UI', sans-serif; background: var(--bg); margin: 20px; color: var(--dark); }
        .grid { display: grid; grid-template-columns: 350px 1fr; gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 12px; }
        label { display: block; font-size: 13px; margin-bottom: 5px; font-weight: 600; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn { border: none; padding: 12px; border-radius: 5px; color: white; cursor: pointer; font-weight: bold; }
        .btn-add { background: var(--primary); width: 100px; height: 42px; }
        .btn-save { background: var(--success); width: 100%; margin-top: 15px; font-size: 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { color: var(--bg); ;background: var(--dark); padding: 12px; text-align: left; border-bottom: 2px solid #eee; }
        td { padding: 12px; border-bottom: 1px solid #eee; }
        .total-area { margin-top: 20px; text-align: right; border-top: 2px solid #eee; padding-top: 10px; }
        .discount-text { color: #e74c3c; font-weight: bold; }
    </style>
</head>
<body>

<form method="POST" id="mainForm">
    <div class="grid">
        <div class="card">
            <h3 style="margin-top:0">📝 Thông tin hóa đơn</h3>
            <div class="form-group"><label>Mã đơn hàng</label><input name="madonhang" value="<?= htmlspecialchars($old_madon) ?>" required></div>
            <div class="form-group"><label>Ngày lập</label><input type="date" name="ngaylap" value="<?= $old_ngay ?>"></div>
            
            <div class="form-group">
                <label>Nhân viên</label>
                <select name="manhanvien">
                    <?php $nvs = $con->query("SELECT * FROM nhanvien"); while($nv = $nvs->fetch_assoc()): ?>
                        <option value="<?= $nv['manhanvien'] ?>" <?= ($old_nv==$nv['manhanvien']?'selected':'') ?>><?= $nv['tennhanvien'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Khách hàng</label>
                <select name="makhachhang">
                    <?php $khs = $con->query("SELECT * FROM khachhang"); while($kh = $khs->fetch_assoc()): ?>
                        <option value="<?= $kh['makhachhang'] ?>" <?= ($old_kh==$kh['makhachhang']?'selected':'') ?>><?= $kh['tenkhachhang'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Mã khuyến mại</label>
                <select name="makhuyenmai" onchange="document.getElementById('action_type').value='update_km'; this.form.submit();">
                    <option value="">-- Không có --</option>
                    <?php 
                    $kms = $con->query("SELECT makhuyenmai, tenkhuyenmai FROM khuyenmai");
                    while($km = $kms->fetch_assoc()): ?>
                        <option value="<?= $km['makhuyenmai'] ?>" <?= ($old_km==$km['makhuyenmai']?'selected':'') ?>><?= $km['makhuyenmai'] ?> - <?= $km['tenkhuyenmai'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Phương thức bán</label>
                <select name="phuongthucban">
                    <option value="Tại quầy" <?= ($old_pt=='Tại quầy'?'selected':'') ?>>Tại quầy</option>
                    <option value="Online" <?= ($old_pt=='Online'?'selected':'') ?>>Online</option>
                </select>
            </div>

            <div class="form-group">
                <label>Thanh toán</label>
                <select name="thanhtoan">
                    <option value="Tiền mặt" <?= ($old_tt=='Tiền mặt'?'selected':'') ?>>Tiền mặt</option>
                    <option value="Chuyển khoản" <?= ($old_tt=='Chuyển khoản'?'selected':'') ?>>Chuyển khoản</option>
                </select>
            </div>
            
            <input type="hidden" name="action" id="action_type" value="save_order">
            <button type="submit" onclick="document.getElementById('action_type').value='save_order'" class="btn btn-save">LƯU HÓA ĐƠN</button>
        </div>

        <div class="card">
            <h3 style="margin-top:0">📦 Chi tiết đơn hàng</h3>
            <div style="display: flex; gap: 10px; margin-bottom: 20px; align-items: flex-end;">
                <div style="flex: 2;">
                    <label>Tìm sản phẩm</label>
                    <input name="ten_sp_search" list="list_sp" placeholder="Gõ tên sản phẩm...">
                    <datalist id="list_sp">
                        <?php $sps = $con->query("SELECT masanpham, tensanpham FROM sanpham"); 
                              while($s = $sps->fetch_assoc()) echo "<option value='{$s['masanpham']}'>{$s['tensanpham']}</option>"; ?>
                    </datalist>
                </div>
                <div style="flex: 0.5;">
                    <label>Số lượng</label>
                    <input type="number" name="sl_input" value="1" min="1" style="text-align:center">
                </div>
                <button type="submit" onclick="document.getElementById('action_type').value='add_product'" class="btn btn-add">THÊM</button>
            </div>

            <table>
                <thead><tr><th>Mã SP</th><th>Tên sản phẩm</th><th>SL</th><th>Đơn giá</th><th>Thành tiền</th><th></th></tr></thead>
                <tbody>
                    <?php 
                    $subtotal = 0;
                    if(!empty($_SESSION['cart'])):
                        foreach($_SESSION['cart'] as $idx => $item): 
                            $tt = $item['soluong'] * $item['dongia'];
                            $subtotal += $tt;
                    ?>
                    <tr>
                        <td><?= $item['masanpham'] ?></td>
                        <td><b><?= $item['tensanpham'] ?></b></td>
                        <td><?= $item['soluong'] ?></td>
                        <td><?= number_format($item['dongia']) ?></td>
                        <td><?= number_format($tt) ?></td>
                        <td><a href="?delete=<?= $idx ?>" style="color:red; text-decoration:none">✖</a></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="6" style="text-align:center; color:#ccc">Chưa có sản phẩm nào</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="total-area">
                <p>Tạm tính: <b><?= number_format($subtotal) ?> VNĐ</b></p>
                <?php 
                    $discount = 0;
                    if ($old_km == 'KM01') {
                        $discount = $subtotal * 0.1;
                        echo "<p class='discount-text'>Giảm giá (KM01 - 10%): -".number_format($discount)." VNĐ</p>";
                    }
                    $grand_total = $subtotal - $discount;
                ?>
                <h2 style="color:var(--primary); margin: 5px 0;">Tổng: <?= number_format($grand_total) ?> VNĐ</h2>
                <input type="hidden" name="tongtien_sau_km" value="<?= $grand_total ?>">
            </div>
        </div>
    </div>
</form>

</body>
</html>