<?php
    $listTag = getListTag();
?>
<div id="admin_list">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <span>List User</span>
    </div>
    <table class="list">
        <tr class="title_table">
            <th>Id</th>
            <th>Name Tag</th>
            <th>Action</th>
        </tr>
        <?php
            foreach ($listTag as $tag){
                echo '
                <tr>
                <th>'.$tag[TAG_ID].'</th>
                <th>'.$tag[TAG_NAME].'</th>
                <th>
                    <div class="bt_change">

                        <div class="bt_edit ">
                             <a href="/admin/tags/edit.php?tag_id=' . $tag[TAG_ID] . '">
                             <i class="fa fa-pencil" aria-hidden="true"></i>
                             </a>
                         </div>

                         <div class="bt_delete" onclick="deleteTags(' . $tag[TAG_ID] . ');">
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

</div>