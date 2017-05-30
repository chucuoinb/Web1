<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/27/2017
 * Time: 11:42 AM
 */
?>
<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/function/function.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/home/config.php");
if (!isset($_SESSION[USE_ID])) {
    $url = "http://localhost:1008/home/login.php";
    header('Location:' . $url);
}
if (!isset($_GET[TAG_ID])){
    $url = "http://localhost:1008/admin/tags";
    header('Location:' . $url);
}
if (isset($_POST[TAG_ID])){
    $tagId = getValue(TAG_ID,INT,0,POST);
    $tagName = getValue(TAG_NAME,STRING,"",POST);
    if (editTags($tagId,$tagName)){
        echo '
            <script type="text/javascript">
                alert("Chỉnh sửa thành công");
                window.location = "/admin/tags";
            </script>
        ';
    }
    else{
        echo '
            <script type="text/javascript">
                alert("Chỉnh sửa thất bại");
                window.location = "/admin/news";
            </script>
        ';
    }
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
        include($_SERVER['DOCUMENT_ROOT'] . "/include/inc_admin_left.php");
        ?>
        <div id="admin_right">
            <?php
            include($_SERVER['DOCUMENT_ROOT'] . "/include/inc_admin_header.php");
            include($_SERVER['DOCUMENT_ROOT'] . "/include/inc_tags_edit.php");
            ?>

        </div>
    </div>
</div>
</body>
</html>
