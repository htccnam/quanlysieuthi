<?php
session_start();
include_once("../../views/connectdb.php");

// /* ===== KIỂM TRA ĐĂNG NHẬP ===== */
// if (!isset($_SESSION['makhachhang'])) {
//     header("Location: ../dangnhap.php");
//     exit();
// }

$makhachhang = $_SESSION['makhachhang'];

/* ========== ĐÁNH DẤU ĐÃ ĐỌC ========== */
if (isset($_GET['doc'])) {
    $matintuc = $_GET['doc'];

    $check = mysqli_query(
        $con,
        "SELECT * FROM tintuc_dadoc 
         WHERE makhachhang='$makhachhang' 
         AND matintuc='$matintuc'"
    );

    if (mysqli_num_rows($check) == 0) {
        mysqli_query(
            $con,
            "INSERT INTO tintuc_dadoc(makhachhang, matintuc)
             VALUES('$makhachhang','$matintuc')"
        );
    }

    header("Location: tintuc.php");
    exit();
}

/* ========== ĐÁNH DẤU CHƯA ĐỌC ========== */
if (isset($_GET['chuadoc'])) {
    $matintuc = $_GET['chuadoc'];

    mysqli_query(
        $con,
        "DELETE FROM tintuc_dadoc 
         WHERE makhachhang='$makhachhang' 
         AND matintuc='$matintuc'"
    );

    header("Location: tintuc.php");
    exit();
}

/* ========== LẤY DANH SÁCH TIN TỨC + TRẠNG THÁI ĐỌC ========== */
$sql = "
SELECT t.*, 
       IF(d.matintuc IS NULL, 0, 1) AS dadoc
FROM tintuc t
LEFT JOIN tintuc_dadoc d
ON t.matintuc = d.matintuc
AND d.makhachhang = '$makhachhang'
ORDER BY t.ngaydang DESC
";

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tin tức khách hàng</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ccc;
        }
        .chua-doc {
            font-weight: bold;
            color: red;
        }
        .da-doc {
            color: gray;
        }
        .btn-doc {
            display: inline-block;
            padding: 5px 10px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn-doc:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

<h2>📰 DANH SÁCH TIN TỨC</h2>

<table>
    <thead>
        <tr>
            <th>TIÊU ĐỀ</th>
            <th>LOẠI</th>
            <th>NỘI DUNG</th>
            <th>NGÀY ĐĂNG</th>
            <th>TRẠNG THÁI</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>

    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr class="<?= $row['dadoc'] ? 'da-doc' : 'chua-doc' ?>">
                <td><?= $row['tieude'] ?></td>
                <td><?= $row['loaitin'] ?></td>
                <td><?= $row['noidung'] ?></td>
                <td><?= $row['ngaydang'] ?></td>
                <td>
                    <?= $row['dadoc'] ? '✔ Đã đọc' : '❌ Chưa đọc' ?>
                </td>
                <td>
                    <?php if ($row['dadoc'] == 0) { ?>
                        <a class="btn-doc"
                           href="tintuc.php?doc=<?= $row['matintuc'] ?>"
                           onclick="return confirm('Xác nhận đánh dấu ĐÃ ĐỌC?')">
                            ✔ Đánh dấu đã đọc
                        </a>
                    <?php } else { ?>
                        <a class="btn-doc"
                           href="tintuc.php?chuadoc=<?= $row['matintuc'] ?>"
                           onclick="return confirm('Đánh dấu lại là CHƯA ĐỌC?')">
                            ↩ Đánh dấu chưa đọc
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
