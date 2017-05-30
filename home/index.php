<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/function/function.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/home/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../css/css_main.css">
    <link rel="stylesheet" type="text/css" href="../css/css_product_view.css">
    <script src="../js/jquery-3.2.0.js"></script>
    <link rel="stylesheet" type="text/css" href="../font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../js/js_main.js"></script>
    <script src="../js/datetime.js"></script>
    <script type="text/javascript">
        function goProducts(id) {
            window.location = "/home/details.php?id="+id;
        }

    </script>
</head>
<body>
<div class="wrapper">
    <?php

    include ("../include/inc_header.php");
    include ("../include/inc_home.php");
    include ("../include/inc_footer.php");
    ?>
</div>
</body>
</html>