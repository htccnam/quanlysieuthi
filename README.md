# 🛒 HỆ THỐNG QUẢN LÝ SIÊU THỊ (SUPERMARKET MANAGEMENT SYSTEM)

## 📌 Giới thiệu

**Hệ thống Quản lý Siêu thị** là một ứng dụng web được xây dựng nhằm hỗ trợ quản lý toàn bộ hoạt động vận hành của siêu thị/cửa hàng bán lẻ, bao gồm:

* Quản lý **nhân viên**
* Quản lý **sản phẩm, kho hàng, nhà cung cấp**
* Quản lý **khách hàng, tích điểm & xếp hạng thành viên**
* **Bán hàng – tạo đơn – hóa đơn**
* Quản lý **chương trình khuyến mãi**

Hệ thống được thiết kế theo hướng **đơn giản – dễ mở rộng – phù hợp cho học tập, đồ án và triển khai thực tế quy mô nhỏ & vừa**.

## 🎯 Mục tiêu dự án

* Áp dụng kiến thức về **PHP & MySQL** vào xây dựng hệ thống quản lý hoàn chỉnh
* Rèn luyện tư duy **thiết kế CSDL, phân quyền, luồng nghiệp vụ**
* Phục vụ cho:

  * Đồ án môn học
  * Tham khảo học tập
  * Portfolio cá nhân

---

## 🛠 Công nghệ sử dụng

* **Ngôn ngữ:** PHP (thuần)
* **Cơ sở dữ liệu:** MySQL
* **Giao diện:** HTML, CSS, Bootstrap
* **Môi trường chạy:** XAMPP / WAMP / Laragon
* **Mô hình:** Web-based Application

---

## 🚀 Cách clone & chạy dự án

### 1️⃣ Clone project từ GitHub

```bash
git clone https://github.com/htccnam/quanlysieuthi_web_php.git
```

Hoặc tải trực tiếp:

* Chọn **Code → Download ZIP**
* Giải nén vào thư mục `htdocs` (XAMPP) hoặc `www` (WAMP)

---

### 2️⃣ Import cơ sở dữ liệu

1. Mở **phpMyAdmin**
2. Tạo database (ví dụ):

   ```sql
   CREATE DATABASE quanlysieuthi;
   ```
3. Import file `.sql` trong thư mục `database/` (nếu có)

---

### 3️⃣ Cấu hình kết nối CSDL

Mở file:

```text
connectdb.php
```

