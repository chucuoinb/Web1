<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/18/2017
 * Time: 11:39 AM
 */
$list = getAllNews();
$dir = '/uploads/news/'
?>
<div id="admin_list">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <span>Tin tức</span>
    </div>
    <div class="bt_add" onclick="go_add_news();"><i class="fa fa-plus" aria-hidden="true"></i></div>

    <table class="list">
        <tr class="title_table">
            <th>Image</th>
            <th>Id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Tags</th>
            <th>Time Create</th>
            <th>Last update</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
        <?php
         foreach ($list as $item){
             if ($item[NEW_ACTIVE] == '1') {
                 $nameActive1 = "display_active";
                 $nameActive0 = "non_display_active";
             } else {
                 $nameActive0 = "display_active";
                 $nameActive1 = "non_display_active";
             }
             $date = new DateTime();
             $date->setTimestamp($item[NEW_TIME_CREATE]);
             $date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
             $date_create = $date->format("H:i:s, d/m/Y");
             if ($item[NEW_LAST_UPDATE] > 0) {
                 $date = new DateTime();
                 $date->setTimestamp($item[NEW_LAST_UPDATE]);
                 $date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
                 $last_update = $date->format("H:i:s, d/m/Y");
             } else
                 $last_update = "";
             $tags = getAllTagsNew($item[NEW_ID]);
             $listTags = "";
             for ($i = 0;$i<count($tags);$i++){
                 $listTags = $listTags.$tags[$i][TAG_NAME];
                 if ($i != count($tags)-1)
                     $listTags = $listTags." , ";
             }
             echo '
            <tr>
            <th>
                <img class="img_list_new" src="'.$dir.$item[NEW_IMAGE].'" alt="">
            </th>

             <th>'.$item[NEW_ID].'</th>
             <th>'.$item[NEW_TITLE].'</th>
             <th>'.$item[NEW_DESCRIPTION].'</th>
             <th>'.$listTags.'</th>
             <th>'.$date_create.'</th>
             <th>'.$last_update.'</th>
             <th>
                <div class="bt_active">
                    <div class="pro_active1 admin_active1 ' . $nameActive1 . '" onclick="add_active(' . $item[NEW_ID] . ')">
                    <i class="fa fa-check " aria-hidden="true"></i>
                    </div>
                    <div class="pro_active0 admin_active0 ' . $nameActive0 . '" onclick="add_active(' . $item[NEW_ID] . ')" >
                    <span>active</span>
                    </div>
                </div> 
            </th>
            <th>
                <div class="bt_change">
                    <div class="bt_edit ">
                        <a href="/admin/news/edit.php?new_id=' . $item[NEW_ID] . '">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    </div>

                    <div class="bt_delete" onclick="deleteNews(' . $item[NEW_ID] . ');">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </div>
                </div>
            </th>
            </tr>
             ';
         }
        ?>
    </table>
</div>
