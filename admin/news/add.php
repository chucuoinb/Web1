<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT']."/home/config.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/function/function.php");
if (!isset($_SESSION[USE_ID])){
    $url = "http://localhost:1008/home/login.php";
    header('Location:'.$url);

}
$defaultArray = array();
if (isset($_POST[NEW_TITLE])){
    $new_title = getValue(NEW_TITLE,STRING,"",POST);
    $new_description = getValue(NEW_DESCRIPTION,STRING,"",POST);
    $new_content = getValue(NEW_CONTENT,STRING,"",POST);
    $new_image = uploadAvatar(time(),NEW_IMAGE,$_SERVER['DOCUMENT_ROOT']."/uploads/news/");
    $new_tag = (isset($_POST[NEW_TAG]))?$_POST[NEW_TAG]:$defaultArray;
    $new_tag = array_unique( $new_tag );
    if ($new_image){
        $res = storeNews($new_title, $new_description, $new_content, $new_image,$new_tag);
        if(!$res){
            echo '
            <script type="text/javascript">
                alert("Thêm mới thất bại, vui lòng thử lại");
            </script>
            ';
        }
        else{
            echo '
            <script type="text/javascript">
                alert("Thêm mới thành công");
                window.location = "/admin/news";
            </script>
            ';
        }
    }
    else{
        echo '
            <script type="text/javascript">
                alert("Thêm mới thất bại, vui lòng thử lại");
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
    <link rel="stylesheet" type="text/css" href="/css/css_main.css">
    <script src="/js/jquery-3.2.0.js"></script>
    <script src="/js/js_main.js"></script>
    <script src="/ckeditor/ckeditor.js" type="text/javascript">

    </script>
    <script type="text/javascript">
        function addTag(index) {
            $("#add_tag").before(
                '<div class="insert_tag">' +
                '<input type="text" class="input_form1" name="new_tag[]' +
                '" required>' +
                ' <i class="fa fa-times remove_tag" aria-hidden="true" ></i>' +
                '</div>'
            )
        }
    </script>
    <link rel="stylesheet" type="text/css" href="/font-awesome-4.7.0/css/font-awesome.min.css">
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
            include($_SERVER['DOCUMENT_ROOT']."/include/inc_news_add.php");
            ?>

        </div>
    </div>
</div>
<?php
include ($_SERVER['DOCUMENT_ROOT']."/include/inc_footer_admin.php")
?>
</body>
</html>