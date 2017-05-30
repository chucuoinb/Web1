<?php
$catName = "";
if (isset($_GET[CAT_ID])) {
    $catId = getValue(CAT_ID, INT, 0, GET);
    $listProduct = getListProduct($catId);
    $catName = getNameCat($catId);
} else {
    $listProduct = getAllProductAdmin();

}

?>
<div id="admin_list">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <?php
        if (isset($_GET[CAT_ID]))
            echo '<span><a id="back_categories" href="/admin/categories"> Categories</a> >> ' . $catName . ' </span>';
        else
            echo '<span>List Product</span>';
        ?>

    </div>

    <div class="bt_add" onclick="go_add_products();"><i class="fa fa-plus" aria-hidden="true"></i></div>

    <table class="list" id="list_categories">
        <tr class="title_table">
            <th>ID</th>
            <th>Image</th>
            <th>Categories</th>
            <th>Name</th>
            <th>Price</th>
            <th>Date Create</th>
            <th>Last Update</th>
            <th>Description</th>
            <th>Type</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
        <?php
        if ($listProduct) {
            foreach ($listProduct as $item) {
                $catName = getNameCat($item[CAT_ID]);
                if ($item[PRO_ACTIVE] == '1') {
                    $nameActive1 = "display_active";
                    $nameActive0 = "non_display_active";
                } else {
                    $nameActive0 = "display_active";
                    $nameActive1 = "non_display_active";
                }
                if ($item[PRO_HOT] == 1){
                    $name_hot = "hot";
                    $nam_class_hot = "pro_hot";
                }else{
                    $name_hot = "new";
                    $nam_class_hot = "pro_new";
                }
                $date = new DateTime();
                $date->setTimestamp($item[PRO_CREATE_DATE]);
                $date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
                $date_create = $date->format("H:i:s, d/m/Y");
                if ($item[PRO_LAST_UPDATE] > 0) {
                    $date = new DateTime();
                    $date->setTimestamp($item[PRO_LAST_UPDATE]);
                    $date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
                    $last_update = $date->format("H:i:s, d/m/Y");
                } else
                    $last_update = "";
                echo '
                        <tr>
                        <th>' . $item[PRO_ID] . '</th>
                        <th>
                        <img src="/uploads/pro_image/' . $item[PRO_IMAGE] . '" class="img_pro">
                        </th>
                        <th>' . $catName . '</th>
                        <th><a >' . $item[PRO_NAME] . '</a></th>
                        <th>' . $item[PRO_PRICE] . '</th>
                        <th>' . $date_create . '</th>
                        <th>' . $last_update . '</th>
                        <th>' . $item[PRO_DESCRIPTION] . '</th>
                        <th>
                            <p onclick="pro_type_click('.$item[PRO_ID].');" class="'.$nam_class_hot.' pro_type">'.$name_hot.'</p>
                        </th>
                        <th>
                            <div class="bt_active">
                                <div class="pro_active1 admin_active1 ' . $nameActive1 . '" onclick="pro_active(' . $item[PRO_ID] . ')">
                                <i class="fa fa-check " aria-hidden="true"></i>
                                </div>
                                <div class="pro_active0 admin_active0 ' . $nameActive0 . '" onclick="pro_active(' . $item[PRO_ID] . ')" >
                                <span>active</span>
                                </div>
                           </div>
                        </th>
                        <th>
                            <div class="bt_change">

                                <div class="bt_edit ">
                                <a href="/admin/product/edit.php?pro_id=' . $item[PRO_ID] . '">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                </div>

                                <div class="bt_delete" onclick="deletePro(' . $item[PRO_ID] . ');">
                                     <i class="fa fa-times" aria-hidden="true"></i>
                                </div>
                            </div>
                        </th>
                        </tr>
                    ';
            }
        }
        ?>
    </table>
    <?php
    if (!$listProduct) {
        echo '
                <p id="no_list_categories">Không có sản phẩm nào thuộc categories <span>' . $catName . '</span></p>
                ';
    }
    ?>
</div>