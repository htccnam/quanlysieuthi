<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>suanhanvien</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
</head>
<body>
    <form action="" method="POST" style="width: 500px; height: auto;">
        <h1>sửa nhân viên</h1>
        <br>
        <label for="txtMaNhanVien">Mã nhân viên</label>
        <input type="text" name="txtMaNhanvien" placeholder="Nhập mã nhân viên" readonly>

        <br>
        <label for="txtTenNhanVien">Tên nhân viên</label>
        <input type="text" name="txtTennhanvien" placeholder="Nhập tên nhân viên" required>

        <br>
        <label for="txtNgaySinh">Ngày sinh</label>
        <input type="date" name="txtNgaySinh" required>

        <br>
        <label for="slGioiTinh">Ngày sinh</label>
        <select name="slGioiTinh" id="">
            <option value="Nam">Nam</option>
            <option value="Nu">Nữ</option>
            <option value="Khac">Khác</option>
        </select>

        <br>
        <label for="txtDiaChi">Địa chỉ</label>
        <input type="text" name="txtDiaChi" placeholder="Nhập địa chỉ" required>

        <br>
        <label for="txtSoDienThoai">Số điện thoại</label>
        <input type="number" name="txtSoDienThoai" placeholder="Nhập số điện thoại" required>
        <br>

        <label for="txtTaiKhoan">Tài khoản</label>
        <input type="text" name="txtTaiKhoan" placeholder="Nhập tài khoản" required>
        <br>

        <label for="txtMatKhau">Số điện thoại</label>
        <input type="text" name="txtMatKhau" placeholder="Nhập mật khẩu" required>
        <br>

        <button name="btnSua">Sửa</button>
        <button name="btnThoat" onclick="window.location = 'quanlynhanvien.php'" >Thoát</button>
    </form>
    
</body>
</html>