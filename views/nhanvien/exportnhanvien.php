<?php 
include_once("../connectdb.php");
$textMaNhanVien = $_GET['manhanvien'];

header("Content-type: text/csv; charset=UTF-8");
header("Content-Disposition: attachment ; filename=danhsach.csv");

$output = fopen("php://output","w");
echo "\xEF\xBB\xBF";

fputcsv($output,['manhanvien','tennhanvien','ngaysinh','diachi','sodienthoai'] , ';');

$sql ="SELECT * FROM nhanvien WHERE manhanvien LIKE '%$textMaNhanVien%'";
$result = mysqli_query($con,$sql);

while ($row = mysqli_fetch_assoc($result)){
    fputcsv($output,
    [
       $row['manhanvien'],
       $row['tennhanvien'],
       $row['ngaysinh'],
       $row['diachi'],
       $row['sodienthoai']
    ] , ';'
    );
}
fclose($output);
exit;
?>