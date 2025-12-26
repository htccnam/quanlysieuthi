<?php 
$con= mysqli_connect('localhost',"root" , null , "quanlysieuthi");
if ($con->connect_error) {
    die("Kết nối thất bại: " . $con->connect_error);
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
}
?>


<!DOCTYPE html>
<html lang="vi">

    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            html, body { 
                font-family: 'Roboto', sans-serif;               
            }

            table{
                border-collapse: collapse;
                border-radius: 5px 5px 5px 5px;
                width: 1100px;
                margin: 50px auto;
                min-width: 400px;
                overflow: hidden;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            }

            thead tr{
                background-color: greenyellow;
                text-align: left;
            }

            th, td{
                max-width: 150px;
                padding: 10px;
                text-align: left;
                overflow: hidden;
            }

            tbody tr {
                border-bottom: 1px solid #dddddd;
            }

            tbody tr:nth-of-type(even) {
                background-color: #f3f3f3ff;
            }

            tbody tr:last-of-type {
                border-bottom: 2px solid #7ae043ff;
            }

            [popover] {
                width: 300px;
                margin: 50px auto;
                padding: 20px 30px;
                border-radius: 8px;       
                border: 1px solid black;                                           
                box-shadow: 0 0 20px rgba(0,0,0,0.15);
            }   
            
            .ppvcontent{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }

            ::backdrop { 
                background: rgba(0,0,0,0.5);
            }

            .ppvcontent input{
                width: 200px;
                padding: 10px;
                border: 1px solid black;
                border-radius: 4px;
            }
        </style>
    </head>

    <body>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Mã khách hàng</th>
                    <th>Mã nhân viên</th>
                    <th>Ngày lập</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>dgsgasádasd</td>
                    <td>dssvdsfa</td>
                    <td>dssvdsfád</td>
                    <td>dssvdsaa</td>
                    <td>dssvaa</td>
                    <td>
                        <button popovertarget="in4"><i class="fa-regular fa-file"></i></button>
                        <div id="in4" popover>
                            <div class="ppvcontent">
                                <h3>CHI TIẾT SẢN PHẨM</h3>
                                <label>Mã sản phẩm</label>
                                <input type="text" name="Masanpham" value="" readonly>
                                <label>Số lượng</label>
                                <input type="number" name="Soluong" value="" readonly>
                                <label>Đơn giá</label>
                                <input type="number" name="Dongia" value="" readonly>
                                <label>Thành tiền</label>
                                <input type="number" name="Thanhtien" value="" readonly>
                            </div>
                        </div>
                        <button><i class="fa-solid fa-hammer"></i></button>
                        <button><i class="fa-solid fa-trash"></i></button>
                    </td>                                      
                </tr>
                <tr>
                    <td>Melissa</td>
                    <td>5150</td>
                    <td>5150</td>
                    <td>5150</td>
                    <td>5150</td>
                    <td>
                        <button><i class="fa-regular fa-file"></i></button>
                        <button><i class="fa-solid fa-hammer"></i></button>
                        <button><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>