Chỉnh lại thông tin:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "quanlysieuthi";
```

---

### 4️⃣ Chạy project

* Mở trình duyệt
* Truy cập:

```text
http://localhost/REPOSITORY_NAME/
```

---

## 🔐 Tài khoản mặc định (nếu có)

```text
Username: admin
Password: admin123
```

> (Có thể chỉnh trong bảng `taikhoan`)

---

## 🗂 Cấu trúc chức năng chính

* **System:** Đăng nhập, đăng xuất, Dashboard
* **Inventory:** Sản phẩm, loại hàng, nhà cung cấp
* **Sales:** Tạo đơn, quản lý hóa đơn
* **HR & CRM:** Nhân viên, khách hàng, thành viên
* **Marketing:** Khuyến mãi

*(Chi tiết CSDL & sitemap được trình bày ở các mục bên dưới 👇)*

---

## 📌 Ghi chú

* Dự án mang tính **học tập & tham khảo**
* Có thể mở rộng thêm:

  * Báo cáo doanh thu
  * Phân quyền chi tiết
  * Thống kê – biểu đồ

---

## 📄 License

This project is licensed under the **MIT License** – feel free to use, modify and share.

---

Nếu bạn muốn mình:

* ✨ Cá nhân hóa README theo **tên bạn**
* 🧩 Viết thêm **ERD / sơ đồ luồng**
* 📸 Thêm **Screenshots section**
* 🎓 Chuẩn hóa theo **đồ án CNTT / báo cáo tốt nghiệp**

👉 Chỉ cần nói mình chỉnh tiếp phần nào nhé 🚀

## 3.1.2. Thiết kế chi tiết các bảng dữ liệu

### 1. Bảng `taikhoan` – Quản lý truy cập hệ thống

Lưu trữ thông tin đăng nhập của người dùng hệ thống (quản trị viên, nhân viên).

| Tên trường | Kiểu dữ liệu | Ràng buộc   | Mô tả                    |
| ---------- | ------------ | ----------- | ------------------------ |
| taikhoan   | VARCHAR(50)  | Primary Key | Tên đăng nhập (Username) |
| matkhau    | VARCHAR(50)  | NOT NULL    | Mật khẩu đăng nhập       |

---

### 2. Bảng `chucvu` – Quản lý chức vụ

Quản lý các chức vụ trong hệ thống nhằm phân quyền cho nhân viên.

| Tên trường | Kiểu dữ liệu | Ràng buộc   | Mô tả                               |
| ---------- | ------------ | ----------- | ----------------------------------- |
| machucvu   | VARCHAR(50)  | Primary Key | Mã chức vụ                          |
| tenchucvu  | VARCHAR(50)  |             | Tên chức vụ (Quản lý, Nhân viên, …) |

---

### 3. Bảng `nhanvien` – Quản lý nhân viên

Lưu trữ thông tin cá nhân và chức vụ của nhân viên.

| Tên trường  | Kiểu dữ liệu | Mô tả                        |
| ----------- | ------------ | ---------------------------- |
| manhanvien  | VARCHAR(50)  | Khóa chính, mã nhân viên     |
| tennhanvien | VARCHAR(50)  | Họ tên nhân viên             |
| ngaysinh    | DATE         | Ngày sinh                    |
| gioitinh    | VARCHAR(10)  | Giới tính                    |
| sodienthoai | VARCHAR(50)  | Số điện thoại                |
| email       | VARCHAR(50)  | Email liên hệ                |
| diachi      | VARCHAR(255) | Địa chỉ                      |
| machucvu    | VARCHAR(50)  | Khóa ngoại liên kết `chucvu` |

---

### 4. Bảng `khuyenmai` – Quản lý khuyến mãi

Quản lý các chương trình khuyến mãi, voucher giảm giá.

| Tên trường   | Kiểu dữ liệu | Mô tả            |
| ------------ | ------------ | ---------------- |
| makhuyenmai  | VARCHAR(50)  | Khóa chính       |
| tenkhuyenmai | VARCHAR(50)  | Tên chương trình |
| mota         | VARCHAR(200) | Mô tả nội dung   |
| sotiengiam   | INT          | Số tiền giảm     |
| ngaytao      | DATE         | Ngày tạo         |

---

### 5. Bảng `khachhang` – Thông tin khách hàng & thành viên

Quản lý khách hàng, tích điểm và xếp hạng thành viên.

| Tên trường    | Kiểu dữ liệu | Mô tả              |
| ------------- | ------------ | ------------------ |
| makhachhang   | VARCHAR(20)  | Khóa chính         |
| tenkhachhang  | VARCHAR(100) | Họ tên khách hàng  |
| gioitinh      | VARCHAR(10)  | Giới tính          |
| ngaysinh      | DATE         | Ngày sinh          |
| diachi        | VARCHAR(255) | Địa chỉ            |
| email         | VARCHAR(100) | Email              |
| sdt           | INT          | Số điện thoại      |
| diemtichluy   | INT          | Tổng điểm tích lũy |
| hangthanhvien | VARCHAR(50)  | Hạng thành viên    |
| diemhientai   | INT          | Điểm hiện có       |

---

### 6. Bảng `loaihang` – Danh mục sản phẩm

Phân loại sản phẩm theo nhóm.

| Tên trường | Kiểu dữ liệu | Mô tả         |
| ---------- | ------------ | ------------- |
| maloai     | VARCHAR(50)  | Khóa chính    |
| tenloai    | VARCHAR(100) | Tên loại hàng |

---

### 7. Bảng `nhacungcap` – Quản lý nhà cung cấp

Lưu thông tin các nhà cung cấp sản phẩm.

| Tên trường    | Kiểu dữ liệu | Mô tả                |
| ------------- | ------------ | -------------------- |
| manhacungcap  | VARCHAR(50)  | Khóa chính           |
| tennhacungcap | VARCHAR(100) | Tên nhà cung cấp     |
| loaihinh      | VARCHAR(50)  | Loại hình kinh doanh |
| email         | VARCHAR(100) | Email liên hệ        |
| sodienthoai   | VARCHAR(20)  | Số điện thoại        |
| diachi        | VARCHAR(255) | Địa chỉ              |

---

### 8. Bảng `sanpham` – Quản lý hàng hóa trong kho

Bảng trung tâm lưu trữ toàn bộ thông tin sản phẩm.

| Tên trường   | Kiểu dữ liệu  | Mô tả                     |
| ------------ | ------------- | ------------------------- |
| masanpham    | VARCHAR(50)   | Khóa chính                |
| tensanpham   | VARCHAR(100)  | Tên sản phẩm              |
| maloai       | VARCHAR(50)   | Khóa ngoại (`loaihang`)   |
| manhacungcap | VARCHAR(50)   | Khóa ngoại (`nhacungcap`) |
| xuatxu       | VARCHAR(100)  | Xuất xứ                   |
| soluong      | INT           | Số lượng tồn              |
| ngaysanxuat  | DATE          | Ngày sản xuất             |
| hansudung    | DATE          | Hạn sử dụng               |
| tinhtrang    | VARCHAR(50)   | Tình trạng                |
| gianhap      | DECIMAL(10,0) | Giá nhập                  |
| giaban       | DECIMAL(10,0) | Giá bán                   |
| donvitinh    | VARCHAR(20)   | Đơn vị tính               |

---

### 9. Bảng `donhang` – Lưu trữ hóa đơn bán hàng

Lưu thông tin tổng quát của mỗi đơn hàng.

| Tên trường    | Kiểu dữ liệu  | Mô tả                   |
| ------------- | ------------- | ----------------------- |
| madonhang     | VARCHAR(50)   | Khóa chính              |
| makhachhang   | VARCHAR(50)   | Khóa ngoại              |
| manhanvien    | VARCHAR(50)   | Khóa ngoại              |
| makhuyenmai   | VARCHAR(50)   | Khóa ngoại              |
| ngaylap       | DATETIME      | Thời điểm lập           |
| phuongthucban | VARCHAR(50)   | Online / Offline        |
| thanhtoan     | VARCHAR(50)   | Tiền mặt / Chuyển khoản |
| tongtien      | DECIMAL(10,0) | Tổng tiền               |

---

### 10. Bảng `chitietdonhang` – Chi tiết đơn hàng

Lưu danh sách sản phẩm trong mỗi đơn hàng.

| Tên trường | Kiểu dữ liệu  | Mô tả        |
| ---------- | ------------- | ------------ |
| madonhang  | VARCHAR(50)   | Khóa ngoại   |
| masanpham  | VARCHAR(50)   | Khóa ngoại   |
| tensanpham | VARCHAR(50)   | Tên sản phẩm |
| soluong    | INT           | Số lượng mua |
| dongia     | DECIMAL(10,0) | Đơn giá      |
| thanhtien  | DECIMAL(10,0) | Thành tiền   |

---

### 11. Bảng `lichsu_doiqua` – Lịch sử đổi quà

Theo dõi việc khách hàng sử dụng điểm để đổi quà.

| Tên trường   | Kiểu dữ liệu | Mô tả               |
| ------------ | ------------ | ------------------- |
| id           | INT          | Khóa chính, tự tăng |
| ma_khachhang | VARCHAR(20)  | Khóa ngoại          |
| ten_qua      | VARCHAR(255) | Tên quà             |
| diem_da_doi  | INT          | Số điểm đã đổi      |
| ngay_doi     | DATETIME     | Thời điểm đổi       |

---

## 3.2. Thiết kế Sơ đồ chức năng hệ thống (Sitemap)

Dựa trên cấu trúc file `menu_admin.php`, hệ thống bao gồm các phân hệ sau:

### 1. Hệ thống (System)

* Đăng nhập (`login.php`)
* Đăng xuất (`logout.php`)
* Trang chủ Dashboard (`logo.php`)

### 2. Quản lý Kho & Hàng hóa (Inventory)

* Danh sách sản phẩm (`quanlysanpham.php`)
* Phân loại hàng (`quanlyloaihang.php`)
* Nhà cung cấp (`quanlynhacungcap.php`)

### 3. Bán hàng & Giao dịch (Sales)

* Tạo đơn hàng – POS (`tao_don.php`)
* Danh sách đơn hàng (`thong_tin.php`)
* Chi tiết đơn hàng (`xem_don.php`)

### 4. Đối tác & Nhân sự (HR & CRM)

* Quản lý khách hàng (`quanlykhachhang.php`)
* Xếp hạng thành viên (`xephangthanhvien.php`)
* Quản lý nhân viên (`quanlynhanvien.php`)
* Quản lý chức vụ (`quanlychucvu.php`)

### 5. Marketing

* Quản lý khuyến mãi (`quanlykhuyenmai.php`)

Chỉ cần nói mục tiêu nhé 👍
