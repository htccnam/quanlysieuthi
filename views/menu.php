<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>

<body>
    <div style="height: 30%;">
        <header>
            <div class="logo">
                <a href="https://crmviet.vn/11-cach-gioi-thieu-san-pham-hay-nhat-dem-lai-hieu-qua-ban-hang/"
                    target="contentFrame">Trang chủ</a>
            </div>
            <ul class="menu">
                <li><a href="">Nhân viên</a>
                    <ul>
                        <li><a href="nhanvien/quanlynhanvien.php" target="contentFrame">quản lý nhân viên</a></li>
                        <li><a href="">thống kê nhân viên</a></li>
                    </ul>
                </li>
                <li><a href="#">quản lý</a></li>
                <li><a href="#">nhân viên</a></li>
                <li><a href="#">khách hàng</a></li>
                <li><button onclick="if(confirm('bạn có chắc chắc muốn đăng xuất')){window.location='login.php';}">Đăng
                        xuất</button></li>
            </ul>
        </header>
    </div>
    <!-- THẺ DIV ĐỂ CHỨA NỘI DUNG -->
    <div style="height: 750px; ">
        <iframe name="contentFrame" style="width:100%; height:100%; border:none;">
        </iframe>
    </div>
</body>
</html>