<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 5/19/2017
 * Time: 9:47 AM
 */
$dir = '/uploads/news/';
$new_id = getValue(NEW_ID,INT,0,GET);
$new = getNewById($new_id);
$tags = getAllTagsNew($new_id);
?>
<div id="admin_list">
    <div id="admin_middle_dash">
        <i class="fa fa-home fa-2x flip_horizontal" aria-hidden="true"></i>
        <span>Chỉnh sửa tin tức</span>
    </div>
    <form id="form_add_news" enctype="multipart/form-data" method="post">
        <input type="text" name="new_id" value="<?php echo $new_id?>" hidden>
        <div>
            <p class="title_form">Title <span>*</span></p>
            <textarea  class="input_area" name="new_title" required ><?php echo $new[NEW_TITLE]?></textarea>
            <p id="" class="new_err"></p>
        </div>
        <div>
            <p class="title_form">Description <span>*</span></p>
            <textarea  class="input_area" name="new_description" required ><?php echo $new[NEW_DESCRIPTION]?></textarea>
            <p id="" class="new_err"></p>
        </div>
        <div>
            <p class="title_form">Content <span>*</span></p>
            <textarea required class="input_form" name="new_content" id="input_news_content" ><?php echo $new[NEW_CONTENT]?></textarea>
            <p id="" class="new_err"></p>
            <script>
                CKEDITOR.replace('input_news_content');
            </script>

        </div>

        <div>
            <p class="title_form">Tags <span>*</span></p>

            <?php
            foreach ($tags as $tag){
                echo '
                <div class="insert_tag">
                <input type="text" class="input_form1" name="new_tag[]" required value="'.$tag[TAG_NAME].'">
                <i class="fa fa-times remove_tag" aria-hidden="true" ></i>
            </div>
                ';
            }
            ?>
            <p id="add_tag" onclick="addTag()">Thêm tag</p>
        </div>
        <div id="upload_image_news">
            <img id="img_news" src="<?php echo $dir.'150x150/'.$new[NEW_IMAGE]?>" style="display: block !important;">
            <br><br>
            <input type="file" id="image_new" accept="image/*" hidden name="new_image">
            <label for="image_new" id="label_image_news">Chọn ảnh</label>
            <p id="img_news_err" class="error"></p>
        </div>
        <input type="submit" id="submit_add_news" value="Lưu">
    </form>
</div>