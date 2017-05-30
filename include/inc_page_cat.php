<?php
$dir = "/uploads/pro_image/";
$id_cat = 0;
$page_number = 1;
$numberPage = 0;
$list = array();
$numberOfPro = 0;
$numRow = 0;
$name = "";
if (isset($_GET[CAT_ID])) {
    $id_cat = getValue(CAT_ID, INT, 0, GET);
    $page_number = getValue("page", INT, 1, GET);
    $numberPage = getNumberPageProduct($id_cat);
    if ($page_number <= 0)
        $page_number = 1;
    else
        if ($page_number > $numberPage)
            $page_number = $numberPage;
    $list = getListProductByPage($id_cat, $page_number);
    $numberOfPro = count($list);
    $numRow = ceil($numberOfPro / NUMBER_COL);
}
if (isset($_GET["search"])) {
    $name = getValue("search", STRING, "", GET);
    $page_number = getValue("page", INT, 1, GET);
    $textSearch = createRewrite($name);
    $list = searchProduct($textSearch, $page_number);
    $numberPage = getNumberPageSearch($textSearch);
    if ($page_number <= 0)
        $page_number = 1;
    else
        if ($page_number > $numberPage)
            $page_number = $numberPage;
    $numberOfPro = count($list);
    $numRow = ceil($numberOfPro / NUMBER_COL);
}
?>
<div id="product_view">
    <div class="container">

        <div id="title_product">
            <ul>
                <li><a>Home</a></li>
                <li> ></li>
                <li><a>Category</a></li>
                <li> ></li>
                <li><a>This page</a></li>
            </ul>
        </div>
        <div id="content_product">
            <?php
            include($_SERVER['DOCUMENT_ROOT'] . "/include/inc_left_product.php");

            ?>
            <div id="right_cat">
                <?php
                if (isset($_GET[CAT_ID]))
                    echo '<p class="title_content_product">' . getNameCat($id_cat) . '</p>';
                if (isset($_GET["search"])) {
                    if ($numberOfPro > 0)
                        echo '<p class="title_content_product">Kết quả tìm kiếm cho "' . $name . '"</p>';
                    else
                        echo '<p class="title_content_product">Không tìm thấy kết quả cho "' . $name . '"</p>';
                }
                for ($i = 1; $i <= $numRow; $i++) {
                    echo '<div class="page_product">';
                    for ($j = 1; $j <= getNumColOfRow($numberOfPro, $i, $numRow); $j++) {
                        $index = ($i - 1) * NUMBER_COL + $j - 1;
                        echo '
                        <a href="/home/details.php?id=' . $list[$index][PRO_ID] . '">
                            <div class="page_cat_item col' . $j . '">
                            <div class="page_img">
                                <img src="' . $dir . $list[$index][PRO_IMAGE] . '" alt="" class="center">
                            </div>
                            <div class="page_des">
                                <span class="page_name">' . $list[$index][PRO_NAME] . '</span>
                                <span class="page_price">' . number_format($list[$index][PRO_PRICE], 0, "", ".") . ' VNĐ</span>
                            </div>
                            </div>
                        </a>
                        ';
                    }
                    echo '</div>';
                }
                if ($numberPage > 0)
                    echo '
                <div class="cat_choose_page">
                <span>Page: </span>
                <ul class="menu_page">';
                for ($i = 1; $i <= $numberPage; $i++) {
                    $go = "";
                    if (isset($_GET[CAT_ID]))
                        $go = '/home/cat.php?cat_id=' . $id_cat . '&page=' . $i;
                    if (isset($_GET["search"]))
                        $go = '/home/cat.php?search=' . $name . '&page=' . $i;
                    if ($i == $page_number)
                        $class = "choose";
                    else
                        $class = "";
                    echo '<li><a class="' . $class . '" href="' . $go . '">' . $i . '</a></li>';
                }
                echo '
                </ul>
            </div>
                ';
                if (isset($_GET["search"]) && $numberOfPro > 0) {
                    echo '
                    <div class="tag_search">
                    <span>Tags:</span>
                    <ul id="menu_tag">
                    ';
                    $listWord = explode(" ", $name);
                    for ($i = 0; $i < count($listWord); $i++) {
                        echo '
                        <li><a href="/home/cat.php?search=' . $listWord[$i] . '">' . $listWord[$i] . '</a></li>
                        ';
                        if ($i < count($listWord) - 1)
                            echo '<li>,</li>';
                    }
                    echo '</ul>
                        </div>';
                }
                ?>


            </div>

        </div>
    </div>
</div>