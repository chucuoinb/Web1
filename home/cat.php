<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/function/function.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/home/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product</title>
    <link rel="stylesheet" type="text/css" href="/css/css_main.css">
    <link rel="stylesheet" type="text/css" href="/css/css_product_view.css">
    <link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../js/jquery-3.2.0.js"></script>
    <script src="../js/js_main.js"></script>
    <script src="../js/datetime.js"></script>
</head>
<body>
<div class="wrapper">
    <?php
    include("../include/inc_header.php");
    include("../include/inc_page_cat.php");
    include("../include/inc_footer.php");
    ?>
</div>
</body>
</html>