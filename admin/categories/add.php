<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/function/function.php");
if (!isset($_SESSION[USE_ID])){
    $url = "http://localhost:1008/home/login.php";
    header('Location:'.$url);
}
if (isset($_POST[CAT_DESCRIPTION]) && isset($_POST[CAT_NAME]) ){
    $name = getValue(CAT_NAME,STRING,"",POST);
    $rewrite = createRewrite($name);
    $description = getValue(CAT_DESCRIPTION,STRING,"",POST);
    if (!isExistCat($name)){

    $res = insertCat($name,$description,$rewrite);
    if ($res)
        echo '
            <script type="text/javascript">
                alert("Thêm mới thành công.");
                window.location = "/admin/categories";
            </script>
        ';
    else
        echo '
            <script type="text/javascript">
                alert("Thêm mới thất bại,vui lòng thử lại");
            </script>
        ';
    }
    else
        echo '
            <script type="text/javascript">
                alert("Tên categories đã tồn tại.");
            </script>
        ';

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="/css/css_admin.css">
    <script src="/js/jquery-3.2.0.js"></script>
    <script src="/js/js_main.js"></script>
    <link rel="stylesheet" type="text/css" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
    </script>
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
            include($_SERVER['DOCUMENT_ROOT']."/include/inc_add_categories.php");
            ?>

        </div>
    </div>
</div>
            <?php
            include($_SERVER['DOCUMENT_ROOT'] . "/include/inc_footer_admin.php")
            ?>
</body>
</html>