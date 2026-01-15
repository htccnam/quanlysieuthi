<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng</title>
    <style>
        /* CSS GỐC - KHÔNG DÙNG FRAMEWORK */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        /* Khu vực thống kê */
        .stats-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            gap: 20px;
        }

        .stat-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            flex: 1;
            text-align: center;
            border-top: 5px solid #3498db;
        }

        .stat-card h3 {
            margin: 0;
            font-size: 14px;
            color: #7f8c8d;
            text-transform: uppercase;
        }

        .stat-card p {
            margin: 10px 0 0;
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        /* Bảng dữ liệu */
        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #34495e;
            color: white;
            font-weight: 600;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Nút chức năng */
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
            margin-right: 5px;
            color: white;
        }

        .btn-view { background-color: #3498db; }
        .btn-edit { background-color: #f1c40f; color: #000; }
        .btn-delete { background-color: #e74c3c; }

        .btn:hover { opacity: 0.8; }

    </style>
</head>
<body>

    <h2>HỆ THỐNG QUẢN LÝ ĐƠN HÀNG</h2>

    <div class="stats-container">
        <div class="stat-card" style="border-top-color: #27ae60;">
            <h3>Tổng doanh thu</h3>
            <p>150.000.000 đ</p>
        </div>
        <div class="stat-card" style="border-top-color: #3498db;">
            <h3>Tổng số đơn</h3>
            <p>120</p>
        </div>
        <div class="stat-card" style="border-top-color: #e67e22;">
            <h3>Doanh thu TB/Đơn</h3>
            <p>1.250.000 đ</p>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Mã Đơn (PK)</th>
                    <th>Ngày Giao Dịch</th>
                    <th>Phương Thức Bán</th>
                    <th>Thanh Toán</th>
                    <th>Tổng Tiền</th>
                    <th>Chức Năng</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>DH001</td>
                    <td>2026-01-13</td>
                    <td>Trực tiếp</td>
                    <td>Tiền mặt</td>
                    <td>5.000.000 đ</td>
                    <td>
                        <button class="btn btn-view">Xem</button>
                        <button class="btn btn-edit">Sửa</button>
                        <button class="btn btn-delete">Xóa</button>
                    </td>
                </tr>
                <tr>
                    <td>DH002</td>
                    <td>2026-01-13</td>
                    <td>Online</td>
                    <td>Chuyển khoản</td>
                    <td>2.500.000 đ</td>
                    <td>
                        <button class="btn btn-view">Xem</button>
                        <button class="btn btn-edit">Sửa</button>
                        <button class="btn btn-delete">Xóa</button>
                    </td>
                </tr>
                </tbody>
        </table>
    </div>

</body>
</html>