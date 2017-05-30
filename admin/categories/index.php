<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/function/function.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/home/config.php");
if (!isset($_SESSION[USE_ID])) {
    $url = "http://localhost:1008/home/login.php";
    header('Location:' . $url);
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

        function cat_active(id) {
            $.ajax({
                url: "/php/active.php",
                type: "post",
                dataType: "text",
                data: {
                    cat_id: id
                },
                success: function (result) {
                    var res = JSON.parse(result);
                    if (res["code"] == 200)
                        window.location.reload();
                    else
                        alert(res["message"]);
                }
            });
        }

        function go_add_categories() {
            window.location = "add.php";
        }

        function deleteCat(id) {
            var as = confirm("Xóa?");
            if (as) {
                $.ajax({
                    url: "/php/deleteCat.php",
                    type: "post",
                    dataType: "text",
                    data: {
                        cat_id: id
                    },
                    success: function (result) {
                        var res = JSON.parse(result);
                        alert(res["message"]);
                        if (res["code"] == 200)
                            window.location.reload();
                    }
                });
            }
        }

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
            include($_SERVER['DOCUMENT_ROOT'] . "/include/inc_categories.php");
            ?>

        </div>
    </div>
</div>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/include/inc_footer_admin.php")
    ?>
</body>
</html>