<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Tạo Đơn Hàng Mới</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <style>
        :root {
            --p: #27ae60;
            --pd: #2563eb;
            --bg: #f3f4f6;
            --txt: #1f2937;
            --txt-s: #6b7280;
            --brd: #e5e7eb;
            --in-brd: #d1d5db;
            --rd-xl: 0.75rem;
            --rd-lg: 0.5rem;
            --sh: 0 1px 2px 0 rgb(0 0 0/0.05);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--txt);
            line-height: 1.5;
            padding: 1rem;
        }

        @media (min-width: 768px) {
            body {
                padding: 2rem;
            }
        }

        .flex {
            display: flex;
            gap: 0.5rem;
        }

        .flex-col {
            flex-direction: column;
        }

        .items-center {
            align-items: center;
        }

        .jc-between {
            justify-content: space-between;
        }

        .w-full {
            width: 100%;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: 700;
        }

        .container {
            max-width: 1024px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .card {
            background: #fff;
            border-radius: var(--rd-xl);
            border: 1px solid var(--brd);
            box-shadow: var(--sh);
            overflow: hidden;
        }

        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--brd);
            background: #34495e;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--bg);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.375rem;
            color: #374151;
        }

        .form-control {
            width: 100%;
            height: 2.5rem;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            border: 1px solid var(--in-brd);
            border-radius: var(--rd-lg);
            transition: 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--p);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: var(--rd-lg);
            cursor: pointer;
            border: 1px solid transparent;
            gap: 0.5rem;
            transition: 0.2s;
        }

        .btn-p {
            background: var(--p);
            color: #fff;
        }

        .btn-p:hover {
            background: var(--pd);
        }

        .btn-s {
            background: #fff;
            color: #4b5563;
            border-color: var(--in-brd);
        }

        .btn-del {
            color: #ef4444;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.375rem;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th {
            background: #f9fafb;
            padding: 1rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--txt-s);
        }

        .custom-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
        }

        @media (min-width: 768px) {
            .page-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .form-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .toolbar-grid {
                display: grid;
                grid-template-columns: repeat(12, 1fr);
                gap: 1rem;
                align-items: end;
            }

            .footer-grid {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        }

        @media (min-width: 1024px) {
            .form-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .span-2 {
                grid-column: span 2;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="card page-header" style="padding:1.5rem">
            <div>
                <h1 style="font-size:1.5rem;font-weight:700">Tạo Đơn Hàng Mới</h1>
                <p style="color:var(--txt-s);font-size:0.875rem">Điền đầy đủ thông tin hệ thống</p>
            </div>
            <div class="flex items-center" style="color:var(--p);font-weight:500"><span style="width:12px;height:12px;background:var(--p);border-radius:50%"></span> ĐANG KHỞI TẠO</div>
        </header>

        <form id="orderForm" class="flex flex-col" style="gap:1.5rem">
            <section class="card">
                <div class="card-header">
                    <h1 class="card-title"><i class="material-icons-round">assignment</i> Thông tin chung</h1>
                </div>
                <div class="card-body form-grid">
                    <div class="form-group"><label>Mã đơn hàng <small style="color:red">*</small></label><input class="form-control" placeholder="DH-XX" required></div>
                    <div class="form-group"><label>Ngày giao dịch</label><input type="date" class="form-control"></div>
                    <div class="form-group"><label>Nhân viên</label><select class="form-control">
                            <option>-- Chọn nhân viên --</option>
                        </select></div>
                    <div class="form-group"><label>Khách hàng</label><select class="form-control">
                            <option>--Chọn khách hàng--</option>
                        </select></div>
                    <div class="form-group"><label>Phương thức bán hàng</label><select class="form-control">
                            <option>Offline</option>
                            <option>Online</option>
                        </select></div>
                    <div class="form-group"><label>Thanh toán</label><select class="form-control">
                            <option>Chuyển khoản</option>
                            <option>Tiền mặt</option>
                        </select></div>
                    <div class="form-group"><label></label></div>
                </div>
            </section>

            <section class="card">
                <div class="card-header">
                    <h1 class="card-title"><i class="material-icons-round">shopping_cart</i> Chi tiết sản phẩm</h1>
                </div>
                <div style="padding:1.5rem; background:rgba(239,246,255,0.3)" class="toolbar-grid">
                    <div style="grid-column: span 5"><label style="font-size:12px;color:var(--txt-s)">TÌM KIẾM</label><input class="form-control" placeholder="Tên hoặc mã..."></div>
                    <div style="grid-column: span 2"><label style="font-size:12px;color:var(--txt-s)">ĐƠN GIÁ</label><input class="form-control"></div>
                    <div style="grid-column: span 2"><label style="font-size:12px;color:var(--txt-s)">SL</label><input type="number" value="1" class="form-control text-center"></div>
                    <button type="button" class="btn btn-p w-full" style="grid-column: span 3; height:2.5rem">THÊM</button>
                </div>
                <div style="overflow-x:auto">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-right">Đơn giá</th>
                                <th class="text-center">SL</th>
                                <th class="text-right">Thành tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="font-bold">Laptop Dell XPS 13</div>
                                    <div style="font-size:12px;color:var(--txt-s)">SP001</div>
                                </td>
                                <td class="text-right">25,000,000 ₫</td>
                                <td class="text-center"><input type="number" value="1" class="form-control text-center" style="width:4rem;height:2rem"></td>
                                <td class="text-right font-bold" style="color:var(--p)">25,000,000 ₫</td>
                                <td class="text-right"><button class="btn-del"><i class="material-icons-round">delete_outline</i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="card" style="padding:1.5rem">
                <div class="footer-grid">
                    <div style="max-width:24rem"><label style="font-size:14px;color:var(--txt-s);font-style:italic">Mã giảm giá</label>
                        <div class="flex"><input class="form-control" placeholder="Mã..."><button type="button" class="btn btn-s">Áp dụng</button></div>
                    </div>
                    <div style="width:20rem">
                        <div class="flex jc-between"><span>Tạm tính:</span><span class="font-bold">25,000,000 ₫</span></div>
                        <div class="flex jc-between" style="border-top:1px solid var(--brd);margin-top:0.5rem;padding-top:0.5rem"><span style="font-size:1.1rem;font-weight:700">Tổng cộng:</span><span style="font-size:1.5rem;font-weight:700;color:var(--p)">25,000,000 ₫</span></div>
                    </div>
                </div>
                <div class="flex" style="justify-content:flex-end;margin-top:1.5rem">
                    <button type="button" class="btn btn-s" style="width:100px">Hủy</button>
                    <button type="submit" class="btn btn-p" style="padding:0 2rem"><i class="material-icons-round">save</i> Lưu </button>
                </div>
            </section>
        </form>
    </div>
</body>

</html>