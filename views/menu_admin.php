<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ SIÊU THỊ</title>

    <!-- link phông chữ -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/menu.css">

    <!-- add phông chữ -->
    <style>
        html,
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body>

    <div>
        <header>
            <div class="logo">
                <a href="logo.php" target="contentFrame">QUẢN LÝ SIÊU THỊ</a>
            </div>
            <ul class="menu">
                <li><a href="#">📦 Hàng hóa & Kho ▼</a>
                    <ul>
                        <li><a href="sanpham/quanlysanpham.php" target="contentFrame">Danh sách sản phẩm</a></li>
                        <li><a href="phanloaihang/quanlyloaihang.php" target="contentFrame">Phân loại hàng</a></li>
                        <li><a href="nhacungcap/quanlynhacungcap.php" target="contentFrame">Nhà cung cấp</a></li>
                    </ul>
                </li>

                <li><a href="#">🛒 Bán hàng ▼</a>
                    <ul>
                        <li><a href="ban_hang/them_don.php" target="contentFrame">Tạo đơn mới</a></li>
                        <li><a href="ban_hang/chi_tiet.php" target="contentFrame">Chi tiết đơn hàng</a></li>
                    </ul>
                </li>
                

                <li><a href="khachhang/quanlykhachhang.php" target="contentFrame">👥 Khách hàng</a></li>
                <!--Khách hàng-->
                <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle" href="#" id="navKhachHang" role="button" data-bs-toggle="dropdown">
                   Khách hàng
                 </a>
                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="">Danh sách khách hàng</a></li>
                     <li><a class="dropdown-item" href="">Lịch sử mua hàng</a></li>
                   </ul>
                 </li>

                <li><a href="tintuc/tintuc.php" target="contentFrame">📰 Tin tức</a></li>

                <li><a href="nhanvien/quanlynhanvien.php" target="contentFrame">👔 Nhân sự</a>
                </li>

                <li>
                    <button onclick="if(confirm('Bạn có chắc muốn đăng xuất?')){window.location='login.php';}"
                        style="color: #ff6b6b; font-weight: bold;">
                        Đăng xuất ➜
                    </button>
                </li>
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