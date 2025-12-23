-- Tạo database nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS quanlysieuthi

-- Chọn database để làm việc
USE quanlysieuthi;

-- Xóa bảng nếu đã tồn tại (tránh lỗi khi chạy lại)
DROP TABLE IF EXISTS nhanvien;

-- Tạo bảng
CREATE TABLE nhanvien (
    manhanvien VARCHAR(50) PRIMARY KEY,
    tennhanvien VARCHAR(50),
    ngaysinh DATE,
    gioitinh VARCHAR(10),
    diachi VARCHAR(50),
    sodienthoai VARCHAR(50),
    taikhoan VARCHAR(30),
    matkhau VARCHAR(30)
);

-- Thêm dữ liệu vào bảng nhanvien
INSERT INTO nhanvien (manhanvien, tennhanvien, ngaysinh, gioitinh, diachi, sodienthoai, taikhoan, matkhau) 
VALUES 
-- Tài khoản đầu tiên: tk=1, mk=1
('NV001', 'Nguyễn Văn A', '1990-05-15', 'Nam', '123 Đường Lê Lợi, Quận 1, TP.HCM', '0909123456', '1', '1')

