<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/function/function.php");
if (!isset($_SESSION[USE_ID])){
    $url = "http://localhost:1008/home/login.php";
    echo 123;
    header('Location:'.$url);
}
if (isset($_POST[CAT_DESCRIPTION]) && isset($_POST[CAT_NAME]) && isset($_POST[CAT_ID])) {
    $name = getValue(CAT_NAME, STRING, "", POST);
    $rewrite = createRewrite($name);
    $description = getValue(CAT_DESCRIPTION, STRING, "", POST);
    $id = getValue(CAT_ID,INT,0,POST);
    $res = updateCat($name, $description, $rewrite,$id);
    if ($res)
        echo '
            <script type="text/javascript">
                alert("ChỈnh sửa thành công.");
                window.location = "/admin/categories";
            </script>
        ';
    else
        echo '
            <script type="text/javascript">
                alert("Chỉnh sửa thất bại,vui lòng thử lại");
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
            include($_SERVER['DOCUMENT_ROOT']."/include/inc_edit_cat.php");
            ?>

        </div>
    </div>
</div>
    <?php
    include ($_SERVER['DOCUMENT_ROOT']."/include/inc_footer_admin.php")
    ?>
</body>
</html>