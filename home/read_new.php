<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/26/2017
 * Time: 8:59 AM
 */
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/function/function.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/home/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Tin tức</title>
    <link rel="stylesheet" type="text/css" href="/css/css_main.css">
    <link rel="stylesheet" type="text/css" href="/css/css_register.css">
    <script src="/js/jquery-3.2.0.js"></script>
    <link rel="stylesheet" type="text/css" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="/js/js_main.js"></script>
    <script src="/js/datetime.js"></script>
</head>
<body>
<div class="wrapper">
    <?php
    include ($_SERVER['DOCUMENT_ROOT']."/include/inc_header.php");
    include ($_SERVER['DOCUMENT_ROOT']."/include/inc_read_news.php");
    include ($_SERVER['DOCUMENT_ROOT']."/include/inc_footer.php");
    ?>
</div>
</body>
</html>
