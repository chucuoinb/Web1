<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/function/function.php");
if (!isset($_SESSION[USE_ID])){
    $url = "http://localhost:1008/home/login.php";
    header('Location:'.$url);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/css_admin.css">
    <script src="../js/jquery-3.2.0.js"></script>
    <script src="../js/js_main.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
//            getAdminData();
        })
    </script>
    <link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="wrapper">
    <div id="admin_content">
        <?php
        include ($_SERVER['DOCUMENT_ROOT']."/include/inc_admin_left.php");
        ?>
        <div id="admin_right">
            <?php
            include ($_SERVER['DOCUMENT_ROOT']."/include/inc_admin_header.php");
            include($_SERVER['DOCUMENT_ROOT']."/include/inc_dashboard.php");
            ?>

        </div>
    </div>
</div>
    <?php
    include ("../include/inc_footer_admin.php")
    ?>
</body>
</html>