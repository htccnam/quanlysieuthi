<?php
session_start();
session_unset();     // xóa biến session
session_destroy();   // hủy session

header("Location: login.php");
exit();
?>