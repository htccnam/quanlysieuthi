<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU</title>
    <link rel="stylesheet" href="menu.css">
</head>

<body>
    <header>
        <div class="logo">
            Trang chủ
        </div>
        <ul class="menu">
            <li><a href="">giới thiệu</a>
                <ul>
                    <li><a href="#" onclick="loadContent('intro.php', 'content-wrapper')">quản lý nhân viên</a></li>
                    <li><a href="">thêm nhân viên</a></li>
                </ul>
            </li>
            <li><a href="">quản lý</a></li>
            <li><a href="">nhân viên</a></li>
            <li><a href="">khách hàng</a></li>
        </ul>
    </header>
    <!-- THẺ DIV ĐỂ CHỨA NỘI DUNG -->
    <div id="contentArea" class="content-area">
        <div class="content-wrapper" id="content-wrapper">
            <p>Chọn một mục từ menu để hiển thị nội dung</p>
        </div>
    </div>

    <script>
        function loadContent(file, targetDivId) {
            const targetDiv = document.getElementById(targetDivId);

            // Hiển thị loading
            targetDiv.innerHTML = '<p>Đang tải...</p>';

            // Dùng fetch để load nội dung PHP và đổ vào div
            fetch(file)
                .then(response => response.text())
                .then(data => {
                    targetDiv.innerHTML = data;
                })
                .catch(error => {
                    targetDiv.innerHTML = '<p>Lỗi khi tải nội dung: ' + error + '</p>';
                });
        }
    </script>
</body>

</html>