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
    <script type="text/javascript">
        function btAddCart(id) {
            var value = $("#number_of_item").val();
            addCart(id, value);
        }

        function changeLarge(id) {
            $("#bt_add_cart").attr("onclick", "btAddCart(" + id + ")");
            var i;
            for (i = 0; i < listProduct.length; i++) {
                if (listProduct[i]["pro_id"] == id){
                    $("#price_item_large").text(listProduct[i]["pro_price"]);
                    $("#img_item_large").attr("src",srcItemBanner+listProduct[i]["pro_image"]);
                }
            }

        }

            function goProducts(id) {
                window.location = "/home/details.php?id="+id;
            }
//            function checkRedirect(num) {
//                if (num > 0)
//                    return true;
//                else{
//                    alert("Thư mụa bạn chọn không có sản phẩm nào");
//                    return false;
//                }
//            }

//
//    </script>
</head>
<body>
<div class="wrapper">
    <?php
    include("../include/inc_header.php");
    include("../include/inc_product_view.php");
    include("../include/inc_footer.php");
    ?>
</div>
</body>
</html>