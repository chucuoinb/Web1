<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/home/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/function/function.php");
if (!isset($_SESSION[USE_ID])) {
    $url = "http://localhost:1008/home/login.php";
    header('Location:' . $url);
}
if (isset($_POST[PRO_NAME])) {
    $time_register = new DateTime("now", new DateTimeZone("Asia/Ho_Chi_Minh"));
    $timestamp = $time_register->getTimestamp();
    $pro_image = uploadAvatar($timestamp, PRO_IMAGE,$_SERVER['DOCUMENT_ROOT']."/uploads/pro_image/");
    if ($pro_image) {
        $pro_name = getValue(PRO_NAME, STRING, "", POST);
        $cat_id = getValue(CAT_ID,INT,0,POST);
        $pro_create_date = $timestamp;
        $pro_price = getValue(PRO_PRICE,STRING,"",POST);
        $pro_description = getValue(PRO_DESCRIPTION,STRING,"",POST);
        $pro_rewrite = createRewrite($pro_name);
        $res = addProduct($cat_id,$pro_name,$pro_create_date,$pro_price,$pro_image,$pro_description,
            1,$pro_rewrite);
        if ($res){
            echo '
            <script type="text/javascript">
                alert("Thêm mới thành công.");
                window.location = "/admin/product/index.php?cat_id='.$cat_id.'";
            </script>
        ';
        }
        else
            echo '
            <script type="text/javascript">
                alert("Thêm mới thất bại.");
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
            include($_SERVER['DOCUMENT_ROOT'] . "/include/inc_add_pro.php");
            ?>

        </div>
    </div>
</div>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/include/inc_footer_admin.php")
    ?>
</body>
</html>