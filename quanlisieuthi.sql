-- Tạo database nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS quanlysieuthi;

-- chạy query tạo database trước tránh lỗi
-- Chọn database để làm việc
USE quanlysieuthi;

DROP TABLE IF EXISTS tintuc;
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

CREATE TABLE tintuc(
    matintuc VARCHAR(50) PRIMARY KEY,
    tieude VARCHAR(255),
    manhanvien VARCHAR(50),
    noidung TEXT,
    loaitin VARCHAR(50),
    ngaydang DATE,

    FOREIGN KEY (manhanvien) REFERENCES nhanvien(manhanvien)
);
-- Thêm dữ liệu vào bảng nhanvien
INSERT INTO nhanvien (manhanvien, tennhanvien, ngaysinh, gioitinh, diachi, sodienthoai, taikhoan, matkhau) 
VALUES 
-- Tài khoản đầu tiên: tk=1, mk=1
('NV001', 'Nguyễn Văn A', '1990-05-15', 'Nam', '123 Đường Lê Lợi, Quận 1, TP.HCM', '0909123456', '1', '1'),
('NV002', 'Hoàng Hải Nam', '1990-05-15', 'Nam', 'Lục Ngạn , Bắc Ninh', '0909123456', '2', '2')
;
-- Thêm dữ liệu vào bảng tintuc
INSERT INTO tintuc (matintuc, tieude, manhanvien, noidung, loaitin, ngaydang)
VALUES
('TT001', 'Thông báo nghỉ lễ 30/4-1/5', 'NV001', 'Công ty sẽ nghỉ lễ từ ngày 30/4 đến hết ngày 1/5...', 'Thông báo nội bộ', '2024-04-25'),
('TT002', 'Kế hoạch team building tháng 5', 'NV001', 'Chương trình team building sẽ được tổ chức vào ngày 15/5...', 'Hoạt động công ty', '2024-04-28'),
('TT003', 'Hướng dẫn sử dụng hệ thống mới', 'NV001', 'Hệ thống quản lý mới sẽ được triển khai từ ngày 1/6...', 'Đào tạo', '2024-04-30');

