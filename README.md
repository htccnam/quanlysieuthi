3.1. Phân tích và Thiết kế Cơ sở dữ liệu (Database Design)
Cơ sở dữ liệu của hệ thống có tên là quanlysieuthi, được thiết kế chuẩn hóa để tránh dư thừa dữ liệu. Dưới đây là thiết kế chi tiết của các bảng quan trọng:
3.1.1. Sơ đồ thực thể liên kết (ERD)
3.1.2. Thiết kế chi tiết các bảng dữ liệu
1. Bảng taikhoan (Quản lý truy cập hệ thống)
Dùng để lưu trữ thông tin đăng nhập của người sử dụng hệ thống (quản trị viên, nhân viên).
Tên trường	Kiểu dữ liệu	Ràng buộc	Mô tả
taikhoan	Varchar(50)	Primary Key	Tên đăng nhập (Username)
matkhau	Varchar(50)	Not Null	Mật khẩu đăng nhập
________________________________________
2. Bảng chucvu (Quản lý chức vụ)
Lưu thông tin các chức vụ trong hệ thống để phân quyền cho nhân viên.
Tên trường	Kiểu dữ liệu	Ràng buộc	Mô tả
machucvu	Varchar(50)	Primary Key	Mã chức vụ
tenchucvu	Varchar(50)		Tên chức vụ (Quản lý, Nhân viên…)
________________________________________
3. Bảng nhanvien (Quản lý nhân viên)
Lưu trữ thông tin cá nhân và chức vụ của nhân viên làm việc tại cửa hàng.
Tên trường	Kiểu dữ liệu	Mô tả
manhanvien	Varchar(50)	Khóa chính, mã nhân viên
tennhanvien	Varchar(50)	Họ tên nhân viên
ngaysinh	Date	Ngày sinh
gioitinh	Varchar(10)	Giới tính
sodienthoai	Varchar(50)	Số điện thoại
email	Varchar(50)	Email liên hệ
diachi	Varchar(255)	Địa chỉ
machucvu	Varchar(50)	Khóa ngoại liên kết bảng chucvu
________________________________________
4. Bảng khuyenmai (Quản lý khuyến mãi)
Lưu thông tin các chương trình khuyến mãi, voucher giảm giá.
Tên trường	Kiểu dữ liệu	Mô tả
makhuyenmai	Varchar(50)	Khóa chính
tenkhuyenmai	Varchar(50)	Tên chương trình khuyến mãi
mota	Varchar(200)	Mô tả nội dung
sotiengiam	Int	Số tiền được giảm
ngaytao	Date	Ngày tạo khuyến mãi
________________________________________
5. Bảng khachhang (Thông tin khách hàng & thành viên)
Quản lý thông tin khách hàng và hệ thống tích điểm – xếp hạng.
Tên trường	Kiểu dữ liệu	Mô tả
makhachhang	Varchar(20)	Khóa chính
tenkhachhang	Varchar(100)	Họ tên khách hàng
gioitinh	Varchar(10)	Giới tính
ngaysinh	Date	Ngày sinh
diachi	Varchar(255)	Địa chỉ
email	Varchar(100)	Email
sdt	Int	Số điện thoại
diemtichluy	Int	Tổng điểm tích lũy
hangthanhvien	Varchar(50)	Hạng thành viên
diemhientai	Int	Điểm hiện có
________________________________________
6. Bảng loaihang (Danh mục sản phẩm)
Dùng để phân loại sản phẩm theo nhóm.
Tên trường	Kiểu dữ liệu	Mô tả
maloai	Varchar(50)	Khóa chính
tenloai	Varchar(100)	Tên loại hàng
________________________________________
7. Bảng nhacungcap (Quản lý nhà cung cấp)
Lưu thông tin các nhà cung cấp sản phẩm cho cửa hàng.
Tên trường	Kiểu dữ liệu	Mô tả
manhacungcap	Varchar(50)	Khóa chính
tennhacungcap	Varchar(100)	Tên nhà cung cấp
loaihinh	Varchar(50)	Loại hình kinh doanh
email	Varchar(100)	Email liên hệ
sodienthoai	Varchar(20)	Số điện thoại
diachi	Varchar(255)	Địa chỉ
________________________________________
8. Bảng sanpham (Quản lý hàng hóa trong kho)
Bảng trung tâm lưu trữ toàn bộ thông tin sản phẩm.
Tên trường	Kiểu dữ liệu	Mô tả
masanpham	Varchar(50)	Khóa chính
tensanpham	Varchar(100)	Tên sản phẩm
maloai	Varchar(50)	Khóa ngoại (loaihang)
manhacungcap	Varchar(50)	Khóa ngoại (nhacungcap)
xuatxu	Varchar(100)	Xuất xứ
soluong	Int	Số lượng tồn
ngaysanxuat	Date	Ngày sản xuất
hansudung	Date	Hạn sử dụng
tinhtrang	Varchar(50)	Tình trạng sản phẩm
gianhap	Decimal(10,0)	Giá nhập
giaban	Decimal(10,0)	Giá bán
donvitinh	Varchar(20)	Đơn vị tính
________________________________________
9. Bảng donhang (Lưu trữ hóa đơn bán hàng)
Lưu thông tin tổng quát của mỗi đơn hàng.
Tên trường	Kiểu dữ liệu	Mô tả
madonhang	Varchar(50)	Khóa chính
makhachhang	Varchar(50)	Khóa ngoại (khách mua)
manhanvien	Varchar(50)	Khóa ngoại (nhân viên bán)
makhuyenmai	Varchar(50)	Khóa ngoại (khuyến mãi)
ngaylap	DateTime	Thời điểm lập đơn
phuongthucban	Varchar(50)	Online / Offline
thanhtoan	Varchar(50)	Tiền mặt / Chuyển khoản
tongtien	Decimal(10,0)	Tổng tiền thanh toán
________________________________________
10. Bảng chitietdonhang (Chi tiết từng món hàng)
Lưu danh sách sản phẩm trong mỗi đơn hàng.
Tên trường	Kiểu dữ liệu	Mô tả
madonhang	Varchar(50)	Khóa ngoại (donhang)
masanpham	Varchar(50)	Khóa ngoại (sanpham)
tensanpham	Varchar(50)	Tên sản phẩm
soluong	Int	Số lượng mua
dongia	Decimal(10,0)	Đơn giá tại thời điểm bán
thanhtien	Decimal(10,0)	Thành tiền
________________________________________
11. Bảng lichsu_doiqua (Lịch sử đổi quà)
Theo dõi việc khách hàng sử dụng điểm để đổi quà.
Tên trường	Kiểu dữ liệu	Mô tả
id	Int	Khóa chính, tự tăng
ma_khachhang	Varchar(20)	Khóa ngoại (khachhang)
ten_qua	Varchar(255)	Tên quà đã đổi
diem_da_doi	Int	Số điểm đã sử dụng
ngay_doi	DateTime	Thời điểm đổi quà
3.2. Thiết kế Sơ đồ chức năng hệ thống (Sitemap)
Dựa trên cấu trúc file điều hướng menu_admin.php, hệ thống được chia thành các phân hệ chức năng rõ ràng:
1.	Hệ thống (System):
o	Đăng nhập (login.php).
o	Đăng xuất (logout.php).
o	Trang chủ Dashboard (logo.php).
2.	Quản lý Kho & Hàng hóa (Inventory):
o	Danh sách sản phẩm (quanlysanpham.php).
o	Phân loại hàng (quanlyloaihang.php).
o	Nhà cung cấp (quanlynhacungcap.php).
3.	Bán hàng & Giao dịch (Sales):
o	Tạo đơn hàng mới - POS (tao_don.php).
o	Quản lý danh sách đơn hàng (thong_tin.php).
o	Chi tiết đơn hàng (xem_don.php).
4.	Đối tác & Nhân sự (HR & CRM):
o	Quản lý Khách hàng (quanlykhachhang.php).
o	Xếp hạng thành viên (xephangthanhvien.php).
o	Quản lý Nhân viên (quanlynhanvien.php).
o	Quản lý Chức vụ (quanlychucvu.php).
5.	Marketing:
o	Quản lý Khuyến mãi (quanlykhuyenmai.php).
