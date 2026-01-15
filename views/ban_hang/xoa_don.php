<?php
$con = mysqli_connect('localhost', "root", "", "quanlysieuthi");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query1 = "DELETE FROM chitietdonhang WHERE madonhang = '$id'";
    mysqli_query($con, $query1);

    $query2 = "DELETE FROM donhang WHERE madonhang = '$id'";
    mysqli_query($con, $query2);
}

header("Location: thong_tin.php");
exit();
?>