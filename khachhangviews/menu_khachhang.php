<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ SIÊU THỊ</title>

    <!-- link phông chữ -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/menu.css">

    <!-- add phông chữ -->
    <style>
        html,
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body>

    <div>
        <header>
            <div class="logo">
                <a href="../views/logo.php" target="contentFrame">SIÊU THỊ</a>
            </div>

            <li><a href="tintuc/tintuc.php" target="contentFrame">📰 Tin tức</a></li>

            <li>
                <button onclick="if(confirm('Bạn có chắc muốn đăng xuất?')){window.location='http://localhost/quanlysieuthi/views/login.php';}"
                    style="color: #ff6b6b; font-weight: bold;">
                    Đăng xuất ➜
                </button>
            </li>
            </ul>
        </header>
    </div>

    <!-- THẺ DIV ĐỂ CHỨA NỘI DUNG -->
    <div style="height: 750px; ">
        <iframe name="contentFrame" style="width:100%; height:100%; border:none;">
        </iframe>
    </div>

</body>

</html>