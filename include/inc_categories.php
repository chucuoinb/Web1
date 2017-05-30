<?php
$listCategories = getListCategories();
?>
<div id="admin_list">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <span>List Categories</span>
    </div>

    <div class="bt_add" onclick="go_add_categories();"><i class="fa fa-plus" aria-hidden="true"></i></div>

    <table class="list" id="list_categories">
        <tr class="title_table">
            <th>ID</th>
            <th>Name</th>
            <th>Date Create</th>
            <th>Last Update</th>
            <th>Description</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
        <?php
        if ($listCategories) {
            foreach ($listCategories as $item) {
                if ($item[CAT_ACTIVE] == '1') {
                    $nameActive1 = "display_active";
                    $nameActive0 = "non_display_active";
                } else {
                    $nameActive0 = "display_active";
                    $nameActive1 = "non_display_active";
                }
                if ($item[CAT_LAST_UPDATE] > 0) {
                    $date = new DateTime();
                    $date->setTimestamp($item[CAT_LAST_UPDATE]);
                    $date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
                    $last_update = $date->format("H:i:s, d/m/Y");
                } else
                    $last_update = "";
                if ($item[CAT_CREATE_DATE] > 0) {
                    $date = new DateTime();
                    $date->setTimestamp($item[CAT_CREATE_DATE]);
                    $date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
                    $create_time = $date->format("H:i:s, d/m/Y");
                } else
                    $create_time = "";
                echo '
                        <tr>
                        <th class="name_cat"><a href="/admin/product?cat_id='.$item[CAT_ID].'">' . $item[CAT_ID] . '</a></th>
                        <th class="name_cat"><a href="/admin/product?cat_id='.$item[CAT_ID].'">' . $item[CAT_NAME] . '</a></th>
                        <th>' . $create_time . '</th>
                        <th>' . $last_update . '</th>
                        <th>' . $item[CAT_DESCRIPTION] . '</th>
                        <th>
                            <div class="bt_active">
                                <div class="cat_active1 admin_active1 ' . $nameActive1 . '" onclick="cat_active(' . $item[CAT_ID] . ')">
                                <i class="fa fa-check " aria-hidden="true"></i>
                                </div>
                                <div class="cat_active0 admin_active0 ' . $nameActive0 . '" onclick="cat_active(' . $item[CAT_ID] . ')" >
                                <span>active</span>
                                </div>
                           </div>
                        </th>
                        <th>
                            <div class="bt_change">
                            
                                <div class="bt_edit ">
                                <a href="/admin/categories/edit.php?cat_id=' . $item[CAT_ID] . '">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                </div>
                            
                                <div class="bt_delete" onclick="deleteCat('.$item[CAT_ID].')">
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
    if (!$listCategories) {
        echo '
                <p id="no_list_categories">Không có thư mục nào</p>
                ';
    }
    ?>
</div>