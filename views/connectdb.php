<?php
    $con= mysqli_connect('localhost',"root" , null , "quanlysieuthi");
    if (!$con) {
    die("Lỗi kết nối MySQL: " . mysqli_connect_error());
}

// Thiết lập font tiếng Việt
mysqli_set_charset($con, 'utf8');
?>