<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/19/2017
 * Time: 9:47 AM
 */
$tagId = getValue(TAG_ID,INT,0,GET);
$tagName = getNameTag($tagId);
?>
<div id="admin_list">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <span>Chỉnh sửa tags</span>
    </div>
    <form id="form_edit_tag"  method="post">
        <div>
            <p class="title_form">ID <span>*</span></p>
            <input id="edit_id_tag" type="text" class="input_area" name="tag_id" required readonly value="<?php echo $tagId?>">
        </div>
        <div>
            <p class="title_form">Tag name <span>*</span></p>
            <input type="text" class="input_area" name="tag_name" required value="<?php echo $tagName?>">
        </div>
        <input type="submit" id="submit_edit_tags" class="submit_add" value="Lưu">

    </form>
</div>