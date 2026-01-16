<?php
$con = mysqli_connect('localhost', "root", "", "quanlysieuthi");
if (!$con) { die("Kết nối thất bại: " . mysqli_connect_error()); }

$sql_stats = "SELECT SUM(tongtien) as total_revenue, COUNT(madonhang) as total_orders FROM donhang";
$res_stats = $con->query($sql_stats);
$stats = $res_stats->fetch_assoc();

$total_revenue = $stats['total_revenue'] ?? 0;
$total_orders = $stats['total_orders'] ?? 0;
$average_per_order = ($total_orders > 0) ? ($total_revenue / $total_orders) : 0;

$sql_list = "SELECT * FROM donhang ORDER BY ngaylap DESC";
$res_list = $con->query($sql_list);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; margin: 20px; color: #333; }
        h2 { text-align: center; color: #2c3e50; }
        .stats-container { display: flex; justify-content: space-between; margin-bottom: 25px; gap: 20px; }
        .stat-card { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); flex: 1; text-align: center; border-top: 5px solid #3498db; }
        .stat-card h3 { margin: 0; font-size: 14px; color: #7f8c8d; text-transform: uppercase; }
        .stat-card p { margin: 10px 0 0; font-size: 24px; font-weight: bold; color: #2c3e50; }
        .table-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table th, table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        table th { background-color: #34495e; color: white; font-weight: 600; }
        table tr:hover { background-color: #f1f1f1; }
        .btn { padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; text-decoration: none; display: inline-block; margin-right: 5px; color: white; }
        .btn-view { background-color: #3498db; }
        .btn-edit { background-color: #f1c40f; color: #000; }
        .btn-delete { background-color: #e74c3c; }
    </style>
</head>
<body>

    <h2>HỆ THỐNG QUẢN LÝ ĐƠN HÀNG</h2>

    <div class="stats-container">
        <div class="stat-card" style="border-top-color: #27ae60;">
            <h3>Tổng doanh thu</h3>
            <p><?= number_format($total_revenue) ?> đ</p>
        </div>
        <div class="stat-card" style="border-top-color: #3498db;">
            <h3>Tổng số đơn</h3>
            <p><?= $total_orders ?></p>
        </div>
        <div class="stat-card" style="border-top-color: #e67e22;">
            <h3>Doanh thu TB/Đơn</h3>
            <p><?= number_format($average_per_order) ?> đ</p>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Mã Đơn</th>
                    <th>Ngày Giao Dịch</th>
                    <th>Phương Thức</th>
                    <th>Thanh Toán</th>
                    <th>Khuyến Mại</th>
                    <th>Tổng Tiền</th>
                    <th>Chức Năng</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($res_list->num_rows > 0): ?>
                    <?php while($row = $res_list->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['madonhang'] ?></td>
                        <td><?= date('d/m/Y', strtotime($row['ngaylap'])) ?></td>
                        <td><?= $row['phuongthucban'] ?></td>
                        <td><?= $row['thanhtoan'] ?></td>
                        <td><?= $row['makhuyenmai'] ?: 'Không' ?></td>
                        <td><b><?= number_format($row['tongtien']) ?> đ</b></td>
                        <td>
                            <a href="xem_don.php?id=<?= $row['madonhang'] ?>" class="btn btn-view">Xem</a>
                            <a href="sua_don.php?id=<?= $row['madonhang'] ?>" class="btn btn-edit">Sửa</a>
                            <a href="xoa_don.php?id=<?= $row['madonhang'] ?>" class="btn btn-delete" onclick="return confirm('Xác nhận xóa?')">Xóa</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7" style="text-align:center;">Chưa có dữ liệu.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>