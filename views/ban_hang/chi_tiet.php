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
        <style>
            html, body { 
                font-family: 'Roboto', sans-serif;               
            }

            table{
                border-collapse: collapse;
                border-radius: 5px 5px 5px 5px;
                width: 1200px;
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
                padding: 10px;
                text-align: left;
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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>dgsgas</td>
                    <td>dssvdsf</td>
                    <td>dssvdsf</td>
                    <td>dssvdsf</td>
                    <td>dssvdsf</td>
                </tr>
                <tr class="active-row">
                    <td>Melissa</td>
                    <td>5150</td>
                    <td>5150</td>
                    <td>5150</td>
                    <td>5150</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>