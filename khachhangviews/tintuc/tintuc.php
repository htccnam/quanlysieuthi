<?php
session_start();
include_once("../../views/connectdb.php");


$makhachhang = $_SESSION['makhachhang'];

/* ========== ĐÁNH DẤU ĐÃ ĐỌC ========== */
if (isset($_GET['matintuc'])) {
    $matintuc = $_GET['matintuc'];

    $check = mysqli_query(
        $con,
        "SELECT * FROM tintuc_dadoc 
         WHERE makhachhang='$makhachhang' AND matintuc='$matintuc'"
    );

    if (mysqli_num_rows($check) == 0) {
        mysqli_query(
            $con,
            "INSERT INTO tintuc_dadoc(makhachhang, matintuc)
             VALUES('$makhachhang','$matintuc')"
        );
    }

    header("location:tintuc_khachhang.php");
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

    header("location:tintuc_khachhang.php");
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
    <title>Tin tức</title>
    <link rel="stylesheet" href="../../css/themsuaxoatimkiem.css">
    <style>
        .chua-doc {
            font-weight: bold;
            color: red;
        }

        .da-doc {
            color: gray;
        }

        .btn-doc {
            padding: 5px 10px;
        }
    </style>
</head>

<body>

    <h2>📰 TIN TỨC</h2>

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
                            <a class="btn-doc" href="tintuc.php?doc=<?= $row['matintuc'] ?>">
                                ✔ Đánh dấu đã đọc
                            </a>
                        <?php } else { ?>
                            <a class="btn-doc" href="tintuc.php?chuadoc=<?= $row['matintuc'] ?>"
                                onclick="return confirm('Đánh dấu lại là chưa đọc?')">
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