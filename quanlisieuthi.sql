-- ===============================
-- 1. TẠO DATABASE
-- ===============================
CREATE DATABASE IF NOT EXISTS quanlysieuthi
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE quanlysieuthi;

-- ===============================
-- 2. BẢNG NHÂN VIÊN
-- ===============================
CREATE TABLE nhanvien (
    manhanvien VARCHAR(50) PRIMARY KEY,
    tennhanvien VARCHAR(50),
    ngaysinh DATE,
    gioitinh VARCHAR(10),
    diachi VARCHAR(255),
    sodienthoai VARCHAR(50)
) ENGINE=InnoDB;

-- ===============================
-- 3. BẢNG KHÁCH HÀNG
-- ===============================
CREATE TABLE khachhang (
    makhachhang VARCHAR(50) PRIMARY KEY,
    tenkhachhang VARCHAR(50),
    sodienthoai VARCHAR(50),
    diachi VARCHAR(255),
    diemtichluy INT DEFAULT 0,
    taikhoan VARCHAR(30),
    matkhau VARCHAR(30)
) ENGINE=InnoDB;

-- ===============================
-- 4. BẢNG LOẠI HÀNG
-- ===============================
CREATE TABLE loaihang (
    maloaihang VARCHAR(50) PRIMARY KEY,
    tenloaihang VARCHAR(100)
) ENGINE=InnoDB;

-- ===============================
-- 5. BẢNG THƯƠNG HIỆU
-- ===============================
CREATE TABLE thuonghieu (
    mathuonghieu VARCHAR(50) PRIMARY KEY,
    tenthuonghieu VARCHAR(100),
    diachi VARCHAR(255)
) ENGINE=InnoDB;

-- ===============================
-- 6. BẢNG SẢN PHẨM
-- ===============================
CREATE TABLE sanpham (
    masanpham VARCHAR(50) PRIMARY KEY,
    tensanpham VARCHAR(100),
    maloaihang VARCHAR(50),
    mathuonghieu VARCHAR(50),
    soluong INT DEFAULT 0,
    gianhap DECIMAL(10,0),
    giaban DECIMAL(10,0),
    donvitinh VARCHAR(20),

    CONSTRAINT fk_sp_loai
        FOREIGN KEY (maloaihang)
        REFERENCES loaihang(maloaihang)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_sp_thuonghieu
        FOREIGN KEY (mathuonghieu)
        REFERENCES thuonghieu(mathuonghieu)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===============================
-- 7. BẢNG TIN TỨC
-- ===============================
CREATE TABLE tintuc (
    matintuc VARCHAR(50) PRIMARY KEY,
    tieude VARCHAR(255),
    manhanvien VARCHAR(50),
    noidung TEXT,
    loaitin VARCHAR(50),
    ngaydang DATE,

    CONSTRAINT fk_tintuc_nv
        FOREIGN KEY (manhanvien)
        REFERENCES nhanvien(manhanvien)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===============================
-- 8. BẢNG TIN TỨC ĐÃ ĐỌC
-- ===============================
CREATE TABLE tintuc_dadoc (
    makhachhang VARCHAR(50),
    matintuc VARCHAR(50),
    ngaydoc DATETIME DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (makhachhang, matintuc),

    FOREIGN KEY (makhachhang)
        REFERENCES khachhang(makhachhang)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (matintuc)
        REFERENCES tintuc(matintuc)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===============================
-- 9. BẢNG ĐƠN HÀNG
-- ===============================
CREATE TABLE donhang (
    madonhang VARCHAR(50) PRIMARY KEY,
    makhachhang VARCHAR(50),
    manhanvien VARCHAR(50),
    ngaylap DATETIME DEFAULT CURRENT_TIMESTAMP,
    noinhanhang VARCHAR(50),
    trangthai VARCHAR(20) DEFAULT 'Chờ xử lý',

    FOREIGN KEY (makhachhang)
        REFERENCES khachhang(makhachhang)
        ON DELETE SET NULL
        ON UPDATE CASCADE,

    FOREIGN KEY (manhanvien)
        REFERENCES nhanvien(manhanvien)
        ON DELETE SET NULL
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===============================
-- 10. BẢNG CHI TIẾT ĐƠN HÀNG
-- ===============================
CREATE TABLE chitietdonhang (
    madonhang VARCHAR(50),
    masanpham VARCHAR(50),
    soluong INT,
    dongia DECIMAL(10,0),
    thanhtien DECIMAL(10,0),

    PRIMARY KEY (madonhang, masanpham),

    FOREIGN KEY (madonhang)
        REFERENCES donhang(madonhang)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (masanpham)
        REFERENCES sanpham(masanpham)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ===============================
-- 11. DỮ LIỆU MẪU
-- ===============================

INSERT INTO nhanvien VALUES
('NV01','Nguyễn Văn A','1990-05-15','Nam','Quận 1, TP.HCM','0909123456'),
('NV02','Hoàng Hải Nam','1995-08-20','Nam','Bắc Ninh','0912345678');

INSERT INTO loaihang VALUES
('LH01','Thực phẩm tươi sống'),
('LH02','Đồ uống'),
('LH03','Gia dụng');

INSERT INTO thuonghieu VALUES
('TH01','Vinamilk','Việt Nam'),
('TH02','Coca Cola','Mỹ'),
('TH03','Sunhouse','Hàn Quốc');

INSERT INTO sanpham VALUES
('SP01','Sữa tươi 1L','LH02','TH01',100,25000,32000,'Hộp'),
('SP02','Nước ngọt Coca','LH02','TH02',200,8000,10000,'Lon'),
('SP03','Chảo chống dính','LH03','TH03',50,150000,220000,'Cái');

INSERT INTO khachhang VALUES
('KH01','Trần Thị B','0987654321','Hà Nội',10,'admin','admin'),
('KH02','Lê Văn C','0345678910','Đà Nẵng',50,'1','1');

INSERT INTO tintuc VALUES
('TT01','Thông báo nghỉ lễ 30/4','NV01','Nghỉ từ 30/4 đến 1/5','Thông báo','2024-04-25'),
('TT02','Khuyến mãi tháng 5','NV01','Giảm giá 50% toàn bộ','Khuyến mãi','2024-05-01');
