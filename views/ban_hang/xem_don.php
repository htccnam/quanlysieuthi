<?php
$con = mysqli_connect('localhost', "root", "", "quanlysieuthi");
$id = $_GET['id'];
$order = $con->query("SELECT * FROM donhang WHERE madonhang = '$id'")->fetch_assoc();
$details = $con->query("SELECT * FROM chitietdonhang WHERE madonhang = '$id'");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; }
        .container { background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto; border-top: 5px solid #3498db; }
        h2 { color: #2c3e50; text-align: center; margin-top: 0; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .info-item { font-size: 14px; color: #555; }
        .info-item b { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table th, table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        table th { background-color: #34495e; color: white; font-weight: 600; }
        .total-row { text-align: right; font-size: 18px; color: #e74c3c; margin-top: 20px; }
        .btn { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; color: white; display: inline-block; font-size: 14px; }
        .btn-back { background-color: #7f8c8d; } .btn-back:hover { background-color: #95a5a6; }
    </style>
</head>
<body>
    <div class="container">
        <h2>CHI TIẾT ĐƠN HÀNG: <?= $id ?></h2>
        
        <div class="info-row">
            <div class="info-item">Ngày lập: <b><?= date('d/m/Y', strtotime($order['ngaylap'])) ?></b></div>
            <div class="info-item">Phương thức: <b><?= $order['phuongthucban'] ?></b></div>
            <div class="info-item">Thanh toán: <b><?= $order['thanhtoan'] ?></b></div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá</th>
                    <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php while($item = $details->fetch_assoc()): ?>
                <tr>
                    <td><?= $item['tensanpham'] ?></td>
                    <td><?= $item['soluong'] ?></td>
                    <td><?= number_format($item['dongia']) ?> đ</td>
                    <td><b><?= number_format($item['thanhtien']) ?> đ</b></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="total-row">
            Tổng cộng: <b><?= number_format($order['tongtien']) ?> đ</b>
        </div>
        
        <div style="margin-top: 20px; text-align: center;">
            <a href="thong_tin.php" class="btn btn-back">← Quay lại danh sách</a>
        </div>
    </div>
</body>
</html>